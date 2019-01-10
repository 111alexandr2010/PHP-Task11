<?php
session_start();
require_once __DIR__ . '/Session11.php';
require_once __DIR__ . '/DB.php';

$db = DB::pdo();
$session = new Session11();
$login = $session->get('login');

$textQuery = 'SELECT visitTime, a.name animalName, nameRussian, d.name doctorName, paidAmount, comment   
          FROM visits v  INNER JOIN animals a  ON animalID = a.id  INNER JOIN doctors d  ON v.doctorId = d.id     
          INNER JOIN species s  ON a.species = s.id  INNER JOIN clients c  ON a.clientId = c.id  WHERE login = ';

$sql = $textQuery.':login ORDER BY visitTime DESC';

if ($_GET['visitDate']) {
    if($_SESSION['visitDate']) {
        $sql = $textQuery . ':login ORDER BY visitTime';
        $_SESSION['visitDate'] = false;
    } else {
        $sql = $textQuery . ':login ORDER BY visitTime DESC';
        $_SESSION['visitDate'] = true;
    }
}

if ($_GET['name']){
    if($_SESSION['name'] == 0 ) {
        $sql = $textQuery . ':login ORDER BY a.name';
        $_SESSION['name']++;
    } elseif($arrayOrder[1] == 1) {
        $sql = $textQuery . ':login ORDER BY a.name DESC';
        $_SESSION['name']++;
    } else {
        $sql = $textQuery . ':login ORDER BY visitTime DESC';
        $_SESSION['name'] = 0;
    }
}

if ($_GET['species']){
    if($_SESSION['species'] == 0) {
        $sql = $textQuery . ':login ORDER BY nameRussian';
        $_SESSION['species']++;
    } elseif($_SESSION['species'] == 1) {
        $sql = $textQuery . ':login ORDER BY nameRussian DESC';
        $_SESSION['species']++;
    } else {
        $sql = $textQuery . ':login ORDER BY visitTime DESC';
        $_SESSION['species'] = 0;
    }
}

if ($_GET['doctor']){
    if($_SESSION['doctor'] == 0) {
        $sql = $textQuery . ':login ORDER BY d.name';
        $_SESSION['doctor']++;
    } elseif($_SESSION['doctor'] == 1) {
        $sql = $textQuery . ':login ORDER BY d.name DESC';
        $_SESSION['doctor']++;
    } else {
        $sql = $textQuery . ':login ORDER BY visitTime DESC';
        $_SESSION['doctor'] = 0;
    }
}

if ($_GET['paidAmount']){
    if($_SESSION['paidAmount'] == 0) {
        $sql = $textQuery . ':login ORDER BY paidAmount';
        $_SESSION['paidAmount']++;
    } elseif($_SESSION['paidAmount'] == 1) {
        $sql = $textQuery . ':login ORDER BY paidAmount DESC';
        $_SESSION['paidAmount']++;
    } else {
        $sql = $textQuery . ':login ORDER BY visitTime DESC';
        $_SESSION['paidAmount'] = 0;
    }
}

if ($_GET['comment']){
    if($_SESSION['comment'] == 0) {
        $sql = $textQuery . ':login ORDER BY comment';
        $_SESSION['comment']++;
    } elseif($_SESSION['comment'] == 1) {
        $sql = $textQuery . ':login ORDER BY comment DESC';
        $_SESSION['comment']++;
    } else {
        $sql = $textQuery . ':login ORDER BY visitTime DESC';
        $_SESSION['comment'] = 0;
    }
}

$sth = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

$sth->execute(array(':login' => $login));
$queryData = $sth->fetchAll(PDO::FETCH_ASSOC);

if ($queryData == null) {
    $message = "В истории ваших визитов пока нет записей.";
} else {
    $message = "Напоминаем о ваших визитах в клинику: ";
}
createTable($queryData, $message);
exit();

function createTable($array, $message)
{
?>
<html>
<body>
<H2><b>Добро пожаловать на сайт нашей ветеринарной клиники!</b></H2>
<img src="https://avatars.mds.yandex.net/get-pdb/69339/90bbf42c-9857-4ba2-8b4d-cb9011ee8024/s800"><br/>
<p style="color:darkgreen;"><?= $message; ?></p>
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
