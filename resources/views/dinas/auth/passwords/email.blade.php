<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="flex h-screen w-full items-center justify-center bg-background px-4">
        <div class="flex w-full max-w-md flex-col items-center rounded-2xl bg-neutral-white px-6 py-8 shadow-md">
            <h3 class="mb-8 text-2xl font-bold dark:text-white">Lupa Kata Sandi</h3>

            <!-- Toast Container -->
            <x-dinas.toast-container :errors="$errors" :session="session()" />

            <!-- Success Message -->
            @if (session('success'))
                <p class="mb-4 text-center text-green-500">Kami telah mengirimkan link reset password ke email Anda.
                    Silakan periksa email Anda.</p>
            @else
                <!-- Reset Password Form -->
                <form method="POST" action="{{ route('pegawai.password.email') }}" class="w-full max-w-sm">
                    @csrf
                    <div class="mb-4">
                        <label for="email"
                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                            autofocus
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500">
                    </div>
                    <div class="flex w-full flex-col items-center">
                        <button type="submit"
                            class="mb-4 w-full rounded-lg bg-primary-500 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-primary-600 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Kirim Link Reset Password
                        </button>
                    </div>
                </form>
            @endif
        </div>
    </div>
    <script src="https://unpkg.com/flowbite@latest/dist/flowbite.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toasts = document.querySelectorAll('.toast');
            toasts.forEach(toast => {
                setTimeout(() => {
                    toast.classList.add('hidden');
                }, 5000);
            });
        });
    </script>
</body>

</html>
