@if (!request()->routeIs('login') && !request()->routeIs('forget.password') && !request()->routeIs('reset.password'))
    <div class="bg-gray-50 dark:bg-gray-900">
        <nav
            class="bg-white border-b border-gray-200 px-4 py-2.5 dark:bg-gray-800 dark:border-gray-700 fixed left-0 right-0 top-0 z-50">
            <div class="flex flex-wrap items-center justify-between">
                <div class="flex items-center justify-start">
                    <button data-drawer-target="drawer-navigation" data-drawer-toggle="drawer-navigation"
                        aria-controls="drawer-navigation"
                        class="p-2 mr-2 text-gray-600 rounded-lg cursor-pointer md:hidden hover:text-gray-900 hover:bg-gray-100 focus:ring-2 focus:ring-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                        <span class="sr-only">Toggle sidebar</span>
                    </button>
                    <a href="{{ route('dashboard') }}" class="flex items-center justify-between mr-4">
                        <img src="{{ asset('storage/logos/logo-lavafy.png') }}" class="mr-3 h-14 dark:hidden"
                            alt="Logo Light" />
                        <img src="{{ asset('storage/logos/logo-lavafy.png') }}" class="hidden mr-3 h-14 dark:block"
                            alt="Logo Dark" />
                    </a>
                </div>
                <div class="flex items-center lg:order-2">
                    <button type="button"
                        class="flex mx-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                        id="user-menu-button" aria-expanded="false" data-dropdown-toggle="dropdown">
                        <span class="sr-only">Open user menu</span>
                        <i class="fas fa-user-circle text-gray-300 text-3xl"></i>
                    </button>
                    <div class="z-50 hidden w-56 my-4 text-base list-none bg-white divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600 rounded-xl"
                        id="dropdown">
                        <div class="px-4 py-3">
                            <span
                                class="block text-sm font-semibold text-gray-900 dark:text-white">{{ Auth()->user()->person->names . ' ' . Auth()->user()->person->surnames }}</span>
                            <span
                                class="block text-sm text-gray-900 truncate dark:text-white">{{ Auth()->user()->email }}</span>
                        </div>
                        <ul class="py-1 text-gray-700 dark:text-gray-300">
                            <li>
                                <a href="{{ route('users.show', Auth()->user()->id) }}"
                                    class="block px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white">
                                    Perfil
                                </a>
                            </li>
                        </ul>
                        <ul class="text-gray-700 dark:text-gray-300">
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="flex items-center w-full px-4 py-3 rounded-b-xl text-sm text-red-600 hover:bg-red-100 hover:text-red-800 dark:text-red-400 dark:hover:bg-red-600 dark:hover:text-white transition-colors">
                                        <i class="fas fa-sign-out-alt mr-2"></i>
                                        Cerrar sesión
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <aside id="drawer-navigation"
            class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full bg-white shadow-xl pt-14 md:translate-x-0 dark:bg-gray-800"
            aria-label="Sidenav">
            <div class="h-full px-3 py-5 overflow-y-auto bg-white dark:bg-gray-800">
                <ul class="mt-6 space-y-4 font-medium">
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                        <i class="fas fa-tachometer-alt text-gray-500"></i>
                        <span class="ml-3">Dashboard</span>
                    </a>
                    <a href=""
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                        <i class="fas fa-home text-gray-500"></i>
                        <span class="ml-3">Boton</span>
                    </a>
                    <div>
                        <button type="button"
                            class="flex items-center w-full p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
                            aria-controls="submenu-two" data-collapse-toggle="submenu-two">
                            <i class="fas fa-envelope text-gray-500"></i>
                            <span class="flex-1 ml-3 text-left whitespace-nowrap">Boton desplegable</span>
                            <i
                                class="fas fa-chevron-down text-sm text-light w-4 h-4 ml-1 transition-transform rotate-90 group-hover:rotate-0"></i>
                        </button>
                        <ul id="submenu-two" class="hidden py-2 space-y-2">
                            <li>
                                <a href=""
                                    class="flex items-center w-full p-2 pl-11 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <i class="fas fa-envelope mr-2 w-4 h-4 text-gray-500"></i>
                                    Opción 1
                                </a>
                            </li>
                            <li>
                                <a href=""
                                    class="flex items-center w-full p-2 pl-11 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <i class="fas fa-briefcase mr-2 w-4 h-4 text-gray-500"></i>
                                    Opción 2
                                </a>
                            </li>
                        </ul>
                    </div>
                </ul>
            </div>
        </aside>
        <main class="h-auto p-4 pt-20 overflow-x-auto md:ml-64">
            @include('partials.alerts')
            @yield('content')
        </main>
    </div>
@else
    @yield('content')
@endif
