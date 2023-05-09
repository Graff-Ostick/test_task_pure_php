<?php

$start_time = microtime(true);

$pdo = new PDO('mysql:host=localhost;dbname=testtwo', 'root', 'password');

$stmt = $pdo->query('SELECT * FROM categories ORDER BY parent_id, categories_id');

function buildTree(array $elements, $parentId = 0) {
    $branch = array();

    foreach ($elements as $element) {
        if ($element['parent_id'] == $parentId) {
            $children = buildTree($elements, $element['categories_id']);
            if ($children) {
                $element['children'] = $children;
            }
            $branch[$element['categories_id']] = $element;
            unset($elements[$element['categories_id']]);
        }
    }

    return $branch;
}

$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

$tree = buildTree($categories);

$end_time = microtime(true);
echo "Execution time: " . ($end_time - $start_time) . " seconds\n";
echo "Peak memory usage: " . memory_get_peak_usage(true) . " bytes";
//print_r($tree);
