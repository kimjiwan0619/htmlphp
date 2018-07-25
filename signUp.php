<?php
$id=$_POST['id'];
$pw=$_POST['pw'];
$pwc=$_POST['pwc'];
$name=$_POST['name'];
$email=$_POST['email'];

if($pw!=$pwc)
{
  echo "<script>alert('비밀번호와 비밀번호확인이 다릅니다')</script>";
  echo"<script>window.location.replace('http://127.0.0.1/web/signUp.html');</script>";
  exit();
}
if($id==NULL || $pw==NULL || $name==NULL ||$email==NULL)
{
  echo"<script>alert('빈칸을 모두채워주세요')</script>";
  echo"<script>window.location.replace('http://127.0.0.1/web/signUp.html');</script>";
  exit();
}


$db = mysqli_connect('127.0.0.1', 'root', 'autoset', 'dasom'); //서버주소, php 아이디, 비번, 스키마 이름
if(mysqli_connect_errno())
{
  echo "Failed to connect to MySQL!";
} //접속 실패시

$check="SELECT id from user_list WHERE id='$id'";
$result=$db->query($check);
if($result->num_rows==1)
{
    echo "<script>alert('중복된 id입니다.')</script>)";
    echo "<script>window.location.replace('http://127.0.0.1/web/signUp.html');</script>";
    exit();
}

$pw_encode = md5($pw); //패스워드 암호화
$table_name = "user_list"; // 스키마의 table 이름

// INSERT : 추가, UPDATE : 업데이트, SELECT : 불러오기(?), DELETE : 삭제, WHERE : 조건문

$sql = "INSERT INTO `$table_name`(`id`, `pw`, `name`, `email`, `permission`) VALUES ('$id','$pw_encode','$name', '$email', 'FALSE')";
mysqli_query($db, $sql); //서버에 요청하는거
mysqli_close($db); //접속종료

echo "<script>alert('succeded register!')</script>"; //회원가입 성공
echo "<script>window.location.replace('http://127.0.0.1/web/login.html');</script>"; //login.html로 돌아가기



?>
