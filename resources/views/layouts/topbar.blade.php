<nav class="fixed z-40 w-full border-gray-200 bg-slate-100 dark:bg-gray-900">
    <div class="mx-auto flex max-w-screen-xl flex-wrap items-center justify-between p-4">
        <a
            href="{{ route("album.index") }}"
            class="flex items-center space-x-3 rtl:space-x-reverse"
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
        <div
            class="flex items-center space-x-3 md:order-2 md:space-x-0 rtl:space-x-reverse"
        >
            <button
                type="button"
                class="flex rounded-full bg-gray-800 text-sm focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600 md:me-0"
                id="user-menu-button"
                aria-expanded="false"
                data-dropdown-toggle="user-dropdown"
                data-dropdown-placement="bottom"
            >
                <span class="sr-only">@lang("app.open_user_menu")</span>
                <img
                    class="h-8 w-8 rounded-full"
                    src="{{ asset("images/users/dummy/boy.png") }}"
                    alt="user photo"
                />
            </button>
            <!-- Dropdown menu -->
            <div
                class="z-50 my-4 hidden list-none divide-y divide-gray-100 rounded-lg bg-white text-base shadow dark:divide-gray-600 dark:bg-gray-700"
                id="user-dropdown"
            >
                <div class="px-4 py-3">
                    <span class="block text-sm text-gray-900 dark:text-white">
                        {{ auth()->user()->full_name }}
                    </span>
                    <span class="block truncate text-sm text-gray-500 dark:text-gray-400">
                        {{ "@" }}{{ auth()->user()->username }}
                    </span>
                </div>
                <ul
                    class="py-2"
                    aria-labelledby="user-menu-button"
                >
                    <li>
                        <a
                            href="{{ route("album.show", auth()->user()->slug) }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-600 dark:hover:text-white"
                        >
                            @lang("app.your_albums")
                        </a>
                    </li>
                    <li>
                        <a
                            href="{{ route("user.show", auth()->user()->slug) }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-600 dark:hover:text-white"
                        >
                            @lang("app.settings")
                        </a>
                    </li>
                    <li>
                        <a
                            href="{{ route("logout") }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-100 dark:text-gray-200 dark:hover:bg-gray-600 dark:hover:text-white"
                        >
                            @lang("app.logout")
                        </a>
                    </li>
                </ul>
            </div>
            <button
                data-collapse-toggle="navbar-user"
                type="button"
                class="inline-flex h-10 w-10 items-center justify-center rounded-lg p-2 text-sm text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600 md:hidden"
                aria-controls="navbar-user"
                aria-expanded="false"
            >
                <span class="sr-only">@lang("app.open_main_menu")</span>
                <svg
                    class="h-5 w-5"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 17 14"
                >
                    <path
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15"
                    />
                </svg>
            </button>
        </div>
        <div
            class="hidden w-full items-center justify-between md:order-1 md:flex md:w-auto"
            id="navbar-user"
        >
            <ul
                class="mt-4 flex flex-col rounded-lg border border-gray-100 bg-gray-50 p-4 font-medium dark:border-gray-700 dark:bg-gray-800 md:mt-0 md:flex-row md:space-x-8 md:border-0 md:bg-transparent md:p-0 md:dark:bg-gray-900 rtl:space-x-reverse"
            >
                <li>
                    <a
                        href="{{ route("album.index") }}"
                        @if (request()->is("album"))
                            class="block rounded px-3 py-2 text-white md:p-0 bg-blue-700 md:text-blue-700 md:dark:text-blue-500 md:bg-transparent"
                        @else
                            class="block rounded px-3 py-2 md:p-0 bg-slate-300 sm:bg-transparent text-slate-800 md:text-slate-700"
                        @endif
                        aria-current="@if (request()->is('album')) page @else '' @endif"
                    >
                        <i class="bi-house-fill md:hidden"></i>
                        @lang("app.home")
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
