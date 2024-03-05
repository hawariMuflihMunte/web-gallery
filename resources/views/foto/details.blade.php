@extends("layouts.app")

@section("title", "Web Gallery | Photo Details")

@section("content")
  @include("layouts.nav")

  <main class="min-h-[100vh] min-w-full py-28">
    <section class="mx-auto flex h-max max-w-[92%] flex-col gap-4 px-5 py-3 md:max-w-[80%]">
      <section class="flex items-center justify-between">
        <h1 class="text-2xl font-semibold">Foto {{ $foto["JudulFoto"] }}</h1>
        @if ($editable)
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
        @endif
      </section>
      <section class="flex w-full bg-slate-200">
        <section class="flex flex-col">
          <img
            src="{{ url("/storage/" . $foto["LokasiFile"]) }}"
            alt="{{ $foto["DeskripsiFoto"] }}"
            class="h-auto w-full"
          />
          <section class="flex justify-between bg-slate-100 px-3 py-2">
            @if (! $liked)
              <form
                action="{{ route("likefoto.store") }}"
                method="post"
                role="group"
                class="flex gap-4"
              >
                @csrf
                <input
                  type="hidden"
                  name="fotoid"
                  id="fotoid"
                  value="{{ $foto["FotoID"] }}"
                />
                <button
                  type="submit"
                  class="text-xl duration-200 hover:text-red-400"
                >
                  <i class="bi-heart"></i>
                  <span>{{ $likes }}</span>
                </button>
                <a
                  href="#"
                  class="text-xl duration-200 hover:text-blue-400"
                >
                  <i class="bi-chat-square"></i>
                </a>
              </form>
            @else
              <form
                action="{{ route("likefoto.destroy", ["likefoto" => $likefoto["LikeID"]]) }}"
                method="post"
                role="group"
                class="flex gap-4"
              >
                @csrf
                @method("delete")
                <button
                  type="submit"
                  class="text-xl text-red-500 duration-200 hover:text-red-400"
                >
                  <i class="bi-heart-fill"></i>
                  <span>{{ $likes }}</span>
                </button>
                <a
                  href="#"
                  class="text-xl duration-200 hover:text-blue-400"
                >
                  <i class="bi-chat-square"></i>
                </a>
              </form>
            @endif
            <h3 class="text-md cursor-default text-slate-500 hover:text-slate-600">
              {{ date("d F Y", strtotime($foto["TanggalUnggah"])) }}
            </h3>
          </section>
          <section class="flex flex-col px-3 py-2">
            <h4>Deskripsi:</h4>
            <p>{{ $foto["DeskripsiFoto"] }}</p>
          </section>
        </section>
      </section>
    </section>
  </main>

  @include("layouts.footer")
@endsection
