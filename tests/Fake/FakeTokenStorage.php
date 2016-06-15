<?php

namespace Ray\OAuthModule;

use OAuth\Common\Storage\TokenStorageInterface;
use OAuth\Common\Token\TokenInterface;

class FakeTokenStorage implements TokenStorageInterface
{
    public function retrieveAccessToken($service)
    {
    }

    public function storeAccessToken($service, TokenInterface $token)
    {
    }

    public function hasAccessToken($service)
    {
    }

    public function clearToken($service)
    {
    }

    public function clearAllTokens()
    {
    }

    public function storeAuthorizationState($service, $state)
    {
    }

    public function hasAuthorizationState($service)
    {
    }

    public function retrieveAuthorizationState($service)
    {
    }

    public function clearAuthorizationState($service)
    {
    }

    public function clearAllAuthorizationStates()
    {
    }
}
