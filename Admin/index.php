<?php
session_start();
if(isset($_SESSION['admin_logged_in'])){
  Header("location: home.php");
}
?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>


</head>
<body>
  <style>
  *{
  margin: 0px;
  padding: 0px;;
}

body{
  font-family: Arial, Helvetica, sans-serif;

}

.container
{
  display: grid;
  grid-template-columns: 1fr 2fr;
  background-color: red;
  background: linear-gradient(to bottom, rgb(6, 108, 100),  rgb(14, 48, 122));
  width: 800px;
  height: 400px;
  margin: 5% auto;;
  border-radius: 5px;
}

.content-holder
{
  text-align: center;
  color: white;
  font-size: 14px;
  font-weight: lighter;
  letter-spacing: 2px;
  margin-top: 15%;
  padding: 50px;
}

.content-holder h2
{
  font-size: 34px;
  margin: 20px auto;
}

.content-holder p
{
  margin: 30px auto;
}

.content-holder button
{
  border:none;
  font-size: 15px;
  padding: 10px;
  border-radius: 6px;
  background-color: white;
  width: 150px;
  margin: 20px auto;
  
}


.box-2{
  background-color: white;

  margin: 5px;
}

.login-form-container
{
  text-align: center;
  margin-top: 10%;

}

.login-form-container h1
{
  color: black;
  font-size: 24px;
  padding: 20px;
}

.input-field
{
  box-sizing: border-box;
  font-size: 14px;
  padding: 10px;
  border-radius: 7px;
  border: 1px solid rgb(168, 168, 168);
  width: 250px;
  outline: none;
}

.login-button{
  box-sizing: border-box;
  color: white;
  font-size: 14px;
  padding: 13px;
  border-radius: 7px;
  border: none;
  width: 250px;
  outline: none;
  background-color: rgb(56, 102, 189);
   cursor: pointer;
}


.button-2
{
  display: none;
}

.signup-form-container
{
  position: relative;
  top: 50%;
  left: 50%;
  transform: translate(-50%,-60%);
  text-align: center;
  display: none;
}


.signup-form-container h1
{
  color: black;
  font-size: 24px;
  padding: 20px;
}

.signup-button{
  box-sizing: border-box;
  color: white;
  font-size: 14px;
  padding: 13px;
  border-radius: 7px;
  border: none;
  width: 250px;
  outline: none;
  background-color: rgb(56, 189, 149);  
}
.alert{
 
  width:300px;
  height: 40px;
  text-align: center;
  position: relative;
  padding: 10px;
  top: 20px;
  margin-left: 45%;
  font-weight: bold;
  font-family: Arial;
  color: blue;
  font-size: 30px;

}
</style>

<?php 


if(isset($_GET['msg'])){
  print '<div class="alert ">
                '.$_GET['msg'].'
                
            </div>';
}

?>

 <div class="container" style = "">
      <!--Data or Content-->
      <div class="box-1">
          <div class="content-holder" style="position: relative; top:10%">
              <h2>SEEF Admin Panel!</h2> 
              <!-- <button class="button-1" onclick="signup()">Sign up</button>
              <button class="button-2" onclick="login()">Login</button> -->
          </div>
      </div>

      
      <!--Forms-->
      <div class="box-2">
          <div class="login-form-container">
              <h1>Login Form</h1>
              <form method = "post" action = "verify.php">
                <input type="text" placeholder="Username" class="input-field" name = "username">
                <br><br>
                <input type="password" placeholder="Password" class="input-field" name = "password">
                <br><br>
                <button class="login-button" type="submit">Login</button>
              </form>
          </div>
          


<!--Create Container for Signup form-->
      <div class="signup-form-container">
          <h1>Sign Up Form</h1>
          <input type="text" placeholder="Username" class="input-field">
          <br><br>
          <input type="email" placeholder="Email" class="input-field">
          <br><br>
          <input type="password" placeholder="Password" class="input-field">
          <br><br>
          <button class="signup-button" type="button">Sign Up</button>
      </div>



      </div>






<script type="text/javascript">
  

  function signup()
{
    document.querySelector(".login-form-container").style.cssText = "display: none;";
    document.querySelector(".signup-form-container").style.cssText = "display: block;";
    document.querySelector(".container").style.cssText = "background: linear-gradient(to bottom, rgb(56, 189, 149),  rgb(28, 139, 106));";
    document.querySelector(".button-1").style.cssText = "display: none";
    document.querySelector(".button-2").style.cssText = "display: block";

};

function login()
{
    document.querySelector(".signup-form-container").style.cssText = "display: none;";
    document.querySelector(".login-form-container").style.cssText = "display: block;";
    document.querySelector(".container").style.cssText = "background: linear-gradient(to bottom, rgb(6, 108, 224),  rgb(14, 48, 122));";
    document.querySelector(".button-2").style.cssText = "display: none";
    document.querySelector(".button-1").style.cssText = "display: block";

}
</script>

</body>
</html>