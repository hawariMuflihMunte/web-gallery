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

    <section class="mx-auto flex h-max max-w-[92%] flex-col gap-4 px-5 py-3 md:max-w-[80%]">
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
                <h1 class="text-2xl font-semibold">Edit Album</h1>
                <hr class="mt-3 border-slate-500" />
              </section>
              <section class="flex flex-col">
                <label for="namaalbum">Nama Album</label>
                <input
                  type="text"
                  name="namaalbum"
                  id="namaalbum"
                  class="rounded-sm bg-white bg-opacity-95 p-2 outline-none"
                  value="{{ $album["NamaAlbum"] }}"
                />
              </section>
              <section class="flex flex-col">
                <label for="deskripsi">Deskripsi</label>
                <textarea
                  name="deskripsi"
                  id="deskripsi"
                  class="min-h-20 min-w-full resize-none rounded-sm bg-white bg-opacity-95 p-2"
                >
{{ $album["Deskripsi"] }}</textarea
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
                class="absolute right-0 top-[calc(100%+6px)] z-40 flex min-w-56 flex-col rounded-sm bg-slate-100 p-3 shadow-md"
                @click.outside="openDeleteConfirmation = false"
              >
                <p>Yakin ingin menghapus album ini ?</p>
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
        @endif
      </section>
      <section class="my-5 rounded-sm bg-slate-100 p-4">
        <h2>{{ $album["Deskripsi"] }}</h2>
      </section>
      <section class="grid grid-cols-2 grid-rows-2 gap-4 bg-slate-100">
        @foreach ($foto as $f)
          <a
            href="#"
            class="flex h-full w-full flex-col place-content-center place-items-center transition-all duration-200 hover:bg-slate-200"
            x-data="{
              hovered: false,
            }"
            @mouseover="hovered = true"
            @mouseleave="hovered = false"
          >
            <img
              src="{{ url("/storage/" . $f["LokasiFile"]) }}"
              alt="{{ $f["JudulFoto"] }}"
              loading="lazy"
              class="block transition-all duration-200"
              :class="hovered ? 'scale-100' : 'scale-90'"
            />
            <h3>{{ $f["JudulFoto"] }}</h3>
          </a>
        @endforeach
      </section>
    </section>
  </main>

  @include("layouts.footer")
@endsection
