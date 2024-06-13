<section class="flex items-center gap-4 rounded-sm bg-slate-100 p-2">
    <form
        action="{{ route("foto.destroy", $foto) }}"
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
            class="absolute right-0 top-[calc(100%+6px)] z-40 flex min-w-56 flex-col rounded-sm bg-slate-100 p-3 shadow-md"
            @click.outside="openDeleteConfirmation = false"
        >
            <p>Yakin ingin menghapus foto ini ?</p>
            <br />
            <button
                type="submit"
                class="flex justify-between rounded-sm bg-red-400 px-4 py-2 duration-200 hover:bg-red-500 hover:text-slate-50"
            >
                <i class="bi-check-square"></i>
                Ya
            </button>
            <button
                type="button"
                class="flex justify-between rounded-sm bg-blue-100 px-4 py-2 duration-200 hover:bg-blue-200"
                @click="openDeleteConfirmation = false"
            >
                <i class="bi-x-square"></i>
                Tidak
            </button>
        </section>
    </form>
</section>
