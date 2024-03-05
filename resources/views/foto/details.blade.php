@extends("layouts.app")

@section("title", "Web Gallery | Photo Details")

@section("content")
  @include("layouts.nav")

  <main class="min-h-[100vh] min-w-full py-28">
    <section
      class="mx-auto flex h-max max-w-[92%] flex-col gap-4 px-5 py-3 md:max-w-[80%]"
      x-data="{
        showCommentThread: false,
      }"
    >
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
                  class="flex items-center gap-2 text-xl duration-200 hover:text-red-400"
                >
                  <i class="bi-heart"></i>
                  <span class="text-lg">{{ $likes }}</span>
                </button>
                <a
                  href="#"
                  class="flex items-center gap-2 text-xl duration-200 hover:text-blue-400"
                  @click="showCommentThread = !showCommentThread"
                >
                  <i class="bi-chat-square"></i>
                  <span class="text-lg">{{ $commentcount }}</span>
                </a>
              </form>
            @else
              <form
                action="{{ route("likefoto.destroy", ["likefoto" => $likefoto["LikeID"]]) }}"
                method="post"
                role="group"
                class="flex items-center gap-4"
              >
                @csrf
                @method("delete")
                <button
                  type="submit"
                  class="flex items-center gap-2 text-xl text-red-500 duration-200 hover:text-red-400"
                >
                  <i class="bi-heart-fill"></i>
                  <span class="text-lg">{{ $likes }}</span>
                </button>
                <hr class="h-full border-x border-x-slate-300" />
                <a
                  href="#"
                  class="flex items-center gap-2 text-xl duration-200 hover:text-blue-400"
                  @click="showCommentThread = !showCommentThread"
                >
                  <i class="bi-chat-square"></i>
                  <span class="text-lg">{{ $commentcount }}</span>
                </a>
                <hr class="h-full border-x border-x-slate-300" />
              </form>
            @endif
            <h3 class="text-md cursor-default text-slate-500 hover:text-slate-600">
              {{ date("d F Y", strtotime($foto["TanggalUnggah"])) }}
            </h3>
          </section>
          <section class="flex flex-col px-4 py-8">
            <h4>Deskripsi:</h4>
            <p>{{ $foto["DeskripsiFoto"] }}</p>
          </section>
          <hr
            x-show="showCommentThread"
            x-cloak
            class="border-y border-y-slate-300"
          />
          <section
            x-show="showCommentThread"
            x-cloak
            class="flex flex-col gap-3 px-3 py-5"
          >
            <article
              href="#"
              class="flex flex-col gap-2 bg-slate-100 px-4 py-2 duration-200 hover:bg-slate-50"
              x-data="{
                openCommentPrompt: false,
              }"
            >
              <button
                type="button"
                @click="openCommentPrompt = true"
                class="cursor-pointer"
                x-cloak
                x-show="!openCommentPrompt"
              >
                Tambah Komentar
              </button>
              <button
                type="button"
                @click="openCommentPrompt = false"
                class="cursor-pointer"
                x-cloak
                x-show="openCommentPrompt"
              >
                Batal
              </button>
              <hr
                class="border-y border-y-slate-300"
                x-cloak
                x-show="openCommentPrompt"
              />
              <section
                x-cloak
                x-show="openCommentPrompt"
                class="w-full"
              >
                <form
                  action="{{ route("komentarfoto.store") }}"
                  method="post"
                  class="flex w-full flex-col"
                >
                  @csrf
                  @error("isikomentar")
                    {{ $message }}
                  @enderror

                  <input
                    type="hidden"
                    name="fotoid"
                    value="{{ $foto["FotoID"] }}"
                  />
                  <input
                    type="hidden"
                    name="userid"
                    value="{{ $foto["UserID"] }}"
                  />
                  <section class="flex flex-col">
                    <textarea
                      name="isikomentar"
                      id="isikomentar"
                      class="max-h-40 min-h-10 bg-slate-200 p-2 outline-none"
                    ></textarea>
                    <button
                      type="submit"
                      class="flex items-center justify-center bg-blue-200 p-2 text-slate-600 duration-200 hover:text-slate-800"
                    >
                      <i class="bi-chat-square-dots-fill"></i>
                    </button>
                  </section>
                </form>
              </section>
            </article>
            @foreach ($komentarfoto as $komentar)
              <article
                x-show="showCommentThread"
                x-cloak
                class="bg-slate-100 px-4 py-2 duration-200 hover:bg-slate-50"
              >
                <h4
                  class="flex cursor-default gap-2 text-slate-500 duration-200 hover:text-slate-800"
                >
                  <section class="flex gap-2">
                    <i class="bi-person-fill"></i>
                    <span>
                      {{ $komentar->user()->get()->first()["Username"] }}
                    </span>
                  </section>
                  @if ($komentar->user()->get()->first()["UserID"] == $album["UserID"])
                    <section class="flex gap-2">
                      <hr class="h-full border-x border-x-slate-300" />
                      <i class="bi-person-rolodex"></i>
                      <span>Owner</span>
                    </section>
                  @endif
                </h4>
                {{ $komentar["IsiKomentar"] }}
              </article>
            @endforeach
          </section>
        </section>
      </section>
    </section>
  </main>

  @include("layouts.footer")
@endsection
