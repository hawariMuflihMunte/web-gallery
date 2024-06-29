{{-- Set the button first before use this modal. See https://flowbite.com/docs/components/modal/ --}}

<!-- Main modal -->
<div
    id="{{ $modalId ?? "modal" }}"
    data-modal-backdrop="static"
    tabindex="-1"
    aria-hidden="true"
    class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0"
>
    <div class="relative max-h-full w-full max-w-2xl p-4">
        <!-- Modal content -->
        <div class="relative rounded-lg bg-white shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div
                class="flex items-center justify-between rounded-t border-b p-4 dark:border-gray-600 md:p-5"
            >
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    {{ $title ?? "Modal" }}
                </h3>
                @if (isset($closeButton))
                    {{-- This syntax `{{ !! }}` is used to display unescaped content. In this case, it's used to display the content of the `$closeButton` variable without escaping any HTML entities. This is useful when you want to include HTML code in your Blade templates. --}}
                    {!! $closeButton !!}
                @else
                    <button
                        type="button"
                        class="ml-auto inline-flex items-center rounded-lg bg-transparent p-1.5 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-700 dark:hover:text-white"
                        data-modal-hide="{{ $modalId ?? "modal" }}"
                    >
                        <span class="sr-only">@lang("app.close")</span>
                        <svg
                            class="h-5 w-5"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>
                    </button>
                @endif
            </div>
            <!-- Modal body -->
            <div class="space-y-4 p-4 md:p-5">
                {{ $slot }}
            </div>
            <!-- Modal footer -->
            @if (isset($footer))
                <div
                    class="flex items-center justify-end border-t p-4 dark:border-gray-600"
                >
                    {!! $footer !!}
                </div>
            @endif
        </div>
    </div>
</div>
