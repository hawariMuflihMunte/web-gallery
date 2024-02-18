@extends('layouts.app')

@section('title', 'Web Gallery | Home')

@section('content')
  <nav
    class="w-full fixed min-h-10 flex items-center px-5 py-3 text-gray-700 justify-between z-50 border-b-2 border-b-slate-300 bg-teal-200"
    x-data="{
      openList: false,
      logoutConfirm: false,
    }"
  >
    <h1 class="text-2xl italic font-semibold">Web Gallery</h1>
    <section class="relative">
      <button
        type="button"
        class="glass_morphism_bg outline-none px-3 py-1 text-lg hover:opacity-80 transition duration-100 border border-slate-300"
        @click="openList = !openList"
      >
        <i class="bi-list"></i>
      </button>
      <template x-if="openList">
        <section
          class="glass_morphism_bg absolute right-0 py-2 shadow-md border-slate-300"
        >
          <ul class="flex flex-col gap-4">
            <li>
              <a href="#" class="flex items-center gap-2 px-5 py-2 bg-inherit hover:brightness-125 hover:opacity-60 text-slate-800 transition-all duration-100">
                <i class="bi-person-circle"></i>
                Profil
              </a>
            </li>
            <li>
              <button
                type="button"
                class="flex items-center gap-2 px-5 py-2 bg-red-500 hover:bg-red-400 text-white transition-all duration-100"
                @click="logoutConfirm = true"
              >
                <i class="bi-x-square"></i>
                Keluar
              </button>
              {{-- <a href="{{ route('logout') }}" ></a> --}}
            </li>
          </ul>
        </section>
      </template>
    </section>
    {{-- Popups --}}
    <section
      class="fixed inset-0 z-50 bg-black bg-opacity-40 flex items-center justify-center p-8"
      x-show="logoutConfirm"
    >
      <article
        class="glass_morphism_bg w-full md:1/2 px-8 py-10 rounded-sm"
        @click.outside="logoutConfirm = false"
      >
        <h3 class="text-2xl">Yakin ingin keluar ?</h3>
        <hr class="border-gray-700 my-2">
        <section class="my-6"></section>
        <section class="flex gap-6">
          <a
            href="{{ route('logout') }}"
            class="glass_morphism_red_bg px-3 py-1 rounded-md"
          >
            Ya
          </a>
          <button
            class="glass_morphism_navy_bg px-3 py-1 rounded-md"
            @click="logoutConfirm = false"
          >
            Batal
          </button>
        </section>
      </article>
    </section>
    {{-- Endof Popups --}}
  </nav>
  <main class="min-w-full min-h-full h-[100vh] pt-28">
    @session('success-login')
      <x-alert title="Selamat Datang !" :message="session('success-login')"></x-alert>
    @endsession
    <section
      role="group"
      class="flex justify-center sm:justify-start gap-4 flex-wrap max-w-[92%] md:max-w-[80%] mx-auto"
    >
      <a
        href="#"
        class="flex flex-col bg-emerald-300 text-slate-700 font-bold rounded-sm max-w-[200px] md:max-w-[240px] lg:min-w-[300px] overflow-hidden cursor-pointer border border-slate-400"
        role="article"
        x-data="{
          showImage: false
        }"
        x-on:mouseover="showImage = true"
        x-on:mouseleave="showImage = false"
      >
        <section class="w-full">
          <img
            src="{{ asset('images/bg_add_image.png') }}"
            alt="illustration"
            class="h-auto w-full"
            x-show="showImage"
            x-transition.duration.200ms
          />
        </section>
        <section class="w-full text-inherit min-w-[200px] md:min-w-[240px] lg:min-w-[300px] flex justify-center items-center py-4">
          <h2>Tambah Album</h2>
        </section>
      </a>
    </section>
  </main>
  <footer class="px-4 py-5 flex border-t-2 border-t-slate-300 bg-violet-200">
    <section class="flex">
      <h3 class="text-base font-semibold">Web Gallery @ <span class="font-normal" x-data x-text="new Date().getFullYear()"></span></h3>
    </section>
  </footer>
@endsection
