<?php
$id=$_POST['id'];
$pw=$_POST['pw'];

$db = mysqli_connect('127.0.0.1', 'root', 'autoset', 'dasom'); //서버주소, php 아이디, 비번, 스키마 이름
if(mysqli_connect_errno())
{
  echo "Failed to connect to MySQL!";
} //접속 실패시

$pass_encode=md5($pw);
$table_name="user_list";
$sql="SELECT pw FROM $table_name WHERE name ='$id'";
if($result = mysqli_query($db, $sql))
{
    if(mysqli_num_rows($result) == 0)
    {
        echo "<script>alert('No matched ID.');</script>";
        echo "<script>window.location.replace('http://127.0.0.1/web/login.html');</script>";
    }
    else
    {
        $row = mysqli_fetch_assoc($result);
        if($row["pw"] == $pass_encode) // 로그인 성공
        {
            // 리디렉션
            echo "<script>alert('Login Succeed.');</script>";
            echo "<script>location.href='http://www.naver.com';</script>";
        }
        else
        {
            echo "<script>alert('Wrong Password.');</script>";
            echo "<script>window.location.replace('http://127.0.0.1/web/login.html');</script>";
        }
    }
}
mysqli_free_result($result);
mysqli_close($db);

?>
