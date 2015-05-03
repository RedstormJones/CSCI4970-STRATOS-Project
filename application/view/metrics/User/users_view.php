<?php
require APP . 'view\metrics\Base_View_Metrics.php';

class Users_View Extends Base_View_Metrics
{
	public function renderUserMetrics( $charts, $currentUser, $userList )
	{
        // Form
        foreach ( $userList as $user )
        {
            // Add a user button, should all call the same function and submit the user's pid
        }

        // Add currentUser to title

		$this->renderMetrics('User Ticket Metrics', $charts);
	}
}
?>