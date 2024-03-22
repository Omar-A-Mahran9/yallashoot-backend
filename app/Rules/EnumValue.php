<?php

namespace App\Rules;
use ReflectionClass;
use Illuminate\Contracts\Validation\Rule;

class EnumValue implements Rule
{
    protected $enumClass;

    public function __construct(string $enumClass)
    {
        $this->enumClass = $enumClass;
    }

    public function passes($attribute, $value)
    {
        $class = new ReflectionClass($this->enumClass);
        $enumValues = collect($class->getConstants())->pluck("value")->toArray();

        return in_array($value, $enumValues);
    }

    public function message()
    {
        return __("قيمة ") . ":attribute" . __(" غير صالحة");
    }
}
