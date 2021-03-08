<?php

namespace ExpertSenderFr\ExpertSenderApi\Tests\Model\Subscriber;

use ExpertSenderFr\ExpertSenderApi\Model\Subscriber\AdditionMode;
use ExpertSenderFr\ExpertSenderApi\Model\Subscriber\AddSubscriberOptions;
use ExpertSenderFr\ExpertSenderApi\Model\Subscriber\MatchingMode;
use PHPUnit\Framework\TestCase;

class AddSubscriberOptionsTest extends TestCase
{
    /**
     * @test
     */
    public function canDisallowUnsubscribed()
    {
        $options = new AddSubscriberOptions(
            new AdditionMode(),
            new MatchingMode()
        );

        $options->disallowUnsubscribed();

        self::assertFalse($options->areUnsubscribedAllowed());
    }

    /**
     * @test
     */
    public function canDisallowRemoved()
    {
        $options = new AddSubscriberOptions(
            new AdditionMode(),
            new MatchingMode()
        );

        $options->disallowRemoved();

        self::assertFalse($options->areRemovedAllowed());
    }
}
