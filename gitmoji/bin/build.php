#!/usr/bin/env php
<?php

$dir = dirname(__DIR__);

require $dir . '/workflows.php';

$VERSION = "1.0.0";
$plist = $dir . '/info.plist';


exec(sprintf('/usr/libexec/PlistBuddy -c "Set :version %s" %s', $VERSION, escapeshellarg($plist)));
//$changelog = file_get_contents($dir.'/CHANGELOG.md');
//$changelog = str_replace("\n", '\n', $changelog);
//exec(sprintf('/usr/libexec/PlistBuddy -c "Set :readme \"%s\"" %s', escapeshellcmd($changelog), escapeshellarg($plist)));

$zipFile = $dir . '/github.zip';
if (file_exists($zipFile)) {
    unlink($zipFile);
}

$zip = new PharData($zipFile);

$files = [
    //'icon.png',
    'info.plist',
    'gitmoji.php',
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

$workflow = $dir . '/gitmoji.alfredworkflow';
if (file_exists($workflow)) {
    unlink($workflow);
}
rename($zipFile, $workflow);