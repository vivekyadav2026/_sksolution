<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$exc = DB::table('failed_jobs')->where('queue', 'default')->orderBy('failed_at', 'desc')->first()->exception;
file_put_contents('failed_error.txt', $exc);
echo "Done";
