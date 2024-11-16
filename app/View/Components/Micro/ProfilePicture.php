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
    public function __construct(public $profilePicture = null)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.micro.profile-picture');
    }
}
