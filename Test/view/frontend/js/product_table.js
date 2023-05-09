$(document).ready(function() {
    let $sortSelect = $('#sort-select');
    let $categoryList = $('#category-list');
    let $productsTable = $('#products-table');
    let lastCategoryId = 'all';
    let lastSortOption = localStorage.getItem('lastSortOption') || '';
    let urlParams = new URLSearchParams(window.location.search);

    if (lastSortOption) {
        $sortSelect.val(lastSortOption);
    }

    if (urlParams.has('category_id')) {
        lastCategoryId = urlParams.get('category_id');
    }

    if (urlParams.has('sort_option')) {
        lastSortOption = urlParams.get('sort_option');
        $sortSelect.val(lastSortOption);
    }

    let updateUrlParams = () => {
        let url = window.location.href.split('?')[0];
        if (lastCategoryId !== 'all') {
            url += `?category_id=${lastCategoryId}`;
        }
        if (lastSortOption) {
            url += (url.indexOf('?') === -1 ? '?' : '&') + `sort_option=${lastSortOption}`;
        }
        history.replaceState({}, '', url);
    };

    let updateProductsTable = (products) => {
        $productsTable.find('tr:gt(0)').remove();
        if (products.length > 0) {
            let rows = products.map(({ product_id, product_name, price, date_added, category_name }) =>
                `<tr>
                    <td>${product_id}</td>
                    <td>${product_name}</td>
                    <td>${price}</td>
                    <td>${date_added}</td>
                    <td>${category_name}</td>
                    <td><button class="buy-button" data-product-id="${product_id}" data-toggle="modal" data-target="#product-modal">Buy</button></td>
                </tr>`
            ).join('');
            $productsTable.append(rows);
        } else {
            let row = '<tr><td colspan="5">There are no products available</td></tr>';
            $productsTable.append(row);
        }
    };

    let getProducts = () => {
        $.ajax({
            url: 'ajax-handler.php',
            method: 'GET',
            data: {
                category_id: lastCategoryId,
                sort_option: lastSortOption,
            },
            success: (response) => {
                updateProductsTable(JSON.parse(response));
            },
            error: (xhr, status, error) => {
                console.error(xhr.responseText, status, "Error: ", error);
            },
        });
    };

    $categoryList.on('click', 'li', function() {
        let { categoryId } = $(this).data();
        lastCategoryId = categoryId;
        updateUrlParams();
        getProducts();
    });

    $sortSelect.on('change', () => {
        lastSortOption = $sortSelect.val();
        localStorage.setItem('lastSortOption', lastSortOption);
        updateUrlParams();
        getProducts();
    });

    getProducts();
});
