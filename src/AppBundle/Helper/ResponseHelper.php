<?php

namespace AppBundle\Helper;

use Symfony\Component\HttpFoundation\Response;

/**
 * Class ResponseHelper
 * @package Project\Core\Helper
 */
class ResponseHelper
{
    /**
     * @param array|null $responseContent
     * @param int $codeStatus
     */
    public static function response(array $responseContent = null, $codeStatus = 200)
    {
        $response = new Response();
        $response->setStatusCode($codeStatus);
        $response->headers->set('Content-Type', 'application/json');
        $response->setContent(json_encode($responseContent, JSON_UNESCAPED_UNICODE));
        $response->send();
    }
}
