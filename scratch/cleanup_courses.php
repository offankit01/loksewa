<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Course;

$unique = [];
foreach(Course::all() as $c) {
    if(in_array($c->title, $unique)) {
        echo "Deleting duplicate: " . $c->title . " (ID: " . $c->id . ")\n";
        $c->delete();
    } else {
        $unique[] = $c->title;
    }
}
echo "Cleanup complete.\n";
