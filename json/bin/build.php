#!/usr/bin/env php
<?php

$dir = dirname(__DIR__);

require $dir . '/workflows.php';

$VERSION = "1.0.0";
$plist = $dir . '/info.plist';


exec(sprintf('/usr/libexec/PlistBuddy -c "Set :version %s" %s', $VERSION, escapeshellarg($plist)));

$zipFile = $dir . '/github.zip';
if (file_exists($zipFile)) {
    unlink($zipFile);
}

$zip = new PharData($zipFile);

$files = [
    'icon.png',
    'info.plist',
    'json.php',
    'README.md',
    'workflows.php',
];

foreach ($files as $file) {
    $zip->addFile($dir . '/' . $file, $file);
}
foreach (glob($dir . '/icons/*.png') as $path) {
    $zip->addFile($path, 'icons/' . basename($path));
}

$zip->compressFiles(Phar::GZ);

$workflow = $dir . '/justwkj_json.alfredworkflow';
if (file_exists($workflow)) {
    unlink($workflow);
}
rename($zipFile, $workflow);