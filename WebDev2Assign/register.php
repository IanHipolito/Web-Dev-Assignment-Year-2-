<!-- Library Website For Web Development 2 Assignment -->
<!-- Author: Ian Rainier Hipolito (C21436494, TU856/2) -->
<!-- Register Page For Library Website -->

<!DOCTYPE html>
<html>

<head>
    <title>Library</title>
    <link rel="stylesheet" href="http://localhost/WebDev2Assign/css/stylesheet1.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <div class="header">
		<div class="container">
			<ul class="navbar">
				<li><a href="Login.php">Login</a></li>
                <li><a href="register.php" class="active">Register</a></li>
			</ul>
		</div>
    </div>

    <div class="register">
        <form action="register.php" method="post">
            <h1>Create An Account</h1>
            <h1>Registration Form</h1>
            <p>Please Fill Your Details In Below</p>
            <label>First Name: </label>
            <input type="text" name="FirstName" placeholder="First Name">
            <label>Surname: </label>
            <input type="text" name="Surname" placeholder="Surname">
            <label>Username: </label>
            <input type="text" name="Username" placeholder="Username">
            <label>Password: </label>
            <input type="password" name="Password" placeholder="Password">
            <label>Re-Enter Password: </label>
            <input type="password" name="ReEnterPassword" placeholder="Re-Enter Password">
            <label>Address Line 1: </label>
            <input type="text" name="AddressLine1" placeholder="Address Line 1">
            <label>Address Line 2: </label>
            <input type="text" name="AddressLine2" placeholder="Address Line 2">
            <label>City: </label>
            <input type="text" name="City" placeholder="City">
            <label>Telephone No.: </label>
            <input type="text" name="TelephoneNo" placeholder="Telephone No.">
            <label>Mobile No.: </label>
            <input type="text" name="MobileNo" placeholder="Mobile No.">
            <button type="submit">Register</button>
        </form>
    </div>

    <div  class="footer">
        <div class="container">
            <p>Copyright. 2022 Ian Rainier Hipolito. All rights reserved.</p>
        </div>
    </div>

</body>
</html>

<?php
    session_start();

    include "database.php";

    if(isset($_SESSION["Username"])){
        header("Location: home.php");
    }

    if(isset($_REQUEST['Username'])){
        $FirstName = mysqli_real_escape_string($conn, $_REQUEST['FirstName']);
        $Surname = mysqli_real_escape_string($conn, $_REQUEST['Surname']);
        $Username = mysqli_real_escape_string($conn, $_REQUEST['Username']);
        $Password = mysqli_real_escape_string($conn, $_REQUEST['Password']);
        $ReEnterPassword = mysqli_real_escape_string($conn, $_REQUEST['ReEnterPassword']);

        //Checks if password inputted is longer than 4 characters
        if(strlen($Password) < 6){
            echo "<div class='registererror'><p>Your password should be at least 6 characters long.</p></br></div>";
            return;
        }

        //Checks if the 2 passwords inputted are the same
        if($Password != $ReEnterPassword){
            echo "<div class='registererror'><p>The Passwords You Have Entered Do Not Match. Please Try Again.</p></br></div>";
            return;
        }

        $AddressLine1 = mysqli_real_escape_string($conn,$_REQUEST["AddressLine1"]);
        $AddressLine2 = mysqli_real_escape_string($conn,$_REQUEST["AddressLine2"]);
        $City = mysqli_real_escape_string($conn,$_REQUEST["City"]);
        $Telephone = mysqli_real_escape_string($conn,$_REQUEST["TelephoneNo"]);
        $Mobile = mysqli_real_escape_string($conn,$_REQUEST["MobileNo"]);


        //Checks if telephone/mobile input is numeric and not a character
        if(!is_numeric($Telephone)){
            echo "<div class='registererror'><p>The Telephone Number You Inputted Is Not Valid. Please Try Again.</p></br></div>";
            return;
        }
        if(!is_numeric($Mobile)){
            echo "<div class='registererror'><p>The Mobile Number You Inputted Is Not Valid. Please Try Again.</p></br></div>";
            return;
        }

        //Checks if telephone/mobile numbers are 10 numbers long
        if(strlen($Telephone) != 10){
            echo "<div class='registererror'><p>Your Telephone number should be 10 digits long.</p></br></div>";
            return;
        }
        if(strlen($Mobile) != 10){
            echo "<div class='registererror'><p>Your Mobile number should be 10 digits long.</p></br></div>";
            return;
        }

        $Query = "INSERT INTO users (Username, Password, FirstName, Surname, Addressline1, AddressLine2, City, Telephone, Mobile) 
        VALUES ('$Username', '$Password', '$FirstName', '$Surname','$AddressLine1', '$AddressLine2', '$City', '$Telephone', '$Mobile')";

        $Result = mysqli_query($conn, $Query);

        if($Result){
            echo "<div class='registered'><p>You have registered, please log in.</p></br>Click here to <a href='login.php'>Login</a></div>";
        }
        else{
            echo "<div class='registererror'><p>The Username You Have Enter Is Already Exists. Please Try Again.</p></br></div>";
        }
    }
        
?>

