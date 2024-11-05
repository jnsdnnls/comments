<?php

namespace Jnsdnnls\Comments;

use Statamic\Providers\AddonServiceProvider;
use Statamic\Facades\CP\Nav;

class ServiceProvider extends AddonServiceProvider
{
    protected $tags = [
        Tags\Comment::class,
        Tags\Profile::class,
        Tags\Auth::class,
    ];

    protected $modifiers = [];

    protected $commands = [];

    protected $publishables = [];

    protected $fieldTypes = [];

    protected $widgets = [];

    protected $scripts = [];

    protected $routes = [
        'actions' => __DIR__ . '/../routes/actions.php',
        'web' => __DIR__ . '/../routes/web.php'
    ];

    protected $menuItems = [];

    public function bootAddon()
    {
        $this->extendCPNav();
    }

    private function extendCPNav()
    {
        Nav::extend(function ($nav) {
            $nav->content('Comments')->section('Addons')
                ->route('comments.index')
                ->icon('addons')
                ->active('comments')
                ->children([
                    'Comments' => cp_route('comments.index'),
                    'Users' => cp_route('comments.index'),
                ]);
        });
    }
}
