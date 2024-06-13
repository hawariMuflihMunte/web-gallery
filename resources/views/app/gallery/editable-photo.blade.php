<section
    x-data="{
        showAddImageForm: false,
    }"
>
    <a
        href="#"
        @click="showAddImageForm = !showAddImageForm"
        class="flex min-w-10 items-center justify-center rounded-sm border border-slate-300 bg-white bg-opacity-95 p-2 outline-none"
    >
        <i class="bi-plus"></i>
    </a>
    {{-- Popups --}}
    <section
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 p-8"
        x-show="showAddImageForm"
        x-cloak
    >
        <article
            class="glass_morphism_bg md:1/2 w-full rounded-sm px-8 py-10"
            @click.outside="showAddImageForm = false"
        >
            <form
                action="{{ route("foto.store") }}"
                method="post"
                enctype="multipart/form-data"
                autocomplete="off"
                class="rounded-sm border border-slate-300 bg-slate-200 px-5 py-6 shadow-md"
            >
                @csrf
                <input
                    type="hidden"
                    name="albumid"
                    id="albumid"
                    value="{{ $album["AlbumID"] }}"
                />
                <article
                    class="z-20 flex h-max w-full items-stretch gap-3 border-b border-b-slate-400 bg-slate-100 px-2 py-6"
                >
                    <label
                        for="image"
                        class="cursor-pointer"
                    ></label>
                    <input
                        type="file"
                        name="image"
                        id="image"
                        accept="image/*"
                        class="cursor-pointer file:hidden file:h-full file:w-full hover:underline"
                    />
                    <section
                        class="flex flex-col gap-3 border-l border-l-slate-300 px-7"
                    >
                        <section class="flex flex-col">
                            <label for="judulfoto">Judul</label>
                            <input
                                type="text"
                                name="judulfoto"
                                id="judulfoto"
                                class="rounded-sm border border-slate-300 bg-slate-50 px-2 py-1 outline-none"
                            />
                        </section>
                        <section class="flex flex-col">
                            <label for="deskripsifoto">
                                Deskripsi
                            </label>
                            <textarea
                                name="deskripsifoto"
                                id="deskripsifoto"
                                class="max-h-20 min-h-10 rounded-sm border border-slate-300 bg-slate-50 px-2 py-1 outline-none"
                            ></textarea>
                        </section>
                    </section>
                </article>
                <button
                    type="submit"
                    class="flex w-full place-content-center place-items-center gap-4 bg-blue-300 p-2 duration-200 hover:bg-blue-400"
                >
                    Tambah
                </button>
            </form>
        </article>
    </section>
    {{-- End of Popups --}}
</section>
