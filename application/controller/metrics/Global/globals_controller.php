<?php
require APP . 'controller\metrics\Base_Controller_Metrics.php';

class Globals_Controller Extends Base_Controller_Metrics
{
    public function noAction()
    {
        $metrics = array();

        $result = $this->model->GetActiveTicketsInEachPriority();
        $activeTicketsInEachPriority = array();
        $name = "Active tickets by priority";
        foreach ( $result as $row )
        {
            $priority = $row->NAME;
            $count = $row->COUNT;

            $activeTicketsInEachPriority[] = array( $priority, $count );
        }
        $metrics[] = array($name, $activeTicketsInEachPriority);

        $result = $this->model->GetNewTicketsInLastMonthInEachPriority();
        $newTicketsInLastMonthInEachPriority = array();
        $name = "Tickets created in the last 30 days by priority";
        foreach( $result as $row )
        {
            $priority = $row->NAME;
            $count = $row->COUNT;

            $newTicketsInLastMonthInEachPriority[] = array( $priority, $count );
        }
        $metrics[] = array($name, $newTicketsInLastMonthInEachPriority);

        $result = $this->model->GetAverageTicketTimeForNonActiveInEachPriorty();
        $averageTicketTimeForNonActiveInEachPriorty = array();
        $name = "Average ticket time for non-active tickets";
        foreach( $result as $row )
        {
            $priority = $row->NAME;
            $time = $row->SUM_TIME;
            $count = $row->COUNT;

            $averageTicketTimeForNonActiveInEachPriorty[] = array( $priority, $time/$count );
        }
        $metrics[] = array($name, $averageTicketTimeForNonActiveInEachPriorty);

        $result = $this->model->GetAverageDifferenceTimeInEachPriority();
        $averageDifferenceTimeInEachPriority = array();
        $name = "Average difference in estimation for non-active tickets";
        foreach( $result as $row )
        {
            $priority = $row->NAME;
            $time = $row->SUM_TIME;
            $expct = $row->SUM_EXPCT;
            $count = $row->COUNT;

            $averageDifferenceTimeInEachPriority[] = array( $priority, ($time-$expct)/$count );
        }
        $metrics[] = array($name, $averageDifferenceTimeInEachPriority);

        $this->view->renderGlobals( $metrics );
    }
}
?>