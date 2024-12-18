<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Explore Jabar - Dinas')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .icon {
            width: 24px;
            height: 24px;
            cursor: pointer;
        }

        .icon-hidden {
            display: none;
        }
    </style>
</head>

<body>
    <div class="flex h-screen w-full items-center justify-center bg-background px-4">
        <!-- Toast Container -->
        <x-dinas.toast-container :errors="$errors" :session="session()" />

        <div class="flex w-full max-w-md flex-col items-center rounded-2xl bg-neutral-white px-6 py-8 shadow-md">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" width="60px">
            <h3 class="mb-8 text-2xl font-bold dark:text-white">DISPARBUD</h3>

            <form method="POST" action="{{ route('dinas.login.post') }}" class="w-full max-w-sm">
                @csrf
                <div class="mb-4">
                    <label for="email"
                        class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                        placeholder="example@mail.com" required />
                </div>
                <div class="relative mb-4">
                    <label for="password"
                        class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Password</label>
                    <div class="relative">
                        <input type="password" id="password" name="password"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 pr-12 text-sm text-black focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                            placeholder="••••••••••" required />
                        <div class="absolute inset-y-4 right-3 flex items-center space-x-2">
                            <svg id="show-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="icon">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                            <svg id="hide-icon" class="icon icon-hidden" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>
                        </div>
                    </div>

                </div>
                <div class="flex w-full flex-col items-center">
                    <button type="submit"
                        class="mb-4 w-full rounded-lg bg-primary-500 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-primary-600 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login</button>
                    @if (Route::has('pegawai.password.request'))
                        <a href="{{ route('pegawai.password.request') }}"
                            class="text-blue-600 hover:underline dark:text-blue-500">Lupa kata sandi?</a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Include Flowbite JS -->
    <script src="https://unpkg.com/flowbite@latest/dist/flowbite.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toast = document.getElementById('toast-danger');
            if (toast) {
                setTimeout(() => {
                    toast.classList.add('hidden');
                }, 5000);
            }

            // Password visibility toggle
            const passwordField = document.getElementById('password');
            const showIcon = document.getElementById('show-icon');
            const hideIcon = document.getElementById('hide-icon');

            showIcon.addEventListener('click', function() {
                passwordField.type = 'text';
                showIcon.classList.add('icon-hidden');
                hideIcon.classList.remove('icon-hidden');
            });

            hideIcon.addEventListener('click', function() {
                passwordField.type = 'password';
                hideIcon.classList.add('icon-hidden');
                showIcon.classList.remove('icon-hidden');
            });
        });
    </script>
</body>

</html>
