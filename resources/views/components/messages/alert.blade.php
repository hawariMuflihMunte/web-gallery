@if ($type == "info")
    <div
        class="mb-4 flex items-center rounded-lg border border-blue-300 bg-blue-50 p-4 text-sm text-blue-800 dark:border-blue-800 dark:bg-gray-800 dark:text-blue-400"
        role="alert"
    >
        {{ $slot }}
    </div>
@endif

@if ($type == "danger")
    <div
        class="mb-4 flex items-center rounded-lg border border-red-300 bg-red-50 p-4 text-sm text-red-800 dark:border-red-800 dark:bg-gray-800 dark:text-red-400"
        role="alert"
    >
        {{ $slot }}
    </div>
@endif

@if ($type == "success")
    <div
        class="mb-4 flex items-center rounded-lg border border-green-300 bg-green-50 p-4 text-sm text-green-800 dark:border-green-800 dark:bg-gray-800 dark:text-green-400"
        role="alert"
    >
        {{ $slot }}
    </div>
@endif

@if ($type == "warning")
    <div
        class="mb-4 flex items-center rounded-lg border border-yellow-300 bg-yellow-50 p-4 text-sm text-yellow-800 dark:border-yellow-800 dark:bg-gray-800 dark:text-yellow-300"
        role="alert"
    >
        {{ $slot }}
    </div>
@endif
