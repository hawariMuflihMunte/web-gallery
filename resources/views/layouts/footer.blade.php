<footer class="m-4 rounded-lg bg-white shadow dark:bg-gray-900">
    <div class="mx-auto w-full max-w-screen-xl p-4 md:py-8">
        <div class="sm:flex sm:items-center sm:justify-between">
            <a
                href="{{ route("album.index") }}"
                class="mb-4 flex items-center space-x-3 sm:mb-0 rtl:space-x-reverse"
            >
                <img
                    src="{{ asset("images/application/sphertra.png") }}"
                    class="h-8"
                    alt="{{ __("app.app_name") }} Logo"
                />
                <span
                    class="self-center whitespace-nowrap text-2xl font-semibold dark:text-white"
                >
                    @lang("app.app_name")
                </span>
            </a>
            <ul
                class="mb-6 flex flex-wrap items-center text-sm font-medium text-gray-500 dark:text-gray-400 sm:mb-0"
            >
                <li>
                    <a
                        href="{{ route("album.index") }}"
                        class="me-4 hover:underline md:me-6"
                    >
                        @lang("app.home")
                    </a>
                </li>
            </ul>
        </div>
        <hr class="my-6 border-gray-200 dark:border-gray-700 sm:mx-auto lg:my-8" />
        <span class="block text-sm text-gray-500 dark:text-gray-400 sm:text-center">
            ©
            <span
                mclass="font-normal"
                x-data
                x-text="new Date().getFullYear()"
            ></span>
            <a
                href="{{ route("album.index") }}"
                class="hover:underline"
            >
                @lang("app.app_name")
            </a>
            .
            @lang("app.all_rights_reserved")
            .
        </span>
    </div>
</footer>
