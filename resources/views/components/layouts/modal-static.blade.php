{{-- Set the button first before use this modal. See https://flowbite.com/docs/components/modal/ --}}

<!-- Main modal -->
<div id="{{ $modalId ?? 'modal' }}" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700" >
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    {{ $title ?? 'Modal' }}
                </h3>
                @if (isset($closeButton))
                    {{-- This syntax `{{ !! }}` is used to display unescaped content. In this case, it's used to display the content of the `$closeButton` variable without escaping any HTML entities. This is useful when you want to include HTML code in your Blade templates. --}}
                    {!! $closeButton !!}
                @else
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-700 dark:hover:text-white" data-modal-hide="{{ $modalId ?? 'modal' }}">
                        <span class="sr-only">@lang('app.close')</span>
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                @endif
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4">
                {{ $slot }}
            </div>
            <!-- Modal footer -->
            @if (isset($footer))
                <div class="flex items-center justify-end p-4 border-t dark:border-gray-600">
                    {!! $footer !!}
                </div>
            @endif
        </div>
    </div>
</div>
