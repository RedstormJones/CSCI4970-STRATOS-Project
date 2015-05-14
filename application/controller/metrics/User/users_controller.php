<?php
require APP . 'controller\metrics\Base_Controller_Metrics.php';

class Users_Controller extends Base_Controller_Metrics
{
    /**
    * Redirects application control to the doRenderMetrics()
    * method using the currently logged on user's pid
    */
    public function noAction()
    {
        $this->doRenderMetrics( $this->globals->getCurrentUserPid() );
    }

    /**
    * Redirects application control to the doRenderMetrics()
    * method using the pid set in the environment variables
    */
    public function QueryUser()
    {
        $this->doRenderMetrics( $this->getParam( 'pid' ) );
    }

    /**
    * Sets up three data sets corresponding to the code comments below and 
    * sends each data set to a Charts method to format the user metrics data
    * into graphs and/or visual displays
    *
    * @param $user : String (identifies the user who's metrics should be shown as default)
    */
    public function doRenderMetrics( $user )
    {
        $metrics = array();
        $userName = '';

        $results = $this->model->GetAllUsers();
        $userList = array();
        foreach( $results as $result )
        {
            $pid   = $result->pid;
            $fname = $result->fname;
            $lname = $result->lname;

            $name  = $fname . ($fname == "" ? "" : " ") . $lname;
            if( $pid == $user ) $userName = $name;

            $userList[] = array( $pid, $name );
        }

        // Active tickets for this user control
        $name = "Active Tickets for " . $userName;
        $activeTickets_IEP = array();
        $results = $this->model->GetActiveTickets_IEP_ByUser( $user );
        foreach( $results as $result )
        {
            $priority = $result->NAME;
            $count = $result->COUNT;
            $activeTickets_IEP[] = array( $priority, $count );
        }
        $metrics[] = new Pie_Chart( $name, $activeTickets_IEP );

        // Average time to finish a ticket control
        $name = "Average Time [Non-Active Tickets]  -  " . $userName;
        $nonActiveTicketsTime_IEP = array();
        $results = $this->model->GetNonActiveTicketTime_IEP_ByUser( $user );
        foreach( $results as $result )
        {
        	$time_sum = $result->SUM_TIME;
            $priority = $result->NAME;
            $count = $result->COUNT;
            $nonActiveTicketsTime_IEP[] = array( $priority, ($time_sum / $count) );
        }
        $metrics[] = new Bar_Chart( $name, $nonActiveTicketsTime_IEP );

        // Average estimated difference between expected close time and ticket's actual close time
        $name = "Average Estimate Difference [Non-Active Tickets]  -  " . $userName;
        $averageDifferenceTime_IEP = array();
        $results = $this->model->GetAverageDifferenceTime_IEP_ByUser( $user );
        foreach( $results as $result )
        {
        	$expect_sum = $result->SUM_EXPCT;
        	$time_sum = $result->SUM_TIME;
            $priority = $result->NAME;
            $count = $result->COUNT;
            $averageDifferenceTime_IEP[] = array( $priority, (($expect_sum - $time_sum) / $count) );
        }
        $metrics[] = new Bar_Chart( $name, $averageDifferenceTime_IEP );

        // Command view to render metrics data to the webpage
        $this->view->renderUserMetrics( $metrics, $user, $userList );
    }
}
?>