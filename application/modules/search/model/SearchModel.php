<?php
namespace modules\search\model;


class SearchModel
{
    private $query = '';
    public function __construct($query)
    {
        $this->query = $query;
    }
    public function search()
    {

    }

} 