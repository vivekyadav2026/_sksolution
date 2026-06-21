<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
Illuminate\Support\Facades\DB::statement("ALTER TABLE banners ADD COLUMN type ENUM('home', 'partner') DEFAULT 'home' AFTER link");
echo "Done\n";
