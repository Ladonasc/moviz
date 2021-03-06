<?php

namespace App\Representation;

use Pagerfanta\Pagerfanta;
use JMS\Serializer\Annotation\Type;

class Persons extends AbstractRepresentation
{
    /**
     * @Type("array<App\Entity\Person>")
     *
     * @var App\Entity\Person[]
     */
    public $data;
}
