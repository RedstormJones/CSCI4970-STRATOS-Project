<?php
require APP . 'controller\metrics\Base_Controller_Metrics.php';

class Globals_Controller extends Base_Controller_Metrics
{
    /**
    * Sets up four data sets corresponding to the code comments below and 
    * sends each data set to a Charts method to format the metrics data
    * into graphs and/or visual displays
    */
    public function noAction()
    {
        $this->user = $this->globals->getCurrentUserName();
        $this->pid = $this->globals->getCurrentUserPid();

        $metrics = array();
        
        // Active Tickets metrics control
        $activeTickets_IEP = array();
        $name = "Active Tickets by Priority";
        $result = $this->model->GetActiveTickets_IEP();
        foreach ( $result as $row )
        {
            $priority = $row->NAME;
            $count = $row->COUNT;
            $activeTickets_IEP[] = array( $priority, $count );
        }
        $metrics[] = new Line_Chart( $name, $activeTickets_IEP );

        // New Tickets in last Month control
        $newTicketsInLastMonth_IEP = array();
        $name = "Recently Opened Tickets by Priority  [last 30 days]";
        $result = $this->model->GetNewTicketsInLastMonth_IEP();
        foreach( $result as $row )
        {
            $priority = $row->NAME;
            $count = $row->COUNT;
            $newTicketsInLastMonth_IEP[] = array( $priority, $count );
        }
        $metrics[] = new Bar_Chart( $name, $newTicketsInLastMonth_IEP );

        // Average non-active ticket time control
        $averageTicketTimeForNonActive_IEP = array();
        $name = "Average Time [Non-Active Tickets]";
        $result = $this->model->GetAverageTicketTimeForNonActive_IEP();
        foreach( $result as $row )
        {
            $priority = $row->NAME;
            $time = $row->SUM_TIME;
            $count = $row->COUNT;
            $averageTicketTimeForNonActive_IEP[] = array( $priority, $time/$count );
        }
        $metrics[] = new PolarArea_Chart( $name, $averageTicketTimeForNonActive_IEP );
        
        // Average time estimate difference control
        $averageDifferenceTime_IEP = array();
        $name = "Average Estimate Difference [Non-Active Tickets]";
        $result = $this->model->GetAverageDifferenceTime_IEP();
        foreach( $result as $row )
        {
            $priority = $row->NAME;
            $time = $row->SUM_TIME;
            $expct = $row->SUM_EXPCT;
            $count = $row->COUNT;
            $averageDifferenceTime_IEP[] = array( $priority, ($time-$expct)/$count );
        }
        $metrics[] = new Doughnut_Chart($name, $averageDifferenceTime_IEP);

        // Send metrics data to the view for rendering in the web browser
        $this->view->renderGlobals( $metrics );
    }
}
?>