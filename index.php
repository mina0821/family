<!DOCTYPE html>
<html>
    <head>
        <style>  
            .header{
                display: inline-block;
                width: 100%;
            }
            #name{
                display: block;
                float: left;
            }
            #logo{
                display: inline-block;
                float: right;
            }
            .userInfo {
                display: inline-block;
                width:100%;
            }            
            #userName {
                padding-right: 10px;
                float: left;
                display: block;
            }
            #myProgress {
                width: 75%;
                background-color: lightblue;
                display: inline-block;
            }
            #myBar {
                width: 
                <?php
                $con = mysqli_connect("localhost", "root", "root");
                if (!$con) {
                   exit('Connect Error (' . mysqli_connect_errno() . ') '
                          . mysqli_connect_error());
                }

                //set the default client character set 
                mysqli_set_charset($con, 'utf-8');
                mysqli_select_db($con, "myActivities");
                $bar_sum = 0;
                $result = mysqli_query($con, "SELECT SUM(hrs) FROM activities");
                $row = mysqli_fetch_array($result);
                $bar_sum = $row["SUM(hrs)"]*60/10;
                echo $bar_sum 
                ?>%;
                height: 20px;
                background-color: lightseagreen;
            }
            #userPoints{
                padding-right: 30px;
                float: right;
                display: inline-block;
            }    
            #myProgress caption{
                display: none;
            }
            #myProgress:hover caption{
                display: block;
            }
            
        
        .dropbtn {
            background-color: transparent;
            color: black;
            font-size: 23px;
            font-weight: bold;
            border: none;
        }

        #dropdown {
            position: relative;
            left: 50px;
            size: relative;
            display: block;
            float: right;
        }

        .dropdown-content {
            display: none;            
            min-width: 150px;
            background-color: lightgrey;
            font-size: 1ypx;
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            text-decoration: none;
            display: block;
        }

        .dropdown:hover .dropdown-content {
            display: block;
            position: absolute;
            size: relative;
            float: left;
            overflow: auto;}

        .dropdown:hover .dropbtn {background-color: transparent;}
        
        body{background-color:#fffdd0;}
        </style>
        
        <title>Elevate Hackathon Connected Community</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    
    <body>
        <div class="header">
            <h1 id="name">FAMILY</h1>
        </div>
        
        
        <div class="userInfo">
            <div id="userName">Hello <a href="#" style="color:black; text-decoration:none;"><b>familyName</b></a>   |   <a href="#" style="color:lightseagreen; text-decoration:none; font-size: 10px">Edit Profile</a></div>
            <div id="myProgress">
                    <div id="myBar"></div>
                    <caption></caption>
            </div>
            <?php
            $con = mysqli_connect("localhost", "root", "root");
            if (!$con) {
               exit('Connect Error (' . mysqli_connect_errno() . ') '
                      . mysqli_connect_error());
            }

            //set the default client character set 
            mysqli_set_charset($con, 'utf-8');
            mysqli_select_db($con, "myActivities");
            ?>
            <div id="userPoints">
            <div class="dropdown">
            <?php
            $result = mysqli_query($con, "SELECT SUM(hrs) FROM activities");
            $row = mysqli_fetch_array($result);
            $bar_sum = $row["SUM(hrs)"]*60;
            echo "<button class='dropbtn'>".htmlentities($bar_sum)."/1000 PT</button>";
            ?>
                <div class="dropdown-content">
                    <?php
                    $result = mysqli_query($con, "SELECT catg, SUM(hrs) FROM activities GROUP BY catg;");
                    while ($row = mysqli_fetch_array($result)) {
                        switch ($row["catg"]){
                            case "Collaborative Learning":
                                echo "<a><table><tr>Collaborative Learn</tr> <th>".htmlentities($row["SUM(hrs)"]*60)." points</th></table></a>";
                                break;
                            case "Recreational Activities":
                                echo "<a><table><tr>Recreational Activities</tr> <th>".htmlentities($row["SUM(hrs)"]*60)." points</th></table></a>";
                                break;
                            case "Character Development":
                                echo "<a><table><tr>Character Development</tr> <th>".htmlentities($row["SUM(hrs)"]*60)." points</th></table></a>";
                                break;
                        }
                    }
                    $result = mysqli_query($con, "SELECT COUNT(distinct catg), dates FROM activities GROUP BY dates;");
                    $bonus = 0;
                    while ($row = mysqli_fetch_array($result)) {
                        if ($row["COUNT(distinct catg)"] >= 3) {
                            $bonus = $bonus + 60;
                        }
                    }
                    $catg = "bonus";
                    $date = "2000-01-01";
                    $hrs = $bonus / 60;
    
                    mysqli_query($con, "UPDATE activities SET hrs = " .$hrs. " WHERE catg='bonus';");
                    echo "<a><table><tr>Bonus Points Achieved</tr> <th>".htmlentities($bonus)." points</th></table></a>";
                    ?>
                    <a href="#"><table><th>View Details</th></table></a>
                </div>
            </div>
            </div>
        </div>
        
        <br/>
        
        <div style="float:left; padding-left:350px; padding-top:15px;">
            <table>
                <tr><input type="checkbox" name="sunday" checked="checked" disabled> <b>Sunday</b></tr>
                <tr><input type="checkbox" name="monday" checked="checked" disabled> Monday</tr> 
                <tr><input type="checkbox" name="tuesday" disabled> Tuesday</tr> 
                <tr><input type="checkbox" name="wednesday" checked="checked" disabled> Wednesday</tr> 
                <tr><input type="checkbox" name="thursday" disabled> Thursday</tr> 
                <tr><input type="checkbox" name="friday" checked="checked" disabled> Friday</tr> 
                <tr><input type="checkbox" name="sunday" disabled> Saturday</tr>
                <tr>&nbsp; | &nbsp;<i>Date Consistency: <b>1/7</b></i>&nbsp; | &nbsp; September 23, 2018</tr>
            </table>
        </div>
        
        <div style="float:right;">
            <img id="logo" src="location.png" style="width: 17px;height: auto;">&nbsp;<input type="text" name="location" value="Please Enter Your Location" width="auto">&nbsp;
        </div>
        
        <div style="float:left; padding-left:350px; padding-top: -5px;">
            <table><tr><b>What Activities Have I Done Today:</b></tr>
                <?php
                $result = mysqli_query($con, "SELECT distinct catg, dates FROM activities;");
                $count = 0;
                while ($row = mysqli_fetch_array($result)) {
                    if ($row["dates"] == "2018-09-23") {
                        $count = $count + 1;
                        switch ($row["catg"]){
                            case "Collaborative Learning":
                                echo "<tr><input type='checkbox' name='collab' checked='checked' disabled> Collaborative Learning</tr>";
                                break;
                            case "Recreational Activities":
                                echo "<tr><input type='checkbox' name='rec' checked='checked' disabled> Recreational Activities</tr>";
                                break;
                            case "Character Development":
                                echo "<tr><input type='checkbox' name='care' checked='checked' disabled> Character Development</tr>";
                                break; 
                        }
                    }
                }
                echo "<tr>&nbsp; | &nbsp;<i>Progress: <b>".$count."/3</b></i></tr>";
                ?>
            </table>
        </div>
        
        <div>
            <table style="width: 100%; padding-top: 50px; padding-bottom: 50px;">
                <th><a href="CollaborativeLearning.php"><img src="p1.png"></a><figcaption>Collaborative Learning</figcaption></th>
                <th><a href="RecreationalActivity.php"><img src="p2.png"></a><figcaption>Recreational Activities</figcaption></th>
                <th><a href="CharacterDevelopment.php"><img src="p3.png"></a><figcaption>Character Development</figcaption></th>
            </table>
        </div>
        
        <div class="events">
            <div id="upcoming" style="width:50%; float:left;">
            <p style="background-color: lightgray;"><b>Upcoming Events</b></p>
            <ul>
                <li><a href="eventA.php" style="text-decoration: none;">EventA</a></li>
                <li><a href="eventB.php" style="text-decoration: none;">EventB</a></li>
                <li><a href="createNewActivities.php" style="text-decoration: none;">EventC</a></li>
            </ul>
            </div>
            
            <div id="recommended" style="width:50%; float:right;">
            <p style="background-color: lightgray;"><b>Suggested Events</b></p>
            <ul>
                <li><a href="eventA.php" style="text-decoration: none;">EventNameA</a></li>
                <li><a href="eventB.php" style="text-decoration: none;">EventNameB</a></li>
                <li><a href="createNewActivities.php" style="text-decoration: none;">EventNameC</a></li>
            </ul>            
            </div>
        </div>
    </body>
    <footer>
        <p align=middle><b>Contact Us: </b>email: xxxxxx@exmail.com | phone number: (416) 000-0000</p>
    </footer>
</html>
