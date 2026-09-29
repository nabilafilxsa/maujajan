<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Tampilkan daftar menu untuk customer, dengan filter kategori.
     */
    public function index(Request $request)
    {
        $category = $request->get('category');

        $query = Food::query();
        if ($category && in_array($category, ['Makanan', 'Minuman', 'Cemilan'])) {
            $query->where('category', $category);
        }

        $foods = $query->latest()->get();
        $categories = ['Makanan', 'Minuman', 'Cemilan'];

        return view('home', compact('foods', 'categories', 'category'));
    }

    /**
     * Detail satu menu.
     */
    public function show(Food $food)
    {
        return view('menu-show', compact('food'));
    }
}