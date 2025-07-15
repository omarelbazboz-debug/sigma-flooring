<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\View as ViewFacade;

class MainMenu extends Component
{
    public $menus;
    public $menuServices;
    public $ulClass;
    public $liClass;
    public $aClass;
    public $ulId;

    /**
     * Create a new component instance.
     */
    public function __construct($menus = null, $menuServices = null, $ulClass = 'nav-list', $liClass = 'item has-child', $aClass = '', $ulId = null)
    {
        $this->menus = $menus ?? (ViewFacade::shared('menus') ?? []);
        $this->menuServices = $menuServices ?? (ViewFacade::shared('menuServices') ?? []);
        $this->ulClass = $ulClass;
        $this->liClass = $liClass;
        $this->aClass = $aClass;
        $this->ulId = $ulId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.main-menu');
    }
}
