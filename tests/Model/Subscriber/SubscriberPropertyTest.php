<?php

namespace ExpertSenderFr\ExpertSenderApi\Tests\Model\Subscriber;

use ExpertSenderFr\ExpertSenderApi\Model\Subscriber\PropertyType;
use ExpertSenderFr\ExpertSenderApi\Model\Subscriber\SubscriberProperty;
use PHPUnit\Framework\TestCase;

class SubscriberPropertyTest extends TestCase
{
    /** @var SubscriberProperty $property */
    protected $property;

    public function setUpTest()
    {
        $this->property = new SubscriberProperty(1, new PropertyType(PropertyType::DATE), '2016-08-30');
    }

    /**
     * @test
     */
    public function canCreateInstance()
    {
        $this->setUpTest();

        $this->canGetTheId();
        $this->canGetTheType();
        $this->canGetTheValue();
    }

    public function canGetTheId()
    {
        self::assertSame(1, $this->property->id());
    }

    public function canGetTheType()
    {
        self::assertInstanceOf(PropertyType::class, $this->property->type());
    }

    public function canGetTheValue()
    {
        self::assertEquals('2016-08-30', $this->property->value());
    }
}
