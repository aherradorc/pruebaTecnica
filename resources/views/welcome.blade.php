<x-app-layout>
    <x-slot name="header">
        <h2 class="h4">Panel de Control</h2>
    </x-slot>
    <div class="container">
        {{-- Estadísticas principales --}}
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card shadow-sm text-center card-hover">
                    <div class="card-body">
                        <h5 class="card-title">Categorías</h5>
                        <p class="display-6">{{ \App\Models\Category::count() }}</p>
                        <a href="{{ route('categories.index') }}" class="btn btn-outline-primary btn-sm">Ver categorías</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm text-center card-hover">
                    <div class="card-body">
                        <h5 class="card-title">Productos</h5>
                        <p class="display-6">{{ \App\Models\Product::count() }}</p>
                        <a href="{{ route('products.index') }}" class="btn btn-outline-primary btn-sm">Ver productos</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm text-center card-hover">
                    <div class="card-body">
                        <h5 class="card-title">Recordatorios</h5>
                        <p class="display-6">{{ \App\Models\Reminder::where('date', '>=', now())->count() }}</p>
                        <a href="{{ route('calendar.index') }}" class="btn btn-outline-primary btn-sm">Ver calendario</a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tabla de próximas compras --}}
        <div class="card mt-5 shadow-sm">
            <div class="card-header">
                <h5>Próximas compras registradas</h5>
            </div>
            <div class="card-body">
                @php
                    $reminders = \App\Models\Reminder::with('product')->whereDate('date', '>=', \Illuminate\Support\Carbon::today())->orderBy('date')->take(5)->get();
                @endphp

                @if($reminders->isEmpty())
                    <p class="text-muted">No hay recordatorios próximos.</p>
                @else
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Producto</th>
                                <th>Unidades</th>
                                <th>Coste estimado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reminders as $reminder)
                                <tr>
                                    <td>
                                        Recordatorio: {{ $reminder->date->format('d/m/Y') }}<br>
                                        @if($reminder->applicableRate())
                                            <small class="text-muted">
                                                Tarifa válida:
                                                {{ $reminder->applicableRate()->start_date->format('d/m/Y') }}
                                                -
                                                {{ $reminder->applicableRate()->end_date->format('d/m/Y') }}
                                            </small>
                                        @else
                                            <small class="text-danger">Sin tarifa válida</small>
                                        @endif
                                    </td>
                                    <td>{{ $reminder->product->name }}</td>
                                    <td>{{ $reminder->units }}</td>
                                    <td>
                                        @php
                                            $rate = $reminder->applicableRate();
                                        @endphp

                                        @if($rate)
                                            <div class="text-success">
                                                {{ number_format($rate->price * $reminder->units, 2) }} €
                                            </div>
                                        @else
                                            <span class="text-danger">Sin tarifa válida</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
