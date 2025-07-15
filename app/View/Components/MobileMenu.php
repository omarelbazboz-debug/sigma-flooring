<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;
use Illuminate\View\Component;

class MobileMenu extends Component
{
    public $menus;
    public $menuServices;

    /**
     * Create a new component instance.
     */
    public function __construct($menus = null, $menuServices = null)
    {
        $this->menus = $menus ?? (ViewFacade::shared('menus') ?? []);
        $this->menuServices = $menuServices ?? (ViewFacade::shared('menuServices') ?? []);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.mobile-menu');
    }
}
