<?php

namespace Model;

class Category
{
    private $connect;

    public function __construct(Connect $connect)
    {
        $this->connect = $connect;
    }

    public function getCategoriesWithProductCount()
    {
        $query = "SELECT c.category_id, c.category_name, COUNT(p.product_id) AS product_count
                  FROM categories c
                  LEFT JOIN products p ON c.category_id = p.category_id
                  GROUP BY c.category_id, c.category_name";

        return $this->connect->executeQuery($query);
    }
}
