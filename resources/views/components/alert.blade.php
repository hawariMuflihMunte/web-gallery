@props([
    'title',
    'message'
])

<section
    class="fixed inset-0 z-50 bg-black bg-opacity-40 flex items-center justify-center p-8"
    x-data="{ show: true }"
    x-show="show"
>
    <section class="glass_morphism_bg w-full md:w-1/2 rounded-xl p-6">
        <h3 class="text-2xl">{{ $title }}</h3>
        <hr class="border-gray-700 my-2">
        <section class="my-6">
            <p>{{ $message }}</p>
        </section>
        <button
            class="glass_morphism_navy_bg px-3 py-1 rounded-md"
            x-on:click="show = false"
        >
        Close
        </button>
    </section>
</section>
