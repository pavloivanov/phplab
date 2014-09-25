<?php
function mysqlConnect($username, $password, $dbName, $host='localhost') {
    mysql_connect($host, $username, $password)
        or die("Could not connect: ".mysql_error());
    mysql_select_db($dbName)
        or die("Could not select database: ".mysql_error());

    return true;
}

function logout() {
    $_SESSION = array();
    unset($_COOKIE[session_name()]);
    session_destroy();
}

function usernameExists($username) {
    $result = mysql_query("SELECT * FROM users WHERE username = '$username'");
    $data = mysql_fetch_assoc($result);

    return ($data === TRUE);
}


function isValidEmail($email) {
    return (boolean) filter_var($email, FILTER_VALIDATE_EMAIL);
}

function isValidUsername($username) {
    return (strlen($username) > 2 && strlen($username) < 20);
}

function isValidPassword($password, $confirmPassword) {
    return ($password === $confirmPassword) && (strlen($password) > 2 && strlen($password) < 20);
}

function validateRegistrationForm($username, $email, $password) {
    $errorMessages = array();
    if (usernameExists($username) || !isValidUsername($username)) {
        $errorMessages['errorUsername'] = "Не правильно введене ім'я користувача";
    }
    if (!isValidEmail($email)) {
        $errorMessages['errorEmail'] = "Не правильно ведений eMail";
    }
    if (! isValidPassword($password, $password)) {
        $errorMessages['errorPassword'] = "Не правильно введений пароль";
    }

    return $errorMessages;
}


function registerUser($username, $email, $password) {
    $result = mysql_query("INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')");

    return $result;
}

function isValidAuthData($username, $password) {
    $result = mysql_query("SELECT * FROM users WHERE username = '$username' AND password = '$password'");
    $data = mysql_fetch_assoc($result);

    return ($data !== FALSE);
}


function addTask($task, $username) {
    $result = mysql_query("INSERT INTO tasks SET task = '$task', username = '$username'");

    return $result;
}


function readTasks($username) {
    $result = mysql_query("SELECT * FROM tasks WHERE username = '$username' ORDER BY status ASC, id ASC");
    for ($tasks = array(); $task = mysql_fetch_assoc($result); $tasks[] = $task);

    return $tasks;
}


function changeStatus($id) {
    $result = mysql_query("SELECT status FROM tasks WHERE id = '$id'");
    $data = mysql_fetch_assoc($result);
    if ($data['status'] === '0') {
        $new_status = '1';
    } elseif ($data['status'] === '1') {
        $new_status = '0';
    }
    $result = mysql_query("UPDATE tasks SET status='$new_status' WHERE id = '$id'");

    return $result;
}


function renderTemplate($template, $args=array()) {
    extract($args);
    ob_start();
    include $template;
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}

?>