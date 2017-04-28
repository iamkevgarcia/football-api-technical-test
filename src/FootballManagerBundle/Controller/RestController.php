<?php
namespace FootballManagerBundle\Controller;

use FootballManagerBundle\Handler\BaseHandler;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class RestController extends FOSRestController
{
    /**
     * @param $name
     * @return BaseHandler
     */
    protected function getHandler($name)
    {
        return $this->get(sprintf('football_mgr_bundle.%s.handler', $name));
    }

    /**
     * @param Response $response
     * @param Request $request
     * @return Response
     */
    protected function cacheValidationUsingETag(Response $response, Request $request)
    {
        $response->setEtag(md5($response->getContent()));
        $response->setPublic();
        $response->isNotModified($request);

        return $response;
    }
}