<?php
session_start();
require_once __DIR__ . '/Session11.php';
require_once __DIR__ . '/DB.php';

$error = null;

$db = DB::pdo();
$session = new Session11();

if (!isset($_POST['login2'])) {
    $error = 'Введите "логин"!';
} else {
    $login = $_POST['login2'];

    $sql = 'SELECT * FROM clients WHERE login = :login';
    $sth = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $sth->execute(array(':login' => $login));
    $clientData = $sth->fetchObject();

    if ($clientData != null) {
        $error = 'Клиент с таким "логином" уже зарегистрирован!';
    } else {
        $session->set('login', $login);

        if (!isset($_POST['pass2']) || !isset($_POST['pass3']) || ($_POST['pass2']) !== $_POST['pass3']) {
            $error = 'Необходимо ввести и повторить "пароль" ';
        } else {
            $pass2 = $_POST['pass2'];

            if ($_POST['surname2'] == null || $_POST['name2'] == null) {
                $error = 'Необходимо внести и фамилию и имя!';
            } else {
                $clientName2 = $_POST['surname2'] . ' ' . $_POST['name2'];
                $salt2 = $session->generateSalt();
                $passHash2 = md5($pass2 . $salt2);

                if ($clientName2 != ' ' && $login != null && $pass2 != null) {
                    $sql2 = 'INSERT INTO clients (Name, Login, PasswordHash, PasswordSalt) VALUES (:name, :login, :passHash, :salt)';
                    $sth2 = $db->prepare($sql2, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth2->execute(array(':name' => $clientName2, ':login' => $login, ':passHash' => $passHash2, ':salt' => $salt2));
                    header('Location:/Task11/home11.php');
                    exit();
                }
            }
        }
    }
}
//
?>
<html>
<body>
<?php
if ( isset($_POST['OK3']) ){?>
    <p style="color:red;"><?= $error;?></p>
<?php }
?>
<form method="post" action="/Task11/index111.php">
    <H2>Добро пожаловать на страницу регистрации на нашем сайте!</H2>
    <img src="https://avatarfiles.alphacoders.com/119/thumb-119518.jpg"><br/>
    <p><b>Пожалуйста, заполните эту форму: </b></p>
    <p>Введите "логин" <input type="text" name="login2"></p>
    <p>Введите "пароль" <input type="password" name="pass2"></p>
    <p>Повторите "пароль" <input type="password" name="pass3"></p>
    <p>Введите вашу фамилию <input type="text" name="surname2"></p>
    <p>Введите ваше имя <input type="text" name="name2"></p>
    <p>Если вы заполнили все поля формы, нажмите эту кнопку <input type="submit" name ="OK3" value="ВВОД"></p>
</form>
</body>
</html>