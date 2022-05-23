<?php

namespace Controllers;

use Exception;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Psr7\Stream;

class SSRF
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
     */
    public function noRestrictions(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $parsedBody = $request->getQueryParams();
        $url = $parsedBody['url'];
        $fh = fopen($url, 'rb');
        $file_stream = new Stream($fh);

        return $response->withBody($file_stream);
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return ResponseInterface
     * @throws Exception
     */
    public function blacklist(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $denyList = ["127.0.0.1", "0.0.0.0", "localhost"];
        $parsedBody = $request->getQueryParams();
        $url = $parsedBody['url'];
        $urlParts = parse_url($url);
        if (in_array($urlParts['host'], $denyList)) {
            throw new Exception('URL not allowed');
        }
        $fh = fopen($url, 'rb');
        $file_stream = new Stream($fh);

        return $response->withBody($file_stream);
    }

    public function noRestrictionsBlind(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $parsedBody = $request->getQueryParams();
        $url = $parsedBody['url'];
        $fh = fopen($url, 'rb');
        $file_stream = new Stream($fh);

        return $response->withBody($file_stream)
            ->withHeader('Content-Disposition', 'attachment; filename=document.pdf;')
            ->withHeader('Content-Type', mime_content_type($url))
            ->withHeader('Content-Length', filesize($url));
    }

}
