<?php
header('Content-Type: text/html; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    print("hi");
    if (!empty($_GET['save'])) {
        print('Спасибо, результаты сохранены.');
    }
    include('form.php');
    exit();
}

$errors = FALSE;
if (empty($_POST['fio'])) {
    print('Заполните имя.<br/>');
    $errors = TRUE;
}

if (empty($_POST['email'])) {
    print('Заполните email.<br/>');
    $errors = TRUE;
} else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    print('Email введен некорректно.<br/>');
    $errors = TRUE;
}

if ($errors) {
    exit();
}




$user = 'u41819';
$pass = '5909620';
$db = new PDO('mysql:host=localhost;dbname=study', $user, $pass, array(PDO::ATTR_PERSISTENT => true));
try {
    $stmt = $db->prepare("INSERT INTO users (name, year, sex, email) VALUES (:name, :year, :sex, :email)");
    $stmt->bindParam(':name', $_POST['fio']);
    $stmt->bindParam(':year', $_POST['year']);
    $stmt->bindParam(':sex', $_POST['sex']);
    $stmt->bindParam(':email', $_POST['email']);
    $stmt->execute();
} catch(PDOException $e) {
    print('Error : ' . $e->getMessage());
    exit();
}
$stmt = $db->prepare("INSERT INTO users (name, year, sex, email) VALUES (:name, :year, :sex, :email)");
$stmt->bindParam(':name', $_POST['fio']);
$stmt->bindParam(':year', $_POST['year']);
$stmt->bindParam(':sex', $_POST['sex']);
$stmt->bindParam(':email', $_POST['email']);
$stmt->execute();

print_r($_POST);
?>
