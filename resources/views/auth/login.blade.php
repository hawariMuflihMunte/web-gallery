@extends("layouts.app")

@section("title", "Web Gallery | Login")

@section("additional-head-props")
  <style>
    main {
      background-image: url('./images/bg_register.png');
      background-size: 100%;
    }
  </style>
@endsection

@section("content")
  <main class="flex h-[100vh] min-h-full min-w-full items-center justify-center">
    @session("success-register")
      <x-alert
        title="Pendaftaran berhasil!"
        :message="session('success-register')"
      ></x-alert>
    @endsession

    @session("error-login")
      <x-alert
        title="Gagal masuk!"
        :message="session('error-login')"
      ></x-alert>
    @endsession

    <section class="glass_morphism flex w-full max-w-96 flex-col gap-4 p-10 text-gray-700">
      <h1 class="text-2xl">Masuk</h1>
      <hr class="border-current" />
      <form
        method="post"
        autocomplete="off"
        class="flex w-full flex-col gap-4"
      >
        @csrf
        <section class="flex flex-col">
          <label for="username">Username</label>
          <input
            type="text"
            name="username"
            id="username"
            autofocus
            class="glass_morphism_blue_bg rounded-md px-2 py-1 font-serif text-slate-700 outline-none"
            value="{{ old("username") }}"
          />
        </section>
        <section
          class="flex flex-col"
          x-data="{
            passwordCount: '',
            showPasswordCounter: false,
            passwordMinLength: 8,
          }"
        >
          <label for="password">Password</label>
          <input
            type="password"
            name="password"
            id="password"
            required
            minlength="1"
            class="glass_morphism_purple_bg rounded-md px-2 py-1 font-serif text-slate-900 outline-none"
            x-model="passwordCount"
            x-on:focus="showPasswordCounter = true"
            x-on:blur="showPasswordCounter = false"
          />
          <p
            class="text-red-700"
            x-text="passwordMinLength - passwordCount.length"
            x-show="showPasswordCounter && passwordMinLength - passwordCount.length > 0"
          ></p>
          @error("password")
            <p class="text-red-700">
              <small>Password berisi minimal 8 karakter !</small>
            </p>
          @enderror
        </section>
        <section class="mt-2">
          <button
            type="submit"
            class="glass_morphism_navy_bg flex w-full justify-center rounded-md px-2 py-1 font-serif text-black outline-none"
          >
            Masuk
          </button>
        </section>
      </form>
      <hr class="my-2 border-current" />
      <section class="flex items-center justify-between">
        <p>Tidak punya akun ?</p>
        <a
          href="/register"
          class="glass_morphism_yellow_bg rounded-md p-1"
        >
          Daftar
        </a>
      </section>
    </section>
  </main>
@endsection
