<section class="pb-20 px-4 md:px-8 min-h-[80vh] flex flex-col justify-center relative">
    <div class="max-w-7xl mx-auto grid grid-cols-12 gap-6 md:gap-8 lg:gap-10">
        <div class="col-span-12 md:col-span-7 space-y-6" data-animate="up" style="transition-delay: .12s">
            <h1 class="text-6xl md:text-8xl lg:text-9xl font-bold leading-[0.95] anime-title">
                SWISS
                <br />
                DESIGN
            </h1>
            <p class="text-xl md:text-2xl max-w-2xl anime-fade-up">
                Clarity. Precision. Objectivity. The principles of Swiss Design have shaped modern visual communication
                since the 1950s.
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
