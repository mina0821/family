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
    $date = "2018-09-23";
    $hrs = mysqli_real_escape_string($con, $_POST['hrs']);
    
    mysqli_query($con, "INSERT activities (catg, dates, hrs) VALUES ('".$catg."', '".$date."', '".$hrs."')");
    mysqli_close($con);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Regular Family Swimming Session</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <form action="eventB.php" method="POST">
            <table border="1">
                <h3>Regular Family Swimming Session</h3>
                <tr><th>Description:</th><td>This event creates family bonding time and environment needed by the residents in the community, extra rewards points will be given based on activity consistency.</td></tr>
                <tr><th>Category:</th><td>Recreational Activities</td></tr>
                <tr><th>Date:</th><td>2018-09-23</td></tr>
                <tr><th>Duration:</th><td><input type="number" min="0" max="99" step="1" name="hrs" value="0" required> Hours</td></tr>
            </table></div>
            <br>
            <div> <input type="submit" value="Check-In"> | <a href="index.php"><button type="button">Home Page</button></a></div>
        </form> 
    </body>
</html>