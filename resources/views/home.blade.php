@extends("layouts.app")

@section("title", "Web Gallery | Home")

@section("content")
  @include("layouts.nav")

  <main class="min-h-[100vh] min-w-full pt-28">
    @session("success-login")
      <x-alert
        title="Selamat Datang !"
        :message="session('success-login')"
      ></x-alert>
    @endsession

    @session("destroy-success")
      <x-alert
        title="Berhasil !"
        :message="session('destroy-success')"
      ></x-alert>
    @endsession

    <section
      role="group"
      class="mx-auto flex max-w-[92%] flex-wrap justify-center gap-4 sm:justify-start md:max-w-[80%]"
    >
      <a
        href="{{ route("gallery.create") }}"
        class="flex max-w-[200px] cursor-pointer flex-col overflow-hidden rounded-sm border border-slate-400 bg-emerald-300 font-bold text-slate-700 md:max-w-[240px] lg:min-w-[300px]"
        role="article"
        x-data="{
          showImage: false,
        }"
        x-on:mouseover="showImage = true"
        x-on:mouseleave="showImage = false"
      >
        <section class="w-full">
          <img
            src="{{ asset("images/bg_add_image.png") }}"
            alt="illustration"
            class="h-auto w-full"
            x-show="showImage"
            x-transition.duration.200ms
          />
        </section>
        <section
          class="flex w-full min-w-[200px] items-center justify-center py-4 text-inherit md:min-w-[240px] lg:min-w-[300px]"
        >
          <h2>Tambah Album</h2>
        </section>
      </a>
      @foreach ($albums as $album)
        <a
          href="{{ route("gallery.edit", $album["AlbumID"]) }}"
          class="flex max-w-[200px] cursor-pointer flex-col overflow-hidden rounded-sm border border-slate-400 bg-emerald-300 font-bold text-slate-700 md:max-w-[240px] lg:min-w-[300px]"
          role="article"
          x-data="{
            showImage: false,
          }"
          x-on:mouseover="showImage = true"
          x-on:mouseleave="showImage = false"
        >
          <section class="w-full">
            <img
              src="{{ asset("images/bg_add_image.png") }}"
              alt="illustration"
              class="h-auto w-full"
              x-show="showImage"
              x-transition.duration.200ms
            />
          </section>
          <section
            class="flex w-full min-w-[200px] items-center justify-center py-4 text-inherit md:min-w-[240px] lg:min-w-[300px]"
          >
            <h2>{{ $album["NamaAlbum"] }}</h2>
          </section>
        </a>
      @endforeach
    </section>
  </main>

  @include("layouts.footer")
@endsection
