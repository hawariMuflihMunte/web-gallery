<nav
    class="fixed z-50 flex min-h-10 w-full items-center justify-between bg-teal-50 p-0 text-gray-700 shadow"
    x-data="{
        openList: false,
        logoutConfirm: false,
    }"
>
    <a
        href="{{ route("gallery.index") }}"
        class="flex rounded-sm border border-slate-400 shadow-lg"
    >
        <img
            src="{{ asset("favicon-32x32.png") }}"
            alt="Web Gallery"
        />
    </a>
    <section class="flex items-center m-0 p-0 gap-4">
        <h1>
            <i class="bi-person-fill"></i>
            {{ auth()->user()->Username }} @role('admin') (@lang('app.administrator')) @endrole
        </h1>
        <section class="flex items-center m-0 p-0 border-l-2 border-l-slate-400">
            <button
                type="button"
                class="rounded-sm bg-inherit px-3 py-1 m-0 outline-none transition duration-100 hover:opacity-80 flex place-content-center place-items-center"
                @click="openList = !openList"
                @click.outside="openList = false"
            >
                <i x-show="openList" class="bi-x-lg text-2xl" x-cloak></i>
                <i x-show="!openList" class="bi-list text-2xl"></i>
            </button>
            <template x-if="openList">
                <section class="relative top-[20px]">
                    <section
                        class="absolute right-0 top-full min-w-[180px] rounded-sm border-slate-300 bg-white shadow"
                    >
                        <ul class="flex flex-col">
                            <li>
                                <a
                                    href="{{ route("gallery.index") }}"
                                    class="align-center flex w-full content-between gap-2 bg-inherit p-3 text-slate-800 transition-all duration-100 hover:bg-emerald-400"
                                >
                                    <i class="bi-house"></i>
                                    <span class="w-full ps-3 text-right">
                                        @lang("app.home")
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a
                                    href="{{ route("album.index") }}"
                                    class="align-center flex w-full content-between gap-2 bg-inherit p-3 text-slate-800 transition-all duration-100 hover:bg-emerald-400"
                                >
                                <i class="bi-ui-checks-grid"></i>
                                <span class="w-full ps-3 text-right">
                                        @lang("app.your_albums")
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a
                                    href="{{ route("profile.index") }}"
                                    class="align-center flex w-full content-between gap-2 bg-inherit p-3 text-slate-800 transition-all duration-100 hover:bg-emerald-400"
                                >
                                    <i class="bi-person-circle"></i>
                                    <span class="w-full ps-3 text-right">
                                        @lang("app.profile")
                                    </span>
                                </a>
                            </li>
                            <li>
                                <button
                                    type="button"
                                    class="align-center flex w-full content-between gap-2 p-3 transition-all duration-100 hover:bg-red-500 hover:text-white"
                                    @click="logoutConfirm = true"
                                >
                                    <i class="bi-x-square"></i>
                                    <span class="w-full ps-3 text-right">
                                        @lang("app.logout")
                                    </span>
                                </button>
                            </li>
                        </ul>
                    </section>
                </section>
            </template>
        </section>
    </section>
    {{-- Popups --}}
    <section
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 p-8"
        x-show="logoutConfirm"
        x-cloak
    >
        <article
            class="glass_morphism_bg md:1/2 w-full rounded-sm px-8 py-10"
            @click.outside="logoutConfirm = false"
        >
            <h3 class="text-2xl">@lang("app.confirm_logout")</h3>
            <hr class="my-2 border-gray-700" />
            <section class="my-6"></section>
            <section class="flex gap-6">
                <a
                    href="{{ route("logout") }}"
                    class="glass_morphism_red_bg rounded-md px-3 py-1"
                >
                    @lang("app.yes")
                </a>
                <button
                    class="glass_morphism_navy_bg rounded-md px-3 py-1"
                    @click="logoutConfirm = false"
                >
                    @lang("app.no")
                </button>
            </section>
        </article>
    </section>
    {{-- Endof Popups --}}
</nav>
