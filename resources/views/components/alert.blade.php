@props([
  "title",
  "message",
])

<section
  class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 p-8"
  x-data="{ show: true }"
  x-show="show"
>
  <section class="glass_morphism_bg w-full rounded-xl p-6 md:w-1/2">
    <h3 class="text-2xl">{{ $title }}</h3>
    <hr class="my-2 border-gray-700" />
    <section class="my-6">
      <p>{{ $message }}</p>
    </section>
    <button
      class="glass_morphism_navy_bg rounded-md px-3 py-1"
      x-on:click="show = false"
    >
      Batal
    </button>
  </section>
</section>
