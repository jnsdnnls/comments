<?php

namespace Jnsdnnls\Comments\Http;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Statamic\Facades\File;
use Statamic\Http\Controllers\Controller;
use Statamic\Facades\YAML;

class AuthCPController extends Controller
{
    // Display all users in the CP
    public function index()
    {
        // Define the path to the visitors directory
        $directoryPath = base_path('resources/visitors');

        // Check if the directory exists; if not, create it
        if (!File::exists($directoryPath)) {
            File::makeDirectory($directoryPath, 0755, true);
        }

        // Get all YAML files in the 'resources/visitors' directory
        $userFiles = File::getFiles($directoryPath);
        $users = [];

        // Loop through all YAML files and parse user data
        foreach ($userFiles as $file) {
            $userData = YAML::file($file)->parse();
            if ($userData) {
                $users[] = $userData;
            }
        }

        return view('comments::cp.users.index', compact('users'));
    }

    // Ban a user
    public function ban(Request $request, $userId)
    {
        // Define the path to the visitors directory
        $directoryPath = base_path('resources/visitors');

        // Check if the directory exists; if not, create it
        if (!File::exists($directoryPath)) {
            File::makeDirectory($directoryPath, 0755, true);
        }

        // Get the path to the YAML file based on userId
        $filePath = "{$directoryPath}/{$userId}.yaml";

        if (File::exists($filePath)) {
            // Retrieve the user data from the YAML file
            $userData = YAML::file($filePath)->parse();

            // Update the user status to "banned"
            $userData['status'] = 'banned';

            // Write the updated data back to the YAML file
            File::put($filePath, YAML::dump($userData));

            return redirect()->route('statamic.cp.comments.users.index')->with('success', 'User has been banned.');
        }

        return redirect()->route('statamic.cp.comments.users.index')->withErrors('User not found.');
    }
}
