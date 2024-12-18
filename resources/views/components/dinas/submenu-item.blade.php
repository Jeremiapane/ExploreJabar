<a {{ $attributes }}
    class="{{ $active ? 'bg-primary-500 text-white dark:bg-neutral-white dark:text-neutral-black' : 'text-gray-900' }} flex items-center p-2 pl-11 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 hover:text-neutral-black dark:text-white dark:hover:bg-gray-700">{{ $slot }}</a>
