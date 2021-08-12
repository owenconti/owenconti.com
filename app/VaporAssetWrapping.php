<?php

namespace App;

use Illuminate\Support\Str;
use League\CommonMark\ConfigurableEnvironmentInterface;
use League\CommonMark\Event\DocumentParsedEvent;
use League\CommonMark\Extension\ExtensionInterface;
use League\CommonMark\Inline\Element\Image;

class VaporAssetWrapping implements ExtensionInterface
{
    public function register(ConfigurableEnvironmentInterface $environment)
    {
        $environment->addEventListener(DocumentParsedEvent::class, [$this, 'onDocumentParsed']);
    }

    public function onDocumentParsed(DocumentParsedEvent $event)
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
            $node->setUrl(asset('dist'.$node->getUrl()));
        }
    }
}
