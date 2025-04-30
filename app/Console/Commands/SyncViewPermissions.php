<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class SyncViewPermissions extends Command
{
    protected $signature = 'permissions:sync-views';
    protected $description = 'Sincroniza permisos de vistas según las rutas con nombre';

    public function handle()
    {
        $routes = Route::getRoutes();
        $count = 0;
        foreach ($routes as $route) {
            $name = $route->getName();
            if ($name) {
                // Crea el permiso si no existe, con guard web
                Permission::firstOrCreate([
                    'name' => $name,
                    'guard_name' => 'web',
                ]);
                $count++;
            }
        }
        $this->info("Permisos sincronizados: $count");
    }
} 