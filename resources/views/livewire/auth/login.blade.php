<div class="flex items-center justify-center w-full h-screen dark:bg-gray-950">
    <div class="flex w-full text-slate-800">
        <div class="relative flex-col justify-center hidden object-center h-screen text-center md:flex md:w-1/2">
            <img class="object-cover w-full h-full" src="https://picsum.photos/1920/1080?grayscale" />
        </div>
        <div class="flex flex-col items-center justify-center h-screen w-full md:w-1/2">
            <div class="my-auto mx-auto flex flex-col justify-center px-6 pt-8 md:justify-start lg:w-[28rem]">
                <p class="text-3xl font-bold text-center dark:text-white md:leading-tight">Inicia sesión</p>
                <p class="text-lg mt-4 text-center text-gray-600 dark:text-gray-300">
                    Ingresa tus credenciales para acceder a tu cuenta
                </p>
                <form wire:submit.prevent="login" class="flex flex-col items-stretch pt-3 md:pt-8">
                    <div class="flex flex-col pt-4">
                        <div class="mb-0">
                            <label for="email"
                                class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Correo
                                electrónico
                            </label>
                            <input type="email" id="email" wire:model="email"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                placeholder="your@email.com" required>
                            @include('partials.message', ['input' => 'email'])
                        </div>
                    </div>
                    <div class="flex flex-col pt-4 mb-4">
                        <label for="password"
                            class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Contraseña</label>
                        <div class="relative mb-4 password-container">
                            <input type="password" id="password" wire:model="password"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md password-input focus:outline-none focus:border-blue-400"
                                placeholder="Contraseña">
                            <span id="togglePassword"
                                class="absolute transform -translate-y-1/2 cursor-pointer top-1/2 right-4 text-gray-600">
                                <i id="eyeIcon" class="fas fa-eye"></i>
                            </span>
                        </div>
                        @include('partials.message', ['input' => 'password'])
                        <a href="{{ route('forget.password') }}"
                            class="text-gray-600 dark:text-white text-md hover:text-indigo-500 transition-all duration-300">¿Olvidaste
                            tu contraseña?</a>
                    </div>
                    <button type="submit"
                        class="px-4 py-2 mt-6 text-base font-semibold text-center text-white transition bg-blue-600 rounded-lg shadow-md outline-none ring-blue-500 ring-offset-2 hover:bg-blue-700 focus:ring-2 md:w-32">Ingresar</button>
                    <div wire:loading wire:target="login"
                        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">
                        <div class="h-screen flex justify-center items-center">
                            <div class="flex flex-col items-center justify-center bg-black/50 p-6 rounded-lg">
                                <i class="fas fa-spinner fa-spin text-4xl text-blue-600 mb-4"></i>
                                <p class="text-sm text-gray-100">Iniciando sesión</p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const passwordInput = document.getElementById("password");
        const togglePassword = document.getElementById("togglePassword");
        const eyeIcon = document.getElementById("eyeIcon");

        togglePassword.addEventListener("click", () => {
            const isPassword = passwordInput.type === "password";
            passwordInput.type = isPassword ? "text" : "password";

            eyeIcon.classList.toggle("fa-eye");
            eyeIcon.classList.toggle("fa-eye-slash");
        });
    });
</script>
