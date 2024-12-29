<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with('menus')->get();
        $successMessage = session('success'); // Pesan sukses dari session
        return view('categories.category-list', compact('categories', 'successMessage'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create-category', [
            'type' => 'danger'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:4096',
        ]);

        // Menyiapkan data input untuk disimpan
        $input = $validatedData;

        // Menyimpan gambar dengan Storage
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . '-' . $image->getClientOriginalName();
            $image->move(public_path('storage/image'), $image_name);
            $input['image'] = $image_name;
        }

        // Menyimpan menu ke dalam database
        Category::create($input);

        // Menambahkan flash message untuk pesan sukses
        session()->flash('success', 'Kategori Baru Berhasil Ditambahkan');

        // Redirect ke halaman daftar menu dengan pesan sukses
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categories.edit-category', [
            'type' => 'danger'
        ], compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
        ]);

        $input = $validatedData;

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
        $category->update($input);

        return redirect()->route('categories')->with('success', 'Kategory Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
