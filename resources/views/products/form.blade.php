<x-app-layout>
    <x-slot name="header">
        <h2 class="h4">{{ $product->exists ? 'Editar' : 'Crear' }} producto</h2>
    </x-slot>
    <div class="container">
        <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if($method === 'PUT')
                @method('PUT')
            @endif

            <div class="mb-3">
                <label class="form-label">Código</label>
                <input type="text" name="code" class="form-control" value="{{ old('code', $product->code) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea name="description" class="form-control">{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Categorías</label>
                <select name="categories[]" class="form-select" multiple>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}"
                            @if(in_array($cat->id, old('categories', $product->categories->pluck('id')->toArray())))
                                selected
                            @endif>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Foto</label>
                <input type="file" name="photo" class="form-control">
                @if($product->photo)
                    <div class="mt-2">
                        <img src="{{ asset($product->photo) }}" class="img-thumbnail" style="max-height: 100px;">
                    </div>
                @endif
            </div>

            <button class="btn btn-success">Guardar</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Volver</a>
        </form>
    </div>
</x-app-layout>