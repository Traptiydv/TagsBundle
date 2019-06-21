<?php

declare(strict_types=1);

namespace Netgen\TagsBundle\Tests\Templating\Twig\Extension;

use Netgen\TagsBundle\Templating\Twig\Extension\NetgenTagsExtension;
use PHPUnit\Framework\TestCase;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class NetgenTagsExtensionTest extends TestCase
{
    /**
     * @var \Netgen\TagsBundle\Templating\Twig\Extension\NetgenTagsExtension
     */
    private $extension;

    protected function setUp(): void
    {
        $this->extension = new NetgenTagsExtension();
    }

    public function testInstanceOfTwigExtension(): void
    {
        self::assertInstanceOf(AbstractExtension::class, $this->extension);
    }

    public function testGetFunctions(): void
    {
        foreach ($this->extension->getFunctions() as $function) {
            self::assertInstanceOf(TwigFunction::class, $function);
        }
    }
}
