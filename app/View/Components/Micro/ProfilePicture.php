<?php

namespace App\View\Components\Micro;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProfilePicture extends Component
{
    /**
     * Create a new component instance.
     */

     public $profilePicture;
     public $name;
     public $class;

     public function __construct($profilePicture = null, $name, $class = null)
     {
         $this->profilePicture = $profilePicture;
         $this->name = $name;
         $this->class = $class;
     }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.micro.profile-picture');
    }
}
