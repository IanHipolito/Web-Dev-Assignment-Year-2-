<!-- Library Website For Web Development 2 Assignment -->
<!-- Author: Ian Rainier Hipolito (C21436494, TU856/2) -->
<!-- Reserve Books Page For Library Website -->

<?php
    session_start();

    include("database.php");
    
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $userName = $_SESSION['Username'];
    $date = date("Y/m/d");

    $query2 = "INSERT INTO reservations VALUES ('$id', '$userName', '$date')";
    $query1 = "UPDATE books SET Reserve ='Y' WHERE ISBN = '$id'";
 
    mysqli_query($conn, $query1);
    mysqli_query($conn, $query2);

    mysqli_close($conn);

    echo "$id Is Now Reserved On Your Account</br>";
    echo "To View Your Reserved Books Click<a href='reserved.php'>here!</a>";
    
?>
