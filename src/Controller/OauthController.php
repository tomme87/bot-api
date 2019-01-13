<?php


namespace App\Controller;

use App\Document\Client;
use App\Document\Scope;
use App\Interfaces\Services\IOauthService;
use Doctrine\ODM\MongoDB\DocumentManager;
use League\OAuth2\Server\Exception\OAuthServerException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Zend\Diactoros\Response;

/**
 * Class OauthController
 * @package App\Controller
 *
 * @Route("/oauth/v2", name="oauth_v2_")
 */
class OauthController {

  /**
   * @Route("/add")
   *
   * @param DocumentManager $documentManager
   * @return JsonResponse
   */
  public function addClient(DocumentManager $documentManager) {
    $client = new Client();
    $client->setClientSecret("secretlamo");
    $client->setName("lolname");
    $client->setRedirectUri('http://test.com');

    $documentManager->persist($client);
    $documentManager->flush();

    return JsonResponse::create(["ok" => true]);
  }

  /**
   * @Route("/addscope")
   *
   * @param DocumentManager $documentManager
   * @return JsonResponse
   */
  public function addScope(DocumentManager $documentManager) {
    $scope = new Scope();
    $scope->setScope('mordi');

    $documentManager->persist($scope);
    $documentManager->flush();

    return JsonResponse::create(["ok" => true]);
  }

  /**
   * @Route("/access_token", methods={"POST"}, name="access-token")
   *
   * @param ServerRequestInterface $request
   * @param IOauthService $oauthService
   * @return \Psr\Http\Message\ResponseInterface
   */
  public function accessToken(ServerRequestInterface $request, IOauthService $oauthService): ResponseInterface {
    $server = $oauthService->getServer();
    $response = new Response();

    try {
      return $server->respondToAccessTokenRequest($request, $response);
    } catch (OAuthServerException $e) {
      return $e->generateHttpResponse($response);
   }
  }

}
