<?php
/** database connection credentials */
$dbHost="localhost"; //on MySql
$dbUsername="root";
$dbPassword="root";

/** other variables */				
$descriptIsEmpty = false;					
$catgIsEmpty = false;				
$dateIsEmpty = false;
$hrsIsEmpty = false;

/** Check that the page was requested from itself via the POST method. */
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if ($_POST['descript'] == "") {
        $descriptIsEmpty = true;
    }
    if ($_POST['catg'] == "") {
        $catgIsEmpty = true;
    }
    if ($_POST['date'] == "") {
        $dateIsEmpty = true;
    }
    if ($_POST['hrs'] == "") {
        $hrsIsEmpty = true;
    }

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
    $catg = mysqli_real_escape_string($con, $_POST['catg']);
    $date = mysqli_real_escape_string($con, $_POST['date']);
    $hrs = mysqli_real_escape_string($con, $_POST['hrs']);
    
    mysqli_query($con, "INSERT activities (catg, dates, hrs) VALUES ('".$catg."', '".$date."', '".$hrs."')");
    mysqli_close($con);
}
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        Welcome!<br><br>
        <form action="createNewActivities.php" method="POST">
            Description Of the Activity: <input type="text" name="descript"/><br/>
            <?php
            if ($descriptIsEmpty) {
                echo ("Enter your description, please!");
                echo ("<br/>");
            }
            ?>
            <br>
            Category of the Activity:<br>
            <input type = "radio" name = "catg" value = "Collaborative Learning" /> Collaborative Learning <br/>
            <input type = "radio" name = "catg" value = "Recreational Activities"/> Recreational Activities <br/>
            <input type = "radio" name = "catg" value = "Character Development" /> Character Development <br/>
            <?php            
            if ($catgIsEmpty) {
                 echo ("Select the category, please!");
                 echo ("<br/>");
             }                
            ?>
            <br>
            Date: <input type="date" name="date" value="dd-mm-yyyy"> <br>
            <?php
             if ($dateIsEmpty) {
                 echo ("Enter your date, please!");
                 echo ("<br/>");    
             }                                 
            ?>
            <br>
            Duration: <input type="number" min="0" max="99" step="1" name="hrs" value="0" required> <br>
            <?php
             if ($hrsIsEmpty) {
                 echo ("Enter your duration of activities, please!");
                 echo ("<br/>");    
             }                                 
            ?>
            <br>
            <input type="submit" value="Submit"/> <br> <br>
        </form>
        
        <form action="index.php" method="GET">
            <input type="submit" value="Go Back" />
        </form>
    </body>
</html>
