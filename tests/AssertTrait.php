<?php
/**
 * @package ExpertSenderFr\ExpertSenderApi\Tests
 * Auteur: Julien Devergnies <j.devergnies@tousleshoraires.fr>
 * Date: 8/3/21
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ExpertSenderFr\ExpertSenderApi\Tests;

trait AssertTrait
{
    public function getAttribute($object, string $attributeName)
    {
        $value = null;

        $reflector = new \ReflectionObject($object);
        try {
            $attribute = $reflector->getProperty($attributeName);

            if (!$attribute || $attribute->isPublic()) {
                return $object->$attributeName;
            }

            $attribute->setAccessible(true);
            $value = $attribute->getValue($object);
            $attribute->setAccessible(false);
        } catch (\ReflectionException $e) {
        }

        return $value;
    }
}
