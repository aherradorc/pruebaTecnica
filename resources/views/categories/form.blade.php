<form action="{{ $action }}" method="POST">
    @csrf
    @if(isset($method) && $method === 'PUT')
        @method('PUT')
    @endif

    <div class="mb-3">
        <label for="code" class="form-label">Código</label>
        <input type="text" name="code" class="form-control" value="{{ old('code', $category->code ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label for="name" class="form-label">Nombre</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $category->name ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Descripción</label>
        <textarea name="description" class="form-control">{{ old('description', $category->description ?? '') }}</textarea>
    </div>

    <div class="mb-3">
        <label for="parent_id" class="form-label">Categoría Padre</label>
        <select name="parent_id" class="form-select">
            <option value="">Ninguna</option>
            @foreach($parents as $parent)
                <option value="{{ $parent->id }}"
                    @if(old('parent_id', $category->parent_id ?? '') == $parent->id) selected @endif>
                    {{ $parent->name }}
                </option>
            @endforeach
        </select>
    </div>

    <button class="btn btn-success">Guardar</button>
    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Volver</a>
</form>