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

        <section class="mx-auto max-w-[96%] md:max-w-[90%] xl:max-w-[85%]">
            <h1 class="mb-12 text-center text-2xl font-semibold sm:text-left">Albums</h1>
            <section
                role="group"
                class="lg:scrollbar-w-2 lg:scrollbar-track-rounded lg:scrollbar-thumb-rounded lg:scrollbar-color-emerald-400 lg:scrollbar-thumb-emerald-400 grid max-h-[40vh] grid-cols-1 gap-5 overflow-y-scroll sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4"
            >
                @foreach ($albums as $album)
                    <a
                        href="{{ route("gallery.edit", $album["AlbumID"]) }}"
                        class="relative flex h-full cursor-pointer flex-col overflow-hidden rounded-sm border border-slate-400 bg-slate-200 font-bold text-slate-700"
                        role="article"
                    >
                        <section class="relative h-full w-full overflow-hidden">
                            <img
                                @if (! empty($album->foto()->get()->first()))
                                    src="{{ url($album->foto()->get()->first()["LokasiFile"],) }}"
                                    alt="{{ $album->foto()->get()->first()["DeskripsiFoto"] }}"
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
                @endforeach
            </section>

            <section class="mt-40">
                <h1 class="mb-12 text-2xl font-semibold">@lang("app.your_album")</h1>
                <section
                    role="group"
                    class="lg:scrollbar-w-2 lg:scrollbar-track-rounded lg:scrollbar-thumb-rounded lg:scrollbar-color-emerald-400 lg:scrollbar-thumb-emerald-400 grid max-h-[40vh] grid-cols-1 gap-5 overflow-y-scroll sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4"
                >
                    <a
                        href="{{ route("gallery.create") }}"
                        class="relative flex h-full cursor-pointer flex-col overflow-hidden rounded-sm border border-slate-400 bg-slate-200 font-bold text-slate-700"
                        role="article"
                    >
                        <section class="relative h-full w-full overflow-hidden">
                            <img
                                src="{{ asset("images/bg_add_image.png") }}"
                                alt="illustration"
                                class="h-full w-full object-cover"
                                loading="lazy"
                            />
                            <section
                                class="absolute left-0 top-0 z-10 flex h-full w-full flex-col items-center justify-center text-center text-lg tracking-widest text-transparent duration-200 ease-linear hover:bg-white hover:bg-opacity-95 hover:text-slate-800"
                            >
                                <h2 class="text-center">
                                    @lang("app.create_new_album")
                                </h2>
                            </section>
                        </section>
                    </a>
                    @foreach ($user->album()->get() as $album)
                        <a
                            href="{{ route("gallery.edit", $album["AlbumID"]) }}"
                            class="relative flex h-full cursor-pointer flex-col overflow-hidden rounded-sm border border-slate-400 bg-slate-200 font-bold text-slate-700"
                            role="article"
                        >
                            <section class="relative h-full w-full overflow-hidden">
                                <img
                                    @if (! empty($album->foto()->get()->first()))
                                        src="{{ url("/storage/" .$album->foto()->get()->first()["LokasiFile"],) }}"
                                        alt="{{ $album->foto()->get()->first()["DeskripsiFoto"] }}"
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
                                    <h2 class="text-center">
                                        {{ $album["NamaAlbum"] }}
                                    </h2>
                                </section>
                            </section>
                        </a>
                    @endforeach
                </section>
            </section>
        </section>
    </main>

    @include("layouts.footer")
@endsection
