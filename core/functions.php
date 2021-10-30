<?php
  class loginValidation{
	#Function to validate password
    public function passVal($name, $pass){
      try{
        include_once 'dbcon.php';
        $select = $con->prepare("SELECT * FROM usrauth WHERE username=?");
        $select->setFetchMode(PDO::FETCH_ASSOC);
        $select->execute([$name]);
        $data=$select->fetch();
		#Checks hashing
        if(password_verify($pass, $data['password'])){
          $_SESSION['name']=$data['username'];
          $_SESSION['permission']=$data['permLevel'];
		  $_SESSION['id']=$data['id'];
          if($_SESSION['permission']==0 or $_SESSION['permission']==1){
            header('LOCATION:user/');
          }elseif($_SESSION['permission']==2){
            header('LOCATION:admin/');
          }
        }else{
          echo '<script>$(document).ready(function(){$("#auth-modal").modal({ blurring: true}).modal("show");});</script>';
          header("refresh:3");
         }
        }
        catch(PDOException $e){
          echo "error".$e->getMessage();
         }
        }
	#Function to create a user	
    public function createUser($name,$pass){
        include_once 'dbcon.php';
		#Hashing password
        $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
        $insert = $con->prepare("INSERT INTO usrauth (username,password, permLevel) VALUES(?,?,?) ");
		$insert->execute([$name,$hashed_pass,0]);
		echo '<script>$(document).ready(function(){$("#success-modal").modal({ blurring: true}).modal("show");});</script>';
		header("refresh:3");
      }
    }
?>
