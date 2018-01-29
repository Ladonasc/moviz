<?php

namespace App\Helpers\QueryParams;
use Symfony\Component\Validator\Constraints as Assert;

class PersonParams
{

    /**
     * @var string
     */
    const TYPE_ACTOR = 'actor';

    /**
     * @var string
     */
    const TYPE_DIRECTOR = 'director';

    /**
     * @var string
     */
    private $query;

    /**
     * If empty : no limitation (both actor or director)
     *
     * @var string
     *
     * @Assert\Choice(callback="getAllowedTypes")
     */
    private $type;

    /**
     * @var integer
     *
     * @Assert\Regex("/^\d+$/")
     */
    private $limit = 20;

    /**
     * @var integer
     *
     * @Assert\Regex("/^\d+$/")
     */
    private $offset = 0;

    /**
     * @return string
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * @param string $query
     *
     * @return self
     */
    public function setQuery($query)
    {
        $this->query = trim($query);

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return self
     */
    public function setType($type)
    {
        $this->type = trim($type);

        return $this;
    }

    public function getAllowedTypes()
    {
        return [self::TYPE_ACTOR, self::TYPE_DIRECTOR];
    }

    /**
     * @return integer
     */
    public function getLimit()
    {
        return (int) $this->limit;
    }

    /**
     * @param integer $limit
     *
     * @return self
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;

        return $this;
    }

    /**
     * @return integer
     */
    public function getOffset()
    {
        return (int) $this->offset;
    }

    /**
     * @param integer $offset
     *
     * @return self
     */
    public function setOffset($offset)
    {
        $this->offset = $offset;

        return $this;
    }
}
