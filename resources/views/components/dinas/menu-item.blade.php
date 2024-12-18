@props(['active' => false])
<a
    {{ $attributes->merge(['class' => 'flex items-center p-2 text-base font-medium rounded-lg transition duration-75 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-neutral-black dark:text-white group ' . ($active ? 'bg-primary-500 text-white dark:bg-neutral-white dark:text-neutral-black' : 'text-gray-900')]) }}>
    {{ $slot }}
</a>
