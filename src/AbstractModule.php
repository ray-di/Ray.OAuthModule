<?php
/**
 * This file is part of the Ray.OAuthModule package
 *
 * @license http://opensource.org/licenses/bsd-license.php MIT
 */
namespace Ray\OAuthModule;

use OAuth\OAuth1\Service\ServiceInterface;
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
     * @param string $consumerKey    Consumer Key
     * @param string $consumerSecret Consumer Secret
     * @param string $oAuthCallbackPath  Callback URL Path
     */
    public function __construct($consumerKey, $consumerSecret, $oAuthCallbackPath)
    {
        // trim namespace
        $serviceName = substr(strrchr($this->serviceClass, "\\"), 1);

        $this->oAuthClient = (new ClientFactory)->createClient(
            $serviceName,
            $consumerKey,
            $consumerSecret,
            $oAuthCallbackPath
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
