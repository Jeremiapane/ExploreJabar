<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/dinas.css'])
    <title>404 Not Found</title>
</head>

<body class="flex min-h-screen w-full items-center justify-center">
    <section class="bg-white dark:bg-gray-900">
        <div class="mx-auto max-w-screen-xl px-4 py-8 lg:px-6 lg:py-16">
            <div class="mx-auto max-w-screen-sm text-center">
                <h1
                    class="mb-4 text-7xl font-extrabold tracking-tight text-primary-600 dark:text-primary-500 lg:text-9xl">
                    404</h1>
                <p class="mb-4 text-3xl font-bold tracking-tight text-gray-900 dark:text-white md:text-4xl">Something's
                    missing.</p>
                <p class="mb-4 text-lg font-light text-gray-500 dark:text-gray-400">Sorry, we can't find that page.
                    You'll find lots to explore on the home page. </p>
                <a onclick="window.history.back()"
                    class="hover:bg-primary-800 focus:ring-primary-300 dark:focus:ring-primary-900 my-4 inline-flex rounded-lg bg-primary-600 px-5 py-2.5 text-center text-sm font-medium text-white focus:outline-none focus:ring-4">Back
                </a>
            </div>
        </div>
    </section>
</body>

</html>
