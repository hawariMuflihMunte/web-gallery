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
    <section
        class="bg-zinc-800 text-zinc-100 flex flex-col gap-5 max-w-96 p-5"
    >
        {{-- <img src="{{ storage_path('') }}" alt=""> --}}
        <p>
            {{ $foto['LokasiFile'] }}
        </p>
        <img src="{{ url('/storage/'.$foto['LokasiFile']) }}" alt="{{ $foto['DeskripsiFoto'] }}">
    </section>
</body>
</html>
