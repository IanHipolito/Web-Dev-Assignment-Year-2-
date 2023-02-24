<!-- Library Website For Web Development 2 Assignment -->
<!-- Author: Ian Rainier Hipolito (C21436494, TU856/2) -->
<!-- Login Page For Library Website -->


<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" href="http://localhost/WebDev2Assign/css/stylesheet1.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <div class="header">
		<div class="container">
			<ul class="navbar">
				<li><a href="login.php" class="active">Login</a></li>
                <li><a href="register.php">Register</a></li>
			</ul>
		</div>
    </div>

    <div class="login">
        <form action="login.php" method="post">
            <h1>LOGIN FORM</h1>
            <?php
                if(isset ($_GET['error'])) { ?>
                    <p class="error"><?php echo $_GET['error']; ?></p>
                <?php } ?>
            <label>Username: </label>
            <input type="text" name="Username" placeholder="Username">
            <label>Password: </label>
            <input type="password" name="Password" placeholder="Password">
            <button type="submit">Login</button>
            <p class="reg">Don't Have An Account? Why Not <a href="register.php">Register</a>!</p>
        </form>
    </div>

    <div class="footer">
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

    if(isset($_POST['Username']) && isset($_POST['Password'])){
        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $Username = validate($_POST['Username']);
        $Password = validate($_POST['Password']);

        if(empty($Username)){
            header("Location: login.php?error=Must Input A Username!");
            return;
        }
        else if(empty($Password)){
            header("Location: login.php?error=Must Input A Password!");
            return;
        }
        else{
            $sql = "SELECT * FROM users WHERE Username='$Username' AND Password='$Password'";
            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_assoc($result);
                if($row['Username'] == $Username && $row['Password'] == $Password){
                    $_SESSION['Username'] = $row['Username'];
                    header("Location: home.php");
                }
            }
            else{
                header("Location: login.php?error=The Username Or Password Do Not Match Or Are Incorrect Please Try Again!");
                return;
            }
        }
    }  
?>