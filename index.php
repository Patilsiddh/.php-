<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories and Products</title>
    <link rel="stylesheet" href="styles.css">
    <style>.container {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
}

h1 {
  text-align: center;
  margin-bottom: 20px;
}

.category {
  margin-bottom: 20px;
}

.category h2 {
  margin-bottom: 10px;
}

ul {
  list-style: none;
  padding: 0;
}

ul li {
  margin-bottom: 5px;
}

/* Optional: Add some spacing between categories and products */
.category + .category {
  border-top: 1px solid #ccc;
  padding-top: 20px;
}
</style>
</head>
<body>
    <div class="container">
        <h1>Categories and Products</h1>
        <div id="categories-container"></div>
    </div>
    <script>
       document.addEventListener('DOMContentLoaded', function() {
            const categoriesContainer = document.getElementById('categories-container');

            // Fetch data from sp.php
            fetch('onlycat.php')
                .then(response => response.json())
                .then(data => {
                    // Render categories
                    data.categories.forEach(category => {
                        const categoryDiv = document.createElement('div');
                        categoryDiv.className = 'category';
                        categoryDiv.innerHTML = `<h2>${category.name}</h2>`;
                        
                        const productsList = document.createElement('ul');
                        // Filter products belonging to this category
                        const categoryProducts = data.products.filter(product => product.category_id === category.id);
                        categoryProducts.forEach(product => {
                            const productItem = document.createElement('li');
                            productItem.textContent = product.name;
                            productsList.appendChild(productItem);
                        });

                        categoryDiv.appendChild(productsList);
                        categoriesContainer.appendChild(categoryDiv);
                    });
                })
                .catch(error => console.error('Error fetching data:', error));
        });

    </script>
</body>
</html>
