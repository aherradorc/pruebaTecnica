<x-app-layout>
    <x-slot name="header">
        <h2 class="h4">Calendario de Recordatorios</h2>
    </x-slot>
    <div class="container">
        <a href="{{ route('reminders.create') }}" class="btn btn-sm btn-success">
            <i class="fas fa-plus"></i> Nuevo Recordatorio
        </a>

        <div id="calendar"></div>
    </div>
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof initCalendar === 'function') {
                initCalendar();
            } else {
                console.warn('initCalendar is not init');
            }
        });
    </script>
    @endpush
</x-app-layout>
