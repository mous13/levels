<?php

namespace Citadel\Levels\Admin\Component;

use Citadel\Levels\Core\Entity\Level;
use Citadel\Levels\Core\Repository\LevelRepository;
use Forumify\Core\Component\Table\AbstractDoctrineTable;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Forumify\Plugin\Attribute\PluginVersion;


#[AsLiveComponent('LevelTable', '@Forumify/components/table/table.html.twig')]
#[IsGranted('levels.admin.levels.manage')]
#[PluginVersion('citadel/levels', 'premium')]
class LevelTable extends AbstractDoctrineTable
{

    public function __construct(
        private readonly LevelRepository $levelRepository
    ) {
        $this->sort = ['xpThreshold' => self::SORT_DESC];
    }

    protected function getEntityClass(): string
    {
        return Level::class;
    }

    protected function buildTable(): void
    {
        $this
            ->addColumn('image', [
                'field' => 'id',
                'label' => '',
                'renderer' => $this->renderImage(...),
                'searchable' => false,
                'sortable' => false,
            ])
            ->addColumn('name', [
                'field' => 'name',
                'sortable' => true,
            ])
            ->addColumn('xpThreshold', [
                'field' => 'xpThreshold',
                'label' => 'Experience Threshold',
                'sortable' => true,
            ])
            ->addColumn('actions', [
                'field' => 'id',
                'label' => '',
                'renderer' => $this->renderActions(...),
                'searchable' => false,
                'sortable' => false,
            ]);
    }

    private function renderActions(int $id): string
    {
        $actions = '';
        if($this->security->isGranted('levels.admin.levels.manage')) {
            $actions .= $this->renderAction('levels_admin_levels_edit', ['identifier' => $id], 'pencil-simple-line');
        }
        if($this->security->isGranted('levels.admin.levels.delete')) {
            $actions .= $this->renderAction('levels_admin_levels_delete', ['identifier' => $id], 'x');
        }

        return $actions;
    }

    private function renderImage(int $id): string
    {
        $level = $this->levelRepository->find($id)->getImage();

        return "<img src='$level' height='25px'>";
    }
}
