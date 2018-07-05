<?php

namespace Reaction\PM\Tests;

use Reaction\PM\Utils;

class UtilsTest extends PhpPmTestCase
{
    public function providePaths()
    {
        return [
            ['/images/foo.png', '/images/foo.png'],
            ['/images/../foo.png', '/foo.png'],
            ['/images/sub/../../foo.png', '/foo.png'],
            ['/images/sub/../foo.png', '/images/foo.png'],

            ['/../foo.png', false],
            ['../foo.png', false],
            ['//images/d/../../foo.png', '/foo.png'],
            ['/images//../foo.png', '/images/foo.png'],
            ["/images/\0/../foo.png", '/images/foo.png'],
            ["/images/\0../foo.png", '/foo.png'],
        ];
    }

    /**
     * @dataProvider providePaths
     * @param string $path
     * @param string $expected
     */
    public function testParseQueryPath($path, $expected)
    {
        $this->assertEquals($expected, Utils::parseQueryPath($path));
    }
}
