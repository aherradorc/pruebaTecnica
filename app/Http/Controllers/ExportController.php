<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ExportController extends Controller
{
    public function exportCategoriesPDF()
    {
        $categories = \App\Models\Category::with('parent')->get();

        $pdf = Pdf::loadView('exports.categories', compact('categories'));
        return $pdf->download('categorias.pdf');
    }

    public function exportProductsPDF()
    {
        $products = \App\Models\Product::with('categories')->get();

        $pdf = Pdf::loadView('exports.products', compact('products'));
        return $pdf->download('productos.pdf');
    }
}
