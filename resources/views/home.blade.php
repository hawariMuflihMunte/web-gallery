@extends('layouts.app')

@section('title', 'Web Gallery | Home')

@section('content')

  @include('layouts.nav')

  <main class="min-w-full min-h-[100vh] pt-28">
    @session('success-login')
      <x-alert title="Selamat Datang !" :message="session('success-login')"></x-alert>
    @endsession
    <section
      role="group"
      class="flex justify-center sm:justify-start gap-4 flex-wrap max-w-[92%] md:max-w-[80%] mx-auto"
    >
      <a
        href="{{ route('gallery.create') }}"
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
      @foreach ($albums as $album)
        <a
          href="{{ route('gallery.edit', $album['AlbumID']) }}"
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
            <h2>{{ $album['NamaAlbum'] }}</h2>
          </section>
        </a>
      @endforeach
    </section>
  </main>

  @include('layouts.footer')

@endsection
