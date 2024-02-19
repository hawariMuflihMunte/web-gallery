@extends('layouts.app')

@section('title', 'Web Gallery | Add')

@section('content')

    @include('layouts.nav')

    <main class="min-w-full min-h-full h-[100vh] pt-28">
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
            class="px-5 py-3 max-w-[92%] md:max-w-[80%] mx-auto flex flex-col gap-4"
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
                    class="bg-lime-200 px-5 py-6 rounded-sm border border-slate-300 shadow-md"
                    x-data="{
                        imageCount: 1,
                        incrementImageCount() {
                            if (this.imageCount < 20) {
                                this.imageCount++;
                            } else {
                                this.imageCount = 20;
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
                    <h1 class="text-2xl font-medium">Tambah Album</h1>
                    <hr class="my-3 border-slate-500">
                    <h2>Gambar (<span x-text="imageCount"></span>)</h2>
                    <button
                        type="button"
                        @click="incrementImageCount"
                    >
                        <i class="bi-plus-square-fill"></i>
                    </button>
                    <button
                        type="button"
                        @click="decrementImageCount"
                    >
                        <i class="bi-dash-square-fill"></i>
                    </button>
                    <template x-for="count in imageCount">
                        <article
                            class="flex items-center gap-3"
                        >
                            <h3 x-text="count"></h3>
                            <input
                                type="file"
                                name="image"
                                id="image"
                                accept="image/*"
                                @change="fileChosen"
                                class=""
                            />
                        </article>
                    </template>
                    <template x-if="imageUrl">
                        <section>
                            <img
                                :src="imageUrl"
                                :alt="imageUrl"
                                class="w-60 h-32"
                            />
                        </section>
                    </template>
                </form>
            </section>
        </section>
    </main>

    @include('layouts.footer')

@endsection
