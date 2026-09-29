<?php

namespace App\Http\Controllers;

use App\Models\Food; //model makanan
use App\Models\Order; // model pesanan
use App\Models\OrderDetail; // model detail pesanan
use Illuminate\Http\Request; // object request
use Illuminate\Support\Facades\DB; //facade untuk query & transaction

/**
 * OrderController
 *
 * Controller untuk mengelola pesanan makanan.
 * Handle katalog menu (customer) & rekap pesanan (admin).
 */
class OrderController extends Controller
{
    /**
     * Halaman katalog menu pelanggan.
     */
    public function index()
    {
        // ambil semua makanan 
        $foods = Food::latest()->get();
        // tampilkan view customer/index.blade.php
        return view('customer.index', compact('foods'));
    }

    /**
     * Simpan pesanan dari form customer.
     */
    public function store(Request $request)
    {
        // validasi input dari form customer
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'table_number' => 'required',
            'items' => 'required|array',
        ]);
        
        // filter item yang qty-nya > 0 saja
        // $request ->items format: [food_id => quantity]
        $items = collect($request->items)->filter(fn ($qty) => (int) $qty > 0);
        // kalau customer tidak pilih menu apapun
        if ($items->isEmpty()) {
            return back()->with('error', 'Pilih minimal 1 menu dengan jumlah lebih dari 0!');
        }

        // mulai database
        DB::beginTransaction();
        try {
            $total = 0; // total harga pesanan
            $details = []; // array untuk simpan detail pesanan

            // loop setiap item yang dipesan
            foreach ($items as $foodId => $qty) {
                // cari data makanan berdasarkan ID
                $food = Food::find($foodId);
                if (!$food) continue;

                // hitung subtotal = harga x jumlah
                $subtotal = $food->price * (int) $qty;
                $total += $subtotal;

                // simpan detail ke array sementara
                $details[] = [
                    'food_id' => $food->id,
                    'quantity' => (int) $qty,
                    'subtotal' => $subtotal,
                ];
            }

            // 1. simpan ke tabel orders 
            $order = Order::create([
                'customer_name' => $request->customer_name,
                'table_number' => $request->table_number,
                'total_price' => $total,
                'status' => 'Pending', // status
            ]);

            // 2. simpan detail pesanan ke tabel order_details
            foreach ($details as $d) {
                $d['order_id'] = $order->id; // set foreign key
                OrderDetail::create($d);
            }

            // commit
            DB::commit();
            // redirect dengan pesan sukses + kode pesanan
            return redirect()->route('customer.index')->with('success', 'Pesanan berhasil dikirim! Kode: #' . $order->id);
        } catch (\Exception $e) {
            // rollback: ada error, batalkan semua perubahan
            DB::rollBack();
            return back()->with('error', 'Gagal: ' . $e->getMessage());
        }
    }

    /**
     * Dashboard admin — rekap pesanan masuk.
     */
    public function adminDashboard()
    {
        // with('orderDetails.food')
        // ambil semua data yang dibutuhkan
        $orders = Order::with('orderDetails.food')->latest()->get();
        // tampilkan view dashboard.blade.php
        return view('dashboard', compact('orders'));
    }

    /**
     * Update status pesanan.
     */
    public function updateStatus(Request $request, $id)
    {
        // validasi input status
        $request->validate([
            'status' => 'required|in:Pending,Diproses,Selesai',
        ]);

        // cari order by ID, kalau tidak ada = 404
        $order = Order::findOrFail($id);
        // update kolom status aja
        $order->update(['status' => $request->status]);
        // balik ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Status pesanan #' . $order->id . ' berhasil diubah menjadi ' . $request->status);
    }
}