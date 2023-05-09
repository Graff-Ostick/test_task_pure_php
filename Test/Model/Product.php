<?php

namespace Model;

class Product
{
    private $connect;

    public function __construct(Connect $connect)
    {
        $this->connect = $connect;
    }

    public function getAllProducts($sortOption = null)
    {
        $query = "SELECT p.product_id, p.product_name, p.price, p.date_added, c.category_name
FROM products p
LEFT JOIN categories c ON p.category_id = c.category_id" . $sortOption;

        return $this->connect->executeQuery($query);
    }

    public function getProductsByCategoryId($categoryId, $sortOption = null)
    {
        $query = "SELECT p.product_id, p.product_name, p.price, p.date_added, c.category_name
FROM products p
LEFT JOIN categories c ON p.category_id = c.category_id
WHERE p.category_id = :category_id" . $sortOption;

        $params = [':category_id' => $categoryId];

        return $this->connect->executeQuery($query, $params);
    }

    public function getProductById($productId)
    {
        $query = "SELECT p.product_id, p.product_name, p.price, p.date_added, c.category_name
FROM products p
LEFT JOIN categories c ON p.category_id = c.category_id
WHERE p.product_id = :product_id" ;
        $params = [':product_id' => $productId];
        return $this->connect->executeQuery($query, $params);
    }

    public function getOrderByClause($sortOption)
    {
        return match ($sortOption) {
            'price_asc' => " ORDER BY p.price ASC",
            'price_desc' => " ORDER BY p.price DESC",
            'name_asc' => " ORDER BY p.product_name ASC",
            'name_desc' => " ORDER BY p.product_name DESC",
            'date_asc' => " ORDER BY p.date_added ASC",
            'date_desc' => " ORDER BY p.date_added DESC",
            default => "",
        };
    }
}
