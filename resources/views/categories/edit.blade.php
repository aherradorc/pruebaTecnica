<x-app-layout>
    <x-slot name="header">
        <h2 class="h4">Editar categoría</h2>
    </x-slot>
    <div class="container">
        @include('categories.form', [
            'action' => route('categories.update', $category),
            'method' => 'PUT',
            'category' => $category
        ])
    </div>
</x-app-layout>
