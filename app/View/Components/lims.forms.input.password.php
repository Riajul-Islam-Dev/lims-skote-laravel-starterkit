<?php

namespace App\View\Components;

use Illuminate\View\Component;

class lims.forms.input.password extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.lims.forms.input.password');
    }
}