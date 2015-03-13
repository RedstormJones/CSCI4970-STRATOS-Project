<!-- Creates the navigation for the whole web site -->
<?php
echo '';
echo '<div id="cssmenu">
    <ul class="menu">
                <li>
                    <a href="Welcome.php"><span>Home</span></a>
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
        </div>' ?>
