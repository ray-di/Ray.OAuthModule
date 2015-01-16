<?php
/**
 * This file is part of the Ray.OAuthModule package
 *
 * @license http://opensource.org/licenses/bsd-license.php MIT
 */
namespace Ray\OAuthModule;

use OAuth\Common\Service\ServiceInterface;
use Ray\Di\AbstractModule as AbstractDiModule;
use Ray\Di\Scope;

abstract class AbstractModule extends AbstractDiModule
{
    /**
     * @var string
     */
    protected $serviceClass;

    /**
     * @var ServiceInterface
     */
    private $oAuthClient;

    /**
     * @param string $consumerKey       Consumer Key
     * @param string $consumerSecret    Consumer Secret
     * @param string $oAuthCallbackPath Callback URL Path
     * @param array  $scopes            Scopes (for OAuth2)
     */
    public function __construct($consumerKey, $consumerSecret, $oAuthCallbackPath, array $scopes = [])
    {
        $this->oAuthClient = (new ServiceFactory)->createService(
            $this->serviceClass,
            $consumerKey,
            $consumerSecret,
            $oAuthCallbackPath,
            $scopes
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->bind($this->serviceClass)->toInstance($this->oAuthClient)->in(Scope::SINGLETON);
    }
}
