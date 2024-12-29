<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Category;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $menus = Menu::all();
        $menus = Menu::with('category')->where('status', '=', 'tersedia')->get();
        $successMessage = session('success'); // Pesan sukses dari session
        return view('menus.menu-list', compact('menus', 'successMessage'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('menus.create-menu', [
            'type' => 'danger'
        ], compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:4096',
        ]);

        // Tentukan status berdasarkan stok
        $status = ($validatedData['stock'] > 0) ? 'tersedia' : 'habis';

        // Menyimpan gambar
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . '-' . $image->getClientOriginalName();
            $image->move(public_path('storage/image'), $image_name);
            $validatedData['image'] = $image_name;
        }

        // Menambahkan status ke data yang akan disimpan
        $validatedData['status'] = $status;

        // Menyimpan menu ke dalam database
        Menu::create($validatedData);

        // Menambahkan flash message untuk pesan sukses
        session()->flash('success', 'Menu Baru Berhasil Ditambahkan');

        // Redirect ke halaman daftar menu dengan pesan sukses
        return redirect()->route('menus.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(Menu $menu)
    // {
    //     //
    // }

    public function edit(Menu $menu)
    {
        $categories = Category::all();
        return view('menus.edit-menu', [
            'type' => 'danger'
        ], compact('menu', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu)
    {
        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|in:makanan,minuman',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'required|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
        ]);

        // Tentukan status berdasarkan stok
        $status = ($validatedData['stock'] > 0) ? 'tersedia' : 'habis';
        $input = $validatedData;
        $input['status'] = $status;

        // Perbarui gambar jika ada file baru yang diunggah
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($menu->image) {
                unlink(public_path('storage/image/' . $menu->image));
            }
            // Simpan gambar baru
            $image = $request->file('image');
            $image_name = time() . '-' . $image->getClientOriginalName();
            $image->move(public_path('storage/image'), $image_name);
            $input['image'] = $image_name;
        }

        // Update data menu di database
        $menu->update($input);

        return redirect()->route('menus')->with('success', 'Menu Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        // Hapus gambar dari direktori jika ada
        if ($menu->image) {
            unlink(public_path('storage/image/' . $menu->image));
        }

        // Hapus menu dari database
        $menu->delete();
        return redirect()->route('menus')->with('successdelete', 'Menu Berhasil Dihapus');
    }

    public function pos()
    {
        $categories = Category::with('menus')->get();
        return view('cashier.pos', compact('categories'));
    }
}
