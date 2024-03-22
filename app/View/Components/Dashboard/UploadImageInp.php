<?php

namespace App\View\Components\Dashboard;

use Illuminate\View\Component;

class UploadImageInp extends Component
{

    public $imagePath;
    public $name;
    public $type;

    public function __construct($image,$directory,$placeholder , $name, $type)
    {
        $this->imagePath = getImagePathFromDirectory( $image , $directory , $placeholder );
        $this->name      = $name;
        $this->type      = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */

    public function render()
    {
        return view('components.dashboard.upload-image-inp',['imagePath' => $this->imagePath]);
    }
}
