<html lang="en"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title>Tickets</title>
        <link rel="stylesheet" type="text/css" href="style.css"> 
    </head>

    <body>
        <?php include 'Header.php'; ?>
        <?php include 'MenuBar.php'; ?>
        <br>
        <br>
        <table>
            <tr>
                <th>Checkbox</th>
                <th>Ticket#</th>
                <th>Tickets</th>		
                <th>Subjects</th>
                <th>Priority</th>
                <th>Status</th>		
                <th>Created</th>
                <th>Last Updated</th>
            </tr>
            <tr>
                <td></td>
                <td>1234</td>
                <td>Ticket1</td>		
                <td>Subject1</td>
                <td>Low</td>
                <td>New</td>		
                <td>Date</td>
                <td>Date</td>
            </tr>
            <tr>
                <td></td>
                <td>5678</td>
                <td>Ticket2</td>		
                <td>Subject2</td>
                <td>High</td>
                <td>In-Progress</td>		
                <td>Date</td>
                <td>Date</td>
            </tr>
        </table>
        <br>
        <br>
        
        <div style="text-align: center">
            <input type=button class="button" onClick="location.href='AddTicket.php'" value='Add Ticket'>
        </div>
    </body>
</html>