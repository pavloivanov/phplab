<form action="index.php" method="POST" class="main_form">
    <div class="authorization">
        <?php if (isset($errorMessages['errorAuthorization'])) echo '<span class="error_authorization">'.$errorMessages['errorAuthorization'].'</span><br/>'; ?>
        Логін <input type="text" name="username" class="npt"><br/><br/>
        Пароль <input type="password" name="password"><br/><br/>
        <input type="hidden" name="execute" value="signin">
    </div>
    <div class="button">
        <input type="submit" value="Ввійти">
    </div>
</form>