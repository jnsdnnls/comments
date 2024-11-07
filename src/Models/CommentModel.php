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
        $directoryPath = base_path('resources/comments');
        $filePath = "{$directoryPath}/{$this->postId}.yaml";

        // Ensure the directory exists
        if (!File::exists($directoryPath)) {
            File::makeDirectory($directoryPath, 0755, true);
        }

        // Load existing comments if they exist
        $comments = File::exists($filePath) ? YAML::file($filePath)->parse() : [];

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
        $directoryPath = base_path('resources/comments');

        // Ensure the directory exists
        if (!File::exists($directoryPath)) {
            return [];
        }

        $comments = [];
        $files = File::getFiles($directoryPath);

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
        $directoryPath = base_path('resources/comments');

        if (!File::exists($directoryPath)) {
            return;
        }

        $files = File::getFiles($directoryPath);

        foreach ($files as $file) {
            // Load comments from file, filter them, and save back
            $comments = collect(YAML::file($file)->parse())->reject(function ($comment) use ($commentId) {
                return $comment['comment_id'] === $commentId;
            });

            File::put($file, YAML::dump($comments->values()->all()));
        }
    }
}
