<?php

namespace App\View\Components\Layouts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModalStatic extends Component
{
    public ?string $modalId;

    /**
     * Create a new component instance.
     */
    public function __construct(?string $modalId = null)
    {
        $this->modalId = $modalId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layouts.modal-static', [
            'modalId' => $this->modalId,
        ]);
    }
}
