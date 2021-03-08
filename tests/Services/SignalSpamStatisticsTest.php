<?php

namespace ExpertSenderFr\ExpertSenderApi\Tests\Services;

use PHPUnit\Framework\TestCase;
use ExpertSenderFr\ExpertSenderApi\ExpertSenderClient;
use ExpertSenderFr\ExpertSenderApi\Model\Message;
use ExpertSenderFr\ExpertSenderApi\Model\NewsletterCreationPayload;

class SignalSpamStatisticsTest extends TestCase
{
    /**
     * @test
     */
    public function canQuery()
    {
        $client = new ExpertSenderClient('<YOUR_API_KEY_HERE>', 'https://api2.esv2.com');
        $service = $client->signalSpamStatistics();

        $response = $service->get(null, null, ['grouping' => 'Provider']);

        $this->assertTrue(true);
    }

    public function testDeleteOnInstantiation()
    {
        $client = new ExpertSenderClient('<YOUR_API_KEY_HERE>', 'https://api2.esv2.com');
        $service = $client->messages();

        $this->assertTrue($service->delete(341));
    }

    public function testDeleteWithApiKeyAsOption()
    {
        $client = new ExpertSenderClient(null, 'https://api2.esv2.com');
        $service = $client->messages();

        $this->assertTrue($service->delete(341, ['api_key' => '<YOUR_API_KEY_HERE>']));
    }

    public function testDeleteWithUrlAsOption()
    {
        $client = new ExpertSenderClient('<YOUR_API_KEY_HERE>');
        $service = $client->messages();

        $this->assertTrue($service->delete(341, ['domain' => 'https://api2.esv2.com']));
    }

    public function testDeleteWithApiKeyAndUrlAsOption()
    {
        $client = new ExpertSenderClient();
        $service = $client->messages();

        $this->assertTrue($service->delete(341, ['api_key' => '<YOUR_API_KEY_HERE>', 'domain' => 'https://api2.esv2.com']));
    }

    public function testDeleteThrowsExceptionIfNoApiKeyIsSet()
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('API Key not set.');

        $client = new ExpertSenderClient();
        $service = $client->messages();

        $service->delete(341, ['domain' => 'https://api2.esv2.com']);
    }

    public function testDeleteThrowsExceptionIfNoDomainIsSet()
    {
        $this->expectException(\Symfony\Component\OptionsResolver\Exception\InvalidOptionsException::class);

        $client = new ExpertSenderClient();
        $service = $client->messages();

        $service->delete(341, ['api_key' => '<YOUR_API_KEY_HERE>']);
    }

    public function testDeleteThrowsExceptionIfDomainIsEmpty()
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('The domain cannot be an empty string.');

        $client = new ExpertSenderClient();
        $service = $client->messages();

        $service->delete(341, ['api_key' => '<YOUR_API_KEY_HERE>', 'domain' => '']);
    }

    public function testCreateNewsletterThrowsExceptionWhenNoRecipientIsSet()
    {
        $this->expectException(\ExpertSenderFr\ExpertSenderApi\NoRecipientsException::class);

        $client = new ExpertSenderClient('<YOUR_API_KEY_HERE>', 'https://api2.esv2.com');
        $service = $client->messages();

        $message = new NewsletterCreationPayload('Test', 'Tester', 'test@example.org');
        $service->createNewsletter($message);
    }

    public function testCreateNewsletter()
    {
        $client = new ExpertSenderClient('<YOUR_API_KEY_HERE>', 'https://api2.esv2.com');
        $service = $client->messages();

        $message = new NewsletterCreationPayload('Test', 'Tester', 'test@example.org');
        $message->addSubscriberList(32);
        $message->setMessageContent('', 'test');

        $message->setDeliveryDate('2017-09-12', 'UTC');

        $messageId = $service->createNewsletter($message);

        $this->assertEquals('integer', gettype($messageId));
        $service->delete($messageId);
    }

    public function testPauseNewsletter()
    {
        $client = new ExpertSenderClient('<YOUR_API_KEY_HERE>', 'https://api2.esv2.com');
        $service = $client->messages();

        $message = new NewsletterCreationPayload('Test', 'Tester', 'test@example.org');
        $message->addSubscriberList(32);
        $message->setMessageContent('', 'test');

        $message->setDeliveryDate('2017-09-12', 'UTC');

        $messageId = $service->createNewsletter($message);
        $resultCode = $service->pause($messageId);

        $this->assertSame(0, $resultCode);
        $service->delete($messageId);
    }

    public function testGetNewsletter()
    {
        $client = new ExpertSenderClient('<YOUR_API_KEY_HERE>', 'https://api2.esv2.com');
        $service = $client->messages();

        $message = $service->get(351);

        $this->assertInstanceOf(Message::class, $message);
        $this->assertEquals(351, $message->getId());
    }
}
