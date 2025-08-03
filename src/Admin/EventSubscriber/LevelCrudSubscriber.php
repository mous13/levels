<?php

namespace Citadel\Levels\Admin\EventSubscriber;

use Citadel\Levels\Core\Entity\Level;
use Forumify\Admin\Crud\Event\PreSaveCrudEvent;
use Forumify\Core\Service\MediaService;
use League\Flysystem\FilesystemOperator;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class LevelCrudSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private readonly MediaService $mediaService,
        private readonly FilesystemOperator $bannerStorage,
        private readonly ParameterBagInterface $params,
    ) {
    }

    public static function getSubscribedEvents(): array
    {
        return [PreSaveCrudEvent::getName(Level::class) => 'preSaveLevel'];
    }

    /**
     * @param PreSaveCrudEvent<Level> $event
     */
    public function preSaveLevel(PreSaveCrudEvent $event): void
    {
        $level = $event->getEntity();
        $form = $event->getForm();
        $newImage = $form->get('newImage')->getData();
        if (!($newImage instanceof UploadedFile)) {
            return;
        }

        $filename = $this->mediaService->saveToFilesystem($this->bannerStorage, $newImage);
        $storagePath = $this->params->get('levels.banner.storage.path');
        $fullImagePath = $storagePath . '/' . $filename;

        $level->setImage($fullImagePath);
    }
}
