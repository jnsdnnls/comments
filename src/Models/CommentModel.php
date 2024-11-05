<?php

namespace Jnsdnnls\Comments\Models;

use Statamic\Facades\File;
use Statamic\Facades\YAML;

class CommentModel
{

    protected $data;
    protected $postId;

    public function __construct($data, $postId)
    {
        $this->data = $data;
        $this->postId = $postId;
    }

    public function save()
    {
        $filePath = base_path("resources/comments/{$this->postId}.yaml");

        // Load existing comments if they exist
        $comments = File::exists($filePath) ? Yaml::file($filePath)->parse() : [];

        // Append the new comment
        $comments[] = $this->data;

        // Write back to the YAML file
        File::put($filePath, YAML::dump($comments));
    }

    public static function all($postId)
    {
        $filePath = base_path("resources/comments/{$postId}.yaml");

        if (!File::exists($filePath)) {
            return [];
        }

        return YAML::file($filePath)->parse();
    }

    public static function allComments()
    {
        $comments = [];

        $files = File::getFiles(base_path('resources/comments'));

        foreach ($files as $file) {
            $comments = array_merge($comments, YAML::file($file)->parse());
        }

        return $comments;
    }
}
