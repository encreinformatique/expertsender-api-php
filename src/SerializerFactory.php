<?php

namespace ExpertSenderFr\ExpertSenderApi;

use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class SerializerFactory
{
    public static function createXmlSerializer()
    {
        $encoders = [new XmlEncoder([XmlEncoder::ROOT_NODE_NAME => 'ApiRequest'])];
        $normalizers = [new ObjectNormalizer()];

        return new Serializer($normalizers, $encoders);
    }
}
