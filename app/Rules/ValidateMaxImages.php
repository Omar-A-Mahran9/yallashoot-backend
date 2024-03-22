<?php

namespace App\Rules;

use App\Models\Car;
use Illuminate\Contracts\Validation\Rule;

class ValidateMaxImages implements Rule
{
    private $car;
    private $deletedImages;

    public function __construct(Car $car, $deletedImages = null)
    {
        $this->car = $car;
        $this->deletedImages = $deletedImages;
    }

    public function passes($attribute, $value)
    {
        $conditionOfStore = count(request()->car_Images) + $this->car->images()->count();

        if ($this->deletedImages !== null) {
            $conditionOfUpdate = $this->car->images()->count() - count($this->deletedImages) + count(request()->car_Images);

            if ($conditionOfUpdate > 15) {
                return false;
            }
        } else {
            if ($conditionOfStore > 15) {
                return false;
            }
        }

        return true;
    }

    public function message()
    {
        return __('Images exceed the maximum allowed.');
    }
}