@extends('layouts.app')

@section('title', 'Web Gallery | Add')

@section('content')

    @include('layouts.nav')

    <main class="min-w-full min-h-full h-[100vh] pt-28">
        <section
            x-data="{
                imageUrl: '',
                fileChosen() {
                    this.fileDataToURL(event, src => this.imageUrl = src);
                },
                fileDataToURL(event, callback) {
                    if (!event.target.files.length) return;

                    let file = event.target.files[0];
                    let reader = new FileReader();

                    reader.readAsDataURL(file);
                    reader.onload = e => callback(e.target.result);
                }
            }"
            class="bg-red-200 p-2"
        >
            <input
                type="file"
                name="image"
                id="image"
                accept="image/*"
                @change="fileChosen"
            />
            <template x-if="imageUrl">
                <section >
                    <img
                        :src="imageUrl"
                        :alt="imageUrl"
                        class="w-60 h-32"
                    />
                </section>
            </template>
        </section>
    </main>

    @include('layouts.footer')

@endsection
