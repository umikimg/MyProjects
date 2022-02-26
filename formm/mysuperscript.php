<?php
 if(isset(filter_var(trim($_POST['usernamesignup']))) == 1 && isset(filter_var(trim($_POST['emailsignup']))) == 1 && isset(filter_var(trim($_POST['passwordsignup']))) == 1 && isset(filter_var(trim($_POST['passwordsignup_confirm']))) == 1){
   $login = filter_var(trim($_POST['usernamesignup']));
   $email = filter_var(trim($_POST['emailsignup']));
   $password = filter_var(trim($_POST['passwordsignup']));
   $passwordconf = filter_var(trim($_POST['passwordsignup_confirm']));
  
  
  
  if(mb_strlen($login) < 1 || mb_strlen($login) > 11) {
      echo ('Invalid username length(from 1 to 11 symbols)');
      exit();
   }
  elseif(mb_strlen($email) < 1 || mb_strlen($email) > 100) {
     echo ('Invalid email length(from 1 to 100 symbols)');
     exit();
  }
  elseif(mb_strlen($password) < 6 || mb_strlen($password) > 32) {
     echo ('Invalidn password length(from 6 to 32 symbols)');
     exit();
  }
  elseif($password != $passwordconf) {
     echo ('Confirm your password(invalid password confirm)');
     exit();
  }
  
  $password = md5($password);
  
  $mysql = new mysqli('localhost','root','','bd');
  $check = $mysql->query("SELECT * FROM `users` WHERE `login` = '$login' OR `email` = '$email'");
  $checkA = $check->fetch_assoc();
  if (count($checkA) == 0) {
  $mysql->query("INSERT INTO `users` (`login`, `email`, `password`) VALUES('$login', '$email', '$password')");
  $mysql->close();
  echo ('Successfull registration');
  }
  else {
     echo ('This user already registered, log in or change your data');
     exit();
  }
 }
?>