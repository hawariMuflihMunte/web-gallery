@switch($buttonType)
    @case("link")
        <a
            href="{{ $href }}"
            {{ $attributes->class(["inline-block h-max w-max rounded-md bg-emerald-500 px-4 py-[6px] font-barlow font-medium text-slate-50 duration-300 hover:opacity-80 hover:brightness-105"]) }}
        >
            {{ $slot }}
        </a>

        @break
    @default
        <button
            type="{{ $buttonType }}"
            {{ $attributes->class(["inline-block h-max w-max rounded-md bg-emerald-500 px-4 py-[6px] font-barlow font-medium text-slate-50 duration-300 hover:opacity-80 hover:brightness-105"]) }}
        >
            {{ $slot }}
        </button>

        @break
@endswitch
