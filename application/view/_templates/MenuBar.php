<!-- Creates the navigation for the whole web site -->
<?php
echo '<div id="cssmenu">
        <ul class="menu">
            <li>
                <a href="/application/view/home/home_index.php"><span>Home</span></a>
            </li>
            <li>
                <a href="/application/view/tickets/tickets_index.php"><span>Tickets</span></a>
            </li>
            <li class="has-sub"><a href=""><span>Inventory</span></a>
                <ul> 
                    <li><a href="/application/view/hardware/hardware_index.php"><span>Hardware</span></a></li>
                    <li><a href="/application/view/software/software_index.php"><span>Software</span></a></li>
                </ul>
            </li>
            <li class="has-sub"><a href=""><span>Metrics</span></a>
                <ul>
                    <li><a href="/application/view/metrics/Global/globals_index.php"><span>Global Metrics</span></a></li>
                    <li><a href="/application/view/metrics/User/users_index.php"><span>Users Metrics</span></a></li>
                </ul>
            </li>
            <li class="has-sub"><a href=""><span>Configuration</span></a>
                <ul> 
                    <li><a href="/application/view/config/affected/affected_config_index.php"><span>Affected Level</span></a></li>
                    <li><a href="/application/view/config/category/category_config_index.php"><span>Category</span></a></li>
                    <li><a href="/application/view/config/lifecycle/lifecycle_config_index.php"><span>Lifecycle</span></a></li>
                    <li><a href="/application/view/config/priority/priority_config_index.php"><span>Priority</span></a></li>
                    <li><a href="/application/view/config/severity/severity_config_index.php"><span>Severity</span></a></li>
                </ul>
            </li>
            <li class="has-sub"><a href=""><span>Account</span></a>
                <ul> 
                    <li><a href="/application/view/account/account_index.php"><span>Account Settings</span></a></li>
                    <li><a id="logout" href="/application/view/logout/logout_index.php"><span>Logout</span></a> </li>
                </ul>
            </li>
        </ul>
    </div>';
?>
