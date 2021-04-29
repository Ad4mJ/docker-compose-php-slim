<?php

namespace App\Controllers;

use App\Models\Users;
use Psr\Log\LoggerInterface as ILogger;
use Psr\Container\ContainerInterface;
use Illuminate\Database\Query\Builder;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

final class AuthController  
{
    protected $container;

    // constructor receives container instance
    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function register(Request $request, Response $response, array $args): Response
    {
        $body = $request->getParsedBody();

        // $newUser = Users::create($body);
        $users = $this->container->db->table('users')->get();

        $directory = $this->container->get('upload_directory');

        $uploadedFiles = $request->getUploadedFiles();
        
        // handle single input with single file upload
        $uploadedFile = $uploadedFiles['image'];
        if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
            $filename = $this->moveUploadedFile($directory, $uploadedFile);
            $response->write('uploaded ' . $filename . '<br/>');
        }
      
        return $response->withJson($users);
    }

    function moveUploadedFile($directory, $uploadedFile)
    {
        $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
        $basename = bin2hex(random_bytes(8)); // see http://php.net/manual/en/function.random-bytes.php
        $filename = sprintf('%s.%0.8s', 'logo', $extension);

        $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);

        return $filename;
    }
}