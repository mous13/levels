<?php

namespace Citadel\Levels\Admin\MenuBuilder;

use Forumify\Admin\MenuBuilder\AdminMenuBuilderInterface;
use Forumify\Core\MenuBuilder\Menu;
use Forumify\Core\MenuBuilder\MenuItem;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class MenuBuilder implements AdminMenuBuilderInterface
{

    public function __construct
    (
        private readonly UrlGeneratorInterface $urlGenerator,
    ){}

    public function build(Menu $menu): void
    {
        $url = $this->urlGenerator->generate(...);

        $levelsMenu = new Menu('Levels', ['icon' => 'ph ph-arrow-fat-up', 'permission' => 'levels.admin.levels.view'], [
            new MenuItem('Levels', $url('levels_admin_levels_list'), ['icon' => 'ph ph-arrow-fat-up', 'permission' => 'levels.admin.levels.view']),
            new MenuItem('Settings', $url('levels_admin_levels_settings'), ['icon' => 'ph ph-gear', 'permission' => 'levels.admin.levels.view']),
        ]);

        $menu->addItem($levelsMenu);
    }
}