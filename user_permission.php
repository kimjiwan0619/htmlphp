<?php

$id = $_GET['id']; //받은 값 : TEST05

$db = mysqli_connect('127.0.0.1', 'root', 'autoset', 'dasom'); //서버주소, php 아이디, 비번, 스키마 이름
if(mysqli_connect_errno())
{
  echo "Failed to connect to MySQL!";
} //접속 실패시



echo("UPDATE `user_list` SET `permission`='TRUE' WHERE `id` = '$id'");

$sql_true = "UPDATE `user_list` SET `permission`='TRUE' WHERE `id` = '$id'";

mysqli_query($db, $sql_true);

echo("<script>location.href = '../logged_in_admin.html'</script>");



 ?>
