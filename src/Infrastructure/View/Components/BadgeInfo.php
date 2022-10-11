<?php

namespace Enrise\LaravelSonar\Infrastructure\View\Components;

use Illuminate\View\Component;

class BadgeInfo extends Component
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
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('laravel-sonar::components.badge.info');
    }
}
