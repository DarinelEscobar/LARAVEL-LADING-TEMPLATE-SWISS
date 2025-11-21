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
