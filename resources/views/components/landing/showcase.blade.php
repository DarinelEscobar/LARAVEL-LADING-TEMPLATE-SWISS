@props(['showcaseCards' => []])

<section id="showcase" class="py-20 px-6">
    <div class="max-w-7xl mx-auto space-y-12">
        <h2 class="text-4xl md:text-5xl font-bold tracking-tight anime-section-title">Featured Work</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($showcaseCards as $index => $project)
                <x-ui.card
                    class="group border-border hover:shadow-xl transition-all duration-500 overflow-hidden anime-showcase-card"
                    data-animate="up" style="transition-delay: {{ 0.16 + $index * 0.1 }}s">
                    <div
                        class="aspect-square {{ $project['tone'] }} group-hover:scale-105 transition-transform duration-500 flex items-center justify-center">
                        <span
                            class="text-background text-7xl md:text-8xl font-bold opacity-20 group-hover:opacity-40 transition-opacity">
                            {{ $project['number'] }}
                        </span>
                    </div>
                    <div class="p-6 space-y-2">
                        <h3 class="text-xl font-bold">{{ $project['title'] }}</h3>
                        <p class="text-sm text-muted-foreground">{{ $project['description'] }}</p>
                    </div>
                </x-ui.card>
            @endforeach
        </div>
    </div>
</section>
