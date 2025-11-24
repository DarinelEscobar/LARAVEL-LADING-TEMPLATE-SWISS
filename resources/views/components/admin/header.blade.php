<header class="flex items-center justify-between p-4 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
    <div class="flex items-center gap-3">
        <div class="h-11 w-11 rounded-xl bg-black text-white flex items-center justify-center font-black shadow-lg">
            AD
        </div>
        <div>
            <p class="text-xs uppercase tracking-[0.24em] text-muted-foreground text-gray-500">Panel</p>
            <p class="text-xl font-bold dark:text-white">Admin Dashboard</p>
        </div>
    </div>
    <form method="POST" action="{{ route('logout') }}" class="flex items-center gap-3">
        @csrf
        <span class="text-sm text-muted-foreground hidden sm:inline dark:text-gray-400">
            {{ Auth::user()->email ?? 'admin@test.com' }}
        </span>
        <button type="submit" class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-none font-medium uppercase tracking-[0.2em] transition-all duration-200 disabled:opacity-50 disabled:pointer-events-none focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-ring bg-primary text-primary-foreground border border-primary hover:bg-primary/90 text-[11px] px-5 py-3 leading-none bg-black text-white hover:bg-red-600">
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m16 17 5-5-5-5"></path>
                <path d="M21 12H9"></path>
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
            </svg>
            <span class="tracking-[0.2em]">Salir</span>
        </button>
    </form>
</header>
