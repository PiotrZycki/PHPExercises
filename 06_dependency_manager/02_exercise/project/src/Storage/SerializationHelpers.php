<?php

namespace Storage;

use Concept\Distinguishable;
use Webmozart\Assert\Assert;

trait SerializationHelpers
{
    public static function deserializeAsDistinguishable(string $contents): Distinguishable
    {
        $object = unserialize($contents);
        Assert::isInstanceOf($object, 'Concept\Distinguishable', "Deserialized object is not a " . Distinguishable::class . "!");
        /*if (!$object instanceof Distinguishable) {
            exit("Deserialized object is not a " . Distinguishable::class . "!");
        }*/
        return $object;
    }

    /**
     * @param string[] $contentsArray
     * @return Distinguishable[]
     */
    public static function deserializeAsDistinguishableArray(array $contentsArray): array
    {
        $result = [];

        foreach ($contentsArray as $contents) {
            $result[] = self::deserializeAsDistinguishable($contents);
        }

        return $result;
    }
}
