<?php

namespace Citadel\Levels\Core\EventSubscriber;

use Citadel\Levels\Core\Service\XpService;
use Forumify\Core\Repository\SettingRepository;
use Forumify\Forum\Event\CommentCreatedEvent;
use Forumify\Forum\Event\TopicCreatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ForumifyXpSubscriber implements EventSubscriberInterface
{

    public function __construct(
        private readonly XpService $xpService,
        private readonly SettingRepository $settingRepository,
    ) {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            TopicCreatedEvent::class => 'onTopicCreated',
            CommentCreatedEvent::class => 'onCommentCreated',
        ];
    }

    public function onTopicCreated(TopicCreatedEvent $event): void
    {
        $topic = $event->getTopic();
        $this->xpService->addXp($topic->getCreatedBy(), (int)$this->settingRepository->get('levels.thread_post_xp'));
    }

    public function onCommentCreated(CommentCreatedEvent $event): void
    {
        $comment = $event->getComment();
        $this->xpService->addXp($comment->getCreatedBy(), (int)$this->settingRepository->get('levels.comment_post_xp'));
    }

}
