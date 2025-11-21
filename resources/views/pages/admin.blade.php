@extends('layouts.admin')

@section('content')
    <div class="relative min-h-screen bg-gradient-to-br from-slate-50 via-white to-slate-100 text-foreground overflow-hidden">
        <div class="absolute -top-24 -left-16 h-64 w-64 rounded-full bg-red-500/10 blur-3xl"></div>
        <div class="absolute bottom-[-20%] right-[-10%] h-72 w-72 rounded-full bg-black/10 blur-3xl"></div>
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=%2740%27 height=%2740%27 viewBox=%270 0 40 40%27 xmlns=%27http://www.w3.org/2000/svg%27%3E%3Ccircle cx=%272%27 cy=%272%27 r=%271%27 fill=%27%23d1d5db%27 opacity=%270.2%27/%3E%3C/svg%3E')] opacity-70 mix-blend-overlay"></div>

        <div class="relative max-w-6xl mx-auto px-6 py-10 space-y-6">
            <header class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="h-11 w-11 rounded-xl bg-black text-white flex items-center justify-center font-black shadow-lg">
                        AD
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-[0.24em] text-muted-foreground">Panel</p>
                        <p class="text-xl font-bold">Admin Dashboard</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="flex items-center gap-3">
                    @csrf
                    <span class="text-sm text-muted-foreground hidden sm:inline">
                        {{ auth()->user()->email ?? '' }}
                    </span>
                    <x-ui.button type="submit" class="bg-black text-white hover:bg-red-600">
                        <x-lucide-log-out class="w-4 h-4" />
                        <span class="tracking-[0.2em]">Salir</span>
                    </x-ui.button>
                </form>
            </header>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="rounded-2xl border border-white/70 bg-white/80 backdrop-blur-xl shadow-lg p-5 transition hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-4">
                        <p class="text-sm text-muted-foreground">Usuarios</p>
                        <x-lucide-users class="w-5 h-5 text-muted-foreground" />
                    </div>
                    <p class="text-3xl font-bold">42</p>
                    <p class="text-xs uppercase tracking-[0.18em] text-green-600 mt-2">+4 nuevos</p>
                </div>

                <div class="rounded-2xl border border-white/70 bg-white/80 backdrop-blur-xl shadow-lg p-5 transition hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-4">
                        <p class="text-sm text-muted-foreground">Tareas</p>
                        <x-lucide-check-circle class="w-5 h-5 text-muted-foreground" />
                    </div>
                    <p class="text-3xl font-bold">18</p>
                    <p class="text-xs uppercase tracking-[0.18em] text-blue-600 mt-2">6 completadas</p>
                </div>

                <div class="rounded-2xl border border-white/70 bg-white/80 backdrop-blur-xl shadow-lg p-5 transition hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-4">
                        <p class="text-sm text-muted-foreground">Notificaciones</p>
                        <x-lucide-bell class="w-5 h-5 text-muted-foreground" />
                    </div>
                    <p class="text-3xl font-bold">3</p>
                    <p class="text-xs uppercase tracking-[0.18em] text-amber-600 mt-2">requieren atención</p>
                </div>
            </div>

            <div class="rounded-3xl border border-white/70 bg-white/80 backdrop-blur-xl shadow-2xl p-6 md:p-8 transition hover:-translate-y-1">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <p class="text-xs uppercase tracking-[0.24em] text-muted-foreground">Estados</p>
                        <p class="text-xl font-semibold">Tabla de status</p>
                    </div>
                    <x-lucide-activity class="w-5 h-5 text-muted-foreground" />
                </div>

                <div class="overflow-hidden rounded-2xl border border-white/60 bg-white/70 backdrop-blur">
                    <div class="grid grid-cols-3 text-xs uppercase tracking-[0.18em] text-muted-foreground border-b border-white/60 px-4 py-3">
                        <div class="text-left">Nombre</div>
                        <div class="text-left">Tipo</div>
                        <div class="text-right">Orden</div>
                    </div>
                    <div class="divide-y divide-white/60">
                        @forelse ($statuses ?? [] as $status)
                            <div class="grid grid-cols-3 items-center px-4 py-3 hover:bg-black/3 transition">
                                <div class="flex items-center gap-3">
                                    <span class="h-2.5 w-2.5 rounded-full bg-black/80"></span>
                                    <span class="text-sm font-medium">{{ $status->name }}</span>
                                </div>
                                <div class="text-sm text-muted-foreground">
                                    {{ $status->type->name ?? '—' }}
                                </div>
                                <div class="text-sm text-muted-foreground text-right">{{ $status->order }}</div>
                            </div>
                        @empty
                            <div class="px-4 py-6 text-sm text-muted-foreground text-center">
                                No hay registros de status.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
