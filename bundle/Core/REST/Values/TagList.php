<?php

declare(strict_types=1);

namespace Netgen\TagsBundle\Core\REST\Values;

use EzSystems\EzPlatformRest\Value;

final class TagList extends Value
{
    /**
     * @var \Netgen\TagsBundle\Core\REST\Values\RestTag[]
     */
    public $tags;

    /**
     * @var string
     */
    public $path;

    /**
     * @param \Netgen\TagsBundle\Core\REST\Values\RestTag[] $tags
     * @param string $path
     */
    public function __construct(array $tags, string $path)
    {
        $this->tags = $tags;
        $this->path = $path;
    }
}
