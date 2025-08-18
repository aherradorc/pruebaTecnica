<x-app-layout>
    <x-slot name="header">
        <h2 class="h4">Calendario de Recordatorios</h2>
    </x-slot>
    <div class="container">
        <form action="{{ route('reminders.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="product_id" class="form-label">Producto</label>
                <select name="product_id" id="product_id" class="form-select" required>
                    <option value="">Seleccionar...</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                            {{ $product->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="date" class="form-label">Fecha</label>
                <input type="date" name="date" class="form-control" value="{{ old('date') }}" required>
            </div>

            <div class="mb-3">
                <label for="units" class="form-label">Unidades</label>
                <input type="number" name="units" class="form-control" min="1" value="{{ old('units', 1) }}" required>
            </div>

            <button class="btn btn-primary">Guardar Recordatorio</button>
            <a href="{{ route('calendar.index') }}" class="btn btn-secondary">Volver</a>
        </form>
    </div>
</x-app-layout>