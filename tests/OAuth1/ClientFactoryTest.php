<?php

namespace Ray\OAuthModule\OAuth1;

use OAuth\OAuth1\Service\Twitter;

class ClientFactoryTest extends \PHPUnit_Framework_TestCase
{
	public function testCreateClient()
	{
		$client = (new ClientFactory)->createClient(
			'Twitter',
			'{CONSUMER_KEY}',
			'{CONSUMER_SECRET}',
			'{OAUTH_CALLBACK_URL}'
		);

		$this->assertInstanceOf(Twitter::class, $client);
	}

	public function testCreateCallbackURL()
	{
		$url = (new ClientFactory)->createCallbackURL('/oauth/twitter/callback');
		$this->assertEquals('http://example.com/oauth/twitter/callback', $url);
	}
}
