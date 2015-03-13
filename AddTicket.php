<html lang="en"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title>Add Ticket</title>
        <link rel="stylesheet" type="text/css" href="style.css"> 
    </head>

    <body>
        <?php include 'Header.php'; ?>
        <?php include 'MenuBar.php'; ?>

        <br>
        <br>

        <form id="Add" name="AddTicket" method="post" class="dark-matter" action="ATForm.php">
            <h1>Ticket Adding Form
                <span>Please fill all the fields.</span>
            </h1>
            <p>
                <label for="textfield">Title:</label>
                <input type="text" placeholder="Enter Subject" name="title" id="title">

                <label for="textfield">Description:</label>
                <textarea id="description" placeholder="Enter details about the ticket" name="des"></textarea>

                <label for="textfield">Customer:</label>
                <input type="text" name="Customer" id="Customer">

                <label for="select">Assign To:</label>
                <select name="select" id="select" size="1">
                    <option value="Please Select">Please Select</option>
                    <?php
                    getMenu('stuserinst', 'pid', 'user');
                    ?>
                </select> 

                <label for="select">Category:</label>
                <select name="select" id="select" size="1">
                    <option value="Please Select">Please Select</option>
                    <?php
                    getMenu('category', 'cid', 'name');
                    ?>
                </select>  
                <label for="textfield"> Affected Level:</label>
            <labelc>
                <input type="radio" name="AffectedLevelRadio" value="Low" id="AffectedLevelRadio_0">
                Low</labelc>
            <labelc>
                <input type="radio" name="AffectedLevelRadio" value="Medium" id="AffectedLevelRadio_1">
                Medium</labelc>
            <labelc>
                <input type="radio" name="AffectedLevelRadio" value="High" id="AffectedLevelRadio_2">
                High</labelc>
            <br><br>

            <label for="textfield"> Severity:</label>
            <labelc>
                <input type="radio" name="SeverityRadio" value="Low" id="SeverityRadio_0">
                Low</labelc>
            <labelc>
                <input type="radio" name="SeverityRadio" value="Medium" id="SeverityRadio_1">
                Medium</labelc>
            <labelc>
                <input type="radio" name="SeverityRadio" value="High" id="SeverityRadio_2">
                High</labelc>      
            <br><br>

            <label for="textfield">Location:</label>
            <input type="text" placeholder="Enter Room Number" name="location" id="location">

            <label for="textfield">Due:</label>
            <input type="text" placeholder="Enter Date" name="date" id="date">        
            <br>
            <labelc>
                <input type="submit" class="button" value="Add Ticket" id="add" name="action">
            </labelc>
            <labelc>
                <input type="submit" class="button" value="Go Back" name="action" onclick="location.href='Tickets.php'">
            </labelc>
        </form>
    </body>
</html>

<?php

function getMenu($table, $column1, $column2) {
    $con = mysqli_connect("127.0.0.1", "root", "", "stratos");
    if (mysqli_connect_errno($con)) {
        echo "Failed to connect to MySQL DB: " . mysqli_connect_errno();
    } else {
        $query = "SELECT * FROM " . $table;
        $result = mysqli_query($con, $query);
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo "<option value=\"{$row[$column1]}\">{$row[$column2]}</option>\n";
        }
    }
}
?>