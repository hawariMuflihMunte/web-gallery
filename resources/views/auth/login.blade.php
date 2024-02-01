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
                    <label for="password">Password</label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="glass_morphism_purple_bg rounded-md px-2 py-1 outline-none text-slate-900 font-serif"
                    />
                </section>
                <section class="mt-2">
                    <button
                        type="submit"
                        class="glass_morphism_navy_bg rounded-md px-2 py-1 outline-none text-black font-serif w-full flex justify-center"
                    >
                        Masuk
                    </button>
                </section>
            </form>
            <hr class="border-current my-2">
            <section class="flex justify-between items-center">
                <p>Tidak punya akun ?</p>
                <a href="/register" class="p-1 glass_morphism_yellow_bg">Daftar</a>
            </section>
        </section>
    </main>
@endsection
