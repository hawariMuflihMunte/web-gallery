@extends("layouts.app")
@section("title", "Login")
@section("content")
  <main class="flex h-full place-content-center place-items-center">
    <section class="flex">
      <section class="flex min-w-[300px] flex-col">
        <section>
          <h1 class="font-barlow text-2xl">Login</h1>
          <hr class="rounded-md border-2 border-emerald-400" />
        </section>
        <section>
          <form
            action=""
            method="post"
          >
            @csrf
            <x-forms.input></x-forms.input>
            <x-forms.input class="w-full"></x-forms.input>
            <x-forms.input type="checkbox"></x-forms.input>
            <x-forms.input type="radio"></x-forms.input>
            <x-button>
              <i class="bi bi-box-arrow-in-right"></i>
              &nbsp;&nbsp;Login
            </x-button>
          </form>
        </section>
      </section>
      <section>
        <img
          src="{{ asset("images/sign-up.svg") }}"
          alt="User authentication session such as sign up or login"
          class="h-auto w-full"
          loading="lazy"
        />
      </section>
    </section>
  </main>
@endsection
