<?php

namespace App\View\Components\dashboard;

use Illuminate\View\Component;

class RadioBtn extends Component
{
    public $title;
    public $name;
    public $radioBtns;

    public function __construct($title,$name,$radioBtns)
    {
        $this->title     = $title;
        $this->radioBtns = $radioBtns;
        $this->name      = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard.radio-btn');
    }
}
