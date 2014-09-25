<div class="clearfix"></div>
<div class="admin_table">
    <h2><a href="/hw/webshop/admin/product/add">Добавити нову позицію</a></h2>
    <?php foreach ($products as $product): ?>
        <div class="admin_row_1">
            <div class="admin_column_1"><?= $product->getId() ?></div>
            <div class="admin_column_2"><?= htmlspecialchars($product->getName()) ?></div>
            <div class="admin_column_3"><?= htmlspecialchars($product->getDate()) ?><br></div>
            <div class="admin_column_4">
                <form class="admin_options" action="index.php" method="GET">
                    <input type="hidden" name="category" value="<?= $product->getCategoryId() ?>">
                    <input type="hidden" name="controller" value="products">
                    <input type="hidden" name="id" value="<?= $product->getId() ?>">
                    <input type="hidden" name="action" value="showForm">
                    <input class="option_button" type="submit" value="Редагувати">
                </form>
            </div>
        </div>
    <? endforeach; ?>
</div>