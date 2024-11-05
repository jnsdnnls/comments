# Comments Addon

A Statamic addon that provides a fully integrated commenting system for your website. This addon allows users to post comments on blog posts and provides administrators with a Control Panel interface to view, moderate, and manage comments.

## Features

- **User Comments**: Allow logged-in users to comment on posts.
- **Admin Dashboard**: Control Panel view to manage all comments.
- **Comment Moderation**: Admins can delete comments directly from the CP.
- **Authentication Required**: Only authenticated users can submit comments.
- **User Profile**: Optionally add a "Profile" link to the navigation bar for registered users.

## Requirements

- Statamic version 3.5 or later
- PHP 7.4 or later
- Mailhog or another mail server for sending registration emails

## Installation

You can install this addon via Composer:

```bash
composer require jnsdnnls/comments
```

## Usage

#### Adding Comments to a Page

To display a comments form on any page, include the {{ comments:form }} tag in your page template:

```antlers
{{ comments:form }}
```

To render a list of comments for a post, use the following:

```antlers
{{ comments:list }}
```

Admin Dashboard
Once installed, you can access the **Comments** dashboard from the Statamic Control Panel. This page allows administrators to view and delete comments.

## User Registration

Users must be registered and logged in to leave comments. When a user registers, they will receive a password setup link by email.

Register Form: Use the following to include a registration form in your template:

```antlers
{{ registration:form }}
```

Login Form: To render a login form:

```antlers
{{ login:form }}
```

## Code Structure

- **routes/cp.ph**p: Defines CP routes for the addon.
- **Http/Controllers/CommentsController.php**: Handles comments listing and deletion in the CP.
- **resources/views/cp/index.blade.php**: Control Panel view to display comments.
- **CommentsService.php**: Handles comment storage and retrieval logic.
- **resources/views/tags**: Views for form and list tags.

## Customization

You can customize the appearance of the comments and forms using Tailwind CSS in the provided templates. Update the templates in `resources/views` as desired.
