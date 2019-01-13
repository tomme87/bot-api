<?php


namespace App\Services;


use App\Interfaces\Repository\IAccessTokenRepository;
use App\Interfaces\Repository\IClientRepository;
use App\Interfaces\Repository\IScopeRepository;
use App\Interfaces\Services\IOauthService;
use League\OAuth2\Server\AuthorizationServer;
use League\OAuth2\Server\Grant\ClientCredentialsGrant;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class OauthService implements IOauthService {
  const PRIVATE_KEY_FILE_PARAMETER = 'ba.keys.oauth.private';
  const ENCRYPTION_KEY_PARAMTER = 'ba.keys.oauth.encryption';

  /**
   * @var IClientRepository
   */
  private $clientRepository;

  /**
   * @var IScopeRepository
   */
  private $scopeRepository;

  /**
   * @var IAccessTokenRepository
   */
  private $accessTokenRepository;

  /**
   * @var AuthorizationServer
   */
  private $server;

  /**
   * OauthService constructor.
   * @param IClientRepository $clientRepository
   * @param IScopeRepository $scopeRepository
   * @param IAccessTokenRepository $accessTokenRepository
   * @param ParameterBagInterface $parameterBag
   * @throws \Exception
   */
  public function __construct(
    IClientRepository $clientRepository,
    IScopeRepository $scopeRepository,
    IAccessTokenRepository $accessTokenRepository,
    ParameterBagInterface $parameterBag
  ) {
    $this->clientRepository = $clientRepository;
    $this->scopeRepository = $scopeRepository;
    $this->accessTokenRepository = $accessTokenRepository;

    $privateKeyFile = $parameterBag->get(self::PRIVATE_KEY_FILE_PARAMETER);
    $encryptionKey = $parameterBag->get(self::ENCRYPTION_KEY_PARAMTER);

    $this->server = new AuthorizationServer(
      $this->clientRepository,
      $this->accessTokenRepository,
      $this->scopeRepository,
      $privateKeyFile,
      $encryptionKey
    );

    $this->server->enableGrantType(new ClientCredentialsGrant(), new \DateInterval('PT1H'));
  }

  /**
   * @return AuthorizationServer
   */
  public function getServer(): AuthorizationServer {
    return $this->server;
  }

}
