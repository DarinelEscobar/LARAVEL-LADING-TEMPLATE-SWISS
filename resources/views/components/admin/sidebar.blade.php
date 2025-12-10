<div class="hidden md:flex md:flex-shrink-0">
    <div class="flex flex-col w-64 border-r border-border bg-card">
        <div class="flex flex-col flex-grow pt-5 pb-4 overflow-y-auto">
             <div class="px-6 mb-6">
                <a href="{{ route('landing') }}" target="_blank" class="flex items-center gap-2 text-muted-foreground hover:text-primary transition-colors">
                    <x-ui.icon name="external-link" class="w-4 h-4" />
                    <span class="text-xs font-medium uppercase tracking-wider">Ver Sitio Web</span>
                </a>
             </div>

            <nav class="flex-1 px-3 space-y-1">
                @php
                    $navItems = [
                        ['label' => 'Dashboard', 'route' => 'dashboard', 'icon' => 'layout-dashboard'],
                        ['label' => 'Users', 'route' => 'users.index', 'icon' => 'users'],
                        ['label' => 'Products', 'route' => 'products.index', 'icon' => 'package'],
                    ];
                @endphp

                @foreach ($navItems as $item)
                    @php
                        $isActive = request()->routeIs($item['route']) || request()->routeIs(str_replace('.index', '.*', $item['route']));
                        $classes = $isActive
                            ? 'bg-primary/10 text-primary'
                            : 'text-muted-foreground hover:bg-accent hover:text-foreground';
                    @endphp

                    <a href="{{ route($item['route']) }}" class="group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors {{ $classes }}">
                        <x-ui.icon name="{{ $item['icon'] }}" class="mr-3 w-5 h-5 flex-shrink-0 {{ $isActive ? 'text-primary' : 'text-muted-foreground group-hover:text-foreground' }}" />
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </nav>
        </div>

        <div class="flex-shrink-0 flex border-t border-border p-4">
            <div class="flex items-center w-full">
                <div class="ml-3">
                    <p class="text-xs font-medium text-muted-foreground group-hover:text-foreground">
                        v1.0.0
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
