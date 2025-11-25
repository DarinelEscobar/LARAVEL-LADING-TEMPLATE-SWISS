<div class="relative min-h-screen flex items-center justify-center overflow-hidden bg-gradient-to-br from-slate-50 via-white to-red-50 text-foreground">
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-[-10%] left-[-10%] h-72 w-72 rounded-full bg-red-500/10 blur-3xl"></div>
        <div class="absolute bottom-[-10%] right-[-5%] h-80 w-80 rounded-full bg-black/10 blur-3xl"></div>
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=%2740%27 height=%2740%27 viewBox=%270 0 40 40%27 xmlns=%27http://www.w3.org/2000/svg%27%3E%3Ccircle cx=%272%27 cy=%272%27 r=%271%27 fill=%27%23d1d5db%27 opacity=%270.25%27/%3E%3C/svg%3E')] opacity-60 mix-blend-overlay"></div>
    </div>

    <div class="relative w-full max-w-5xl px-6 md:px-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
            <div class="hidden md:flex flex-col gap-6 pl-4">
                <div class="flex items-center gap-3 text-sm uppercase tracking-[0.24em] font-semibold">
                    <span class="h-10 w-10 bg-black text-white flex items-center justify-center font-black">SD</span>
                    <span>Swiss Design</span>
                </div>
                <h1 class="text-4xl md:text-5xl font-bold leading-tight">Recuperación</h1>
                <p class="text-lg text-muted-foreground max-w-lg">
                    ¿Olvidaste tu contraseña? No te preocupes, te enviaremos las instrucciones para restablecerla.
                </p>
                <div class="flex items-center gap-3 text-sm text-muted-foreground">
                    <div class="h-10 w-10 rounded-full bg-white/70 border border-white/60 flex items-center justify-center shadow">
                        <x-lucide-shield-check class="w-5 h-5" />
                    </div>
                    <span class="tracking-[0.18em] uppercase text-xs">Proceso seguro</span>
                </div>
            </div>

            <div class="relative">
                <div class="absolute -right-6 -top-6 h-16 w-16 bg-black rounded-full opacity-10 blur-xl"></div>
                <div class="relative rounded-3xl border border-white/60 bg-white/80 backdrop-blur-2xl shadow-2xl p-8 md:p-10 glass-surface">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <p class="text-xs uppercase tracking-[0.24em] text-muted-foreground">Seguridad</p>
                            <p class="text-2xl font-bold mt-1">Restablecer</p>
                        </div>
                        <div class="h-12 w-12 rounded-xl bg-black text-white flex items-center justify-center shadow-lg">
                            <x-lucide-key class="h-5 w-5" />
                        </div>
                    </div>

                    <form wire:submit.prevent="store" class="space-y-6">
                        <div class="space-y-2">
                            <x-ui.label for="email">Correo electrónico</x-ui.label>
                            <div class="relative">
                                <x-ui.input id="email" type="email" wire:model="email" placeholder="tu@email.com"
                                    class="pl-11 bg-white/70 border-white/70 focus-visible:ring-ring focus-visible:border-black" required />
                                <x-lucide-mail class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-muted-foreground" />
                            </div>
                            @include('partials.message', ['input' => 'email'])
                        </div>

                        <div class="pt-2">
                            <x-ui.button type="submit" class="w-full bg-black text-white hover:bg-red-600">
                                <span class="tracking-[0.2em]">Enviar enlace</span>
                                <x-lucide-arrow-right class="w-4 h-4" />
                            </x-ui.button>
                        </div>

                        <div class="text-center pt-4">
                             <a href="{{ route('login') }}" class="text-sm text-muted-foreground hover:text-foreground transition flex items-center justify-center gap-2">
                                <x-lucide-arrow-left class="w-4 h-4" />
                                Volver al inicio de sesión
                             </a>
                        </div>
                    </form>

                    <div wire:loading wire:target="store"
                        class="absolute inset-0 z-20 flex items-center justify-center rounded-3xl bg-white/70 backdrop-blur-md">
                        <div class="flex items-center gap-3 text-sm font-medium">
                            <x-lucide-loader-2 class="w-5 h-5 animate-spin" />
                            Enviando...
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
