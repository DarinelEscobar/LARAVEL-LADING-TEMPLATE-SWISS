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
