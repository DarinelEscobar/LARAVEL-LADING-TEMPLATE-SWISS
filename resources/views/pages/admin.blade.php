@extends('layouts.admin')

@section('content')
    <div class="relative bg-gradient-to-br from-slate-50 via-white to-slate-100 min-h-screen overflow-hidden text-foreground">
        <div class="-top-24 -left-16 absolute bg-red-500/10 blur-3xl rounded-full w-64 h-64"></div>
        <div class="right-[-10%] bottom-[-20%] absolute bg-black/10 blur-3xl rounded-full w-72 h-72"></div>
        <div class="absolute inset-0 flex opacity-70 bg-[url('data:image/svg+xml,%3Csvg width=%2740%27 height=%2740%27 viewBox=%270 0 40 40%27 xmlns=%27http://www.w3.org/2000/svg%27%3E%3Ccircle cx=%272%27 cy=%272%27 r=%271%27 fill=%27%23d1d5db%27 opacity=%270.2%27/%3E%3C/svg%3E')] mix-blend-overlay"></div>

        <div class="relative space-y-6 mx-auto px-6 py-10 max-w-6xl">


            <div class="gap-4 grid grid-cols-1 md:grid-cols-3">
                <div class="bg-white/80 shadow-lg backdrop-blur-xl p-5 border border-white/70 rounded-2xl transition hover:-translate-y-1">
                    <div class="flex justify-between items-center mb-4">
                        <p class="text-muted-foreground text-sm">Usuarios</p>
                        <x-lucide-users class="w-5 h-5 text-muted-foreground" />
                    </div>
                    <p class="font-bold text-3xl">42</p>
                    <p class="mt-2 text-green-600 text-xs uppercase tracking-[0.18em]">+4 nuevos</p>
                </div>

                <div class="bg-white/80 shadow-lg backdrop-blur-xl p-5 border border-white/70 rounded-2xl transition hover:-translate-y-1">
                    <div class="flex justify-between items-center mb-4">
                        <p class="text-muted-foreground text-sm">Tareas</p>
                        <x-lucide-check-circle class="w-5 h-5 text-muted-foreground" />
                    </div>
                    <p class="font-bold text-3xl">18</p>
                    <p class="mt-2 text-blue-600 text-xs uppercase tracking-[0.18em]">6 completadas</p>
                </div>

                <div class="bg-white/80 shadow-lg backdrop-blur-xl p-5 border border-white/70 rounded-2xl transition hover:-translate-y-1">
                    <div class="flex justify-between items-center mb-4">
                        <p class="text-muted-foreground text-sm">Notificaciones</p>
                        <x-lucide-bell class="w-5 h-5 text-muted-foreground" />
                    </div>
                    <p class="font-bold text-3xl">3</p>
                    <p class="mt-2 text-amber-600 text-xs uppercase tracking-[0.18em]">requieren atención</p>
                </div>
            </div>

            <div class="bg-white/80 shadow-2xl backdrop-blur-xl p-6 md:p-8 border border-white/70 rounded-3xl transition hover:-translate-y-1">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <p class="text-muted-foreground text-xs uppercase tracking-[0.24em]">Estados</p>
                        <p class="font-semibold text-xl">Tabla de status</p>
                    </div>
                    <x-lucide-activity class="w-5 h-5 text-muted-foreground" />
                </div>

                <div class="bg-white/70 backdrop-blur border border-white/60 rounded-2xl overflow-hidden">
                    <div class="grid grid-cols-3 px-4 py-3 border-white/60 border-b text-muted-foreground text-xs uppercase tracking-[0.18em]">
                        <div class="text-left">Nombre</div>
                        <div class="text-left">Tipo</div>
                        <div class="text-right">Orden</div>
                    </div>
                    <div class="divide-y divide-white/60">
                        @forelse ($statuses ?? [] as $status)
                            <div class="items-center grid grid-cols-3 hover:bg-black/3 px-4 py-3 transition">
                                <div class="flex items-center gap-3">
                                    <span class="bg-black/80 rounded-full w-2.5 h-2.5"></span>
                                    <span class="font-medium text-sm">{{ $status->name }}</span>
                                </div>
                                <div class="text-muted-foreground text-sm">
                                    {{ $status->type->name ?? '—' }}
                                </div>
                                <div class="text-muted-foreground text-sm text-right">{{ $status->order }}</div>
                            </div>
                        @empty
                            <div class="px-4 py-6 text-muted-foreground text-sm text-center">
                                No hay registros de status.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
