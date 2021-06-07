<?php
require_once "Main.php";
$data = new Main();

$state_id = $_POST["state_id"];
$sql=$data->getCityByStateId($state_id);
$cnt=1;
?>
<option value="">Select City</option>
<?php
while($row = mysqli_fetch_array($sql)) {
?>
<option value="<?php echo $row["id"];?>"><?php echo $row["name"];?></option>
<?php
}
?>