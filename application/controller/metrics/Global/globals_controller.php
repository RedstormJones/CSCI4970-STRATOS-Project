<?php
require APP . 'controller\metrics\Base_Controller_Metrics.php';

class Globals_Controller Extends Base_Controller_Metrics
{
    public function noAction()
    {
        $metrics = array();
        
        #--------------------------------#
        # Active Tickets metrics control #
        #--------------------------------#
        $activeTickets_IEP = array();
        $name = "Active tickets by priority";

        $result = $this->model->GetActiveTickets_IEP();

        foreach ( $result as $row )
        {
            $priority = $row->NAME;
            $count = $row->COUNT;

            $activeTickets_IEP[] = array( $priority, $count );
        }

        $metrics[] = array($name, $activeTickets_IEP);

        $result = $this->model->GetNewTicketsInLastMonth_IEP();

        #-----------------------------------#
        # New Tickets in last Month control #
        #-----------------------------------#
        $newTicketsInLastMonth_IEP = array();
        $name = "Tickets created in the last 30 days by priority";
        
        foreach( $result as $row )
        {
            $priority = $row->NAME;
            $count = $row->COUNT;

            $newTicketsInLastMonth_IEP[] = array( $priority, $count );
        }
        
        $metrics[] = array($name, $newTicketsInLastMonth_IEP);

        $result = $this->model->GetAverageTicketTimeForNonActive_IEP();

        #----------------------------------------#
        # Average non-active ticket time control #
        #----------------------------------------#
        $averageTicketTimeForNonActive_IEP = array();
        $name = "Average ticket time for non-active tickets";

        foreach( $result as $row )
        {
            $priority = $row->NAME;
            $time = $row->SUM_TIME;
            $count = $row->COUNT;

            $averageTicketTimeForNonActive_IEP[] = array( $priority, $time/$count );
        }

        $metrics[] = array($name, $averageTicketTimeForNonActive_IEP);

        $result = $this->model->GetAverageDifferenceTime_IEP();
        
        #------------------------------------------#
        # Average time estimate difference control #
        #------------------------------------------#
        $averageDifferenceTime_IEP = array();
        $name = "Average difference in estimation for non-active tickets";

        foreach( $result as $row )
        {
            $priority = $row->NAME;
            $time = $row->SUM_TIME;
            $expct = $row->SUM_EXPCT;
            $count = $row->COUNT;

            $averageDifferenceTime_IEP[] = array( $priority, ($time-$expct)/$count );
        }
        
        $metrics[] = array($name, $averageDifferenceTime_IEP);

        $this->view->renderGlobals( $metrics );
    }
}
?>