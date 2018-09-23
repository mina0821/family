<?php
/** database connection credentials */
$dbHost="localhost"; //on MySql
$dbUsername="root";
$dbPassword="root";

/** Check that the page was requested from itself via the POST method. */
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    /** Create database connection */
    $con = mysqli_connect($dbHost, $dbUsername, $dbPassword);
    if (!$con) {
        exit('Connect Error (' . mysqli_connect_errno() . ') '
                . mysqli_connect_error());
    }
    //set the default client character set 
    mysqli_set_charset($con, 'utf-8');

    mysqli_select_db($con, "myActivities");
    mysqli_select_db($con, "activities");
    $catg = "Recreational Activities";
    $date = "2018-04-22";
    $hrs = 2;
    
    mysqli_query($con, "INSERT activities (catg, dates, hrs) VALUES ('".$catg."', '".$date."', '".$hrs."')");
    mysqli_close($con);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Earth Day Garbage Pickup</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <form action="eventA.php" method="POST">
            <div><table border="1">
                    <h3>Earth Day Garbage Pickup</h3>
                    <tr><th>Description:</th><td>This event brings families together on Earth day for them to bond with oneself and each other though collaboration.</td></tr>
                    <tr><th>Category:</th><td>Recreational Activities</td></tr>
                    <tr><th>Date:</th><td>2018-04-22</td></tr>
                    <tr><th>Duration:</th><td>2 hours</td></tr>
                    <br>
            </table></div>
            <br>
            <div><input type="submit" value="Check-In"/> | <a href="index.php"><button type="button">Home Page</button></a></div>
            <br>
        </form>
    </body>
</html>
