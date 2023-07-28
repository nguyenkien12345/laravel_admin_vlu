<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TitlePreview extends Component
{
    public $icon;
    public $content;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($icon = null, $content = null)
    {
        $this->icon = $icon;
        $this->content = $content;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.title-preview');
    }
}
