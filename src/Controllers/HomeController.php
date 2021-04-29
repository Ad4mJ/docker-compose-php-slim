<?php

namespace App\Controllers;

use Psr\Log\LoggerInterface as ILogger;
use Illuminate\Database\Query\Builder;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

final class HomeController  {

    private $logger;
    protected $table;

    public function __construct(
    ) {
      
    }

    public function __invoke(Request $request, Response $response, array $args): Response
    {
      // your code here
      // use $this->view to render the HTML
      // ...
      
      return $response->withJson(array('test'));
    }
}