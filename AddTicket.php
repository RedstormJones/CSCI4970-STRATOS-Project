<html lang="en"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title>Add Ticket</title>
        <link rel="stylesheet" type="text/css" href="style.css"> 
    </head>

    <body>
        <img src="Header.jpg" alt="Header Image" height="80" style="width:100%">

        <div id='cssmenu'>

            <ul class="menu">
                <li>
                    <a href='Welcome.php'><span>Home</span></a>
                </li>
                <li>
                    <a href="Tickets.php">Tickets</a>
                </li>
                <li class="has-sub"><a href=""><span>Inventory</span></a>
                    <ul> 
                        <li><a href=""><span>Hardware</span></a></li>
                        <li><a href=""><span>Software</span></a></li>
                    </ul>
                </li>
                <li class="has-sub"><a href=""><span>Analytics</span></a>
                    <ul> 
                        <li><a href=""><span>Metrics</span></a></li>
                        <li><a href=""><span>Configuration</span></a></li>
                    </ul>
                </li>
                <li class="has-sub"><a href=""><span>Accounts</span></a>
                    <ul> 
                        <li><a href=""><span>Account Settings</span></a></li>
                        <li><a href=""><span>Logout</span></a></li>
                    </ul>
                </li>
        </div>
        
        <br>
        <br>
        
        <form id="Add" name="AddTicket" method="post" class="dark-matter">
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

                <label for="textfield"> Assigned To:</label>
                <input type="checkbox" name="00">
            <labelc for="checkbox">Sasank </labelc>
            <input type="checkbox" name="01"> 
            <labelc for="checkbox">Asad </labelc>
            <input type="checkbox" name="02">
            <labelc for="checkbox">EPrice </labelc>
            <input type="checkbox" name="03"> 
            <labelc for="checkbox">Alex </labelc>
            <input type="checkbox" name="04">
            <labelc for="checkbox">MrGrove </labelc>
            <input type="checkbox" name="05">
            <labelc for="checkbox">Jojomo </labelc>   
            <br><br>

            <label for="select">Category:</label>
            <select name="select" id="select" size="1">
                <option value="Pleae select">Please Select</option>
                <option value="Account creation">Account Creation</option>
                <option value="Account previleges">Account previleges</option>
                <option value="AD">AD</option>
                <option value="Backup">Backup</option>
                <option value="Checkout item">Checkout item</option>
                <option value="Course">Course</option>
                <option value="Data">Data</option>
                <option value="Database">Database</option>
                <option value="Decomission">Decommision</option>
                <option value="DNS">DNS</option>
                <option value="Documentation">Documentation</option>
                <option value="Email">Email</option>
                <option value="Hardware">Hardware</option>
                <option value="HCC">HCC</option>
                <option value="HPC">HPC</option>
                <option value="Imaging">Imaging</option>
                <option value="Inventory">Inventory</option>
                <option value="IRC">IRC</option>
                <option value="Login">Login</option>
                <option value="Logs">Logs</option>
                <option value="Misc">Misc</option>
                <option value="Move">Move</option>
                <option value="Network">Netowrk</option>
                <option value="Organize">Organize</option>
                <option value="OS Install">OS Install</option>
                <option value="Inventory">OS Upgrade</option>
                <option value="Other Account Related">Other Account Related</option>
                <option value="Password">Password</option>
                <option value="Permission">Permission</option>
                <option value="Printer">Printer</option>
                <option value="Public Relations">Public Relations</option>
                <option value="Purchase Request">Purchase Request</option>
                <option value="Restricted Data">Restricted Data</option>
                <option value="Room Access">Room Access</option>
                <option value="Room Reservation">Room Reservation</option>
                <option value="SCM">SCM</option>
                <option value="Security">Security</option>
                <option value="Server">Server</option>
                <option value="Software">Software</option>
                <option value="SSL Certificate">SSL Certificate</option>
                <option value="Storage">Storage</option>
                <option value="Surplus">Surplus</option>
                <option value="Systems Integration">Systems Integration</option>
                <option value="Technical Specifications">Technical Specifications</option>
                <option value="Virus/Spyware/Malware">Virus/Spyware/Malware</option>
                <option value="VMWARE">VMWARE</option>
                <option value="Website">Website</option>
                <option value="Wiki">Wiki</option>
                <option value="Workstation Setup">Workstation Setup</option>
            </select>  
            <label for="textfield"> Affected Level:</label>
            <labelc>
                <input type="radio" name="AffectedLevelRadio" value="Low" id="AffectedLevelRadio_0">
                Low</labelc>
            <labelc>
                <input type="radio" name="AffectedLevelRadio" value="Medium" id="AffectedLevelRadio_1">
                Meidum</labelc>
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
                Meidum</labelc>
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
                <input type="button" class="button" value="Add Ticket" id="add" name="add">
            </labelc>
            <labelc>
                <input type="button" class="button" value="Go Back" id="back" name="back">
            </labelc>
        </form>
    </body>
</html>