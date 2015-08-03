<?php 
require_once 'DownloadFile.php';

use Core\DownloadFile;

$filePatch = "file.jpg";
$extensionList = ['png', 'jpg'];

try {
    $downloadFile = new DownloadFile();
    $downloadFile->setFile($filePatch)
        ->setValidatorExtension($extensionList)
        ->download();

} catch (Exception $e) {
    echo $e->getMessage();
}
