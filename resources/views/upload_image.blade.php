<!DOCTYPE html>
<html lang="en">
<head>
    <title>Upload Image</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-slate-900 flex justify-center items-center w-screen h-screen shadow-md">
    @if($errors->any())
    <section class="fixed top-3 left-3 bg-slate-300 text-slate-900 p-3">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </section>
    @endif
    <form
        action="{{ route('upload.image.post') }}"
        method="post"
        enctype="multipart/form-data"
        class="bg-zinc-800 text-zinc-100 flex justify-center max-w-60 p-5"
    />
        @csrf
        <section
            class="flex flex-col"
        >
            <label
                for="image"
                class="
                    flex content-center bg-zinc-600 w-full px-5 py-2 rounded-tl-md rounded-tr-md cursor-pointer
                    hover:bg-zinc-700 transition-colors
                "
            >
                Upload Image
            </label>
            <input
                type="file"
                name="image"
                id="image"
                class="w-full hidden"
            />
            <button
                type="submit"
                class="bg-zinc-500 w-full px-5 py-2 rounded-bl-md rounded-br-md hover:bg-zinc-700 transition-colors"
            >SUBMIT</button>
        </section>
    </form>
</body>
</html>
