@extends("layouts.app")

@section("title", "Web Gallery | Add Album")

@section("content")
  @include("layouts.nav")

  <main class="min-h-[100vh] min-w-full py-28">
    <section class="mx-auto flex h-max max-w-[92%] flex-col gap-4 px-5 py-3 md:max-w-[80%]">
      <section>
        <form
          action="{{ route("gallery.store") }}"
          method="post"
          enctype="multipart/form-data"
          autocomplete="off"
          class="rounded-sm border border-slate-300 bg-slate-200 px-5 py-6 shadow-md"
          x-data="{
            imageCount: 1,
            imageLimit: 10,
            incrementImageCount() {
              if (this.imageCount < this.imageLimit) {
                this.imageCount++
              } else {
                this.imageCount = this.imageLimit
              }
            },
            decrementImageCount() {
              if (this.imageCount > 1) {
                this.imageCount--
              } else {
                this.imageCount = 1
              }
            },
          }"
        >
          @csrf
          <h1 class="text-2xl font-medium">Tambah Album</h1>
          <hr class="my-3 border-slate-500" />
          <section class="my-5 flex flex-col">
            <label for="namaalbum">Nama</label>
            <input
              type="text"
              name="namaalbum"
              id="namaalbum"
              class="rounded-sm border border-slate-300 bg-slate-50 px-2 py-1 outline-none"
              autofocus
            />
          </section>
          <section class="my-5 flex flex-col">
            <label for="deskripsi">Deskripsi</label>
            <textarea
              name="deskripsi"
              id="deskripsi"
              class="max-h-20 min-h-10 rounded-sm border border-slate-300 bg-slate-50 px-2 py-1 outline-none"
            ></textarea>
          </section>
          <h2 class="text-lg font-medium">
            Gambar (
            <span x-text="imageCount"></span>
            )
            <small
              x-show="imageCount == imageLimit"
              class="text-md text-red-600"
            >
              Sudah mencapai batas
            </small>
          </h2>
          <hr class="my-3 border-slate-500" />
          <section class="mb-2 flex gap-5 p-2">
            <button
              type="button"
              @click="incrementImageCount"
              class="glass_morphism_bg border border-slate-300 px-3 py-1 text-slate-600 outline-none transition duration-100 hover:opacity-80"
            >
              <i class="bi-plus"></i>
            </button>
            <button
              type="button"
              @click="decrementImageCount"
              class="glass_morphism_bg border border-slate-300 px-3 py-1 text-slate-600 outline-none transition duration-100 hover:opacity-80"
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
              <article class="flex h-max w-full items-center gap-3 bg-slate-300 px-1 py-3">
                <label
                  :for="count"
                  x-text="count"
                  class="cursor-pointer"
                ></label>
                <input
                  type="file"
                  name="images[]"
                  :id="count"
                  accept="image/*"
                  @change="fileChosen"
                  class="cursor-pointer file:hidden"
                />
                <section class="flex flex-col gap-3">
                  <section class="flex flex-col">
                    <label for="judulfoto">Judul</label>
                    <input
                      type="text"
                      name="judulfoto[]"
                      id="judulfoto"
                      class="rounded-sm border border-slate-300 bg-slate-200 px-2 py-1 outline-none"
                    />
                  </section>
                  <section class="flex flex-col">
                    <label for="deskripsifoto">Deskripsi</label>
                    <input
                      type="text"
                      name="deskripsifoto[]"
                      id="deskripsifoto"
                      class="rounded-sm border border-slate-300 bg-slate-200 px-2 py-1 outline-none"
                    />
                  </section>
                </section>
              </article>
            </template>
          </section>
          <button
            type="submit"
            class="glass_morphism_navy_bg flex w-full items-center justify-center gap-2 rounded-sm py-2"
          >
            Tambah
            <i class="bi-floppy2-fill"></i>
          </button>
        </form>
      </section>
    </section>
  </main>

  @include("layouts.footer")
@endsection
