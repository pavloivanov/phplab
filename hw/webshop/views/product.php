<table align="center" border="1" cellpadding="10">
    <tr align="center">
        <td colspan="2">
            <h1>
                <a href="/hw/webshop/category/<?= $category->translitUa($category->getName()) . '_' . $category->getId() ?>">
                    <?= $category->getName(); ?>
                </a>
            </h1>
        </td>
    </tr>
    <tr>
        <td><?= $product->getName() ?></td>
    </tr>
    <tr>
        <td><?= $product->getPrice() ?></td>
    </tr>
    <tr>
        <td><?= $product->getDescription() ?></td>
    </tr>
    <tr>
        <td><?= $product->getDate() ?></td>
    </tr>

    <tr align="center">
        <td colspan="2"><a href="/hw/webshop/">Main page</a></td>
    </tr>
</table>
