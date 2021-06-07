<?php 

//class ClassName extends AnotherClass implements Interface
class Main{

    private $servername ="localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "ip_test";
    private $conn;

    function __construct()
    {
        $this->conn = new mysqli($this->servername,$this->username,$this->password,$this->dbname,3308);
        if($this->conn->connect_error)
        {
            echo "Connection Failed";
        }else{
            return $this->conn;
        }
    }

    function addRecord(){
        // echo "inserted";
        $name = $_POST['name'];
        $city_id = $_POST['cityid'];
        $state_id = $_POST['stateid'];
        $feedback = $_POST['feedback'];
        
        $sql = "INSERT INTO feedback (`id`, `name`, `state_id`, `city_id`, `feedback`) VALUES (NULL,'$name',$city_id,$state_id,'$feedback')";

        if(mysqli_query($conn, $sql)){
            return $data = true;
        } else{
                return $data =false;
        }
    }

    function getState()
    {
        // $sql ="SELECT * FROM states";
        $result=mysqli_query($this->conn,"select * from states");
        return $result;
        
    }

    function getCityByStateId($id)
    {
    
        $result=mysqli_query($this->conn,"SELECT * FROM cities where state_id = $id");
        return $result;

    }
    
}

//$obj = new Main();



?>