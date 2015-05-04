<?php
require APP . 'controller\metrics\Base_Controller_Metrics.php';

class Users_Controller Extends Base_Controller_Metrics
{
    public function noAction()
    {
        $this->doRenderMetrics( $this->globals->getCurrentUserPid() );
    }

    public function QueryUser()
    {
        $this->doRenderMetrics( $this->getParam( 'pid' ) );
    }

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

        
        $name = "Non-Active Tickets Time for " . $userName;
        $nonActiveTicketsTime_IEP = array();
        $results = $this->model->GetNonActiveTicketTime_IEP_ByUser( $user );
        foreach( $results as $result )
        {
            $priority = $result->NAME;
            $count = $result->COUNT;
            $nonActiveTicketsTime_IEP[] = array( $priority, $count );
        }
        $metrics[] = new Bar_Chart( $name, $nonActiveTicketsTime_IEP );

        $name = "Average Difference in Non-Active Ticket Time to Estimated Time for " . $userName;
        $averageDifferenceTime_IEP = array();
        $results = $this->model->GetAverageDifferenceTime_IEP_ByUser( $user );
        foreach( $results as $result )
        {
            $priority = $result->NAME;
            $count = $result->COUNT;
            $averageDifferenceTime_IEP[] = array( $priority, $count );
        }
        $metrics[] = new Bar_Chart( $name, $averageDifferenceTime_IEP );

        // Call view
        $this->view->renderUserMetrics( $metrics, $user, $userList );
    }
}
?>