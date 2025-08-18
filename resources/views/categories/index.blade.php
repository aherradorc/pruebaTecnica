<x-app-layout>
    <x-slot name="header">
        <h2 class="h4">Categorías</h2>
    </x-slot>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 text-end">
                <a href="{{ route('categories.export.pdf') }}" class="btn btn-success mb-3"> Exportar a PDF</a>
                <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Nueva categoría</a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Padre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $cat)
                    <tr>
                        <td>{{ $cat->code }}</td>
                        <td>{{ $cat->name }}</td>
                        <td>{{ $cat->parent?->name ?? '—' }}</td>
                        <td>
                            <a href="{{ route('categories.edit', $cat) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('categories.destroy', $cat) }}" method="POST" style="display:inline-block;">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar?')">Borrar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $categories->links() }}
    </div>
</x-app-layout>