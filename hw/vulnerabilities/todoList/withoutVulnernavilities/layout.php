<!DOCTYPE html>
<html>

    <head>
        <title><?= htmlspecialchars($header) ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css" />
    </head>

    <body>

        <div class="container">

            <div class="head">
                <?= htmlspecialchars($header) ?>
            </div>

            <div class="content">
                <?= $body ?>
            </div>

            <div class="footer">
                <?= $footer ?>
            </div>

        </div>

    </body>

</html>