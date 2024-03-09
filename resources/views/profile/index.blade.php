@extends("layouts.app")

@section("title", "Web Gallery | Profile")

@section("content")
  @include("layouts.nav")

  <main class="min-h-[100vh] min-w-full py-28">
    <section class="mx-auto flex h-max max-w-[92%] flex-col gap-4 px-5 py-3 md:max-w-[80%]">
      <section class="mt-5">
        <h1 class="text-2xl">Profil Saya</h1>
        <hr class="mt-2 border-slate-500" />
      </section>
      <form
        method="post"
        action="{{ route("profile.update", ["profile" => $user]) }}"
        class="flex flex-col gap-7 bg-slate-100 px-4 py-7"
        x-data="{
          usernameInputEnabled: false,
          emailInputEnabled: false,
          namalengkapInputEnabled: false,
          alamatInputEnabled: false,
          usernameInput() {
            $username = $refs.usernameInput
            if (! $username.hasAttribute('disabled')) {
              $username.setAttribute('disabled', '')
              this.usernameInputEnabled = false
            } else {
              $username.removeAttribute('disabled')
              this.usernameInputEnabled = true
            }
          },
          emailInput() {
            $email = $refs.emailInput
            if (! $email.hasAttribute('disabled')) {
              $email.setAttribute('disabled', '')
              this.emailInputEnabled = false
            } else {
              $email.removeAttribute('disabled')
              this.emailInputEnabled = true
            }
          },
          namalengkapInput() {
            $namalengkap = $refs.namalengkapInput
            if (! $namalengkap.hasAttribute('disabled')) {
              $namalengkap.setAttribute('disabled', '')
              this.namalengkapInputEnabled = false
            } else {
              $namalengkap.removeAttribute('disabled')
              this.namalengkapInputEnabled = true
            }
          },
          alamatInput() {
            $alamat = $refs.alamatInput
            if (! $alamat.hasAttribute('disabled')) {
              $alamat.setAttribute('disabled', '')
              this.alamatInputEnabled = false
            } else {
              $alamat.removeAttribute('disabled')
              this.alamatInputEnabled = true
            }
          },
        }"
        autocomplete="off"
      >
        @csrf
        @method("PUT")

        @session("success")
          {{ session("success") }}
        @endsession

        @session("success-username")
          {{ session("success-username") }}
        @endsession

        @session("success-email")
          {{ session("success-email") }}
        @endsession

        @session("success-namalengkap")
          {{ session("success-namalengkap") }}
        @endsession

        @session("success-namalengkap")
          {{ session("success-alamat") }}
        @endsession

        @error("error")
          {{ $message }}
        @enderror

        <section class="flex flex-col">
          <label for="username">
            Username
            <span class="text-red-500">*</span>
          </label>
          <section class="flex w-full">
            <input
              type="text"
              name="username"
              id="username"
              value="{{ $user["Username"] }}"
              class="w-full rounded-sm border border-slate-300 bg-slate-50 px-2 py-1 outline-none transition-all duration-200 disabled:bg-slate-300"
              disabled
              x-ref="usernameInput"
            />
            <button
              type="button"
              class="bg-slate-300 px-2"
              @click="usernameInput()"
            >
              <i
                class="bi-pencil"
                x-show="!usernameInputEnabled"
              ></i>
              <i
                class="bi-x-lg"
                x-show="usernameInputEnabled"
              ></i>
            </button>
          </section>
        </section>
        <section class="flex flex-col">
          <label for="email">
            Email
            <span class="text-red-500">*</span>
          </label>
          <section class="flex w-full">
            <input
              type="email"
              name="email"
              id="email"
              value="{{ $user["Email"] }}"
              class="w-full rounded-sm border border-slate-300 bg-slate-50 px-2 py-1 outline-none transition-all duration-200 disabled:bg-slate-300"
              disabled
              x-ref="emailInput"
            />
            <button
              type="button"
              class="bg-slate-300 px-2"
              @click="emailInput()"
            >
              <i
                class="bi-pencil"
                x-show="!emailInputEnabled"
              ></i>
              <i
                class="bi-x-lg"
                x-show="emailInputEnabled"
              ></i>
            </button>
          </section>
        </section>
        <section class="flex flex-col">
          <label for="namalengkap">
            Nama Lengkap
            <span class="text-red-500">*</span>
          </label>
          <section class="flex w-full">
            <input
              type="text"
              name="namalengkap"
              id="namalengkap"
              value="{{ $user["NamaLengkap"] }}"
              class="w-full rounded-sm border border-slate-300 bg-slate-50 px-2 py-1 outline-none transition-all duration-200 disabled:bg-slate-300"
              disabled
              x-ref="namalengkapInput"
            />
            <button
              type="button"
              class="bg-slate-300 px-2"
              @click="namalengkapInput()"
            >
              <i
                class="bi-pencil"
                x-show="!namalengkapInputEnabled"
              ></i>
              <i
                class="bi-x-lg"
                x-show="namalengkapInputEnabled"
              ></i>
            </button>
          </section>
        </section>
        <section class="flex flex-col">
          <section class="mb-3 flex w-full items-center justify-between">
            <label for="alamat">Alamat</label>
            <button
              type="button"
              class="bg-slate-300 px-2 py-1"
              @click="alamatInput()"
            >
              <i
                class="bi-pencil"
                x-show="!alamatInputEnabled"
              ></i>
              <i
                class="bi-x-lg"
                x-show="alamatInputEnabled"
              ></i>
            </button>
          </section>
          <!-- prettier-ignore -->
          <textarea
            name="alamat"
            id="alamat"
            class="max-h-20 min-h-10 w-full rounded-sm border border-slate-300 bg-slate-50 px-2 py-1 outline-none transition-all duration-200 disabled:bg-slate-300"
            disabled
            x-ref="alamatInput"
          >{{ $user["Alamat"] }}</textarea>
        </section>
        <section>
          <button
            type="submit"
            class="flex w-full items-center justify-center bg-blue-200 px-3 py-2"
          >
            Update
          </button>
        </section>
      </form>
      <section class="mt-5">
        <h2 class="text-2xl">
          Danger Zone
          <i class="bi-exclamation-triangle-fill text-yellow-500"></i>
        </h2>
        <hr class="mt-2 border-slate-500" />
      </section>
      <form
        action="{{ route("profile.destroy", ["profile" => $user]) }}"
        method="post"
        class="flex items-center justify-between bg-slate-100 px-5 py-7"
        x-data="{
          confirmDelete: false,
        }"
      >
        @csrf
        @method("DELETE")
        <label for="delete">Hapus Akun</label>
        <button
          type="button"
          id="delete"
          class="bg-red-200 px-2 py-3"
          @click="confirmDelete = !confirmDelete"
        >
          Hapus
        </button>
        {{-- Popup --}}
        <section
          class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 p-8"
          x-show="confirmDelete"
          x-cloak
        >
          <article
            class="glass_morphism_bg md:1/2 w-full rounded-sm px-8 py-10"
            @click.outside="confirmDelete = false"
          >
            <h3 class="text-2xl">Yakin ingin hapus akun ?</h3>
            <hr class="my-2 border-gray-700" />
            <section class="my-6">
              <p>Data akun kamu akan dihapus beserta dengan data album dan foto !</p>
            </section>
            <section class="flex gap-6">
              <button
                type="submit"
                class="glass_morphism_red_bg rounded-md px-3 py-1"
              >
                Ya
              </button>
              <button
                type="button"
                class="glass_morphism_navy_bg rounded-md px-3 py-1"
                @click="confirmDelete = false"
              >
                Batal
              </button>
            </section>
          </article>
        </section>
        {{-- End of Popup --}}
      </form>
    </section>
  </main>

  @include("layouts.footer")
@endsection
