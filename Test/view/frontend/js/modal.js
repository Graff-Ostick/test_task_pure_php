$(document).ready(function () {
    const $productsTable = $('#products-table');
    const $productModal = $('#product-modal');
    const $productId = $('#product-id');
    const $productName = $('#product-name');
    const $productPrice = $('#product-price');
    const $productDate = $('#product-date');
    const $productCategory = $('#product-category');

    $productsTable.on('click', '.buy-button', function () {
        const productId = $(this).data('product-id');
        getProductDetails(productId);
    });

    function getProductDetails(productId) {
        $.ajax({
            url: 'ajax-handler.php',
            method: 'GET',
            data: {
                product_id: productId
            },
            success: function (response) {
                const product = JSON.parse(response)[0];
                displayProductDetails(product);
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    function displayProductDetails(product) {
        $productId.text(product.product_id);
        $productName.text(product.product_name);
        $productPrice.text(product.price);
        $productDate.text(product.date_added);
        $productCategory.text(product.category_name);
        $productModal.modal('show');
    }
});

