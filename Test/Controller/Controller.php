<?php

namespace Controller;

use Model\Category;
use Model\Product;

class Controller
{
    private $category;
    private $product;

    public function __construct(Category $category, Product $product)
    {
        $this->category = $category;
        $this->product = $product;
    }

    public function execute()
    {
        $response = null;
        if (isset($_GET['product_id'])) {
            $response = $this->product->getProductById($_GET['product_id']);
        } elseif (isset($_GET['category_id'])) {
            $category_id = $_GET['category_id'] ?? 'all';
            $sort_option = $_GET['sort_option'] ?? 'default';
            $response = $this->getProducts($category_id, $sort_option);
        } elseif (isset($_GET['getCategories'])) {
            $response = $this->category->getCategoriesWithProductCount();
        }

        echo json_encode($response);
    }

    private function getProducts($categoryId, $sort_option)
    {
        $sort_option = $this->product->getOrderByClause($sort_option);
        if ($categoryId == 'all') {
            return $this->product->getAllProducts($sort_option);
        }
        return $this->product->getProductsByCategoryId($categoryId, $sort_option);
    }
}
