@extends("layouts.app")

@section("title", "Web Gallery | Album Details")

@section("content")
    @include("layouts.nav")

    <main class="min-h-[100vh] min-w-full py-28">
        @session("update-success")
            <x-alert
                title="Berhasil !"
                :message="session('update-success')"
            ></x-alert>
        @endsession

        <section class="mx-auto max-w-[96%] md:max-w-[90%] xl:max-w-[85%]">
            <section class="flex flex-col gap-3">
                <section
                    class="flex items-center justify-between"
                    x-data="{
                        editMode: false,
                    }"
                >
                    <section class="flex flex-col">
                        <h1 class="text-2xl font-semibold">
                            {{ $album["NamaAlbum"] }}
                        </h1>
                        <p class="text-md text-slate-600">
                            {{ date("d F Y", strtotime($album["TanggalDibuat"])) }}
                        </p>
                    </section>
                    @if ($editable)
                        @include("app.gallery.editable-album")
                    @endif
                </section>
                <section class="rounded-sm bg-slate-100 p-4">
                    <h2>@lang("app.description")</h2>
                    <p>{{ $album["Deskripsi"] }}</p>
                </section>
                <section class="flex items-center justify-between bg-slate-100 p-4">
                    <h3>
                        @lang("app.images")
                        ({{ count($foto) }})
                    </h3>
                    @if ($editable)
                        @include("app.gallery.editable-photo")
                    @endif
                </section>
                <section class="grid grid-cols-2 grid-rows-2 bg-slate-100">
                    @if (count($foto) > 0)
                        @foreach ($foto as $f)
                            <a
                                href="{{ route("foto.edit", $f) }}"
                                class="flex h-full w-full flex-col place-content-center place-items-center transition-all duration-200 hover:bg-slate-200"
                            >
                                <section class="relative h-full w-full overflow-hidden">
                                    <img
                                        src="{{ url($f["LokasiFile"]) }}"
                                        alt="{{ $f["JudulFoto"] }}"
                                        loading="lazy"
                                        class="h-full w-full object-cover"
                                    />
                                    <section
                                        class="absolute left-0 top-0 z-10 flex h-full w-full flex-col items-center justify-center text-center text-lg tracking-widest text-transparent duration-200 ease-linear hover:bg-white hover:bg-opacity-95 hover:text-slate-800"
                                    >
                                        <h2 class="text-center">
                                            {{ $f["JudulFoto"] }}
                                        </h2>
                                    </section>
                                </section>
                            </a>
                        @endforeach
                    @else
                        <a
                            href="{{ route("foto.show", ["foto" => $album["AlbumID"]]) }}"
                            class="flex h-full w-full flex-col place-content-center place-items-center bg-slate-200 transition-all duration-200"
                        >
                            <img
                                src="{{ asset("images/bg_add_image.png") }}"
                                alt="No photos. Click to add"
                                loading="lazy"
                                class="block transition-all duration-200"
                            />
                            <h2>Add Photo</h2>
                        </a>
                    @endif
                </section>
            </section>
        </section>
    </main>

    @include("layouts.footer")
@endsection
