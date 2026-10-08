# Project Profile

A small **profile directory** built with Laravel. Anyone can add a profile, browse the list, open a single profile, view its skills, edit it, delete it, or jump to a random one. Profiles are stored in a database, so they stay after the browser is closed.

Repository: https://github.com/patchwikkjvdeee/Project-Profile

---

## Table of contents

- [Features](#features)
- [Tech stack](#tech-stack)
- [Requirements](#requirements)
- [Setup](#setup)
- [Configuration](#configuration)
- [Usage](#usage)
- [Routes reference (the "API")](#routes-reference-the-api)
- [Form fields and validation](#form-fields-and-validation)
- [Data model](#data-model)
- [Project structure](#project-structure)
- [How a request flows](#how-a-request-flows)
- [Useful commands](#useful-commands)
- [Troubleshooting](#troubleshooting)
- [Known limitations](#known-limitations)
- [Pushing changes to GitHub](#pushing-changes-to-github)

---

## Features

- **List** every saved profile, newest first
- **Create** a new profile (each save adds a new row, nothing is overwritten)
- **View** one profile: name, tagline, bio, skills, contact info, fun fact
- **Skills page** for a single profile
- **Edit** a profile. Fields left blank keep their old value, and the old values show as placeholders
- **Delete** a profile, with a confirmation popup
- **Meet someone**: jump to a random profile
- **About** page
- Dark gray theme with a straight, full-width navigation bar
- One shared Blade layout, so the design lives in a single file

## Tech stack

| Part | Technology |
|---|---|
| Framework | Laravel 13 |
| Language | PHP 8.5 |
| Database | SQLite (default), MySQL also works |
| Templates | Blade |
| Database access | Eloquent ORM |
| Styling | Plain CSS inside the layout file (no build step) |

The project was developed with PHP 8.5.9 and Laravel 13.33.0. Other recent versions of PHP and Laravel should work, but they were not tested.

## Requirements

- **PHP** (8.2 or newer recommended)
- **Composer**
- **Git**
- The PHP **SQLite extension** (`pdo_sqlite`), which is enabled in most PHP installs
- Node.js is **not** needed. The CSS is inline, so there is nothing to compile.

Check what you have:

```
php -v
composer -V
git --version
```

## Setup

### 1. Clone the repository

Run this in the folder where you keep projects, not inside another project:

```
git clone https://github.com/patchwikkjvdeee/Project-Profile.git
cd Project-Profile
```

### 2. Install the PHP packages

```
composer install
```

This rebuilds the `vendor` folder, which is not stored in GitHub.

### 3. Create the environment file

Windows (Command Prompt or PowerShell):
```
copy .env.example .env
```

Mac or Linux:
```
cp .env.example .env
```

### 4. Generate the app key

```
php artisan key:generate
```

### 5. Build the database

```
php artisan migrate
```

If Laravel asks whether to create the SQLite database file, type `yes`. This creates `database/database.sqlite` and the `profiles` table.

### 6. Start the server

```
php artisan serve
```

Open **http://127.0.0.1:8000** in your browser. Press `Ctrl + C` in the terminal to stop the server.

> Your profiles are saved in `database/database.sqlite`. That file is not uploaded to GitHub, so a fresh clone starts with no profiles.

## Configuration

Settings live in the `.env` file. Do not commit this file. It is already ignored by `.gitignore`.

### SQLite (default)

```
DB_CONNECTION=sqlite
```

### MySQL (optional)

1. Create an empty database, for example `project_profile`.
2. Change these lines in `.env`:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=project_profile
DB_USERNAME=root
DB_PASSWORD=
```

3. Run `php artisan migrate`.

After you change `.env`, clear the saved settings if the app still uses the old values:

```
php artisan config:clear
```

## Usage

1. Open the home page (`/`). If no profiles exist, you will see an empty message.
2. Click **+ New profile**. Fill in the form and click **Save profile**. You land on the new profile's page.
3. Add a second profile the same way. Go back to `/` and both appear in the list.
4. Click a name to open its page. From there you can:
   - **Skills** shows only that person's skills
   - **Edit** changes the profile
   - **Back to list** returns to `/`
   - **Delete** removes the profile after you confirm
5. On the home page, **Meet someone** opens a random profile.

### Editing tips

- The edit form shows the saved values as light gray **placeholders**. The boxes are empty on purpose.
- Type only in the fields you want to change. Any box you leave empty **keeps its old value**.
- **Clear form** empties the boxes on screen. It does not touch the database.
- **Skills** are typed as one line separated by commas, for example `HTML, CSS, PHP, Laravel`.

## Routes reference (the "API")

This project is a **server-rendered website**. It does not have a JSON REST API. Every route below returns either an HTML page or a redirect. All routes belong to the `web` group, so every `POST` request needs a CSRF token (the `@csrf` line in each form).

| Method | URL | Controller method | What it does | Response |
|---|---|---|---|---|
| GET | `/` | `index` | List all profiles, newest first | HTML page (`home`) |
| GET | `/about` | `about` | About page | HTML page (`about`) |
| GET | `/spotlight` | `spotlight` | Pick a random profile | Redirect to `/profiles/{id}`, or to `/` if there are no profiles |
| GET | `/profiles/create` | `create` | Empty form for a new profile | HTML page (`create`) |
| POST | `/profiles` | `store` | Validate and create a new profile | Redirect to `/profiles/{id}` of the new row |
| GET | `/profiles/{id}` | `show` | Show one profile | HTML page (`show`), or 404 |
| GET | `/profiles/{id}/skills` | `skills` | Show one profile's skills | HTML page (`skills`), or 404 |
| GET | `/profiles/{id}/edit` | `edit` | Edit form for one profile | HTML page (`edit`), or 404 |
| POST | `/profiles/{id}` | `update` | Validate and update one profile | Redirect to `/profiles/{id}`, or 404 |
| POST | `/profiles/{id}/delete` | `destroy` | Delete one profile | Redirect to `/`, or 404 |

### Route notes

- `{id}` is the profile's database id, a whole number such as `7`.
- `/profiles/create` is declared **before** `/profiles/{id}` on purpose. If the order is swapped, Laravel treats the word `create` as an id.
- Delete uses `POST` and not a plain link, so it cannot be triggered by accident (for example by a browser prefetching a link).
- A missing profile id returns Laravel's standard **404 Not Found** page, because the controller uses `findOrFail()`.

### Example requests

Create a profile (this is what the form sends):

```
POST /profiles
Content-Type: application/x-www-form-urlencoded

_token=<csrf token>&name=Aji&tagline=Learning Laravel&skills=HTML, CSS, PHP&city=Cebu
```

Response: `302 Found`, `Location: /profiles/1`

Update only the city of profile 1:

```
POST /profiles/1
Content-Type: application/x-www-form-urlencoded

_token=<csrf token>&name=&tagline=&bio=&skills=&fun_fact=&email=&github=&city=Manila
```

Empty fields are ignored, so only `city` changes.

> Because of CSRF protection, calling these routes from tools like `curl` or Postman needs a valid `_token` and session cookie. Using the website forms is the normal way.

## Form fields and validation

Both the create form and the edit form send the same fields. The rules are in `ProfileController::validated()`.

| Field | Rule | Notes |
|---|---|---|
| `name` | optional, text, max 100 characters | If empty on create, it is saved as `Someone` |
| `tagline` | optional, text, max 150 characters | Short line shown under the name |
| `bio` | optional, text, max 1000 characters | Longer description |
| `skills` | optional, text, max 500 characters | Comma-separated. Split into a list, trimmed, empty items removed |
| `fun_fact` | optional, text, max 300 characters | |
| `email` | optional, text, max 100 characters | Stored as plain text, not checked as an email address |
| `github` | optional, text, max 100 characters | |
| `city` | optional, text, max 100 characters | |

If a rule fails, Laravel sends the user back to the form and the `@error` lines show the message.

### Create vs update behavior

| | `store` (create) | `update` (edit) |
|---|---|---|
| Empty field | Saved as empty (name becomes `Someone`) | **Ignored**, the old value stays |
| Database action | `Profile::create()` inserts a **new row** | `$profile->update()` changes the **same row** |

## Data model

**Model:** `app/Models/Profile.php` maps to the `profiles` table.

| Column | Type | Nullable | Notes |
|---|---|---|---|
| `id` | integer, primary key | no | Auto-increments. Numbers are never reused after a delete |
| `name` | string | no | |
| `tagline` | string | yes | |
| `bio` | text | yes | |
| `skills` | JSON | yes | Cast to a PHP array by the model |
| `fun_fact` | text | yes | |
| `email` | string | yes | |
| `github` | string | yes | |
| `city` | string | yes | |
| `created_at` | timestamp | yes | Set by Laravel |
| `updated_at` | timestamp | yes | Set by Laravel |

Two important settings in the model:

- `$fillable` lists the columns that can be mass-assigned, such as with `Profile::create($data)`. A column missing from this list causes a `MassAssignmentException`.
- `$casts = ['skills' => 'array']` saves the skills list as JSON and gives it back as a PHP array.

## Project structure

Only the files made or changed for this project are shown.

```
Project-Profile/
├── app/
│   ├── Http/Controllers/
│   │   └── ProfileController.php      # All page actions
│   └── Models/
│       └── Profile.php                # Eloquent model
├── database/
│   ├── migrations/
│   │   └── ..._create_profiles_table.php   # Builds the profiles table
│   └── database.sqlite                # Created by migrate (not in Git)
├── resources/views/
│   ├── layouts/
│   │   └── app.blade.php              # Shared layout, navbar, footer, CSS
│   ├── home.blade.php                 # Profile list
│   ├── show.blade.php                 # One profile
│   ├── skills.blade.php               # One profile's skills
│   ├── create.blade.php               # New profile form
│   ├── edit.blade.php                 # Edit form
│   └── about.blade.php                # About page
├── routes/
│   └── web.php                        # All routes
├── .env.example                       # Copy to .env
└── composer.json
```

## How a request flows

```
Browser  ->  routes/web.php  ->  ProfileController  ->  Profile model  ->  database
                                        |
                                        v
                                  Blade view (inside layouts/app.blade.php)
                                        |
                                        v
                                     Browser
```

1. The browser asks for a URL.
2. `routes/web.php` finds the matching rule.
3. The rule calls a method in `ProfileController`.
4. The controller uses the `Profile` model to read or write the database.
5. The controller returns a Blade view, or redirects to another URL.
6. The view fills the layout and the page is sent back.

## Useful commands

| Command | Purpose |
|---|---|
| `php artisan serve` | Start the local server |
| `php artisan migrate` | Run new migrations |
| `php artisan migrate:fresh` | **Delete all tables** and rebuild them. All saved profiles are lost |
| `php artisan migrate:status` | Show which migrations have run |
| `php artisan route:list` | Show every route |
| `php artisan tinker` | Open a test console, for example `App\Models\Profile::all();` |
| `php artisan config:clear` | Clear cached settings |
| `php artisan optimize:clear` | Clear all cached files |
| `composer dump-autoload` | Rebuild the class list |

### Check the saved data

```
php artisan tinker
```
```
App\Models\Profile::count();
App\Models\Profile::all();
```

You can also open `database/database.sqlite` in VS Code with the **SQLite Viewer** extension. Close and reopen the tab if it looks out of date.

## Troubleshooting

| Problem | Likely cause | Fix |
|---|---|---|
| `Class "App\Models\Profile" not found` | `Profile.php` has the wrong content, or the file is missing | Put the model code in `app/Models/Profile.php`, then run `composer dump-autoload` |
| `MassAssignmentException` | A column is missing from `$fillable` | Add all columns to `$fillable` in the model |
| `419 Page Expired` | `@csrf` is missing in a form | Add `@csrf` as the first line inside the `<form>` |
| `no such table: profiles` | Migration has not run | Run `php artisan migrate` |
| `Nothing to migrate` after editing a migration | The file already ran once | Run `php artisan migrate:fresh` (this deletes data) |
| 404 on `/profiles/create` | Route order is wrong | Keep `/profiles/create` above `/profiles/{id}` |
| Old design still shows | Browser cache | Press `Ctrl + F5` |
| `View [x] not found` | View file missing or misnamed | Check the file is in `resources/views` and ends in `.blade.php` |
| `composer` or `php` not recognized | Not installed or not in PATH | Install it, then reopen the terminal |
| New profiles seem to replace old ones | An old single-profile version of the controller is still in use | Make sure `store()` uses `Profile::create($data)` |
| `Repository not found` on `git push` | Wrong remote URL | `git remote set-url origin https://github.com/patchwikkjvdeee/Project-Profile.git` |

## Known limitations

- **No login.** Anyone who can open the site can edit or delete any profile.
- **Blank means keep.** Because empty edit fields keep their old value, you cannot clear a field to empty from the edit form. Type a replacement value instead.
- **No email check.** The email field accepts any text.
- **No pagination.** The home page loads all profiles at once.
- **No JSON API.** The routes return HTML and redirects only.
- **No automated tests** are included.

Possible next steps: user accounts, a proper email rule, pagination or search on the list, a JSON API under `routes/api.php`, and feature tests.

## Pushing changes to GitHub

```
git add .
git commit -m "Describe what you changed"
git push
```

If the remote is wrong, check it and fix it:

```
git remote -v
git remote set-url origin https://github.com/patchwikkjvdeee/Project-Profile.git
git push -u origin main
```

If GitHub rejects the push because the remote has files you do not have, pull them first:

```
git pull origin main --allow-unrelated-histories
git push -u origin main
```

GitHub does not accept your account password for pushes. Use the browser sign-in that Git opens, or a Personal Access Token.

## License

No license has been chosen yet. Add a `LICENSE` file if you want others to be able to reuse the code.
