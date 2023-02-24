<!-- Library Website For Web Development 2 Assignment -->
<!-- Author: Ian Rainier Hipolito (C21436494, TU856/2) -->
<!-- Home Page For Library Website -->
<!DOCTYPE html>
<html>
<?php   
    session_start();

    if(isset($_SESSION["Username"])){
       
    }
    else{
        header("Location: login.php");
    }
?>

<head>
    <title>Library</title>
    <link rel="stylesheet" href="http://localhost/WebDev2Assign/css/stylesheet1.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <div class="header">
		<div class="container">
			<ul class="navbar">
				<li><a href="home.php" class="active">Home</a></li>
				<li><a href="search.php">Search</a></li>
                <li><a href="display.php">Books</a></li>
				<li><a href="reserved.php">Reserved</a></li>
                <li><a href="logout.php">Logout</a></li>
			</ul>
		</div>
    </div>

    <div class="banner">
        <img class="mySlides" src="images/library3.jpg" alt="">
        <img class="mySlides" src="images/library.jpg" alt="">
        <img class="mySlides" src="images/library2.jpg" alt="">

        <div class="content">
            <h2>Welcome To</h2>
            <h2>Technological University Dublin's Library</h2>
        </div>
    </div>

    <div class="text">
        <h2>You Can Now Search And Reserve Books</h2>
    </div>

    <div class="container2">
        <div class="buttons">
            <a href="search.php" class="button button1">Search</a>
            <a href="reserved.php" class="button button1">My Books</a>
        </div>
    </div>

    <div  class="footer">
        <div class="container">
            <p>Copyright. 2022 Ian Rainier Hipolito. All rights reserved.</p>
        </div>
    </div>

    <script src="js/javascript1.js"></script>

</body>


</html>