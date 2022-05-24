<?php

declare(strict_types=1);
//prevPass, newPass, newPassConfirm
session_start();
require_once(__DIR__ . '/../database/connection.db.php');

$db = getDatabaseConnection();
$prevpass = $_POST['prevPass'];
$newPass = $_POST['newPass'];
$newPassConfirm = $_POST['newPassConfirm'];

$stmt = $db->prepare('Select password from user where idUser = ?');
$stmt->execute(array($_SESSION['id']));
$result = $stmt->fetchAll();
$dbpass = $result[0]['password'];
if (!password_verify($prevpass, $dbpass)) {
    header('Location: http://localhost:9000/pages/update_password.php?successprev=false');
} else {
    if ($newPass != $newPassConfirm) {
        header('Location: http://localhost:9000/pages/update_password.php?successmatch=false');
    } else {
        $stmt = $db->prepare('Update User SET password = ? WHERE idUser = ?');
        $stmt->execute(array(password_hash($newPass, PASSWORD_DEFAULT), $_SESSION['id']));
        header('Location: http://localhost:9000/pages/index.php');
    }
}

//   $stmt = $db->prepare('Update User SET password = ? WHERE idUser = ?');
//   $stmt -> execute(array(password_hash($newPass, PASSWORD_DEFAULT)));
//   header('Location: http://localhost:9000/pages/index.php');
