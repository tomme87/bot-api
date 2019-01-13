<?php


namespace App\Interfaces\Services;


use League\OAuth2\Server\AuthorizationServer;

interface IOauthService {
  public function getServer(): AuthorizationServer;
}
