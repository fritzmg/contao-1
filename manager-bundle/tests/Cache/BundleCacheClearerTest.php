<?php

/*
 * This file is part of Contao.
 *
 * Copyright (c) 2005-2017 Leo Feyer
 *
 * @license LGPL-3.0+
 */

namespace Contao\ManagerBundle\Test\Cache;

use Contao\CoreBundle\Test\TestCase;
use Contao\ManagerBundle\Cache\BundleCacheClearer;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Tests the BundleCacheClearer class.
 *
 * @author Kamil Kuzminski <https://github.com/qzminski>
 */
class BundleCacheClearerTest extends TestCase
{
    /**
     * Tests the object instantiation.
     */
    public function testInstantiation()
    {
        $clearer = new BundleCacheClearer();

        $this->assertInstanceOf('Contao\ManagerBundle\Cache\BundleCacheClearer', $clearer);
    }

    /**
     * Tests the clear() method.
     */
    public function testClear()
    {
        $fs = new Filesystem();
        $cacheDir = $this->getCacheDir();

        $fs->touch("$cacheDir/bundles.map");
        $this->assertFileExists("$cacheDir/bundles.map");

        $clearer = new BundleCacheClearer($fs);
        $clearer->clear($cacheDir);

        $this->assertFileNotExists("$cacheDir/bundles.map");
    }
}
