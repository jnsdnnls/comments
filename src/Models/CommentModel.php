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
            // Parse the YAML file and ensure it returns an array
            $parsedComments = YAML::file($file)->parse();

            // Only merge if $parsedComments is an array
            if (is_array($parsedComments)) {
                $comments = array_merge($comments, $parsedComments);
            }
        }

        return $comments;
    }

    public static function find($commentId)
    {
        $comments = self::allComments();

        return collect($comments)->firstWhere('id', $commentId);
    }

    public static function findById($commentId)
    {
        $comments = self::allComments();

        return collect($comments)->firstWhere('comment_id', $commentId);
    }

    public static function destroy($commentId)
    {
        $comments = self::allComments();

        $comments = collect($comments)->reject(function ($comment) use ($commentId) {
            return $comment['post_id'] === $commentId;
        });

        $files = File::getFiles(base_path('resources/comments'));

        foreach ($files as $file) {
            $comments = collect(YAML::file($file)->parse())->reject(function ($comment) use ($commentId) {
                return $comment['post_id'] === $commentId;
            });

            File::put($file, YAML::dump($comments));
        }
    }
}
