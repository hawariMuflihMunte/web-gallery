@extends("layouts.app")

@section("title")
    @lang("app.app_name")
    |
    @lang("app.user_albums", ["username" => auth()->user()->Username])
@endsection

@section("content")
    @include("layouts.topbar")

    <main class="min-h-[100vh] min-w-full py-28">
        <section class="mx-auto max-w-[96%] md:max-w-[90%] xl:max-w-[85%]">
            <section class="flex w-full flex-col">
                <section class="m-0 flex content-center justify-between">
                    <section class="flex flex-col">
                        <h1
                            class="mb-0 text-center text-2xl font-bold leading-none tracking-tight text-gray-700 dark:text-white md:text-3xl lg:text-4xl"
                        >
                            @lang("app.your_albums")
                        </h1>
                        <p class="text-md mb-0 text-slate-600">
                            {{ count($albums) }}
                            @lang("app.albums")
                        </p>
                    </section>
                    @if (auth()->user()->Username == $user["Username"])
                        <button
                            id="albumMenu"
                            data-dropdown-toggle="dropdownMenu"
                            class="m-0 p-0 text-lg text-inherit"
                            type="button"
                        >
                            <i class="bi-three-dots-vertical"></i>
                        </button>

                        <!-- Dropdown menu -->
                        <div
                            id="dropdownMenu"
                            class="z-10 hidden w-44 divide-y divide-gray-100 rounded-lg bg-white shadow dark:bg-gray-700"
                        >
                            <ul
                                class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                aria-labelledby="albumMenu"
                            >
                                <li>
                                    <button
                                        data-modal-target="addAlbum"
                                        data-modal-toggle="addAlbum"
                                        class="w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                        type="button"
                                    >
                                        @lang("app.add_album")
                                    </button>
                                </li>
                            </ul>
                        </div>
                    @endif
                </section>
                <x-layouts.hr margin="mt-2 mb-6"></x-layouts.hr>
            </section>
            <section>
                @if (count($albums) > 0)
                    <section
                        class="grid grid-cols-2 gap-4 md:grid-cols-3"
                        role="list"
                    >
                        @foreach ($albums as $album)
                            <a
                                href="{{ route("album.edit", $album["slug"]) }}"
                                class="relative flex h-full cursor-pointer flex-col overflow-hidden rounded-sm border border-slate-400 bg-slate-200 font-bold text-slate-700"
                                role="article"
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
                                        <h2 class="text-center">
                                            {{ $album["NamaAlbum"] }}
                                        </h2>
                                    </section>
                                </section>
                            </a>
                        @endforeach
                    </section>
                @else
                    <p>@lang("app.no_albums")</p>
                @endif
            </section>
        </section>
    </main>

    <x-layouts.modal modalId="addAlbum">
        <x-slot:title>@lang("app.add_album")</x-slot>
        <form
            action="{{ route("album.store") }}"
            method="post"
            enctype="multipart/form-data"
            autocomplete="off"
            x-data="{
                inputCount: 1,
                inputLimit: 10,
                incrementInput: function () {
                    if (this.inputCount < this.inputLimit) {
                        this.inputCount++
                    } else {
                        this.inputCount = this.inputLimit
                    }
                },
                decrementInput() {
                    if (this.inputCount > 1) {
                        this.inputCount--
                    } else {
                        this.inputCount = 1
                    }
                },
            }"
        >
            @csrf
            <!--TODO
                1. Integrate this feature with Filepond
                2. You might need to configure `resources/js/filepond.js`
            -->
            {{--
                <input type="file" class="filepond" name="filepond[]" multiple data-max-file-size="2MB" data-max-files="10" data-allow-reorder="true" />
                <button type="submit" class="btn btn-primary mt-3">@lang('app.upload')</button>
            --}}
            <input
                type="hidden"
                name="slug"
                value="{{ $album["slug"] }}"
            />
            <section class="flex flex-col gap-4">
                <section>
                    <label
                        for="album_title"
                        class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                    >
                        @lang("app.title")
                    </label>
                    <input
                        type="text"
                        id="album_title"
                        name="namaalbum"
                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                        placeholder="{{ __("app.placeholder_album_title") }}"
                        required
                    />
                </section>
                <section>
                    <label
                        for="album_description"
                        class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                    >
                        @lang("app.description")
                    </label>
                    <input
                        type="text"
                        id="album_description"
                        name="deskripsi"
                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                        placeholder="{{ __("app.placeholder_album_description") }}"
                        required
                    />
                </section>
            </section>
            <x-layouts.hr margin="mt-2 mb-6"></x-layouts.hr>
            <section
                class="inline-flex rounded-md shadow-sm"
                role="group"
            >
                <button
                    type="button"
                    @click="incrementInput"
                    class="rounded-s-lg border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:text-blue-700 focus:ring-2 focus:ring-blue-700 dark:border-gray-700 dark:bg-gray-800 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white dark:focus:text-white dark:focus:ring-blue-500"
                >
                    @lang("app.add")
                </button>
                <button
                    type="button"
                    @click="decrementInput"
                    class="rounded-e-lg border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:text-blue-700 focus:ring-2 focus:ring-blue-700 dark:border-gray-700 dark:bg-gray-800 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white dark:focus:text-white dark:focus:ring-blue-500"
                >
                    @lang("app.remove")
                </button>
            </section>
            <section class="max-h-64 overflow-y-scroll">
                <p
                    x-show="inputCount == inputLimit"
                    x-cloak
                    class="mt-4 text-red-500"
                >
                    Maximum uploads reached. Only 10 files are allowed at once.
                </p>
                @if (count($errors) > 0)
                    <ul class="my-3 list-inside list-disc text-red-500">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <template x-for="i in inputCount">
                    <section class="mt-5 flex border-b border-b-slate-200">
                        <section class="mb-2 flex flex-col">
                            <label
                                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                                :for="`file_input_` + i"
                            >
                                @lang("app.upload")
                                <span x-text="i"></span>
                                <span class="text-red-500">*</span>
                            </label>
                            <input
                                class="block w-full cursor-pointer rounded-lg border border-gray-300 bg-gray-50 text-sm text-gray-900 focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-gray-400 dark:placeholder-gray-400"
                                :id="`file_input_` + i"
                                name="images[]"
                                accept="image/jpeg, image/jpg, image/png"
                                type="file"
                                required
                            />
                        </section>
                        <section class="mx-3 mb-2 flex flex-col">
                            <label
                                :for="`judul_foto_` + i"
                                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                            >
                                @lang("app.title")
                                <span x-text="i"></span>
                                <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                :id="`judul_foto_` + i"
                                name="judulfoto[]"
                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                                placeholder="{{ __("app.placeholder_image_title") }}"
                                required
                            />
                        </section>
                        <section class="mb-2 flex flex-col">
                            <label
                                :for="`deskripsi_foto_` + i"
                                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                            >
                                @lang("app.description")
                                <span x-text="i"></span>
                                <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                :id="`deskripsi_foto_` + i"
                                name="deskripsifoto[]"
                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                                placeholder="{{ __("app.placeholder_image_description") }}"
                                required
                            />
                        </section>
                    </section>
                </template>
            </section>
            <button
                type="submit"
                class="mt-2 w-full rounded-lg bg-gradient-to-r from-cyan-500 to-blue-500 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gradient-to-bl focus:outline-none focus:ring-4 focus:ring-cyan-300 dark:focus:ring-cyan-800"
            >
                @lang("app.add")
            </button>
        </form>
    </x-layouts.modal>

    @include("layouts.footer")
@endsection
