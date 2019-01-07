<?php

session_start();
require_once __DIR__ . '/Session11.php';
require_once __DIR__ . '/DB.php';

$error = null;

$db = DB::pdo();
$session = new Session11();

if (isset($_POST['login'])) {
    $login = $_POST['login'];

    $session->set('login', $login);

    $sql = 'SELECT * FROM clients WHERE login = :login';
    $sth = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $sth->execute(array(':login' => $login));
    $clientData = $sth->fetchObject();

    if ($clientData == null) {
        $error = 'Не правильно ввели "логин"!';
    } else {
        $id = $clientData->ID;
        $passwordHash = $clientData->PasswordHash;
        $salt = $clientData->PasswordSalt;

        if (!isset($_POST['pass'])) {
            $error = 'Введите "пароль"!';
            session_destroy();
        } else {
            $pass = $_POST['pass'];
            $session->set('pass', $pass);
            $session->set('salt', $salt);
            $session->set('id', $id);

            if (($session->checkPass($passwordHash, $pass, $salt)) === true) {
                header('Location:/Task11/home11.php');
                exit();
            } else {
                $error = 'Не правильно ввели "пароль"!';
                //session_destroy();
            }
        }
    }
}


if (isset($_SESSION['login']) && isset($_SESSION['pass'])) {
    $login = $session->get('login');
    $pass = $session->get('pass');
    $salt = $session->get('salt');

    if ($session->checkPass($login, $pass, $salt) === true) {
        header('Location:/Task11/home11.php');
        exit();
    }
}
?>
<html>
<body>
<p style="color:red;"><?= $error; ?></p>

<form method="post" action="/Task11/index11.php">
    <p>Введите "логин" <input type="text" name="login"></p>
    <p>Введите "пароль" <input type="password" name="pass"></p>
    <p><input type="submit" value="OK"></p>
</form>
</body>
</html>