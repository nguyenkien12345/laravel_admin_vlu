<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InformationPreview extends Component
{
    public $value1;
    public $value2;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($value1 = null, $value2 = null)
    {
        $this->value1 = $value1;
        $this->value2 = $value2;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.information-preview');
    }
}
