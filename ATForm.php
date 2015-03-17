<?php
    $action = $_POST['action'];
    $con = mysqli_connect("127.0.0.1","root","","stratos");
    // Variables for the form
    $title = $description = $customer = $assignee = $category = "";
    $affLvl = $severity = $location = $estTime = "";
    if(mysqli_connect_errno($con))
    {
            echo "Failed to connect to MySQL DB: " . mysqli_connect_errno();
    }
    else
    {
        
        if($action=='Go Back')
        {
            header("Location: Tickets.php");
        }
        else 
        {
            if ($_SERVER["REQUEST_METHOD"] == "POST") 
            {
                $title = validate_input($_POST["title"]);
                $description = validate_input($_POST["des"]);
                $customer = validate_input($_POST["cust"]);
                $assignee = validate_input($_POST["assignee"]);
                $category = validate_input($_POST["category"]);
                $affLvl = validate_input($_POST["affLvl"]);
                $severity = validate_input($_POST["sev"]);
                $location = validate_input($_POST["location"]);
                $estTime = validate_input($_POST["estHrs"]);
            }
            
        }
        
        $result = mysqli_query($con, "SELECT `pid` FROM StUserInst WHERE `user`='ykhan'");
        $row = $result->fetch_assoc();
        $opener = $row["pid"];
        
        $result = mysqli_query($con, "SELECT `user` FROM StUserInst WHERE `user`='ykhan'");
        $row = $result->fetch_assoc();
        $lastMdUser = $row["user"];

        $result = mysqli_query($con, "SELECT `key` FROM StNxtPriKeyInst WHERE `table`='StTktInst'");
        $row = $result->fetch_assoc();
        $tid = $row["key"];
        
        $tid = $tid + 1;
        
        $result = mysqli_query($con, "UPDATE StNxtPriKeyInst SET `key` = '$tid' WHERE `table`='StTktInst'");
        
        $query = "INSERT INTO sttktinst (tid, opener, assignee, aff_level, "
                . "severity, title, description, catg, life_cycl_id, insrt_tmst, "
                . "expct_hours, last_open_time, logl_del, last_mdfd_user, "
                . "last_mdfd_tmst) VALUES ('$tid', '$opener', '$assignee', '$affLvl', "
                . "'$severity', '$title', '$description', '$category', '0',CURRENT_TIMESTAMP , "
                . "'$estTime', '0', 'FALSE', '$lastMdUser', CURRENT_TIMESTAMP)";
        
       if ($con->query($query) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: ";
        }
    }
        
    function validate_input($data) 
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>