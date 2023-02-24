<!-- Library Website For Web Development 2 Assignment -->
<!-- Author: Ian Rainier Hipolito (C21436494, TU856/2) -->
<!-- View Reserved Books Page For Library Website -->
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
				<li><a href="home.php">Home</a></li>
				<li><a href="search.php">Search</a></li>
                <li><a href="display.php">Books</a></li>
				<li><a href="reserved.php" class="active">Reserved</a></li>
                <li><a href="logout.php">Logout</a></li>
			</ul>
		</div>
    </div>

    <div class = "reservedpagebg">
        <h1>Welcome To The Reservations Page</h1>
    </div>

    <div class = "reservedpage">
        <p>Here You Can View The Books You Have Reserved And You Can Unreserve Them If You Wish</p>
        <table class="reservedtable">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Date</th>
                    <th>ISBN</th>
                    <th>BookTitle</th>
                    <th>Unreserve</th>
                </tr>
        </thead>
            <?php
                include("database.php");

                $username = $_SESSION['Username'];
                $query = "SELECT books.ISBN, books.BookTitle, reservations.ReservedDate, reservations.Username FROM reservations NATURAL JOIN books WHERE reservations.Username ='".$username."'";
                $Results = mysqli_query($conn, $query);
                
                if($Results && mysqli_num_rows($Results)>0)
                {
                    while($Row = mysqli_fetch_array($Results, MYSQLI_BOTH)){
                        echo "<tr><td>";
                        echo(htmlentities($Row[3]));
                        echo("</td><td>");
                        echo(htmlentities($Row[2]));
                        echo("</td><td>");
                        echo(htmlentities($Row[0]));
                        echo("</td><td>\n");
                        echo(htmlentities($Row[1]));
                        echo("</td><td>\n");
                        echo('<a href="unreserve.php?id='.htmlentities($Row[0]).'">Unreserve</a>');
                        echo("</td></tr>\n");
                    }
                }
            ?>
        </table>
    </div>  

    <div  class="footer">
        <div class="container">
            <p>Copyright. 2022 Ian Rainier Hipolito. All rights reserved.</p>
        </div>
    </div>
</body>
</html>