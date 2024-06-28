@extends("layouts.app")

@section("title")
    @lang("app.app_name")
    |
    @lang("app.home")
@endsection

@section("content")
    @include("layouts.topbar")

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

        <section class="mx-auto max-w-[96%] md:max-w-[90%] xl:max-w-[85%]">
            <h1 class="mb-12 text-center text-2xl font-semibold sm:text-left">
                @lang("app.albums")
            </h1>
            <section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                @if (count($albums) > 0)
                    @foreach ($albums as $album)
                        <section class="grid gap-4">
                            <a
                                href="{{ route("album.edit", $album["slug"]) }}"
                                class="flex h-full w-full flex-col place-content-center place-items-center transition-all duration-200 hover:bg-slate-200"
                            >
                                <section class="relative h-full w-full overflow-hidden">
                                    <img
                                        @if (! empty($album->photos()->first()))
                                            src="{{ url($album->photos()->first()["LokasiFile"]) }}"
                                            alt="{{ $album->photos()->first()["DeskripsiFoto"] }}"
                                        @else
                                            src="{{ asset("images/bg_no_image.png") }}"
                                            alt="Coffee Time. There are no images in this album"
                                        @endif
                                        class="h-full w-full object-cover"
                                        loading="lazy"
                                    />
                                    <section
                                        class="absolute left-0 top-0 z-10 flex h-full w-full flex-col items-center justify-center text-center text-lg tracking-widest text-transparent duration-200 ease-linear hover:bg-white hover:bg-opacity-95 hover:text-slate-800"
                                    >
                                        <h2 class="text-center">{{ $album["NamaAlbum"] }}</h2>
                                    </section>
                                </section>
                            </a>
                        </section>
                    @endforeach
                @else
                    <section
                        class="flex h-full w-full flex-col place-content-center place-items-center bg-slate-200 transition-all duration-200"
                    >
                        <img
                            src="{{ asset("images/bg_no_image.png") }}"
                            alt="No Photo. Click to add"
                            loading="lazy"
                            class="block transition-all duration-200"
                        >
                        <h2>No Albums Found</h2>
                    </section>
                @endif
            </section>

        </section>
    </main>

    @include("layouts.footer")
@endsection
