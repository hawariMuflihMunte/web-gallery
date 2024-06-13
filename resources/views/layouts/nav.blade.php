<nav
    class="fixed z-50 flex min-h-10 w-full items-center justify-between bg-emerald-200 px-5 py-3 text-gray-700 shadow"
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
    <section class="flex">
        <button
            type="button"
            class="rounded-sm bg-white px-3 py-1 text-lg outline-none transition duration-100 hover:opacity-80"
            @click="openList = !openList"
            @click.outside="openList = false"
        >
            <i class="bi-list"></i>
        </button>
        <template x-if="openList">
            <section class="relative">
                <section
                    class="absolute right-0 top-full rounded-sm border-slate-300 bg-white shadow"
                >
                    <ul class="flex flex-col">
                        <li>
                            <a
                                href="{{ route("profile.index") }}"
                                class="flex items-center gap-2 bg-inherit p-3 text-slate-800 transition-all duration-100 hover:bg-emerald-400"
                            >
                                <i class="bi-person-circle"></i>
                                <span class="ps-3">Profil</span>
                            </a>
                        </li>
                        <li>
                            <button
                                type="button"
                                class="flex items-center gap-2 p-3 transition-all duration-100 hover:bg-red-500 hover:text-white"
                                @click="logoutConfirm = true"
                            >
                                <i class="bi-x-square"></i>
                                <span class="ps-3">Keluar</span>
                            </button>
                        </li>
                    </ul>
                </section>
            </section>
        </template>
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
            <h3 class="text-2xl">Yakin ingin keluar ?</h3>
            <hr class="my-2 border-gray-700" />
            <section class="my-6"></section>
            <section class="flex gap-6">
                <a
                    href="{{ route("logout") }}"
                    class="glass_morphism_red_bg rounded-md px-3 py-1"
                >
                    Ya
                </a>
                <button
                    class="glass_morphism_navy_bg rounded-md px-3 py-1"
                    @click="logoutConfirm = false"
                >
                    Batal
                </button>
            </section>
        </article>
    </section>
    {{-- Endof Popups --}}
</nav>
