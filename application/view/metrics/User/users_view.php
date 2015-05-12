<?php
require APP . 'view\metrics\Base_View_Metrics.php';

class Users_View Extends Base_View_Metrics
{
    #----------------------------------------------#
    # Creates the buttons on the User Metrics page #
    # for viewing metrics particular to one of the #
    # systems users, then sends this preconfigured #
    # html to the renderMetrics() in the           #
    # Base_View_Metrics file for actual rendering  #
    # to the webpage                               #
    #----------------------------------------------#
	public function renderUserMetrics( $charts, $currentUser, $userList )
	{
        $userButtons = '<br>';
        foreach ( $userList as $user )
        {
            $pid  = $user[0];
            $name = $user[1];
            
            $userButtons .= '<div align="center">';
            $userButtons .= '   <form action="users_index.php" method="GET">';
            $userButtons .= '       <input type="hidden" name="pid" value="' . $pid . '"> ';
            $userButtons .= '       <input type="hidden" name="action" value="QueryUser"> ';
            $userButtons .= '       <input type=submit class="button" value="' . $name . '">';
            $userButtons .= '   </form>';
            $userButtons .= '</div>';
            $userButtons .= '<br>';
        }
        $userButtons .= '<br><br><br>';

        // Add currentUser to title

		$this->renderMetrics('Users - Ticket Metrics', $charts, $userButtons);
	}
}
?>