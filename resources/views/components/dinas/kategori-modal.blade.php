@props(['modalId', 'title', 'formId', 'action', 'method' => 'POST', 'label', 'inputId', 'buttonText'])

<div id="{{ $modalId }}"
    {{ $attributes->merge(['class' => 'fixed inset-0 z-50 hidden items-center justify-center bg-gray-600 bg-opacity-50']) }}>
    <div class="relative w-full max-w-md rounded-lg bg-white p-6 shadow-md">
        <button type="button" onclick="closeModal('{{ $modalId }}')"
            class="absolute right-4 top-4 text-gray-500 hover:text-gray-700">
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <h2 class="mb-4 text-xl font-semibold">{{ $title }}</h2>
        <form id="{{ $formId }}" method="POST" action="{{ $action }}">
            @csrf
            @if ($method !== 'POST')
                @method($method)
            @endif
            <div class="mb-4">
                <label for="{{ $inputId }}"
                    class="block text-sm font-medium text-gray-700">{{ $label }}</label>
                <input type="text" name="nama" id="{{ $inputId }}" pattern="[A-Za-z\s]+"
                    title="Hanya huruf dan spasi yang diperbolehkan"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50"
                    required>
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="closeModal('{{ $modalId }}')"
                    class="mr-2 rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-700 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-900">Batal</button>
                <button type="submit"
                    class="rounded-lg bg-primary-500 px-4 py-2 text-white hover:bg-primary-600">{{ $buttonText }}</button>
            </div>
        </form>
    </div>
</div>