<?php

namespace App\Http\Controllers;

use App\Models\Food; //model untuk tabel foods
use Illuminate\Http\Request; //object request dari form
use Illuminate\Support\Facades\Storage; //untuk manage file di storage

/**
 * FoodController
 *
 * Controller untuk mengelola data makanan (CRUD).
 * Hanya bisa diakses oleh admin yang sudah login.
 */
class FoodController extends Controller
{
     /**
     * Tampilkan daftar semua makanan.
     * Method ini dipanggil saat admin buka /admin/foods
     */
    public function index()
    
    {
        //ambil data foods, urutkan dari terbaru, 10 data per halaman
        $foods = Food::latest()->paginate(10);
        // kirim data $foods ke view admin/foods/index.blade.php
        return view('admin.foods.index', compact('foods'));
    }

     /**
     * Tampilkan form untuk menambah makanan baru.
     */
    public function create()
    {
        //tampilkan view form tambah
        return view('admin.foods.create');
    }

    /**
     * Simpan data makanan baru ke database.
     * Dipanggil saat user submit form tambah.
     */
    public function store(Request $request)
    {
        //validasi input dari form
        $request->validate([
            'name' => 'required|string|max:255', //wajib teks
            'category' => 'required|in:Makanan,Minuman,Cemilan', //harus salah satu dari 3 kategori
            'price' => 'required|numeric|min:0', //wajib angka
            'description' => 'required|string', //wajib teks
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', //gambar produk, opsional
        ]);

        // default: tidak ada gambar
        $imagePath = null;
        // kalau user upload gambar
        if ($request->hasFile('image')) {
            // simpan gambar ke storage/app/public/foods/
            $imagePath = $request->file('image')->store('foods', 'public');
        }

        // simpan data makanan ke database
        Food::create([
            'name' => $request->name,
            'category' => $request->category,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        // redirect ke halaman i ndex dengan pesan sukses
        return redirect()->route('foods.index')->with('success', 'Data makanan berhasil ditambahkan!');
    }

    /**
     * Tampilkan form edit untuk makanan tertentu.
     * Route Model Binding: Laravel otomatis cari Food berdasarkan ID di URL.
     */
    public function edit(Food $food)
    {
        // kirim data $foods ke view form edit
        return view('admin.foods.edit', compact('food'));
    }

     /**
     * Update data makanan yang sudah ada.
     */
    public function update(Request $request, Food $food)
    {
        // validasi input seperti store
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:Makanan,Minuman,Cemilan',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        //default:pakai gambar lama
        $imagePath = $food->image;

        //user upload gambar baru
        if ($request->hasFile('image')) {
            // hapus gambar lama dari storage
            if ($food->image && Storage::disk('public')->exists($food->image)) {
                Storage::disk('public')->delete($food->image);
            }
            // simpan gambar baru
            $imagePath = $request->file('image')->store('foods', 'public');
        }

        // update data di database
        $food->update([
            'name' => $request->name,
            'category' => $request->category,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        // redirect dengan pesan sukses
        return redirect()->route('foods.index')->with('success', 'Data makanan berhasil diperbarui!');
    }

    /**
     * Hapus data makanan dari database.
     */
    public function destroy(Food $food)
    {
        if ($food->image && Storage::disk('public')->exists($food->image)) {
            Storage::disk('public')->delete($food->image);
        }
        // hapus data dari database
        $food->delete();
        // redirect dengan pesan sukses
        return redirect()->route('foods.index')->with('success', 'Data makanan berhasil dihapus!');
    }
}