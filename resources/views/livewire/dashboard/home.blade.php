@php
    $navItems = ['NEW', 'MEN', 'WOMEN', 'KIDS'];
    $projectCards = [
        ['number' => '01', 'title' => 'Typography Project', 'description' => 'Exploring grid systems and typographic hierarchy'],
        ['number' => '02', 'title' => 'Poster Design', 'description' => 'Minimalist approach to visual communication'],
        ['number' => '03', 'title' => 'Brand Identity', 'description' => 'Clean, systematic visual language for modern brands'],
    ];
    $featureCards = [
        ['icon' => 'cable', 'title' => 'Modular', 'description' => 'Component-driven structure for flexible, repeatable layouts.'],
        ['icon' => 'sparkles', 'title' => 'Animated', 'description' => 'Crisp, performant motion crafted with Anime.js and Tailwind.'],
        ['icon' => 'shield', 'title' => 'Reliable', 'description' => 'Accessible UI parts inspired by shadcn/ui patterns.'],
        ['icon' => 'zap', 'title' => 'Fast', 'description' => 'Lean markup and Vite-powered assets keep interactions instant.'],
    ];
    $showcaseCards = [
        ['number' => '01', 'title' => 'Typography System', 'description' => 'Exploring hierarchy and readability', 'tone' => 'bg-chart-1'],
        ['number' => '02', 'title' => 'Grid Layouts', 'description' => 'Systematic visual organization', 'tone' => 'bg-chart-2'],
        ['number' => '03', 'title' => 'Brand Identity', 'description' => 'Clean visual language', 'tone' => 'bg-chart-3'],
    ];
@endphp

<div data-landing-page class="bg-background text-foreground min-h-screen">
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

    <main class="pt-28 md:pt-32">
        <section class="pb-20 px-4 md:px-8 min-h-[80vh] flex flex-col justify-center relative">
            <div class="max-w-7xl mx-auto grid grid-cols-12 gap-6 md:gap-8 lg:gap-10">
                <div class="col-span-12 md:col-span-7 space-y-6" data-animate="up" style="transition-delay: .12s">
                    <h1 class="text-6xl md:text-8xl lg:text-9xl font-bold leading-[0.95] anime-title">
                        SWISS
                        <br />
                        DESIGN
                    </h1>
                    <p class="text-xl md:text-2xl max-w-2xl anime-fade-up">
                        Clarity. Precision. Objectivity. The principles of Swiss Design have shaped modern visual
                        communication since the 1950s.
                    </p>
                    <div class="anime-fade-up" style="animation-delay: .15s">
                        <x-ui.button class="bg-black text-white hover:bg-red-600 px-8 py-4 text-[11px] tracking-[0.24em]">
                            Explore Collection
                        </x-ui.button>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-5 flex items-center justify-center" data-animate="scale"
                    style="transition-delay: .16s">
                    <div class="relative w-full max-w-[440px] aspect-square bg-red-600 anime-scale-in shadow-xl">
                        <div class="absolute -bottom-6 -right-6 w-24 h-24 bg-black anime-rotate-in"></div>
                    </div>
                </div>
            </div>
            <div class="absolute bottom-10 left-1/2 -translate-x-1/2 animate-bounce" aria-hidden="true">
                <x-lucide-arrow-down class="w-6 h-6 text-black" />
            </div>
        </section>

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
                                    <span
                                        class="text-black text-7xl md:text-8xl font-bold">{{ $card['number'] }}</span>
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
                                <div
                                    class="w-12 h-12 bg-primary text-primary-foreground rounded-lg flex items-center justify-center">
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

        <section id="contact" class="py-20 px-4 md:px-8 bg-red-600 text-white">
            <div class="container mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-start">
                    <div class="space-y-6 anime-fade-right">
                        <h2 class="text-5xl md:text-6xl font-bold tracking-tighter">CONTACT</h2>
                        <p class="text-xl">Interested in working together? Let's discuss your project.</p>
                        <div class="space-y-4">
                            <p class="flex items-center gap-4">
                                <span class="w-24 text-[11px] uppercase tracking-[0.24em]">Email</span>
                                <a href="mailto:hello@swissdesign.com" class="hover:underline">hello@swissdesign.com</a>
                            </p>
                            <p class="flex items-center gap-4">
                                <span class="w-24 text-[11px] uppercase tracking-[0.24em]">Phone</span>
                                <a href="tel:+41123456789" class="hover:underline">+41 123 456 789</a>
                            </p>
                            <p class="flex items-center gap-4">
                                <span class="w-24 text-[11px] uppercase tracking-[0.24em]">Location</span>
                                <span>Zürich, Switzerland</span>
                            </p>
                        </div>
                    </div>
                    <div class="anime-fade-left">
                        <form class="space-y-6">
                            <div class="space-y-2">
                                <x-ui.label for="name" class="text-white">Name</x-ui.label>
                                <x-ui.input id="name" type="text" placeholder="Your name"
                                    class="bg-transparent border-b-2 border-white border-t-0 border-x-0 rounded-none px-0 text-white focus-visible:ring-0 focus-visible:border-black placeholder:text-white/60" />
                            </div>
                            <div class="space-y-2">
                                <x-ui.label for="email" class="text-white">Email</x-ui.label>
                                <x-ui.input id="email" type="email" placeholder="Your email"
                                    class="bg-transparent border-b-2 border-white border-t-0 border-x-0 rounded-none px-0 text-white focus-visible:ring-0 focus-visible:border-black placeholder:text-white/60" />
                            </div>
                            <div class="space-y-2">
                                <x-ui.label for="message" class="text-white">Message</x-ui.label>
                                <x-ui.textarea id="message" rows="4" placeholder="Your message"
                                    class="bg-transparent border-b-2 border-white border-t-0 border-x-0 rounded-none px-0 text-white focus-visible:ring-0 focus-visible:border-black placeholder:text-white/60" />
                            </div>
                            <x-ui.button type="submit"
                                class="mt-6 w-full md:w-auto bg-black text-white hover:bg-white hover:text-black px-10 py-4 text-[11px] tracking-[0.24em]">
                                Send Message
                            </x-ui.button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-black text-white py-12 px-4 md:px-8 border-t border-neutral-800">
        <div class="container mx-auto flex flex-col md:flex-row justify-between items-center gap-8">
            <div>
                <h3 class="text-2xl font-bold tracking-tighter mb-2">SWISS DESIGN</h3>
                <p class="text-neutral-500 text-sm">© {{ now()->year }} All rights reserved.</p>
            </div>

            <div class="flex flex-col md:flex-row items-center gap-6">
                <nav class="flex gap-4">
                    @foreach (['Privacy', 'Terms', 'Sitemap'] as $link)
                        <x-ui.button variant="link" class="text-neutral-400 hover:text-white p-0 h-auto text-sm">
                            {{ $link }}
                        </x-ui.button>
                    @endforeach
                </nav>

                <div class="flex gap-3">
                    <x-ui.button variant="ghost" size="icon"
                        class="text-white hover:bg-neutral-800 hover:text-white rounded-full" aria-label="GitHub">
                        <x-lucide-github class="w-4 h-4" />
                    </x-ui.button>
                    <x-ui.button variant="ghost" size="icon"
                        class="text-white hover:bg-neutral-800 hover:text-white rounded-full" aria-label="Twitter">
                        <x-lucide-twitter class="w-4 h-4" />
                    </x-ui.button>
                    <x-ui.button variant="ghost" size="icon"
                        class="text-white hover:bg-neutral-800 hover:text-white rounded-full" aria-label="LinkedIn">
                        <x-lucide-linkedin class="w-4 h-4" />
                    </x-ui.button>
                    <x-ui.button variant="ghost" size="icon"
                        class="text-white hover:bg-neutral-800 hover:text-white rounded-full" aria-label="Instagram">
                        <x-lucide-instagram class="w-4 h-4" />
                    </x-ui.button>
                    <x-ui.button variant="ghost" size="icon"
                        class="text-white hover:bg-neutral-800 hover:text-white rounded-full" aria-label="Facebook">
                        <x-lucide-facebook class="w-4 h-4" />
                    </x-ui.button>
                </div>
            </div>
        </div>
    </footer>
</div>

@push('scripts')
    @vite('resources/js/landing-page.js')
@endpush
