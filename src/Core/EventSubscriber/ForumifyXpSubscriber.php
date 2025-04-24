<?php

namespace Citadel\Levels\Core\EventSubscriber;

use Citadel\Levels\Core\Repository\UserXpRepository;
use Citadel\Levels\Core\Service\XpService;
use Forumify\Forum\Event\CommentCreatedEvent;
use Forumify\Forum\Event\TopicCreatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ForumifyXpSubscriber implements EventSubscriberInterface
{

    public function __construct(
        private readonly XpService $xpService,
    ){}

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
        $this->xpService->addXp($topic->getCreatedBy(), 10);
    }

    public function onCommentCreated(CommentCreatedEvent $event): void
    {
        $comment = $event->getComment();
        $this->xpService->addXp($comment->getCreatedBy(), 2);
    }

}