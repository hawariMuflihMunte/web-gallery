<?php

namespace App\View\Components\Messages;

use App\Enums\AlertType;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AlertDismissible extends Component
{
    public AlertType $type;
    public ?string $alertId;

    /**
     * Create a new component instance.
     */
    public function __construct(string $type = 'info', string $alertId = null)
    {
        if (!AlertType::hasValue($type)) {
            $type = 'info';
        }

        $this->type = AlertType::fromValue($type);
        $this->alertId = $alertId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.messages.alert-dismissible', [
            'type' => $this->type,
            'alertId' => $this->alertId,
        ]);
    }
}
