<?php

namespace App\Helpers;

public function uploadedFile($directory, $uploadedFile)
{
    $directory = realpath(__DIR__ . '/../uploads');

    $uploadedFiles = $request->getUploadedFiles();
    
    // handle single input with single file upload
    $uploadedFile = $uploadedFiles['image'];
    if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
        $basename = bin2hex(random_bytes(8)); // see http://php.net/manual/en/function.random-bytes.php
        $filename = sprintf('%s.%0.8s', 'logo', $extension);
        $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);
        $response->write('uploaded ' . $filename . '<br/>'); 
    }
    return $filename;
}

