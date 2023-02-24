<!-- Library Website For Web Development 2 Assignment -->
<!-- Author: Ian Rainier Hipolito (C21436494, TU856/2) -->
<!-- Unreserve For Library Website -->

<?php
    session_start();
    include("database.php");

    if ( isset($_POST['delete']) && isset($_POST['id']) ) {
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $sql = "DELETE FROM reservations WHERE ISBN = '$id'";
        $sql2 = "UPDATE books SET Reserve = 'N' WHERE ISBN = '$id'";

        mysqli_query($conn, $sql);
        mysqli_query($conn, $sql2);
        echo "Reservation Succesfully Unreserved<br>";
        echo 'Please Continue Back To The Reservations Page- <a href="reserved.php">Continue...</a>';
        return;
    }

    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $Results = mysqli_query($conn, "SELECT reservations.ISBN, reservations.Username, books.BookTitle FROM reservations NATURAL JOIN books WHERE ISBN ='$id'");
    $Row = mysqli_fetch_row($Results);

    echo('Please Confirm That You Want To Make An Unreservation For:' . $Row[0] . $Row[2] . '\n');
    echo('<form method="post"><input type="hidden" ');
    echo('name="id" value="'.htmlentities($Row[0]).'">'."\n");
    echo('<input type="submit" value="Unreserve" name="delete">');
    echo('<a href="home.php">Cancel</a>');
    echo("\n</form>\n");
?>