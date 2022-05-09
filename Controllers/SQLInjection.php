<?php
namespace Controllers;

use PDO;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class SQLInjection
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
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function rawConcat(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $userId = $args['id'];

        $DB = $this->container->get('db');

        $stmt = $DB->query('SELECT * from posts where user_id = ' . $userId);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $data = $stmt->fetchAll();

        $response->getBody()->write(json_encode($data));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return ResponseInterface
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function pdoQuote(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $userId = $args['id'];

        $DB = $this->container->get('db');
        //quote string and escape special characters
        $userId = $DB->quote($userId);
        $stmt = $DB->query('SELECT * from posts where user_id = ' . $userId);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $data = $stmt->fetchAll();

        $response->getBody()->write(json_encode($data));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return ResponseInterface
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function pdoPrepare(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $userId = $args['id'];

        $DB = $this->container->get('db');
        //user parameter binding to add value to query
        $stmt = $DB->prepare('SELECT * from posts where user_id = :userId');
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $data = $stmt->fetchAll();

        $response->getBody()->write(json_encode($data));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}