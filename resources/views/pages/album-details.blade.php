@extends("layouts.app")

@section("title")
    @lang("app.app_name")
    |
    @lang(
        "app.album_details_by_username",
        [
            "username" => auth()->user()->Username,
            "album" => $album["NamaAlbum"],
        ]
    )
@endsection

@section("content")
    @include("layouts.topbar")

    <main class="min-h-[100vh] min-w-full py-28">
        @session("update-success")
            <x-alert
                title="Berhasil !"
                :message="session('update-success')"
            ></x-alert>
        @endsession

        <section class="mx-auto max-w-[96%] md:max-w-[90%] xl:max-w-[85%]">
            <section class="flex flex-col gap-3">
                <section class="flex w-full flex-col">
                    <section class="m-0 flex content-center justify-between">
                        <section class="flex flex-col">
                            <h1
                                class="mb-0 text-center text-2xl font-bold leading-none tracking-tight text-gray-700 dark:text-white md:text-3xl lg:text-4xl"
                            >
                                {{ $album["NamaAlbum"] }}
                            </h1>
                            <p class="text-md mb-0 text-slate-600">
                                @timeago($album["TanggalDibuat"])
                            </p>
                        </section>
                        @if (auth()->user()->UserID == $album["UserID"])
                            <button
                                id="albumMenu"
                                data-dropdown-toggle="deleteAlbum"
                                class="m-0 p-0 text-lg text-inherit"
                                type="button"
                            >
                                <i class="bi-three-dots-vertical"></i>
                            </button>

                            <!-- Dropdown menu -->
                            <div
                                id="deleteAlbum"
                                class="z-10 hidden w-44 divide-y divide-gray-100 rounded-lg bg-white shadow dark:bg-gray-700"
                            >
                                <ul
                                    class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                    aria-labelledby="albumMenu"
                                >
                                    <li>
                                        <button
                                            data-modal-target="descriptionAlbum"
                                            data-modal-toggle="descriptionAlbum"
                                            class="w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                            type="button"
                                        >
                                            @lang("app.view_description")
                                        </button>
                                    </li>
                                    <li>
                                        <button
                                            data-modal-target="editAlbum"
                                            data-modal-toggle="editAlbum"
                                            class="w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                            type="button"
                                        >
                                            @lang("app.edit_album")
                                        </button>
                                    </li>
                                    <li>
                                        <button
                                            type="button"
                                            data-modal-target="addImage"
                                            data-modal-toggle="addImage"
                                            class="w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                        >
                                            @lang("app.add_image")
                                        </button>
                                    </li>
                                    <li>
                                        <button
                                            data-modal-target="deleteAlbumConfirmation"
                                            data-modal-toggle="deleteAlbumConfirmation"
                                            class="w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                            type="button"
                                        >
                                            @lang("app.delete_album")
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        @endif
                    </section>
                    <x-layouts.hr margin="mt-2 mb-6"></x-layouts.hr>
                </section>
                <section class="grid grid-cols-2 gap-4 md:grid-cols-3">
                    @if (count($photos) > 0)
                        @foreach ($photos as $photo)
                            <a
                                href="{{ route("foto.show", $photo["slug"]) }}"
                                class="flex h-full w-full flex-col place-content-center place-items-center transition-all duration-200 hover:bg-slate-200"
                            >
                                <section class="relative h-full w-full overflow-hidden">
                                    <img
                                        src="{{ url($photo["LokasiFile"]) }}"
                                        alt="{{ $photo["JudulFoto"] }}"
                                        loading="lazy"
                                    />
                                    <section
                                        class="absolute left-0 top-0 z-10 flex h-full w-full flex-col items-center justify-center text-center text-lg tracking-widest text-transparent duration-200 ease-linear hover:bg-white hover:bg-opacity-95 hover:text-slate-800"
                                    >
                                        <h3>{{ $photo["JudulFoto"] }}</h3>
                                    </section>
                                </section>
                            </a>
                        @endforeach
                    @else
                        <section
                            class="flex h-full w-full flex-col place-content-center place-items-center bg-slate-200 transition-all duration-200"
                        >
                            <img
                                src="{{ asset("images/bg_add_image.png") }}"
                                alt="No Photo. Click to add"
                                loading="lazy"
                                class="block transition-all duration-200"
                            />
                            <h2>@lang("app.add_photo")</h2>
                        </section>
                    @endif
                </section>
            </section>
        </section>
    </main>

    <x-layouts.modal modalId="addImage">
        <x-slot:title>@lang("app.add_image")</x-slot>
        <form
            action="{{ route("foto.store") }}"
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
            <section class="max-h-80 overflow-y-scroll">
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
                @lang("app.upload")
            </button>
        </form>
    </x-layouts.modal>

    <div
        id="deleteAlbumConfirmation"
        tabindex="-1"
        class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0"
    >
        <div class="relative max-h-full w-full max-w-md p-4">
            <div class="relative rounded-lg bg-white shadow dark:bg-gray-700">
                <button
                    type="button"
                    class="absolute end-2.5 top-3 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="deleteAlbumConfirmation"
                >
                    <svg
                        class="h-3 w-3"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 14 14"
                    >
                        <path
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                        />
                    </svg>
                    <span class="sr-only">@lang("app.close_modal")</span>
                </button>
                <div class="p-4 text-center md:p-5">
                    <svg
                        class="mx-auto mb-4 h-12 w-12 text-gray-400 dark:text-gray-200"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 20 20"
                    >
                        <path
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                        />
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                        @lang("app.delete_album_confirmation")
                    </h3>
                    <form
                        action="{{ route("album.destroy", $album["slug"]) }}"
                        method="POST"
                        class="m-0 w-full p-0"
                    >
                        @csrf
                        @method("DELETE")
                        <button
                            type="submit"
                            class="inline-flex items-center rounded-lg bg-red-600 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 dark:focus:ring-red-800"
                        >
                            @lang("app.confirm_delete_yes")
                        </button>
                        <button
                            data-modal-hide="deleteAlbumConfirmation"
                            type="button"
                            class="ms-3 rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700"
                        >
                            @lang("app.confirm_delete_no")
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div
        id="editAlbum"
        data-modal-backdrop="static"
        tabindex="-1"
        aria-hidden="true"
        class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0"
    >
        <div class="relative max-h-full w-full max-w-2xl p-4">
            <!-- Modal content -->
            <div class="relative rounded-lg bg-white shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div
                    class="flex items-center justify-between rounded-t border-b p-4 dark:border-gray-600 md:p-5"
                >
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        @lang("app.edit_album")
                    </h3>
                    <button
                        type="button"
                        class="ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="editAlbum"
                    >
                        <svg
                            class="h-3 w-3"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 14 14"
                        >
                            <path
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                            />
                        </svg>
                        <span class="sr-only">@lang("app.close_modal")</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="space-y-4 p-4 md:p-5">
                    <form
                        action="{{ route("album.update", $album["slug"]) }}"
                        method="post"
                    >
                        @csrf
                        @method("PUT")
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
                                    value="{{ $album["NamaAlbum"] }}"
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
                                    value="{{ $album["Deskripsi"] }}"
                                    required
                                />
                            </section>
                        </section>
                        <button
                            type="submit"
                            class="mt-2 w-full rounded-lg bg-gradient-to-r from-cyan-500 to-blue-500 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gradient-to-bl focus:outline-none focus:ring-4 focus:ring-cyan-300 dark:focus:ring-cyan-800"
                        >
                            @lang("app.edit")
                        </button>
                    </form>
                </div>
                <div
                    class="flex items-center rounded-b border-t border-gray-200 p-4 dark:border-gray-600 md:p-5"
                >
                    <button
                        data-modal-hide="editAlbum"
                        type="button"
                        class="ms-3 rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700"
                    >
                        @lang("app.close")
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div
        id="descriptionAlbum"
        tabindex="-1"
        aria-hidden="true"
        class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0"
    >
        <div class="relative max-h-full w-full max-w-2xl p-4">
            <!-- Modal content -->
            <div class="relative rounded-lg bg-white shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div
                    class="flex items-center justify-between rounded-t border-b p-4 dark:border-gray-600 md:p-5"
                >
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        @lang("app.description")
                    </h3>
                    <button
                        type="button"
                        class="ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="descriptionAlbum"
                    >
                        <svg
                            class="h-3 w-3"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 14 14"
                        >
                            <path
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                            />
                        </svg>
                        <span class="sr-only">@lang("app.close_modal")</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="space-y-4 p-4 md:p-5">
                    <p class="text-base leading-relaxed text-gray-700 dark:text-gray-500">
                        {{ $album["Deskripsi"] }}
                    </p>
                </div>
                <!-- Modal footer -->
                <div
                    class="flex items-center rounded-b border-t border-gray-200 p-4 dark:border-gray-600 md:p-5"
                >
                    <button
                        data-modal-hide="descriptionAlbum"
                        type="button"
                        class="ms-3 rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700"
                    >
                        @lang("app.close")
                    </button>
                </div>
            </div>
        </div>
    </div>

    @include("layouts.footer")
@endsection
