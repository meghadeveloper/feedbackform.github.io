<?php 
// require_once 'dbcon.php';
$servername='localhost';
$username='root';
$password='';
$dbname = "ip_test";
$conn=mysqli_connect($servername,$username,$password,"$dbname",3308);
  if(!$conn){
      die('Could not Connect MySql Server:' .mysql_error());
    }
$name = $_POST['name'];
$city_id = $_POST['cityid'];
$state_id = $_POST['stateid'];
$feedback = $_POST['feedback'];
// print_r($_POST);
// $sql = "INSERT INTO feedback  VALUES ('',".$name.", 
// ".$city_id.",".$state_id.",".$feedback.")";
$sql = "INSERT INTO feedback (`id`, `name`, `state_id`, `city_id`, `feedback`) VALUES (NULL,'$name',$city_id,$state_id,'$feedback')";

if(mysqli_query($conn, $sql)){
    echo "<h3>data stored in a database successfully</h3>"; 
    return $data = true;
} else{
    echo "ERROR: Hush! Sorry $sql. " 
        . mysqli_error($conn);
        return $data =false;
}
?>