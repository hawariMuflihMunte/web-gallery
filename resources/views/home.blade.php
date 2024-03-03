@extends("layouts.app")

@section("title", "Web Gallery | Home")

@section("content")
  @include("layouts.nav")

  <main class="min-h-[100vh] min-w-full py-28">
    @session("success-login")
      <x-alert
        title="Selamat Datang !"
        :message="session('success-login')"
      ></x-alert>
    @endsession

    @session("insert-success")
      <x-alert
        title="Selamat Datang !"
        :message="session('insert-success')"
      ></x-alert>
    @endsession

    @session("destroy-success")
      <x-alert
        title="Berhasil !"
        :message="session('destroy-success')"
      ></x-alert>
    @endsession

    <section class="mx-auto max-w-[92%] md:max-w-[80%]">
      <h1 class="mb-12 text-2xl font-semibold">Album</h1>
      <section
        role="group"
        class="grid max-h-[500px] grid-cols-1 gap-5 overflow-y-scroll sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4"
      >
        @foreach ($albums as $album)
          <a
            href="{{ route("gallery.edit", $album["AlbumID"]) }}"
            class="flex h-max cursor-pointer flex-col overflow-hidden rounded-sm border border-slate-400 bg-slate-200 font-bold text-slate-700"
            role="article"
            x-data="{
                imageHovered: false,
            }"
            x-on:mouseover="imageHovered = true"
            x-on:mouseleave="imageHovered = false"
          >
            <section class="w-full">
              <img
                @if (! empty($album->foto()->get()->first()))
                    src="{{ url("/storage/" .$album->foto()->get()->first()["LokasiFile"],) }}"
                    alt="{{ $album->foto()->get()->first()["DeskripsiFoto"] }}"
                @else
                    src="{{ asset("images/bg_no_image.png") }}"
                    alt="Coffee Time. There are no images in this album"
                @endif
                class="h-auto w-full duration-200 ease-linear"
                loading="lazy"
                :class="imageHovered ? 'scale-100' : 'scale-95'"
              />
            </section>
            <section
              class="flex max-h-16 w-full items-center justify-center text-clip border-t border-t-slate-400 bg-slate-100 py-4 text-inherit"
            >
              <h2>{{ $album["NamaAlbum"] }}</h2>
            </section>
          </a>
        @endforeach
      </section>

      <section class="mt-40">
        <h1 class="mb-12 text-2xl font-semibold">Album {{ $user["Username"] }}</h1>
        <section
          role="group"
          class="grid max-h-[500px] grid-cols-1 gap-5 overflow-y-scroll sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4"
        >
          <a
            href="{{ route("gallery.create") }}"
            class="flex h-max cursor-pointer flex-col overflow-hidden rounded-sm border border-slate-400 bg-slate-200 font-bold text-slate-700"
            role="article"
            x-data="{
                imageHovered: false,
            }"
            x-on:mouseover="imageHovered = true"
            x-on:mouseleave="imageHovered = false"
          >
            <section class="w-full">
              <img
                src="{{ asset("images/bg_add_image.png") }}"
                alt="illustration"
                class="h-auto w-full duration-200 ease-linear"
                loading="lazy"
                :class="imageHovered ? 'scale-100' : 'scale-95'"
              />
            </section>
            <section
              class="flex max-h-16 w-full items-center justify-center text-clip border-t border-t-slate-400 bg-slate-100 py-4 text-inherit"
            >
              <h2>Tambah Album</h2>
            </section>
          </a>
          @foreach ($user->album()->get() as $album)
            <a
              href="{{ route("gallery.edit", $album["AlbumID"]) }}"
              class="flex h-max cursor-pointer flex-col overflow-hidden rounded-sm border border-slate-400 bg-slate-200 font-bold text-slate-700"
              role="article"
              x-data="{
                  imageHovered: false,
              }"
              x-on:mouseover="imageHovered = true"
              x-on:mouseleave="imageHovered = false"
            >
              <section class="w-full">
                <img
                  @if (! empty($album->foto()->get()->first()))
                      src="{{ url("/storage/" .$album->foto()->get()->first()["LokasiFile"],) }}"
                      alt="{{ $album->foto()->get()->first()["DeskripsiFoto"] }}"
                  @else
                      src="{{ asset("images/bg_no_image.png") }}"
                      alt="Coffee Time. There are no images in this album"
                  @endif
                  class="h-auto w-full duration-200 ease-linear"
                  loading="lazy"
                  :class="imageHovered ? 'scale-100' : 'scale-95'"
                />
              </section>
              <section
                class="flex max-h-16 w-full items-center justify-center text-clip border-t border-t-slate-400 bg-slate-100 py-4 text-inherit"
              >
                <h2>{{ $album["NamaAlbum"] }}</h2>
              </section>
            </a>
          @endforeach
        </section>
      </section>
    </section>
  </main>

  @include("layouts.footer")
@endsection
