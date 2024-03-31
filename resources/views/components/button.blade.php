@switch($buttonType)
  @case("link")
    <a
      href="{{ $href }}"
      {{ $attributes->class(["font-barlow inline-block h-max w-max bg-emerald-500 px-4 py-[6px] rounded-md hover:opacity-80 hover:brightness-105 duration-300 text-slate-50 font-medium"]) }}
    >
      {{ $slot }}
    </a>

    @break
  @case("button")
    <button
      type="{{ $buttonType }}"
      {{ $attributes->class(["font-barlow inline-block h-max w-max bg-emerald-500 px-4 py-[6px] rounded-md hover:opacity-80 hover:brightness-105 duration-300 text-slate-50 font-medium"]) }}
    >
      {{ $slot }}
    </button>

    @break
@endswitch
