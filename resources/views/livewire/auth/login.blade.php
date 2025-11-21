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
                <h1 class="text-4xl md:text-5xl font-bold leading-tight">Bienvenido de vuelta</h1>
                <p class="text-lg text-muted-foreground max-w-lg">
                    Ingresa con tus credenciales para continuar al panel de administración. Minimalismo, claridad y confianza.
                </p>
                <div class="flex items-center gap-3 text-sm text-muted-foreground">
                    <div class="h-10 w-10 rounded-full bg-white/70 border border-white/60 flex items-center justify-center shadow">
                        <x-lucide-shield class="w-5 h-5" />
                    </div>
                    <span class="tracking-[0.18em] uppercase text-xs">Sesión segura y cifrada</span>
                </div>
            </div>

            <div class="relative">
                <div class="absolute -right-6 -top-6 h-16 w-16 bg-black rounded-full opacity-10 blur-xl"></div>
                <div class="relative rounded-3xl border border-white/60 bg-white/80 backdrop-blur-2xl shadow-2xl p-8 md:p-10 glass-surface">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <p class="text-xs uppercase tracking-[0.24em] text-muted-foreground">Acceso</p>
                            <p class="text-2xl font-bold mt-1">Inicia sesión</p>
                        </div>
                        <div class="h-12 w-12 rounded-xl bg-black text-white flex items-center justify-center shadow-lg">
                            <x-lucide-log-in class="h-5 w-5" />
                        </div>
                    </div>

                    @error('server')
                        <div class="mb-4 flex items-center gap-2 rounded-xl border border-red-200/80 bg-red-50/70 px-4 py-3 text-sm text-red-700">
                            <x-lucide-alert-triangle class="w-4 h-4" />
                            {{ $message }}
                        </div>
                    @enderror

                    <form wire:submit.prevent="login" class="space-y-6">
                        <div class="space-y-2">
                            <x-ui.label for="email">Correo electrónico</x-ui.label>
                            <div class="relative">
                                <x-ui.input id="email" type="email" wire:model="email" autocomplete="email" placeholder="tu@email.com"
                                    class="pl-11 bg-white/70 border-white/70 focus-visible:ring-ring focus-visible:border-black" required />
                                <x-lucide-mail class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-muted-foreground" />
                            </div>
                            @include('partials.message', ['input' => 'email'])
                        </div>

                        <div class="space-y-2">
                            <x-ui.label for="password">Contraseña</x-ui.label>
                            <div class="relative">
                                <x-ui.input id="password" type="password" wire:model="password" autocomplete="current-password"
                                    placeholder="••••••••"
                                    class="pl-11 pr-12 bg-white/70 border-white/70 focus-visible:ring-ring focus-visible:border-black" />
                                <x-lucide-lock class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-muted-foreground" />
                                <button type="button" id="togglePassword"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-muted-foreground hover:text-foreground transition">
                                    <x-lucide-eye class="w-4 h-4" />
                                </button>
                            </div>
                            @include('partials.message', ['input' => 'password'])
                            <div class="flex justify-between items-center pt-1">
                                <a href="{{ route('forget.password') }}"
                                    class="text-sm text-muted-foreground hover:text-foreground transition">¿Olvidaste tu contraseña?</a>
                                <span class="text-[11px] tracking-[0.18em] text-muted-foreground uppercase">Admin dashboard</span>
                            </div>
                        </div>

                        <div class="pt-2">
                            <x-ui.button type="submit" class="w-full bg-black text-white hover:bg-red-600">
                                <span class="tracking-[0.2em]">Ingresar</span>
                                <x-lucide-arrow-right class="w-4 h-4" />
                            </x-ui.button>
                        </div>
                    </form>

                    <div wire:loading wire:target="login"
                        class="absolute inset-0 z-20 flex items-center justify-center rounded-3xl bg-white/70 backdrop-blur-md">
                        <div class="flex items-center gap-3 text-sm font-medium">
                            <x-lucide-loader-2 class="w-5 h-5 animate-spin" />
                            Iniciando sesión...
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const toggle = document.getElementById('togglePassword')
        const password = document.getElementById('password')

        if (!toggle || !password) return

        toggle.addEventListener('click', () => {
            const isHidden = password.type === 'password'
            password.type = isHidden ? 'text' : 'password'
            const icon = toggle.querySelector('svg')
            if (icon) {
                icon.setAttribute('data-icon', isHidden ? 'eye-off' : 'eye')
                icon.innerHTML = ''
            }
            toggle.innerHTML = isHidden
                ? '<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3l18 18"/><path d="M10.58 10.58a2 2 0 0 0 2.83 2.83"/><path d="M9.88 5.1l.7-.1a9.12 9.12 0 0 1 8.31 5"/><path d="M6.11 6.11a9.12 9.12 0 0 0-3.02 4.39 9.12 9.12 0 0 0 3.24 4.76 9.12 9.12 0 0 0 6.17 2.15h.2"/><path d="M13.53 13.53c-.69.69-1.8.69-2.48 0"/></svg>'
                : '<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12Z"/><circle cx="12" cy="12" r="3"/></svg>'
        })
    })
</script>
