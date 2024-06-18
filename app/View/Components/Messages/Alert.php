<?php

namespace App\View\Components\Messages;

use App\Enums\AlertType;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Alert extends Component
{
    public AlertType $type;

    /**
     * Create a new component instance.
     */
    public function __construct(string $type = 'info')
    {
        if (!AlertType::hasValue($type)) {
            $type = 'info';
        }

        $this->type = AlertType::fromValue($type);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.messages.alert', [
            'type' => $this->type
        ]);
    }
}
