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
