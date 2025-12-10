<header class="flex items-center justify-between h-16 px-4 bg-background/80 backdrop-blur-sm border-b border-border z-10 sticky top-0 sm:px-6 lg:px-8">
    <div class="flex items-center gap-4">
        <button type="button" class="md:hidden text-muted-foreground hover:text-foreground">
            <x-ui.icon name="menu" class="w-5 h-5" />
        </button>
        <div class="flex items-center gap-3">
             <div class="h-8 w-8 rounded-lg bg-primary text-primary-foreground flex items-center justify-center font-bold text-xs shadow-sm">
                AD
            </div>
            <div class="hidden sm:block">
                <p class="text-[10px] uppercase tracking-wider text-muted-foreground font-semibold">Panel</p>
                <div class="text-sm font-bold leading-none">Admin Dashboard</div>
            </div>
        </div>
    </div>

    <div class="flex items-center gap-4">
        <div class="hidden sm:flex flex-col items-end mr-2">
             <span class="text-sm font-medium">{{ Auth::user()->name ?? 'Administrator' }}</span>
             <span class="text-xs text-muted-foreground">{{ Auth::user()->email ?? '' }}</span>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-ui.button variant="ghost" size="sm" type="submit" icon="log-out">
                Salir
            </x-ui.button>
        </form>
    </div>
</header>
