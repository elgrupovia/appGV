<?php

// Define the path to the bootstrap file
$bootstrapFile = __DIR__.'/../bootstrap/app.php';

// Check if the bootstrap file exists
if (!file_exists($bootstrapFile)) {
    http_response_code(500);
    echo "Error: Bootstrap file not found. Ensure the path is correct.";
    exit;
}

// Bootstrap the Laravel application
require $bootstrapFile;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Contracts\Console\Kernel;

/*
|--------------------------------------------------------------------------
| --- IMPORTANT SECURITY NOTE ---
|--------------------------------------------------------------------------
|
| This file provides a way to run Artisan commands without SSH access.
| It is a MAJOR security risk to leave this file on your public server.
| Anyone who can access this URL can run commands on your application.
|
| 1. UPLOAD this file to your 'public' directory.
| 2. RUN it once by visiting your domain (e.g., https://your-domain.com/runnner.php).
| 3. DELETE this file from your server IMMEDIATELY after use.
| 4. DO NOT commit this file to your version control (Git).
|
*/

try {
    // Set high execution time and memory limit to avoid timeouts
    set_time_limit(300); // 5 minutes
    ini_set('memory_limit', '256M');

    // Start output buffering to capture all command output
    ob_start();

    echo "<pre>";
    echo "Starting Artisan command execution...\n\n";

    // Clear Configuration Cache
    echo "Attempting: php artisan config:clear\n";
    Artisan::call('config:clear');
    echo "Output: " . Artisan::output() . "\n";

    // Clear Application Cache
    echo "Attempting: php artisan cache:clear\n";
    Artisan::call('cache:clear');
    echo "Output: " . Artisan::output() . "\n";

    // Clear Route Cache
    echo "Attempting: php artisan route:clear\n";
    Artisan::call('route:clear');
    echo "Output: " . Artisan::output() . "\n";

    // Clear View Cache
    echo "Attempting: php artisan view:clear\n";
    Artisan::call('view:clear');
    echo "Output: " . Artisan::output() . "\n";
    
    // You can add other commands here if needed, for example:
    // echo "Attempting: php artisan migrate --force\n";
    // Artisan::call('migrate', ['--force' => true]);
    // echo "Output: " . Artisan::output() . "\n";

    echo "----------------------------------------\n";
    echo "All commands executed successfully.\n";
    echo "----------------------------------------\n\n";
    echo "REMINDER: DELETE THIS FILE FROM YOUR SERVER NOW.";
    echo "</pre>";

    // Flush the output buffer
    ob_end_flush();

} catch (Exception $e) {
    // Clean the buffer in case of an error and display the error message
    ob_end_clean();
    http_response_code(500);
    echo "<h1>An Error Occurred</h1>";
    echo "<pre>";
    echo "Message: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . "\n";
    echo "Line: " . $e->getLine() . "\n";
    echo "</pre>";
    echo "<p><strong>REMINDER: Even though an error occurred, you should still delete this file from your server.</strong></p>";
}
