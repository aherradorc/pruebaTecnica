<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Rate;
use App\Models\Product;
use Illuminate\Http\Request;

class RateController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $validated = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'price' => 'required|numeric|min:0',
        ]);

        $product->rates()->create($validated);

        return redirect()->route('products.show', $product)->with('success', 'Tarifa añadida');
    }

    public function update(Request $request, Rate $rate)
    {
        $validated = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'price' => 'required|numeric|min:0',
        ]);

        $rate->update($validated);

        return redirect()->route('products.show', $rate->product_id)->with('success', 'Tarifa actualizada');
    }

    public function destroy(Rate $rate)
    {
        $productId = $rate->product_id;
        $rate->delete();

        return redirect()->route('products.show', $productId)->with('success', 'Tarifa eliminada');
    }
}
