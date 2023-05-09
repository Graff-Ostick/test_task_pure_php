<?php
$sortOptions = array(
    'price_asc' => 'Price: Low to High',
    'name_asc' => 'Alphabetical',
    'date_desc' => 'Date Added: New to Old'
);
?>
<!DOCTYPE html>
<html>
<head>
    <title>List of Categories and Products</title>
    <link rel="stylesheet" href="view/frontend/css/styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="categories">
        <h2>Categories:</h2>
        <ul id="category-list">
            <li>Loading categories...</li>
        </ul>
        <h2>Sorting:</h2>
        <select id="sort-select">
            <?php foreach ($sortOptions as $value => $label): ?>
                <option value="<?php echo $value; ?>"><?php echo $label; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="products">
        <h2>Products:</h2>
        <table id="products-table">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Date Added</th>
                <th>Category</th>
                <th>Buy</th>
            </tr>
        </table>
    </div>
</div>

<div class="modal fade" id="product-modal" tabindex="-1" role="dialog" aria-labelledby="product-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="product-modal-label">Product Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="product-details">
                    <p><strong>Product ID:</strong> <span id="product-id"></span></p>
                    <p><strong>Product Name:</strong> <span id="product-name"></span></p>
                    <p><strong>Price:</strong> <span id="product-price"></span></p>
                    <p><strong>Date Added:</strong> <span id="product-date"></span></p>
                    <p><strong>Category Name:</strong> <span id="product-category"></span></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="view/frontend/js/product_table.js"></script>
<script src="view/frontend/js/category_list.js"></script>
<script src="view/frontend/js/modal.js"></script>

</body>
</html>
