<?php

namespace App\View\Components\web;

use Illuminate\View\Component;

class CarComponent extends Component
{
    public $car;

    public function __construct($car)
    {
        $this->car = $car;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.web.car-component');
    }
}
