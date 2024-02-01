@extends('layouts.app')

@section('title', 'Web Gallery Register')

@section('styles')
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
                        class="glass_morphism_blue_bg rounded-md px-2 py-1 outline-none text-slate-700 font-serif"
                    />
                </section>
                <section class="flex flex-col">
                    <label for="namalengkap">Nama Lengkap</label>
                    <input
                        type="text"
                        name="namalengkap"
                        id="namalengkap"
                        class="glass_morphism_yellow_bg rounded-md px-2 py-1 outline-none text-slate-700 font-serif"
                    />
                </section>
                <section class="flex flex-col">
                    <label for="email">Email</label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        class="glass_morphism_red_bg rounded-md px-2 py-1 outline-none text-slate-900 font-serif"
                    />
                </section>
                <section class="flex flex-col">
                    <label for="password">Password</label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="glass_morphism_purple_bg rounded-md px-2 py-1 outline-none text-slate-900 font-serif"
                    />
                </section>
                <section class="flex flex-col">
                    <label for="password-confirmation">Konfirmasi Password</label>
                    <input
                        type="text"
                        name="password-confirmation"
                        id="password-confirmation"
                        class="glass_morphism_pink_bg rounded-md px-2 py-1 outline-none text-slate-900 font-serif"
                    />
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
        </section>
    </main>
@endsection
