<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('categories')->paginate(10);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.form', [
            'product' => new Product(),
            'categories' => $categories,
            'action' => route('products.store'),
            'method' => 'POST',
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|unique:products',
            'name' => 'required',
            'description' => 'nullable',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'categories' => 'array|exists:categories,id',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('products', 'public');
            $validated['photo'] = 'storage/' . $validated['photo'];
        }

        $product = Product::create($validated);
        $product->categories()->attach($validated['categories'] ?? []);

        return redirect()->route('products.index')->with('success', 'Producto creado');
    }

    public function show($id)
    {
        $product = Product::with(['categories', 'rates'])->findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.form', [
            'product' => $product,
            'categories' => $categories,
            'action' => route('products.update', $product),
            'method' => 'PUT',
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'code' => 'required|unique:products,code,' . $product->id,
            'name' => 'required',
            'description' => 'nullable',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'categories' => 'array|exists:categories,id',
        ]);

        if ($request->hasFile('photo')) {
            // Removes the img if exists
            if ($product->photo && file_exists(public_path($product->photo))) {
                unlink(public_path($product->photo));
            }

            // Saves the new one
            $validated['photo'] = $request->file('photo')->store('products', 'public');
            $validated['photo'] = 'storage/' . $validated['photo'];
        }


        $product->update($validated);
        $product->categories()->sync($validated['categories'] ?? []);

        return redirect()->route('products.index')->with('success', 'Producto actualizado');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Producto eliminado');
    }

    public function removePhoto(Product $product)
    {
        if ($product->photo && file_exists(public_path($product->photo))) {
            unlink(public_path($product->photo));
        }

        $product->update(['photo' => null]);

        return redirect()->back()->with('success', 'Foto eliminada correctamente.');
    }
}
