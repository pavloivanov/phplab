<?php
require_once 'functions.php';

mysqlConnect('root', 'toortoor', 'todo');

session_start();

$action = 'signin';

if (isset($_SESSION['logged'])) {
    $action = 'logged';
    if (isset($_REQUEST['action']) && is_string($_REQUEST['action'])) {
        $action = $_REQUEST['action'];
    }
} elseif (isset($_REQUEST['action']) && ($_REQUEST['action'] === 'logged' || $_REQUEST['action'] === 'registration')) {
    $action = $_REQUEST['action'];
}


$errorMessages = array();
switch ($action) {
    case 'signin':
        if (isset($_REQUEST['execute'])) {
            if (isValidAuthData($_REQUEST['username'], $_REQUEST['password'])) {
                $_SESSION['logged'] = array('username' => $_REQUEST['username'], 'password' => $_REQUEST['password']);
                header("Location: index.php");
                exit();
            }
            $errorMessages['errorAuthorization'] = "Не вірно вірно вказане ім'я або пароль";
        }
        $header = 'Вхід';
        $args = array('errorMessages' => $errorMessages);
        $body = renderTemplate('login.php', $args);
        $footer = '<a href="index.php?action=registration" class="footer_link">Реєстрація</a>';
        break;
    case 'logout':
        logout();
        header("Location: index.php");
        exit();
    case 'registration':
        if (isset($_REQUEST['execute'])) {
            $errorMessages = validateRegistrationForm($_REQUEST['username'], $_REQUEST['email'], $_REQUEST['password']);
            if (empty($errorMessages)) {
                registerUser($_REQUEST['username'], $_REQUEST['email'], $_REQUEST['password']);
                $_SESSION['logged'] = array('username' => $_REQUEST['username'], 'password' => $_REQUEST['password']);
                header("Location: index.php");
                exit();
            }
        }
        $header = 'Реєстрація';
        $args = array('errorMessages' => $errorMessages);
        $body = renderTemplate('registration.php', $args);
        $footer = '<a href="index.php?action=signin" class="footer_link">Вхід</a>';
        break;
    case 'logged':
        $todoList = readTasks($_SESSION['logged']['username']);
        $header = $_SESSION['logged']['username'];
        $args = array('todoList' => $todoList);
        $body = renderTemplate('todoList.php', $args);
        $footer = '<a href="index.php?action=logout" class="footer_link">Вихід</a>';
        break;
    case 'addTask':
        if (isset($_REQUEST['task'])) {
            addTask($_SESSION['logged']['username'], $_REQUEST['task']);
            header('location: index.php');
            exit();
        }
        $header = 'Нове завдання';
        $body = renderTemplate('addTask.php');
        $footer = '<a href="index.php" class="footer_link">Назад</a>';
        break;
    case 'changeStatus':
        changeStatus($_REQUEST['check']);
        header("Location: index.php");
        exit();
    default:
        header("Location: index.php");
        exit();
}


$content = array('header' => $header, 'body' => $body, 'footer' => $footer);

$layout = renderTemplate('layout.php', $content);

echo $layout;