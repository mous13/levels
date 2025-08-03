<?php

namespace Citadel\Levels\Admin\Controller;

use Citadel\Levels\Admin\Form\LevelType;
use Citadel\Levels\Core\Entity\Level;
use Forumify\Admin\Crud\AbstractCrudController;
use Forumify\Plugin\Attribute\PluginVersion;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Form\FormInterface;

#[Route('/levels', 'levels')]
#[IsGranted('levels.admin.levels.view')]
#[PluginVersion('citadel/levels', 'premium')]
class LevelController extends AbstractCrudController
{

    protected ?string $permissionView = 'levels.admin.levels.view';
    protected ?string $permissionCreate = 'levels.admin.levels.create';
    protected ?string $permissionEdit = 'levels.admin.levels.manage';
    protected ?string $permissionDelete = 'levels.admin.levels.delete';

    protected function getTranslationPrefix(): string
    {
        return 'levels.' . parent::getTranslationPrefix();
    }

    protected function getEntityClass(): string
    {
        return Level::class;
    }

    protected function getTableName(): string
    {
        return 'LevelTable';
    }

    protected function getForm(?object $data): FormInterface
    {
        return $this->createForm(LevelType::class, $data, [
            'image_required' => $data === null,
        ]);
    }
}