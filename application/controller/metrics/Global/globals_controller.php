<?php
require APP . 'controller\metrics\Base_Controller_Metrics.php';

class Globals_Controller Extends Base_Controller_Metrics
{
    public function noAction()
    {
        $this->user = $this->globals->getCurrentUserName();
        $this->pid = $this->globals->getCurrentUserPid();

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

        // Type 0 = Doughnut, Type 1 = Pie, Type 2 = Bar
        $type = 0;
        $metrics[] = array($type, $name, $activeTickets_IEP);

        #-----------------------------------#
        # New Tickets in last Month control #
        #-----------------------------------#
        $newTicketsInLastMonth_IEP = array();
        $name = "Tickets created in the last 30 days by priority";

        $result = $this->model->GetNewTicketsInLastMonth_IEP();

        
        foreach( $result as $row )
        {
            $priority = $row->NAME;
            $count = $row->COUNT;

            $newTicketsInLastMonth_IEP[] = array( $priority, $count );
        }
        
        // Type 0 = Doughnut, Type 1 = Pie, Type 2 = Bar
        $type = 2;
        $metrics[] = array($type, $name, $newTicketsInLastMonth_IEP);

        #----------------------------------------#
        # Average non-active ticket time control #
        #----------------------------------------#
        $averageTicketTimeForNonActive_IEP = array();
        $name = "Average ticket time for non-active tickets";

        $result = $this->model->GetAverageTicketTimeForNonActive_IEP();

        foreach( $result as $row )
        {
            $priority = $row->NAME;
            $time = $row->SUM_TIME;
            $count = $row->COUNT;

            $averageTicketTimeForNonActive_IEP[] = array( $priority, $time/$count );
        }

        // Type 0 = Doughnut, Type 1 = Pie, Type 2 = Bar
        $type = 1;
        $metrics[] = array($type, $name, $averageTicketTimeForNonActive_IEP);
        
        #------------------------------------------#
        # Average time estimate difference control #
        #------------------------------------------#
        $averageDifferenceTime_IEP = array();
        $name = "Average difference in estimation for non-active tickets";

        $result = $this->model->GetAverageDifferenceTime_IEP();

        foreach( $result as $row )
        {
            $priority = $row->NAME;
            $time = $row->SUM_TIME;
            $expct = $row->SUM_EXPCT;
            $count = $row->COUNT;

            $averageDifferenceTime_IEP[] = array( $priority, ($time-$expct)/$count );
        }

        // Type 0 = Doughnut, Type 1 = Pie, Type 2 = Bar
        $type = 0;
        $metrics[] = array($type, $name, $averageDifferenceTime_IEP);

        #-----------------------------------#
        # Send metrics data to the view for #
        # rendering in the web browser      #
        #-----------------------------------#
        $this->view->renderGlobals( $metrics );
    }
}
?>