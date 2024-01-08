<?php

namespace App;

use Illuminate\Support\Str;
use League\CommonMark\Environment\EnvironmentBuilderInterface;
use League\CommonMark\Event\DocumentParsedEvent;
use League\CommonMark\Extension\CommonMark\Node\Inline\Image;
use League\CommonMark\Extension\ExtensionInterface;

class VaporAssetWrapping implements ExtensionInterface
{
    public function register(EnvironmentBuilderInterface $environment): void
    {
        $environment->addEventListener(DocumentParsedEvent::class, [$this, 'onDocumentParsed']);
    }

    public function onDocumentParsed(DocumentParsedEvent $event): void
    {
        $walker = $event->getDocument()->walker();
        while ($event = $walker->next()) {
            $node = $event->getNode();
            // Only look for image nodes, and only process them upon entering.
            if (!$node instanceof Image || !$event->isEntering()) {
                continue;
            }
            // If it's an absolute URL, skip it.
            if (Str::startsWith($node->getUrl(), 'http')) {
                continue;
            }
            // Pass it through to the `asset` helper.
            $node->setUrl(asset($node->getUrl()));
        }
    }
}
