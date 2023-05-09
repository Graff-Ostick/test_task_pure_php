document.addEventListener('DOMContentLoaded', function() {
    let cachedCategoryList = localStorage.getItem('categoryList');

    if (cachedCategoryList) {
        displayCategoryList(JSON.parse(cachedCategoryList));
    } else {
        let xhr = new XMLHttpRequest();
        xhr.open('GET', 'ajax-handler.php?getCategories', true);
        xhr.onload = function() {
            if (this.status >= 200 && this.status < 400) {
                let categoryList = JSON.parse(this.response);
                localStorage.setItem('categoryList', JSON.stringify(categoryList));
                displayCategoryList(categoryList);
            } else {
                console.log('Error: ' + this.status);
            }
        };
        xhr.onerror = function() {
            console.log('Error: ' + this.status);
        };
        xhr.send();
    }

    function displayCategoryList(categoryList) {
        let categoryListElement = document.querySelector('#category-list');
        categoryListElement.innerHTML = '';

        categoryList.forEach(function(category) {
            let categoryId = category.category_id;
            let categoryName = category.category_name;
            let productCount = category.product_count;

            let categoryListItem = document.createElement('li');
            categoryListItem.dataset.categoryId = categoryId;
            categoryListItem.textContent = categoryName + ' (' + productCount + ' products)';
            categoryListElement.appendChild(categoryListItem);
        });
    }
});
