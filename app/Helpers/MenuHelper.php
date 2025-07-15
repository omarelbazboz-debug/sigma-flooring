<?php
namespace App\Helpers;

class MenuHelper
{
    public static function prepareMenus($menus, $menuServices = null)
    {
        foreach ($menus as $menu) {
            $menu->subMenus = method_exists($menu, 'subMenu') ? $menu->subMenu() : [];
            $menu->hasSubMenu = count($menu->subMenus) > 0;
            $menu->isServices = $menu->type == 'services' && isset($menuServices) && count($menuServices) > 0;
        }
        return $menus;
    }
}
