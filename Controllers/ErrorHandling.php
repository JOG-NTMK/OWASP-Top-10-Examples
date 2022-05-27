<?php

namespace Controllers;

use Exception;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ErrorHandling
{
    private ContainerInterface $container;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return ResponseInterface
     * @throws Exception
     */
    public function raw(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        trigger_error('You shouldn\'t see this!', E_USER_WARNING);
        throw new Exception('You shouldn\'t see this');
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return ResponseInterface
     * @throws Exception
     */
    public function debug(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        trigger_error('You shouldn\'t see this!', E_USER_WARNING);
        throw new Exception('You shouldn\'t see this');
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return ResponseInterface
     * @throws Exception
     */
    public function clean(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        error_reporting(0);
        trigger_error('You shouldn\'t see this!', E_USER_WARNING);
        throw new Exception('You shouldn\'t see this');
    }

}
