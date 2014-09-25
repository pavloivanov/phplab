<table align="center" border="1" cellpadding="10">
    <tr>
        <th>Category name</th>
        <th>Quantity products</th>
    </tr>
    <?php foreach($categories as $category): ?>
        <tr align="center">
            <td>
                <a href="category/<?= $category->translitUa($category->getName()) . '_' . $category->getId() ?>">
                    <?= $category->getName(); ?>
                </a>
            </td>
            <td> <?= $category->getQuantity(); ?> </td>
        </tr>
    <?php endforeach; ?>
</table>
