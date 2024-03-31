@extends("layouts.app")
@section("title", "Login")
@section("content")
  <main class="flex h-full place-content-center place-items-center">
    <section class="flex gap-10">
      <section class="flex min-w-[300px] flex-col">
        <section>
          <h1 class="font-barlow text-2xl">Login</h1>
          <hr class="rounded-md border-2 border-emerald-400" />
        </section>
        <section>
          <form
            action="{{ route("login") }}"
            method="post"
          >
            @csrf
            <section class="mt-4 flex flex-col gap-8 font-barlow">
              <section class="flex flex-col">
                <label for="username">Username</label>
                <x-forms.input
                  id="username"
                  name="username"
                ></x-forms.input>
              </section>
              <section class="flex flex-col">
                <label for="password">Password</label>
                <x-forms.input
                  id="password"
                  name="password"
                  type="password"
                ></x-forms.input>
              </section>
              <x-button>
                <i class="bi bi-box-arrow-in-right"></i>
                &nbsp;&nbsp;Login
              </x-button>
              <section>
                <hr class="rounded-md border border-emerald-400" />
                <p>
                  No account ?
                  <a
                    href="{{ route("register") }}"
                    class="text-emerald-700 hover:text-emerald-600"
                  >
                    Signup
                  </a>
                </p>
              </section>
            </section>
          </form>
        </section>
      </section>
      <section class="hidden lg:block">
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
