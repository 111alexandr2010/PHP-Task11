<?php
session_start();
require_once __DIR__ . '/Session11.php';
require_once __DIR__ . '/DB.php';

$db = DB::pdo();
$session = new Session11();
$login = $session->get('login');

const WELCOME_QUERY = 'SELECT visitTime, a.name animalName, nameRussian, d.name doctorName, paidAmount, comment   
          FROM visits v  INNER JOIN animals a  ON animalID = a.id  INNER JOIN doctors d  ON v.doctorId = d.id     
          INNER JOIN species s  ON a.species = s.id  INNER JOIN clients c  ON a.clientId = c.id  WHERE login = ';

$sql_1 = WELCOME_QUERY.':login ORDER BY visitTime DESC';

$sth_1 = $db->prepare($sql_1, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$sth_1->execute(array(':login' => $login));
$queryData = $sth_1->fetchAll(PDO::FETCH_ASSOC);

$arrayOrder = array(1, 1, 1, 1, 1, 1);

if ($_GET['visitDate']) {
    $arrayOrder[0] = ++$_SESSION['visitDate'];

    if($arrayOrder[0] % 2 == 1) {
        $sql_1 = WELCOME_QUERY . ':login ORDER BY visitTime';
    } else {
        $sql_1 = WELCOME_QUERY . ':login ORDER BY visitTime DESC';
    }
}

if ($_GET['name']){
    $arrayOrder[1] = ++$_SESSION['name'];

    if($arrayOrder[1] % 3 == 1) {
        $sql_1 = WELCOME_QUERY . ':login ORDER BY a.name';
    } elseif($arrayOrder[1] % 3 == 2) {
        $sql_1 = WELCOME_QUERY . ':login ORDER BY a.name DESC';
    } else {
        $sql_1 = WELCOME_QUERY . ':login ORDER BY visitTime DESC';
        $arrayOrder[0] = 1;
    }
}

if ($_GET['species']){
    $arrayOrder[2] = ++$_SESSION['species'];

    if($arrayOrder[2] % 3 == 1) {
        $sql_1 = WELCOME_QUERY . ':login ORDER BY nameRussian';
    } elseif($arrayOrder[2] % 3 == 2) {
        $sql_1 = WELCOME_QUERY . ':login ORDER BY nameRussian DESC';
    } else {
        $sql_1 = WELCOME_QUERY . ':login ORDER BY visitTime DESC';
        $arrayOrder[0] = 1;
    }
}

if ($_GET['doctor']){
    $arrayOrder[3] = ++$_SESSION['doctor'];

    if($arrayOrder[3] % 3 == 1) {
        $sql_1 = WELCOME_QUERY . ':login ORDER BY d.name';
    } elseif($arrayOrder[3] % 3 == 2) {
        $sql_1 = WELCOME_QUERY . ':login ORDER BY d.name DESC';
    } else {
        $sql_1 = WELCOME_QUERY . ':login ORDER BY visitTime DESC';
        $arrayOrder[0] = 1;
    }
}

if ($_GET['paidAmount']){
    $arrayOrder[4] = ++$_SESSION['paidAmount'];

    if($arrayOrder[4] % 3 == 1) {
        $sql_1 = WELCOME_QUERY . ':login ORDER BY paidAmount';
    } elseif($arrayOrder[4] % 3 == 2) {
        $sql_1 = WELCOME_QUERY . ':login ORDER BY paidAmount DESC';
    } else {
        $sql_1 = WELCOME_QUERY . ':login ORDER BY visitTime DESC';
        $arrayOrder[0] = 1;
    }
}

if ($_GET['comment']){
    $arrayOrder[5] = ++$_SESSION['comment'];

    if($arrayOrder[5] % 3 == 1) {
        $sql_1 = WELCOME_QUERY . ':login ORDER BY comment';
    } elseif($arrayOrder[5] % 3 == 2) {
        $sql_1 = WELCOME_QUERY . ':login ORDER BY comment DESC';
    } else {
        $sql_1 = WELCOME_QUERY . ':login ORDER BY visitTime DESC';
        $arrayOrder[0] = 1;
    }
}

if (isset ($_POST['Logout'])) {
    session_destroy();
    header('Location: /Task11/index11.php');
    exit();
}

$sth_1 = $db->prepare($sql_1, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

$sth_1->execute(array(':login' => $login));
$queryData = $sth_1->fetchAll(PDO::FETCH_ASSOC);

createTable($queryData);
exit();

function createTable($array)
{
?>
<html>
<body>
<H2><b>Добро пожаловать на сайт нашей ветеринарной клиники!</b></H2>
<img src="https://avatars.mds.yandex.net/get-pdb/69339/90bbf42c-9857-4ba2-8b4d-cb9011ee8024/s800"><br/>
<p><b>Напоминаем о ваших визитах в нашу клинику:</b></p>
<form method="get" action="/Task11/home11.php">
    <table width="80%" border="1">
        <thead>
        <style type="text/css">
            TH {
                background: yellow;
                color: black;
            }

            TD {
                background: whitesmoke;
                color: grey;
            }
        </style>
        <tr>
            <th> <input type="submit" name="visitDate"
                        value="Дата и время визита"></th>
            <th><input type="submit" name="name"
                       value="Имя вашего питомца"></th>
            <th><input type="submit" name="species"
                       value="Вид животного"></th>
            <th><input type="submit" name="doctor"
                       value="Принимающий доктор"></th>
            <th><input type="submit" name="paidAmount"
                       value="Уплаченная сумма"></th>
            <th><input type="submit" name="comment"
                       value="Комментарий"></th>
        </tr>
        </thead>
        <?php
        foreach ($array as $itemArray) {
            echo '<tr>';
            foreach ($itemArray as $key => $value) {
                ?>
                <td><?= $value ?></td>
            <?php }
            echo '</tr>';
        }
        }
        ?>
    </table>
</form>
</body>
</html>