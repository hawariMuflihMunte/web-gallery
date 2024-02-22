@extends('layouts.app')

@section('title', 'Web Gallery | Add Album')

@section('content')

    @include('layouts.nav')

    <main class="min-w-full min-h-[100vh] pt-28">
        <section
            x-data="{
                imageUrl: '',
                fileChosen() {
                    this.fileDataToURL(event, src => this.imageUrl = src);
                },
                fileDataToURL(event, callback) {
                    if (!event.target.files.length) return;

                    let file = event.target.files[0];
                    let reader = new FileReader();

                    reader.readAsDataURL(file);
                    reader.onload = e => callback(e.target.result);
                }
            }"
            class="px-5 py-3 max-w-[92%] md:max-w-[80%] mx-auto flex flex-col gap-4 h-max"
        >
            <section>
                <a
                    href="{{ route('gallery.index') }}"
                    class="glass_morphism_navy_bg px-2 py-1"
                >
                    <i class="bi-arrow-left-short"></i>
                    Kembali
                </a>
            </section>
            <section>
                <form
                    action="{{ route('gallery.store') }}"
                    method="post"
                    enctype="multipart/form-data"
                    autocomplete="off"
                    class="bg-slate-100 px-5 py-6 rounded-sm border border-slate-300 shadow-md"
                    x-data="{
                        imageCount: 1,
                        imageLimit: 10,
                        incrementImageCount() {
                            if (this.imageCount < this.imageLimit) {
                                this.imageCount++;
                            } else {
                                this.imageCount = this.imageLimit;
                            }
                        },
                        decrementImageCount() {
                            if (this.imageCount > 1) {
                                this.imageCount--;
                            } else {
                                this.imageCount = 1;
                            }
                        }
                    }"
                >
                    @csrf
                    <h1 class="text-2xl font-medium">Tambah Album</h1>
                    <hr class="my-3 border-slate-500">
                    <section class="flex flex-col my-5">
                        <label for="namaalbum">Nama</label>
                        <input
                            type="text"
                            name="namaalbum"
                            id="namaalbum"
                            class="bg-slate-200 border border-slate-300 rounded-sm outline-none px-2 py-1"
                            autofocus
                        />
                    </section>
                    <section class="flex flex-col my-5">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea
                            name="deskripsi"
                            id="deskripsi"
                            class="bg-slate-200 border border-slate-300 rounded-sm outline-none px-2 py-1"
                        ></textarea>
                    </section>
                    <input type="datetime" name="tanggaldibuat" id="tanggaldibuat" :value="+new Date()" class="hidden"/>
                    <h2 class="text-lg font-medium">
                        Gambar (<span x-text="imageCount"></span>)
                        <small
                            x-show="imageCount == imageLimit"
                            class="text-md text-red-600"
                        >
                            Sudah mencapai batas
                        </small>
                    </h2>
                    <hr class="my-3 border-slate-500">
                    <section
                        class="flex gap-5 p-2 mb-2"
                    >
                        <button
                            type="button"
                            @click="incrementImageCount"
                            class="glass_morphism_bg outline-none px-3 py-1 text-slate-600 hover:opacity-80 transition duration-100 border border-slate-300"
                        >
                            <i class="bi-plus"></i>
                        </button>
                        <button
                            type="button"
                            @click="decrementImageCount"
                            class="glass_morphism_bg outline-none px-3 py-1 text-slate-600 hover:opacity-80 transition duration-100 border border-slate-300"
                        >
                            <i class="bi-dash"></i>
                        </button>
                    </section>
                    <section
                        role="group"
                        class="max-h-32 overflow-y-scroll py-1"
                    >
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                        <template x-for="count in imageCount">
                            <article
                                class="flex items-center gap-3 h-max px-1 py-3 bg-slate-300 w-full"
                            >
                                <label
                                    :for="count"
                                    x-text="count"
                                    class="cursor-pointer">
                                </label>
                                <input
                                    type="file"
                                    name="images[]"
                                    :id="count"
                                    accept="image/*"
                                    @change="fileChosen"
                                    class="file:hidden cursor-pointer"
                                />
                                <section class="flex flex-col gap-3">
                                    <section class="flex flex-col">
                                        <label for="judulfoto">Judul</label>
                                        <input
                                            type="text"
                                            name="judulfoto[]"
                                            id="judulfoto"
                                            class="bg-slate-200 border border-slate-300 rounded-sm outline-none px-2 py-1"
                                        />
                                    </section>
                                    <section class="flex flex-col">
                                        <label for="deskripsifoto">Deskripsi</label>
                                        <input
                                            type="text"
                                            name="deskripsifoto[]"
                                            id="deskripsifoto"
                                            class="bg-slate-200 border border-slate-300 rounded-sm outline-none px-2 py-1"
                                        />
                                    </section>
                                </section>
                            </article>
                        </template>
                    </section>
                    <template x-if="imageUrl">
                        <section>
                            <img
                                :src="imageUrl"
                                :alt="imageUrl"
                                class="w-60 h-32"
                            />
                        </section>
                    </template>
                    <button
                        type="submit"
                        class="glass_morphism_navy_bg rounded-sm w-full flex gap-2 items-center justify-center py-2"
                    >
                        Tambah
                        <i class="bi-floppy2-fill"></i>
                    </button>
                </form>
            </section>
        </section>
    </main>

    @include('layouts.footer')

@endsection
