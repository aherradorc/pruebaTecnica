<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Reminder;

class ReminderController extends Controller
{
    public function index()
    {
        return view('calendar.index');
    }
    
    public function create()
    {
        $products = Product::all();
        return view('reminders.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'date' => 'required|date',
            'units' => 'required|integer|min:1',
        ]);

        $product = Product::find($validated['product_id']);
        $rate = $product->rates()
            ->whereDate('start_date', '<=', $validated['date'])
            ->whereDate('end_date', '>=', $validated['date'])
            ->first();

        if (!$rate) {
            return back()->withErrors(['date' => 'No hay tarifa válida para la fecha seleccionada.'])->withInput();
        }

        Reminder::create([
            'product_id' => $validated['product_id'],
            'date' => $validated['date'],
            'units' => $validated['units'],
            'price' => $rate->price,
        ]);

        return redirect()->route('calendar.index')->with('success', 'Recordatorio creado');
    }

    public function events()
    {
        $reminders = \App\Models\Reminder::with('product')->get();

        $events = $reminders->map(function ($reminder) {
            $cost = number_format($reminder->price, 2);

            return [
                'title' => "{$reminder->product->name} (x{$reminder->units}) - {$cost} €",
                'start' => $reminder->date->format('Y-m-d'),
                'url' => route('products.show', $reminder->product_id),
            ];
        });

        return response()->json($events);
    }
}
