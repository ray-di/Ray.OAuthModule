<?php
/**
 * This file is part of the Ray.OAuthModule package
 *
 * @license http://opensource.org/licenses/bsd-license.php MIT
 */
namespace Ray\OAuthModule;

use OAuth\Common\Consumer\Credentials;
use OAuth\Common\Http\Uri\UriFactory;
use OAuth\Common\Storage\Session;
use OAuth\OAuth1\Service\ServiceInterface;
use OAuth\ServiceFactory;

final class ClientFactory
{
    /**
     * @param string $serviceName       Service Name
     * @param string $consumerKey       Consumer Key
     * @param string $consumerSecret    Consumer Secret
     * @param string $oAuthCallbackPath Callback URL Path
     *
     * @return ServiceInterface
     */
    public function createClient($serviceName, $consumerKey, $consumerSecret, $oAuthCallbackPath)
    {
        $callbackUrl = $this->createCallbackURL($oAuthCallbackPath);
        $credentials = new Credentials($consumerKey, $consumerSecret, $callbackUrl);
        return (new ServiceFactory)->createService($serviceName, $credentials, new Session());
    }

    /**
     * @param string $oAuthCallbackPath Callback URL Path
     *
     * @return string
     */
    public function createCallbackURL($oAuthCallbackPath)
    {
        $uri = (new UriFactory)->createFromSuperGlobalArray($_SERVER);
        $uri->setPath($oAuthCallbackPath);
        $uri->setQuery('');
        return $uri->getAbsoluteUri();
    }
}
