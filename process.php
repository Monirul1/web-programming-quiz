<?php

session_start();

$mysqli = new mysqli('localhost', 'root', 'root', 'mycrud') or die(mysql_error($mysqli));

$id = 0;
$update = false;
$name = '';
$location = '';

if(isset($_POST['save'])){
	$name = $_POST['name'];
	$location = $_POST['location'];

	$mysqli->query("INSERT INTO data (name, location) VALUES('$name', '$location')") or 
	die($mysqli->error);
	
	$_SESSION['message'] = "Saved Record!";
	$_SESSION['msg_type'] = "success";

	header("location: index.php");
}

if(isset($_GET['delete'])){
	$id = $_GET['delete'];
	$mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error());


	$_SESSION['message'] = "Record Deleted!";
	$_SESSION['msg_type'] = "danger";

	header("location: index.php");
}

//selecting the data from database to display on fields
if(isset($_GET['edit'])){
	$id = $_GET['edit'];
	//upadte form
	$update = true;
	$result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error());

	if(count($result)==1){
		$row = $result->fetch_array();
		$name = $row['name'];
		$location = $row['location'];
	}

}

if (isset($_POST['update'])){
	$id = $_POST['id'];
	$name = $_POST['name'];
	$location = $_POST['location'];

	$mysqli->query("UPDATE data SET name='$name', location='$location' WHERE id=$id") or
	die($mysqli->error);

	$_SESSION['message'] = "Record updated!";
	$_SESSION['msg_type'] = "warning";

	header('location: index.php');

}























