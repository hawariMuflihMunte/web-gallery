@extends("layouts.app")

@section("title", "Web Gallery | Register")

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
        @session("error-register")
            <x-alert
                title="Gagal daftar!"
                :message="session('error-register')"
            ></x-alert>
        @endsession

        <section
            class="glass_morphism flex w-full max-w-96 flex-col gap-4 p-10 text-gray-700"
        >
            <h1 class="text-2xl">Daftar</h1>
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
                        value="{{ old("username") }}"
                        required
                        minlength="1"
                        autofocus
                        class="glass_morphism_blue_bg rounded-md px-2 py-1 font-serif text-slate-700 outline-none"
                    />
                </section>
                <section class="flex flex-col">
                    <label for="namalengkap">Nama Lengkap</label>
                    <input
                        type="text"
                        name="namalengkap"
                        id="namalengkap"
                        value="{{ old("namalengkap") }}"
                        required
                        minlength="1"
                        class="glass_morphism_yellow_bg rounded-md px-2 py-1 font-serif text-slate-700 outline-none"
                    />
                    @error("namalengkap")
                        <p class="text-red-700">
                            <small>
                                Karakter yang diperbolelkan hanyalah huruf dan titik !
                            </small>
                        </p>
                    @enderror
                </section>
                <section class="flex flex-col">
                    <label for="email">Email</label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        value="{{ old("email") }}"
                        required
                        minlength="1"
                        class="glass_morphism_red_bg rounded-md px-2 py-1 font-serif text-slate-900 outline-none"
                    />
                    @error("email")
                        <p class="text-red-700">
                            <small>Format email salah, silahkan coba kembali !</small>
                        </p>
                    @enderror
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
                <section class="flex flex-col">
                    <label for="password-confirmation">Konfirmasi Password</label>
                    <input
                        type="password"
                        name="password-confirmation"
                        id="password-confirmation"
                        required
                        minlength="1"
                        class="glass_morphism_pink_bg rounded-md px-2 py-1 font-serif text-slate-900 outline-none"
                    />
                    @error("password-confirmation")
                        <p class="text-red-700">
                            <small>Password tidak cocok, silahkan coba kembali!</small>
                        </p>
                    @enderror
                </section>
                <section class="mt-2">
                    <button
                        type="submit"
                        class="glass_morphism_navy_bg flex w-full justify-center rounded-md px-2 py-1 font-serif text-black outline-none"
                    >
                        Daftar
                    </button>
                </section>
            </form>
            <hr class="my-2 border-current" />
            <section class="flex items-center justify-between">
                <p>Sudah punya akun ?</p>
                <a
                    href="/login"
                    class="glass_morphism_yellow_bg rounded-md p-1"
                >
                    Masuk
                </a>
            </section>
        </section>
    </main>
@endsection
