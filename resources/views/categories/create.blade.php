<x-app-layout>
    <x-slot name="header">
        <h2 class="h4">Nueva categoría</h2>
    </x-slot>
    <div class="container">
        @include('categories.form', ['action' => route('categories.store'), 'method' => 'POST'])
    </div>
</x-app-layout>