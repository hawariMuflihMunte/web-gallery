
@extends("layouts.app")

@section("title")
    @lang('app.app_name')
    |
    {{ $foto["JudulFoto"] }}
@endsection

@section("content")
    @include("layouts.topbar")

    <main class="min-h-[100vh] min-w-full py-28">
        <section
            class="mx-auto h-max max-w-[92%] md:max-w-[80%]"
            class="mx-auto max-w-[96%] md:max-w-[90%] xl:max-w-[85%]"
        >
            <section class="flex flex-col px-5 py-3 rounded">
                <section class="flex items-center justify-between bg-slate-100 text-slate-600 p-4">
                    <h1 class="text-xl font-semibold tracking-widest text-inherit">{{ $foto['JudulFoto'] }}</h1>
                    @if ($editable)
                        <button id="photoMenu" data-dropdown-toggle="dropdown" class="p-0 m-0 text-lg text-inherit" type="button">
                            <i class="bi-three-dots-vertical"></i>
                        </button>

                        <!-- Dropdown menu -->
                        <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="photoMenu">
                                <li>
                                    <button data-modal-target="imageDelete" data-modal-toggle="imageDelete" class="w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" type="button">
                                        @lang('app.delete')
                                    </button>
                                </li>
                            </ul>
                        </div>
                    @endif
                </section>
                <section class="flex w-full bg-slate-100">
                    <section class="flex w-full flex-col">
                        <img
                            src="{{ url($foto["LokasiFile"]) }}"
                            alt="{{ $foto["DeskripsiFoto"] }}"
                            class="h-auto w-full object-contain"
                        />
                        <section class="flex justify-between bg-slate-100 px-3 py-2 border-b border-b-slate-50">
                            @if (! $liked)
                                <form
                                    action="{{ route("likefoto.store") }}"
                                    method="post"
                                    role="group"
                                    class="flex gap-4"
                                >
                                    @csrf
                                    <input
                                        type="hidden"
                                        name="slug"
                                        id="slug"
                                        value="{{ $foto["slug"] }}"
                                    />
                                    <button
                                        type="submit"
                                        class="flex items-center gap-2 text-xl duration-200 hover:text-red-400"
                                    >
                                        <i class="bi-heart"></i>
                                        <span class="text-lg">{{ $likes }}</span>
                                    </button>
                                    <button type="button" data-modal-target="commentModal" data-modal-toggle="commentModal" class="flex items-center gap-2 text-xl duration-200 hover:text-blue-400">
                                        <i class="bi-chat-left-dots"></i>
                                    </button>
                                </form>
                            @else
                                <form
                                    action="{{ route("likefoto.destroy", ["likefoto" => $likefoto["LikeID"]]) }}"
                                    method="post"
                                    role="group"
                                    class="flex items-center gap-4"
                                >
                                    @csrf
                                    @method("delete")
                                    <button
                                        type="submit"
                                        class="flex items-center gap-2 text-xl text-red-500 duration-200 hover:text-red-400"
                                    >
                                        <i class="bi-heart-fill"></i>
                                        <span class="text-lg">{{ $likes }}</span>
                                    </button>
                                    <button type="button" data-modal-target="commentModal" data-modal-toggle="commentModal" class="flex items-center gap-2 text-xl duration-200 hover:text-blue-400">
                                        <i class="bi-chat-left-dots"></i>
                                    </button>
                                </form>
                            @endif
                            <h3
                                class="cursor-default text-sm text-slate-500 hover:text-slate-600"
                            >@timeago($foto["TanggalUnggah"])</h3>
                        </section>
                        <p class="p-3 inline">
                            <!-- TODO:
                                1. Display appropriate resources for the selected user.
                            -->
                            {{-- <a class="inline text-blue-700" href="{{ route('album.show', $album->slug) }}">{{ $user["Username"] }}</a> &nbsp; {{ $foto["DeskripsiFoto"] }} --}}
                            <a class="inline text-blue-700" href="#">{{ $user["Username"] }}</a> &nbsp; {{ $foto["DeskripsiFoto"] }}
                        </p>
                    </section>
                </section>
            </section>
        </section>
    </main>

    <!-- Modal -->
    <div id="commentModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
        <div class="relative p-4 w-full max-w-4xl h-full md:h-auto mx-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 flex">
                <!-- Media Section -->
                <div class="w-1/2 p-4">
                    <img src="{{ url($foto["LokasiFile"]) }}" alt="Content Media" class="rounded-lg">
                </div>
                <!-- Comment Section -->
                <div class="w-1/2 p-4 flex flex-col">
                    <!-- Modal header -->
                    <div class="flex justify-between items-start p-2 rounded-t border-b dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">@lang('app.comments')</h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="commentModal">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                    <!-- Comments Display -->
                    <div class="flex-grow p-4 overflow-y-auto">
                        <div class="space-y-4">
                            <!-- Comment -->
                            @if(count($komentarfoto) > 0)
                                @foreach ($komentarfoto as $komentar)
                                    <div class="flex space-x-2">
                                        <!-- User Avatar -->
                                        <img src="{{ asset('images/users/dummy/boy.png') }}" alt="User Avatar" class="w-10 h-10 rounded-full">
                                        <article>
                                            <h3
                                                class="flex justify-between cursor-default gap-2 text-slate-500 duration-200 hover:text-slate-800"
                                            >
                                                <span>
                                                    {{ $komentar->user()->get()->first()["Username"] }}
                                                    @if ($komentar->user()->first()["UserID"] == $album["UserID"])
                                                        <span class="text-red-500">(@lang('app.owner'))</span>
                                                    @endif
                                                </span>
                                            </h3>
                                            <p>{{ $komentar["IsiKomentar"] }}</p>
                                        </article>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-center italic">@lang('app.no_comments_on_post')</p>
                            @endif
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="p-4 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <!-- Comment Form -->
                        <form action="{{ route('komentarfoto.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="fotoid" value="{{ $foto['FotoID'] }}">
                            <input type="hidden" name="albumid" value="{{ $album['AlbumID'] }}">
                            <textarea id="isikomentar" name="isikomentar" rows="3" class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none resize-none" placeholder="{{ __('app.placeholder_write_a_comment') }}"></textarea>
                            <button type="submit" class="mt-2 text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center w-full">Post</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="imageDelete" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="imageDelete">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">@lang('app.close_modal')</span>
                </button>
                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">@lang('app.delete_image_confirmation')</h3>
                    <form action="{{ route('foto.destroy', $foto['slug']) }}" class="w-full p-0 m-0" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">@lang('app.confirm_delete_yes')</button>
                        <button type="button" @click="void(0);" data-modal-hide="imageDelete" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">@lang('app.confirm_delete_no')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include("layouts.footer")
@endsection
