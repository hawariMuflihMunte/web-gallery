@extends("layouts.app")
@section("title", "Register")
@section("content")
  <main class="flex h-full place-content-center place-items-center">
    <section class="flex gap-10">
      <section class="flex min-w-[300px] flex-col">
        <section>
          <h1 class="font-barlow text-2xl">Signup</h1>
          <hr class="rounded-md border-2 border-emerald-400" />
        </section>
        <section>
          <form
            action=""
            method="post"
          >
            @csrf
            <section class="mt-4 flex flex-col gap-6 font-barlow">
              <section class="flex flex-col">
                <label for="username">Username</label>
                <x-forms.input
                  id="username"
                  name="username"
                  value="{{ old('username') }}"
                ></x-forms.input>
              </section>
              <section class="flex flex-col">
                <label for="namalengkap">Fullname</label>
                <x-forms.input
                  id="namalengkap"
                  name="namalengkap"
                  value="{{ old('namalengkap') }}"
                ></x-forms.input>
              </section>
              <section class="flex flex-col">
                <label for="email">Email</label>
                <x-forms.input
                  id="email"
                  name="email"
                  type="email"
                  value="{{ old('email') }}"
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
              <section class="flex flex-col">
                <label for="password-confirmation">Repeat Password</label>
                <x-forms.input
                  id="password-confirmation"
                  name="password-confirmation"
                  type="password"
                ></x-forms.input>
              </section>
              <x-button buttonType="submit">
                <i class="bi bi-file-earmark-person-fill"></i>
                &nbsp;&nbsp;Signup
              </x-button>
              <section>
                <hr class="rounded-md border border-emerald-400" />
                <p>
                  Already have an account ?
                  <a
                    href="{{ route("login") }}"
                    class="text-emerald-700 hover:text-emerald-600"
                  >
                    Login
                  </a>
                </p>
              </section>
            </section>
          </form>
        </section>
      </section>
      <section class="hidden self-center lg:block">
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
