<?php

namespace App\View\Components\General;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ChatBubbleComment extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public $comments = null)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.general.chat-bubble-comment');
    }
}
