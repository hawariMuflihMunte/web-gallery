@extends('layouts.app')

@section('title', 'Web Gallery | Album Details')

@section('content')

    @include('layouts.nav')

    <main class="min-w-full min-h-[100vh] pt-28">
        @session('update-success')
            <x-alert title="Berhasil !" :message="session('update-success')"></x-alert>
        @endsession
        <section class="px-5 py-3 max-w-[92%] md:max-w-[80%] mx-auto flex flex-col gap-4 h-max">
            <section
                class="flex justify-between items-center"
                x-data="{
                    editMode: false,
                }"
            >
                <section class="flex flex-col">
                    <h1 class="text-2xl font-semibold">{{ $album['NamaAlbum'] }}</h1>
                    <section
                        class="fixed inset-0 z-50 bg-black bg-opacity-40 flex items-center justify-center p-8"
                        x-show="editMode"
                    >
                        <form
                            action="{{ route('gallery.update', $album) }}"
                            method="post"
                            autocomplete="off"
                            class="bg-slate-50 bg-opacity-90 p-6 rounded-sm min-w-72 flex flex-col gap-5"
                            @click.outside="editMode = !editMode"
                        >
                            @csrf
                            @method('put')
                            <section>
                                <h1 class="text-2xl font-semibold">Edit Album</h1>
                                <hr class="mt-3 border-slate-500">
                            </section>
                            <section
                                class="flex flex-col"
                            >
                                <label for="namaalbum">Nama Album</label>
                                <input
                                    type="text"
                                    name="namaalbum"
                                    id="namaalbum"
                                    class="outline-none p-2 rounded-sm bg-white bg-opacity-95"
                                    value="{{ $album['NamaAlbum'] }}"
                                />
                            </section>
                            <section class="flex flex-col">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea
                                    name="deskripsi"
                                    id="deskripsi"
                                    class="resize-none min-w-full min-h-20 p-2 rounded-sm bg-white bg-opacity-95"
                                >{{ $album['Deskripsi'] }}</textarea>
                            </section>
                            <button
                                type="submit"
                                class="bg-blue-100 hover:bg-blue-300 duration-200 block w-full p-2"
                            >
                                <i class="bi-floppy2-fill"></i>
                            </button>
                        </form>
                    </section>
                    <p class="text-md text-slate-600">{{ date('d F Y', strtotime($album['TanggalDibuat'])) }}</p>
                </section>
                <section class="flex gap-4 items-center bg-slate-100 p-2 rounded-sm">
                    <button
                        type="button"
                        class="px-3 py-1 bg-white rounded-sm hover:bg-slate-300 transition-all duration-200"
                        @click="editMode = !editMode"
                    >
                        <i class="bi-pencil"></i>
                    </button>
                    <form
                        action="{{ route('gallery.destroy', $album) }}"
                        method="post"
                        x-data="{
                            openDeleteConfirmation: false,
                        }"
                        class="relative"
                    >
                        @csrf
                        @method('delete')
                        <button
                            type="button"
                            class="px-2 py-1 bg-white rounded-sm hover:bg-slate-300 transition-all duration-200"
                            @click="openDeleteConfirmation = !openDeleteConfirmation"
                        >
                            <i class="bi-x-square"></i>
                        </button>
                        <section
                            x-show="openDeleteConfirmation"
                            class="absolute z-40 bg-slate-100 top-[calc(100%+6px)] right-0 p-3 min-w-56 rounded-sm shadow-md flex flex-col"
                            @click.outside="openDeleteConfirmation = false"
                        >
                            <p>Yakin ingin menghapus album ini ?</p>
                            <br>
                            <button
                                type="submit"
                                class="flex justify-between py-2 px-4 bg-red-400 hover:bg-red-500 hover:text-slate-50 duration-200 rounded-sm"
                            >
                                <i class="bi-check-square"></i>
                                Ya
                            </button>
                            <button
                                type="button"
                                class="flex justify-between py-2 px-4 bg-blue-100 hover:bg-blue-200 duration-200 rounded-sm"
                                @click="openDeleteConfirmation = false"
                            >
                                <i class="bi-x-square"></i>
                                Tidak
                            </button>
                        </section>
                    </form>
                </section>
            </section>
            <section class="my-5 bg-slate-100 p-4 rounded-sm">
                <h2>{{ $album['Deskripsi'] }}</h2>
            </section>
            <section
                class="grid grid-rows-2 grid-cols-2 gap-4 bg-slate-100"
            >
                @foreach ($foto as $f)
                    <a
                        href="#"
                        class="flex flex-col place-content-center place-items-center w-full h-full hover:bg-slate-200 transition-all duration-200"
                        x-data="{
                            hovered: false,
                        }"
                        @mouseover="hovered = true"
                        @mouseleave="hovered = false"
                    >
                        <img
                            src="{{ url('/storage/'.$f['LokasiFile']) }}"
                            alt="{{ $f['JudulFoto'] }}"
                            loading="lazy"
                            class="block transition-all duration-200"
                            :class="hovered ? 'scale-100' : 'scale-90'"
                        />
                        <h3>{{ $f['JudulFoto'] }}</h3>
                    </a>
                @endforeach
            </section>
        </section>
    </main>

    @include('layouts.footer')

@endsection
