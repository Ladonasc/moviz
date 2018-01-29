<?php

namespace App\Representation;

use Pagerfanta\Pagerfanta;
use JMS\Serializer\Annotation\Type;

class Languages extends AbstractRepresentation
{
    /**
     * @Type("array<App\Entity\Language>")
     *
     * @var App\Entity\Language[]
     */
    public $data;
}
