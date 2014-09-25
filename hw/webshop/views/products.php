<table align="center" border="1" cellpadding="10">
    <tr align="center">
        <td colspan="2"><h1><?= $category->getName() ?></h1></td>
    </tr>
    <?php foreach($products as $product): ?>
        <tr align="center">
            <td>
                <a href="/hw/webshop/product/<?= $product->translitUa($product->getName()) . '_' . $product->getId() ?>">
                    <?= $product->getName(); ?>
                </a>
            </td>
            <td> <?= $product->getPrice(); ?> </td>
        </tr>
    <?php endforeach; ?>
    <tr align="center">
        <td colspan="2"><a href="/hw/webshop/">Main page</a></td>
    </tr>
</table>
