@props(['projectCards' => [], 'featureCards' => []])

<section id="work" class="py-20 px-4 md:px-8 bg-black text-white">
    <div class="max-w-7xl mx-auto">
        <div class="flex items-center justify-between mb-12">
            <h2 class="text-5xl md:text-6xl font-bold tracking-tighter anime-section-title">WORK</h2>
            <span class="hidden md:inline-flex items-center text-sm uppercase tracking-[0.24em] text-neutral-400"
                data-animate="left" style="transition-delay: .18s">
                Minimal grid systems · Swiss rigor
            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach ($projectCards as $card)
                <x-ui.card class="group bg-neutral-900 border-neutral-800 text-white overflow-hidden border-0"
                    data-animate="up">
                    <div class="aspect-square bg-white overflow-hidden relative">
                        <div
                            class="w-full h-full flex items-center justify-center bg-neutral-100 group-hover:bg-red-600 transition-colors duration-500">
                            <span class="text-black text-7xl md:text-8xl font-bold">{{ $card['number'] }}</span>
                        </div>
                    </div>
                    <x-ui.card-header>
                        <h3 class="text-xl font-bold">{{ $card['title'] }}</h3>
                        <p class="text-neutral-400 text-sm">{{ $card['description'] }}</p>
                    </x-ui.card-header>
                    <x-ui.card-footer>
                        <x-ui.button variant="link"
                            class="text-white p-0 h-auto text-sm tracking-[0.2em] group-hover:translate-x-2 transition-all duration-300">
                            View Case
                            <x-lucide-arrow-right class="ml-2 w-4 h-4" />
                        </x-ui.button>
                    </x-ui.card-footer>
                </x-ui.card>
            @endforeach

            @foreach ($featureCards as $index => $feature)
                <x-ui.card
                    class="border-border hover:shadow-lg transition-all duration-500 anime-feature-card bg-card text-card-foreground"
                    data-animate="up" style="transition-delay: {{ 0.18 + $index * 0.08 }}s">
                    <x-ui.card-content class="p-6 space-y-4">
                        <div class="w-12 h-12 bg-primary text-primary-foreground rounded-lg flex items-center justify-center">
                            <x-dynamic-component :component="'lucide-' . $feature['icon']" class="w-6 h-6" />
                        </div>
                        <h3 class="text-xl font-semibold">{{ $feature['title'] }}</h3>
                        <p class="text-sm text-muted-foreground text-pretty">{{ $feature['description'] }}</p>
                    </x-ui.card-content>
                </x-ui.card>
            @endforeach
        </div>
    </div>
</section>
