<?php
/**
 * This file is part of the Ray.OAuthModule package
 *
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
namespace Ray\OAuthModule\Inject;

use Maye\OAuthClient\OAuth1ClientInterface;
use Ray\Di\Di\Inject;
use Ray\Di\Di\Named;

trait YahooOAuthInject
{
    /**
     * @var OAuth1ClientInterface
     */
    protected $yahooOAuth;

    /**
     * @param OAuth1ClientInterface $client
     *
     * @Inject
     * @Named("yahoo")
     */
    public function setYahooOAuthInject(OAuth1ClientInterface $client)
    {
        $this->yahooOAuth = $client;
    }
}
