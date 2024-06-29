<input
    type="{{ $type }}"
        @switch($type)
        @case("checkbox")
            {{ $attributes->class(["cursor-pointer before:content[''] peer relative appearance-none rounded-md border-2 border-emerald-500 w-5 h-5 transition-all before:absolute before:block before:top-2/4 before:left-2/4 before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-slate-200 before:opacity-0 before:transition-opacity checked:border-emerald-300 checked:bg-emerald-400 hover:before:opacity-10 hover:bg-emerald-100 hover:checked:bg-emerald-300 checked:border duration-300"]) }}
    
            @break
        @case("radio")
            {{ $attributes->class(["cursor-pointer before:content[''] peer relative appearance-none rounded-full border-2 border-emerald-500 w-5 h-5 transition-all before:absolute before:block before:top-2/4 before:left-2/4 before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-slate-200 before:opacity-0 before:transition-opacity checked:border-emerald-300 checked:bg-emerald-400 hover:before:opacity-10 hover:bg-emerald-100 hover:checked:bg-emerald-300 checked:border duration-300"]) }}
    
            @break
        @default
            {{ $attributes->class(["rounded-md border-[3px] border-slate-300 px-2 py-1 font-barlow text-slate-600 outline-none duration-300 focus-within:border-emerald-400 hover:border-emerald-400 focus:border-emerald-400 focus-visible:border-emerald-400"]) }}
    
            @break
    @endswitch

    placeholder="{{ $placeholder }}"
    value="{{ $value }}"
/>
