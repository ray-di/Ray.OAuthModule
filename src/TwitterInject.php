<?php
/**
 * This file is part of the Ray.OAuthModule package
 *
 * @license http://opensource.org/licenses/bsd-license.php MIT
 */
namespace Ray\OAuthModule;

use OAuth\OAuth1\Service\Twitter;
use Ray\Di\Di\Inject;

trait TwitterInject
{
    /**
     * @var Twitter
     */
    protected $twitterOAuthClient;

    /**
     * @param Twitter $twitter
     *
     * @Inject
     */
    public function setTwitterOAuthClient(Twitter $twitter)
    {
        $this->twitterOAuthClient = $twitter;
    }
}
