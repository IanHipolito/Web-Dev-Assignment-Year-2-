<!-- Library Website For Web Development 2 Assignment -->
<!-- Author: Ian Rainier Hipolito (C21436494, TU856/2) -->
<!-- Books Display Page For Library Website -->
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
                <li><a href="display.php" class="active">Books</a></li>
				<li><a href="reserved.php">Reserved</a></li>
                <li><a href="logout.php">Logout</a></li>
			</ul>
		</div>
    </div>

    <div class = "displaypagebg">
        <h1>Welcome To The Books Display Page</h1>
    </div>

    <div class = "displaypage">
        
        <?php
            include("database.php");
            
            $ResultsPerPage = 5;

            $Result = mysqli_query($conn, "SELECT * FROM books");

            $NumberOfPages = mysqli_num_rows($Result);

            $NumberOfPages = ceil($NumberOfPages/$ResultsPerPage);

            if(!isset($_GET['page'])){
                $page = 1;
            }
            else{
                $page = $_GET['page'];
            }
            
            $FirstPageResults = ($page - 1) * $ResultsPerPage;

            $Result = mysqli_query($conn, "SELECT * FROM books LIMIT " . $FirstPageResults . ',' . $ResultsPerPage);


            echo "<div class ='displayresults'><h1>Here Is A List Of All The Books</h1></div>";
            echo "<table ' border='3'>";
            echo "<tr><th>ISBN</th><th>BookTitle</th><th>Author</th><th>Edition</th><th>Year</th><th>CategoryID</th><th>Reserved</th><th>Reserve</th></tr>";

            while($Row = mysqli_fetch_array($Result)){
                echo "<tr><td>";
                echo (htmlentities($Row["ISBN"]));
                echo ("</td><td>");
                echo (htmlentities($Row["BookTitle"]));
                echo ("</td><td>");
                echo (htmlentities($Row["Author"]));
                echo ("</td><td>\n");
                echo (htmlentities($Row["Edition"]));
                echo ("</td><td>\n");
                echo (htmlentities($Row["Year"]));
                echo ("</td><td>\n");
                echo (htmlentities($Row["CategoryID"]));
                echo ("</td><td>\n");
                echo (htmlentities($Row["Reserve"]));
                echo ("</td><td>\n");

                if(htmlentities ($Row["Reserve"]) == 'N'){
                    echo ('<a href="reserve.php?id='.htmlentities($Row['ISBN']).'">Reserve</a>');
                }
                echo ("</td><td>\n");
                echo ("</td><tr>\n");
            }

            for($page = 1; $page <= $NumberOfPages; $page++){
                echo '<a class="pagenum" href="display.php?page=' .  $page  . '">' .  $page  . '</a>';
            }
        ?>
    </div>  

    <div  class="footer">
        <div class="container">
            <p>Copyright. 2022 Ian Rainier Hipolito. All rights reserved.</p>
        </div>
    </div>
</body>
</html>