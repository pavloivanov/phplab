<?php
require_once('dbManager.php');
require_once('dbFunctions.php');

dbConnect();

if (isset($_GET['category'])) {
    $productList = getProducts($_GET['category']);
    $listHtml = '<tr><th>Product name</th><th>Price</th></tr>';
    foreach ($productList as $product) {
        $listHtml .=
            '<tr align="center">' .
                '<td>' . $product['name'] . '</td>' .
                '<td>' . $product['price'] . '</td>' .
            '</tr>';
    }
} else {
    $categoriesList = getAllCategories();
    $listHtml = '<tr><th>Category name</th><th>Quantity products</th></tr>';
    foreach ($categoriesList as $category) {
        $listHtml .=
            '<tr align="center">' .
                '<td><a href="list.php?category=' . $category['categories_id'] . '">' . $category['name'] . '</a></td>' .
                '<td>' . $category['quantity'] . '</td>' .
            '</tr>';
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <table align="center" border="1" cellpadding="10">
            <?php echo $listHtml; ?>
        <tr align="center"><td colspan="2"><a href="list.php">Main page</a></td></tr>
    </table>
</body>
</html>