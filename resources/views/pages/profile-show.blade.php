@extends("layouts.app")

@section("title")
    @lang("app.app_name")
    |
    @lang("app.my_profile")
@endsection

@section("content")
    @include("layouts.topbar")

    <main class="min-h-[100vh] min-w-full py-28">
        <section
            class="mx-auto flex h-max max-w-[92%] flex-col gap-4 px-5 py-3 md:max-w-[80%]"
        >
            @session("profile-update-success")
                <x-messages.alert-dismissible>
                    {{ $value }}
                </x-messages.alert-dismissible>
            @endsession

            <fieldset>
                <h1
                    class="mb-4 text-center text-2xl font-bold leading-none tracking-tight text-gray-700 dark:text-white md:text-3xl lg:text-4xl"
                >
                    @lang("app.my_profile")
                </h1>
                <x-layouts.hr-trimmed></x-layouts.hr-trimmed>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form
                    method="post"
                    action="{{ route("user.update", auth()->user()->slug) }}"
                    autocomplete="off"
                >
                    @csrf
                    @method("PUT")
                    <div class="mb-6 grid gap-6 md:grid-cols-2">
                        <div>
                            <label
                                for="namalengkap"
                                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                            >
                                @lang("app.full_name")
                            </label>
                            <input
                                type="text"
                                id="namalengkap"
                                name="namalengkap"
                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                                placeholder="{{ __("app.full_name") }}"
                                value="{{ auth()->user()->NamaLengkap }}"
                                required
                            />
                        </div>
                        <div>
                            <label
                                for="username"
                                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                            >
                                @lang("app.username")
                            </label>
                            <input
                                type="text"
                                id="username"
                                name="username"
                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                                placeholder="{{ __("app.username") }}"
                                value="{{ auth()->user()->Username }}"
                                required
                            />
                        </div>
                        <div>
                            <label
                                for="email"
                                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                            >
                                @lang("app.email")
                            </label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                                placeholder="{{ __("app.email") }}"
                                value="{{ auth()->user()->Email }}"
                                required
                            />
                        </div>
                        <div>
                            <label
                                for="alamat"
                                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                            >
                                @lang("app.address")
                            </label>
                            <input
                                type="text"
                                id="alamat"
                                name="alamat"
                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                                placeholder="{{ __("app.address") }}"
                                value="{{ auth()->user()->Alamat }}"
                                required
                            />
                        </div>
                    </div>
                    <button
                        type="submit"
                        class="w-full rounded-lg bg-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 sm:w-auto"
                    >
                        @lang("app.update")
                    </button>
                </form>
            </fieldset>
        </section>
    </main>

    @include("layouts.footer")
@endsection
