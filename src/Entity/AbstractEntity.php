<?php

namespace App\Entity;

abstract class AbstractEntity
{
    public function hydrate(AbstractEntity $entity)
    {
        // Current & given entity should be instances of same class
        if (get_class($this) !== get_class($entity)) {
            throw new \InvalidArgumentException('Provided entity should be the same class of current entity');
        }

        $reflection = new \ReflectionClass($this);
        $privateProperties = $reflection->getProperties(\ReflectionProperty::IS_PRIVATE);

        // Base hydrate process on private properties
        foreach ($privateProperties as $property) {
            if ($property->getName() === 'id') {
                // Do not hydrate the 'id' property
                continue;
            }

            $name = $property->getName();
            $setter = 'set' . ucfirst($name);
            $getter = 'get' . ucfirst($name);

            // If current entity has the setter and provided entity has the getter : let's hydrate !
            if (method_exists($this, $setter) && method_exists($entity, $getter)) {
                $this->$setter($entity->$getter());
            }
        }
    }
}
