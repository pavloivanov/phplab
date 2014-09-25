<?php
$username = (isset($_POST['username'])) ? $_POST['username'] : '';
$email = (isset($_POST['email'])) ? $_POST['email'] : '';
?>

<form action="index.php" method="POST" class="main_form">
    <div class="authorization">
        <?php if (isset($errorMessages['errorUsername'])) echo '<span class="error_authorization">'.$errorMessages['errorUsername'].'<br/></span>'; ?>
        Логін <input type="text" name="username" value="<?= htmlspecialchars($username) ?>"><br/><br/>
        <?php if (isset($errorMessages['errorEmail'])) echo '<span class="error_authorization">'.$errorMessages['errorEmail'].'<br/></span>'; ?>
        eMail <input type="text" name="email" value="<?= htmlspecialchars($email) ?>"><br/><br/>
        <?php if (isset($errorMessages['errorPassword'])) echo '<span class="error_authorization">'.$errorMessages['errorPassword'].'<br/></span>'; ?>
        Пароль <input type="password" name="password"><br/><br/>
        Повторити пароль <input type="password" name="confirmPasword"><br/><br/>
        <input type="hidden" name="execute" value="registration">
    </div>
    <div class="button">
        <input type="submit" value="Зареєструватись">
    </div>
</form>