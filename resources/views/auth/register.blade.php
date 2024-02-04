@extends('layouts.app')

@section('title', 'Web Gallery Register')

@section('additional-head-props')
<style>
main {
    background-image: url('./images/bg_register.png');
    background-size: 100%;
}
</style>
@endsection

@section('content')
    <main class="min-w-full min-h-full h-[100vh] flex items-center justify-center">
        <section class="glass_morphism p-10 max-w-96 flex flex-col gap-4 text-gray-700 w-full">
            <h1 class="text-2xl">Daftar</h1>
            <hr class="border-current">
            <form method="post" autocomplete="off" class="flex flex-col gap-4 w-full">
                @csrf
                <section class="flex flex-col">
                    <label for="username">Username</label>
                    <input
                        type="text"
                        name="username"
                        id="username"
                        value="{{ old('username') }}"
                        required
                        minlength="1"
                        autofocus
                        class="glass_morphism_blue_bg rounded-md px-2 py-1 outline-none text-slate-700 font-serif"
                    />
                </section>
                <section class="flex flex-col">
                    <label for="namalengkap">Nama Lengkap</label>
                    <input
                        type="text"
                        name="namalengkap"
                        id="namalengkap"
                        value="{{ old('namalengkap') }}"
                        required
                        minlength="1"
                        class="glass_morphism_yellow_bg rounded-md px-2 py-1 outline-none text-slate-700 font-serif"
                    />
                    @error('namalengkap')
                        <p class="text-red-700"><small>Karakter yang diperbolelkan hanyalah huruf dan titik !</small></p>
                    @enderror
                </section>
                <section class="flex flex-col">
                    <label for="email">Email</label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        value="{{ old('email') }}"
                        required
                        minlength="1"
                        class="glass_morphism_red_bg rounded-md px-2 py-1 outline-none text-slate-900 font-serif"
                    />
                    @error('email')
                        <p class="text-red-700"><small>Format email salah, silahkan coba kembali !</small></p>
                    @enderror
                </section>
                <section class="flex flex-col" x-data="{
                    passwordCount: '',
                    showPasswordCounter: false,
                    passwordMinLength: 8,
                }">
                    <label for="password">Password</label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        required
                        minlength="1"
                        class="glass_morphism_purple_bg rounded-md px-2 py-1 outline-none text-slate-900 font-serif"
                        x-model="passwordCount"
                        x-on:focus="showPasswordCounter = true"
                        x-on:blur="showPasswordCounter = false"
                    />
                    <p
                        class="text-red-700"
                        x-text="passwordMinLength - passwordCount.length"
                        x-show="showPasswordCounter && passwordMinLength - passwordCount.length > 0"
                    ></p>
                    @error('password')
                        <p class="text-red-700"><small>Password berisi minimal 8 karakter !</small></p>
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
                        class="glass_morphism_pink_bg rounded-md px-2 py-1 outline-none text-slate-900 font-serif"
                    />
                    @error('password-confirmation')
                        <p class="text-red-700"><small>Password tidak cocok, silahkan coba kembali!</small></p>
                    @enderror
                </section>
                <section class="mt-2">
                    <button
                        type="submit"
                        class="glass_morphism_navy_bg rounded-md px-2 py-1 outline-none text-black font-serif w-full flex justify-center"
                    >
                        Daftar
                    </button>
                </section>
            </form>
            <hr class="border-current my-2">
            <section class="flex justify-between items-center">
                <p>Sudah punya akun ?</p>
                <a href="/login" class="p-1 glass_morphism_yellow_bg rounded-md">Masuk</a>
            </section>
        </section>
    </main>
@endsection
