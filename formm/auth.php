<?php
$login = filter_var(trim($_POST['username']));
$password = filter_var(trim($_POST['password']));



$password = md5($password);

$mysql = new mysqli('localhost','root','','bd');
$result = $mysql->query("SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'");
$user = $result->fetch_assoc();
if (count ($user) == 0) {
    echo ('The user is not registered');
    exit();
}
else {
    echo ('Successful log in');
}

?>