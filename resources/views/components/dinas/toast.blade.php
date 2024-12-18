@props(['type' => 'error', 'message' => ''])

@php
    $toastId = 'toast-' . $type;
    $iconColor = match ($type) {
        'error' => 'text-red-500 bg-red-100 dark:bg-red-800 dark:text-red-200',
        'success' => 'text-green-500 bg-green-100 dark:bg-green-800 dark:text-green-200',
        'info' => 'text-blue-500 bg-blue-100 dark:bg-blue-800 dark:text-blue-200',
        'warning' => 'text-yellow-500 bg-yellow-100 dark:bg-yellow-800 dark:text-yellow-200',
        default => 'text-gray-500 bg-gray-100 dark:bg-gray-800 dark:text-gray-200',
    };

    $bgColor = 'bg-white dark:bg-gray-800';
@endphp

<div id="{{ $toastId }}"
    class="fixed top-16 right-4 z-50 flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 {{ $bgColor }} rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
    role="alert">
    <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 {{ $iconColor }} rounded-lg">
        @if ($type === 'error')
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z" />
            </svg>
        @elseif ($type === 'success')
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M16.293 5.293a1 1 0 0 0-1.414 0L8 11.586 5.121 8.707a1 1 0 0 0-1.415 1.413l3.707 3.707a1 1 0 0 0 1.414 0l7-7a1 1 0 0 0 0-1.414zM10 18a8 8 0 1 1 0-16 8 8 0 0 1 0 16z" />
            </svg>
        @elseif ($type === 'info')
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 2a8 8 0 1 0 0 16A8 8 0 0 0 10 2Zm0 11a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm0-4a1 1 0 0 1-1-1V7a1 1 0 1 1 2 0v2a1 1 0 0 1-1 1Z" />
            </svg>
        @elseif ($type === 'warning')
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 2a8 8 0 0 0-7.466 11.075L3 17h14l.466-3.925A8 8 0 0 0 10 2Zm-1 4a1 1 0 0 1 2 0v4a1 1 0 0 1-2 0V6Zm0 6a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z" />
            </svg>
        @endif
        <span class="sr-only">{{ ucfirst($type) }} icon</span>
    </div>
    <div class="ms-3 text-sm font-normal">{{ $message }}</div>
    <button type="button"
        class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
        data-dismiss-target="#{{ $toastId }}" aria-label="Close">
        <span class="sr-only">Close</span>
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
        </svg>
    </button>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toasts = document.querySelectorAll('[id^="toast-"]');
        toasts.forEach(toast => {
            setTimeout(() => {
                toast.classList.add('hidden');
            }, 5000); // Adjust time as needed
        });
    });
</script>