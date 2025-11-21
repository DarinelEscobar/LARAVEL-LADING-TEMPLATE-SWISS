@props(['navItems' => []])

<header
    class="fixed top-0 left-0 right-0 z-50 px-6 md:px-8 py-5 border-b border-border/70 bg-white/80 backdrop-blur-md shadow-[0_8px_32px_rgba(0,0,0,0.03)]">
    <div class="max-w-7xl mx-auto flex items-center justify-between gap-6">
        <div class="flex items-center gap-3" data-animate="left" style="transition-delay: .05s">
            <div class="h-10 w-10 bg-black text-white flex items-center justify-center font-black text-sm tracking-tight">
                SD
            </div>
            <span class="text-sm font-semibold tracking-[0.24em]">SWISS</span>
        </div>

        <nav class="hidden md:flex items-center space-x-6">
            @foreach ($navItems as $index => $item)
                <x-ui.button variant="ghost" size="sm"
                    class="text-[11px] font-semibold tracking-[0.24em] hover:text-neutral-600 hover:bg-transparent"
                    data-animate="down" style="transition-delay: {{ 0.18 + $index * 0.08 }}s">
                    {{ $item }}
                </x-ui.button>
            @endforeach
            <x-ui.button variant="outline" size="sm"
                class="border-black text-black hover:bg-black hover:text-white tracking-[0.24em]" data-animate="down"
                style="transition-delay: .48s">
                <x-heroicon-o-user class="h-4 w-4 mr-2" />
                AI TRY-ON
            </x-ui.button>
        </nav>

        <div class="flex items-center space-x-5 md:space-x-6" data-animate="right" style="transition-delay: .32s">
            <div class="hidden md:flex items-center w-52">
                <div class="relative w-full">
                    <x-lucide-search class="absolute left-2 top-1/2 -translate-y-1/2 w-4 h-4 text-neutral-400" />
                    <x-ui.input type="search" placeholder="SEARCH"
                        class="pl-8 h-9 text-[11px] bg-muted/60 border-border focus-visible:ring-0 focus-visible:border-black tracking-[0.16em]" />
                </div>
            </div>
            <x-ui.button variant="ghost" size="icon" class="hover:bg-transparent" aria-label="Favorites">
                <x-lucide-heart class="w-4 h-4 text-black hover:text-neutral-500 transition-colors" />
            </x-ui.button>
            <x-ui.button variant="ghost" size="icon" class="hover:bg-transparent" aria-label="Bag">
                <x-lucide-shopping-bag class="w-4 h-4 text-black hover:text-neutral-500 transition-colors" />
            </x-ui.button>
        </div>
    </div>
</header>
