<!-- Modal toggle -->
<button
    data-modal-target="{{ $modalId ?? 'modal' }}"
    data-modal-toggle="{{ $modalId ?? 'modal' }}"
    {{ $attributes->merge(['class' => 'block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800']) }}
    type="button">
    {{ $slot }}
</button>

