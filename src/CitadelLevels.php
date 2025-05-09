<?php

declare(strict_types=1);

namespace Citadel\Levels;

use Forumify\Plugin\AbstractForumifyPlugin;
use Forumify\Plugin\PluginMetadata;

class CitadelLevels extends AbstractForumifyPlugin
{
    public function getPluginMetadata(): PluginMetadata
    {
        return new PluginMetadata(
            'Levels',
            'Citadel Software Solutions',
        );
    }

    public function getPermissions(): array
    {
        return [
            'admin' => [ 'view' ]
        ];
    }
}
