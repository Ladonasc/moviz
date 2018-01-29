<?php

namespace App\Helpers\QueryParams;

class CategoryParams
{

    /**
     * @var string
     */
    private $query;

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
}
