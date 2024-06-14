<section
    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 p-8"
    x-show="editMode"
>
    <form
        action="{{ route("gallery.update", $album) }}"
        method="post"
        autocomplete="off"
        class="flex min-w-72 flex-col gap-5 rounded-sm bg-slate-50 bg-opacity-90 p-6"
        @click.outside="editMode = !editMode"
    >
        @csrf
        @method("put")
        <section>
            <h1 class="text-2xl font-semibold">@lang('app.edit_album')</h1>
            <hr class="mt-3 border-slate-500" />
        </section>
        <section class="flex flex-col">
            <label for="namaalbum">@lang('app.album_name')</label>
            <input
                type="text"
                name="namaalbum"
                id="namaalbum"
                class="rounded-sm bg-white bg-opacity-95 p-2 outline-none"
                value="{{ $album["NamaAlbum"] }}"
            />
        </section>
        <section class="flex flex-col">
            <label for="deskripsi">@lang('app.description')</label>
            <textarea
                name="deskripsi"
                id="deskripsi"
                class="min-h-20 min-w-full resize-none rounded-sm bg-white bg-opacity-95 p-2"
            >
{{ $album["Deskripsi"] }}
</textarea
            >
        </section>
        <button
            type="submit"
            class="block w-full bg-blue-100 p-2 duration-200 hover:bg-blue-300"
        >
            <i class="bi-floppy2-fill"></i>
        </button>
    </form>
</section>
<section class="flex items-center gap-4 rounded-sm bg-slate-100 p-2">
    <button
        type="button"
        class="rounded-sm bg-white px-3 py-1 transition-all duration-200 hover:bg-slate-300"
        @click="editMode = !editMode"
    >
        <i class="bi-pencil"></i>
    </button>
    <form
        action="{{ route("gallery.destroy", $album) }}"
        method="post"
        x-data="{
            openDeleteConfirmation: false,
        }"
        class="relative"
    >
        @csrf
        @method("delete")
        <button
            type="button"
            class="rounded-sm bg-white px-2 py-1 transition-all duration-200 hover:bg-slate-300"
            @click="openDeleteConfirmation = !openDeleteConfirmation"
        >
            <i class="bi-x-square"></i>
        </button>
        <section
            x-show="openDeleteConfirmation"
            x-cloak
            class="absolute right-0 top-[calc(100%+6px)] z-40 flex min-w-56 flex-col rounded-sm bg-slate-100 p-3 shadow-md"
            @click.outside="openDeleteConfirmation = false"
        >
            <p>@lang('app.delete_album_confirmation')</p>
            <br />
            <button
                type="submit"
                class="flex justify-between rounded-sm bg-red-400 px-4 py-2 duration-200 hover:bg-red-500 hover:text-slate-50"
            >
                <i class="bi-check-square"></i>
                @lang('app.yes')
            </button>
            <button
                type="button"
                class="flex justify-between rounded-sm bg-blue-100 px-4 py-2 duration-200 hover:bg-blue-200"
                @click="openDeleteConfirmation = false"
            >
                <i class="bi-x-square"></i>
                @lang('app.no')
            </button>
        </section>
    </form>
</section>
