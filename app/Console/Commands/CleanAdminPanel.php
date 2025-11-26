<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CleanAdminPanel extends Command
{
    protected $signature = 'admin:clean';
    protected $description = 'Remove old admin panel files completely';

    public function handle()
    {
        $paths = [
            'app/Models/Admin.php',
            'app/Http/Middleware/RedirectIfNotAdmin.php',
            'app/Http/Controllers/Admin',
            'resources/views/admin',
            'database/seeders/AdminSeeder.php',
        ];

        $migrationFiles = glob(database_path('migrations/*create_admins_table*.php'));

        foreach ($migrationFiles as $file) {
            File::delete($file);
            $this->info("Deleted migration: " . $file);
        }

        foreach ($paths as $path) {
            $fullPath = base_path($path);

            if (File::exists($fullPath)) {
                File::deleteDirectory($fullPath);
                File::delete($fullPath);
                $this->info("Deleted: " . $path);
            }
        }

        // Remove admin routes from web.php
        $web = base_path('routes/web.php');
        $content = file_get_contents($web);

        $pattern = '/Route::prefix\(\'admin\'\).*?->group\(function\s*\(\)\s*{.*?}\);/s';

        $newContent = preg_replace($pattern, '', $content);

        file_put_contents($web, $newContent);
        $this->info("Removed admin routes from web.php");

        // Reset config/auth.php
        $auth = base_path('config/auth.php');
        $authContent = file_get_contents($auth);

        $authContent = preg_replace('/\'admin\' => \[.*?],/s', '', $authContent);
        $authContent = preg_replace('/\'admins\' => \[.*?],/s', '', $authContent);

        file_put_contents($auth, $authContent);
        $this->info("Cleaned admin guard from config/auth.php");

        $this->info("✔ Old Admin Panel removed completely!");
        return 0;
    }
}
