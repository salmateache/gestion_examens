<?php

/*
 *---------------------------------------------------------------
 * CHECK PHP VERSION
 *---------------------------------------------------------------
 */

$minPhpVersion = '8.1'; // If you update this, don't forget to update `spark`.
if (version_compare(PHP_VERSION, $minPhpVersion, '<')) {
    $message = sprintf(
        'Your PHP version must be %s or higher to run CodeIgniter. Current version: %s',
        $minPhpVersion,
        PHP_VERSION
    );

    header('HTTP/1.1 503 Service Unavailable.', true, 503);
    echo $message;

    exit(1);
}

/*
 *---------------------------------------------------------------
 * SET THE CURRENT DIRECTORY
 *---------------------------------------------------------------
 */

// Path to the front controller (this file)
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);

// Ensure the current directory is pointing to the front controller's directory
if (getcwd() . DIRECTORY_SEPARATOR !== FCPATH) {
    chdir(FCPATH);
}

/*
 *---------------------------------------------------------------
 * BOOTSTRAP THE APPLICATION
 *---------------------------------------------------------------
 * This process sets up the path constants, loads and registers
 * our autoloader, along with Composer's, loads our constants
 * and fires up an environment-specific bootstrapping.
 */

 $pathsPath = realpath(__DIR__ . '/../app/Config/Paths.php');

 if (! $pathsPath) {
     header('HTTP/1.1 503 Service Unavailable.', true, 503);
     echo 'The path to the "Paths.php" file does not appear to be set correctly.';
     exit(1);
 }
 
 $pathsPath = realpath(__DIR__ . '/../app/Config/Paths.php');

if (! $pathsPath) {
    header('HTTP/1.1 503 Service Unavailable.', true, 503);
    echo 'The path to the "Paths.php" file does not appear to be set correctly.';
    exit(1);
}

// Load the paths config file
require $pathsPath;
$paths = new Config\Paths();

// Corrected line to include Boot.php
require realpath($paths->systemDirectory) . '/Boot.php';

exit(CodeIgniter\Boot::bootWeb($paths));
