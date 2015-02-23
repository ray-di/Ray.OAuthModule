<?php
/**
 * This file is part of the Ray.OAuthModule package
 *
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
namespace Ray\OAuthModule;

use Maye\OAuthClient\OAuth1ClientInterface;
use Maye\OAuthClient\OAuth2ClientInterface;
use Maye\OAuthClient\OAuthClientInterface;
use Ray\Di\AbstractModule;
use Ray\Di\Scope;

class OAuthModule extends AbstractModule
{
    /**
     * @var OAuthClientInterface
     */
    private $client;

    /**
     * Constructor
     *
     * @param OAuthClientInterface $client
     */
    public function __construct(OAuthClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $named = $this->client->getServiceName();
        $bind = '';

        if ($this->client instanceof OAuth1ClientInterface) {
            $bind = OAuth1ClientInterface::class;
        } else if ($this->client instanceof OAuth2ClientInterface) {
            $bind = OAuth2ClientInterface::class;
        }

        $this->bind($bind)->annotatedWith($named)->toInstance($this->client)->in(Scope::SINGLETON);
    }
}
