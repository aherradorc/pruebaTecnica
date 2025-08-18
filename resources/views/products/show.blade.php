<x-app-layout>
    <x-slot name="header">
        <h2 class="h4">Detalle del producto: {{ $product->name }}</h2>
    </x-slot>
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-4">
                @if($product->photo)
                    <img src="{{ asset($product->photo) }}" class="img-fluid rounded">
                @else
                    <span class="text-muted">Sin imagen</span>
                @endif
            </div>
            <div class="col-md-8">
                <p><strong>Código:</strong> {{ $product->code }}</p>
                <p><strong>Nombre:</strong> {{ $product->name }}</p>
                <p><strong>Categorías:</strong>
                    @foreach($product->categories as $cat)
                        <span class="badge bg-secondary">{{ $cat->name }}</span>
                    @endforeach
                </p>
                <p><strong>Descripción:</strong> {{ $product->description }}</p>
            </div>
        </div>

        <h4 class="h4">Tarifas asignadas</h4>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Desde</th>
                    <th>Hasta</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($product->rates as $rate)
                    <tr>
                        <form action="{{ route('rates.update', $rate) }}" method="POST">
                            @csrf @method('PUT')
                            <td><input type="date" name="start_date" value="{{ $rate->start_date->format('Y-m-d') }}" class="form-control" required></td>
                            <td><input type="date" name="end_date" value="{{ $rate->end_date->format('Y-m-d') }}" class="form-control" required></td>
                            <td><input type="number" name="price" value="{{ $rate->price }}" step="0.01" class="form-control" required></td>
                            <td class="d-flex">
                                <button class="btn btn-sm btn-success me-2">Guardar</button>
                        </form>
                        <form action="{{ route('rates.destroy', $rate) }}" method="POST" onsubmit="return confirm('¿Eliminar tarifa?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">Borrar</button>
                        </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-muted text-center">Sin tarifas</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <h5 class="mt-4">Nueva tarifa</h5>
        <form action="{{ route('rates.store', $product) }}" method="POST" class="row g-2">
            @csrf
            <div class="col-md-3">
                <input type="date" name="start_date" class="form-control" required>
            </div>
            <div class="col-md-3">
                <input type="date" name="end_date" class="form-control" required>
            </div>
            <div class="col-md-3">
                <input type="number" name="price" class="form-control" step="0.01" placeholder="Precio (€)" required>
            </div>
            <div class="col-md-3 mb-3">
                <button class="btn btn-primary w-100">Añadir tarifa</button>
            </div>
        </form>

        <a href="{{ route('products.index') }}" class="btn btn-secondary">Volver</a>
    </div>
</x-app-layout>