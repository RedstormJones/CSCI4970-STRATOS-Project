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
            <li>
                <a href="/application/view/metrics/metrics_index.php"><span>Metrics</span></a>
            </li>
            <li class="has-sub"><a href=""><span>Configuration</span></a>
                <ul> 
                    <li>
                    <li><a href="/application/view/config/lifecycle/lifecycle_config_index.php"><span>Lifecycle</span></a></li>
                </ul>
            </li>
            <li class="has-sub"><a href=""><span>Account</span></a>
                <ul> 
                    <li><a href=""><span>Account Settings</span></a></li>
                    <li><a href=""><span>Logout</span></a></li>
                </ul>
            </li>
        </ul>
    </div>';
?>