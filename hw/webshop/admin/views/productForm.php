<h1>Добавити нову позицію</h1>

<form action="index.php" enctype="multipart/form-data" method="POST">

    Назва товару<br>
    <input class="admin_title" type="text" name="name" value="<?= $product->getName() ?>"><br>
    Опис:<br>
    <textarea class="admin_text" name="description"><?= $product->getDescription() ?></textarea><br>
    Ціна<br>
    <input type="text" name="price" value="<?= $product->getPrice() ?>"><br>
    <input type="hidden" name="categoryId" value="<?= $product->getCategoryId() ?>">
    <input type="hidden" name="controller" value="products">
    <input type="hidden" name="action" value="add">
    <input type="submit" value="ОК">

    <? if ($product->getId()): ?>
        <input type="hidden" name="id" value="<?= $product->getId() ?>">
    <? endif; ?>

</form>