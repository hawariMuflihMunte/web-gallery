<!DOCTYPE html>
<html lang="en">
<head>
    <title>Upload File</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body>
    <main class="container mx-auto">
        <form
            action="{{ route('upload.post') }}"
            method="post"
            enctype="multipart/form-data"
        >
            @csrf
            <section class="my-6 mx-4 flex items-stretch">
                <label
                    for="formFile"
                    class="flex items-center bg-slate-200 text-slate-600 px-6 w-max text-nowrap"
                >Upload File</label>
                <input
                    type="file"
                    id="formFile"
                    class="flex py-2 items-center cursor-pointer text-slate-600 rounded-none outline-none bg-slate-100 px-3 w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-pink-100 file:text-pink-800 file:cursor-pointer hover:file:bg-pink-400 hover:file:text-pink-900 file:transition-colors file:self-center"
                    name="file"
                />
                <button class="bg-slate-600 text-slate-100 px-4 py-2">UPLOAD</button>
            </section>
        </form>
    </main>
</body>
</html>
