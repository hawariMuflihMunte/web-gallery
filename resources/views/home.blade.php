@extends('layouts.app')

@section('title', 'Web Gallery Home')

@section('content')
  <nav class="w-full fixed min-h-10 flex items-center px-5 py-2 text-gray-700 justify-between z-50">
    <h1 class="text-2xl italic font-semibold">Web Gallery</h1>
  </nav>
  <main class="min-w-full min-h-full h-[100vh] pt-28">
    <section
      role="group"
      class="flex justify-center sm:justify-start gap-4 flex-wrap max-w-[92%] md:max-w-[80%] mx-auto"
    >
      <a
        href="#"
        class="flex flex-col bg-black text-slate-200 rounded-md max-w-[200px] md:max-w-[240px] lg:min-w-[300px] overflow-hidden cursor-pointer"
        role="article"
        x-data="{
          showImage: false
        }"
        x-on:mouseover="showImage = true"
        x-on:mouseleave="showImage = false"
      >
        <section class="w-full">
          <img
            src="https://mir-s3-cdn-cf.behance.net/project_modules/1400/e0e93077936011.5deeb6aabe907.jpg"
            alt="illustration"
            class="h-auto w-full"
            x-show="showImage"
            x-transition.duration.200ms
          />
        </section>
        <section class="w-full min-w-[200px] md:min-w-[240px] lg:min-w-[300px] flex justify-center items-center py-4">
          <h2>Album #1</h2>
        </section>
      </a>
    </section>
  </main>
  <footer class="px-4 py-5 flex border-t-2 border-t-gray-400">
    <section class="flex">
      <h3 class="text-lg font-semibold">Web Gallery <span class="font-normal">@ {{ now()->year }}</span></h3>
    </section>
  </footer>
@endsection
