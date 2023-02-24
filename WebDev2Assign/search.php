<?php
    session_start();

    include("database.php");

    if(isset($_SESSION["Username"])){
       
    }
    else{
        header("Location: login.php");
    }
?>

<!DOCTYPE html>
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
                    <li><a href="Search.php" class="active">Search</a></li>
                    <li><a href="display.php">Books</a></li>
                    <li><a href="reserved.php">Reserved</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>

        <div class = "searchpagebg">
            <h1>Welcome To Technological University Dublin's Search Page</h1>
        </div>
        
        <div class="searchbody">
            <div class = "search1_body">
                <form class="BookAuthor" method="GET">
                    <p>Search by Book Title or Author Name</p>
                    <br><input class = "input1" type="text" name="Search" required value="<?php if(isset($_GET['Search'])){echo $_GET['Search']; } ?>"  placeholder = "Search For A Book By Entering The Title or Author">
                    <input class="search" type="submit" value="Search">
                </form>
            </div>
            
    
            <div class = "search2_body">
                <form class = "CategorySearch" method = "POST">
                    <p>You Can Also Search By Category</p>
                    <select class = "input2" name = "search_one">
                    <option class = "input2" name = "search_two">PLEASE SELECT A CATEGORY</option>
                            <option disables selected><- - - -CATEGORIES- - - -></option>
                            <?php
                                include("database.php");

                                $Result = mysqli_query($conn, "SELECT * FROM Categories");

                                while($Row = mysqli_fetch_array($Result)){
                                    echo "<option value ='".$Row['CategoryID']."'>".$Row['CategoryDescription']."</option>";
                                }
                            ?>
                    </select>
                    <br><input class = "search" type = "submit" name = "Search" value = "Search">
                </form>
            </div>
        </div>

        <div  class="footer">
            <div class="container">
                <p>Copyright. 2022 Ian Rainier Hipolito. All rights reserved.</p>
            </div>
        </div>

    <div class = "view">
        <div class = "viewResults1">
            <?php 
            
                if(isset($_GET['Search'])){
                    $filtervalues = $_GET['Search'];
                    $query = "SELECT * FROM books WHERE CONCAT(BookTitle,Author) LIKE '%$filtervalues%' ";
                    $data = mysqli_query($conn, $query);
                
                        if(mysqli_num_rows($data) > 0){
                            echo "<table class='tablesearch' border='3'>";
                            echo "<tr><th>ISBN</th><th>BookTitle</th><th>Author</th><th>Edition</th><th>Year</th><th>CategoryID</th><th>Reserved</th><th>Reserve</th></tr>";
    
                            while($Row = mysqli_fetch_assoc($data)){
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
                    
                        }
                    }
            ?>
        </div>

        <div class = "viewResults1">
            <?php 
                unset($_SESSION['search_one']);

                include("database.php");
        
                if(isset($_POST['search_one'])){
                    $Title1 = $_POST['search_one'];
        
                    $sql = "SELECT * FROM books WHERE CategoryID = '$Title1'";
        
                    $Result = $conn->query($sql);
                    $Count = mysqli_num_rows($Result);
            
                    if($Result->num_rows>0){
                        echo "<table class='tablesearch' border='3'>";
                        echo "<tr><th>ISBN</th><th>BookTitle</th><th>Author</th><th>Edition</th><th>Year</th><th>CategoryID</th><th>Reserved</th><th>Reserve</th></tr>";
        
                        while($Row = $Result->fetch_assoc()){
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
                }
            }
        ?>
        </div>
    </div>
    </body>
</html>   