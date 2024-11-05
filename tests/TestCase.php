<?php

namespace Jnsdnnls\Comments\Tests;

use Jnsdnnls\Comments\ServiceProvider;
use Statamic\Testing\AddonTestCase;

abstract class TestCase extends AddonTestCase
{
    protected string $addonServiceProvider = ServiceProvider::class;
}
