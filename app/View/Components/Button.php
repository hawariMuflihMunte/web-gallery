<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    public string $buttonType;
    public ?string $href;

    /**
     * Create a new component instance.
     */
    public function __construct(
        $buttonType = 'button',
        $href = null,
    )
    {
        $this->buttonType = $buttonType;
        $this->href = $href;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.button');
    }
}
