<nav
  class="fixed z-50 flex min-h-10 w-full items-center justify-between border-b-2 border-b-slate-300 bg-teal-200 px-5 py-3 text-gray-700"
  x-data="{
    openList: false,
    logoutConfirm: false,
  }"
>
  <h1 class="rounded-sm border border-slate-400 shadow-lg">
    <img
      src="{{ asset("favicon-32x32.png") }}"
      alt="Web Gallery"
    />
  </h1>
  <section class="relative">
    <button
      type="button"
      class="glass_morphism_bg border border-slate-300 px-3 py-1 text-lg outline-none transition duration-100 hover:opacity-80"
      @click="openList = !openList"
    >
      <i class="bi-list"></i>
    </button>
    <template x-if="openList">
      <section class="glass_morphism_bg absolute right-0 border-slate-300 py-2 shadow-md">
        <ul class="flex flex-col gap-4">
          <li>
            <a
              href="#"
              class="flex items-center gap-2 bg-inherit px-5 py-2 text-slate-800 transition-all duration-100 hover:opacity-60 hover:brightness-125"
            >
              <i class="bi-person-circle"></i>
              Profil
            </a>
          </li>
          <li>
            <button
              type="button"
              class="flex items-center gap-2 bg-red-500 px-5 py-2 text-white transition-all duration-100 hover:bg-red-400"
              @click="logoutConfirm = true"
            >
              <i class="bi-x-square"></i>
              Keluar
            </button>
          </li>
        </ul>
      </section>
    </template>
  </section>
  {{-- Popups --}}
  <section
    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 p-8"
    x-show="logoutConfirm"
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
