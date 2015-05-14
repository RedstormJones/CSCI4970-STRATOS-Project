<?php
require APP . 'model/metrics/Base_Model_Metrics.php';

class Globals_Model extends Base_Model_Metrics
{
	
	/**
	* return the number of active tickets by their priority
	*/
    public function GetActiveTickets_IEP()
    {
        $this->query_GetActiveTicketsInEachPriority->execute();
        return $this->query_GetActiveTicketsInEachPriority->fetchAll();
    }

	/**
	* return the number of recently opened tickets in the last 30 days by their priority
	*/
    public function GetNewTicketsInLastMonth_IEP()
    {
        $this->query_GetNewTicketsInLastMonthInEachPriority->execute();
        return $this->query_GetNewTicketsInLastMonthInEachPriority->fetchAll();
    }

	/**
	* return the average time of close ticket "non active tickets" by their Severity 
	*/
    public function GetAverageTicketTimeForNonActive_IEP()
    {
        $this->query_GetAverageTicketTimeForNonActiveInEachPriorty->execute();
        return $this->query_GetAverageTicketTimeForNonActiveInEachPriorty->fetchAll();
    }

	/**
	* return the average estimate difference of close ticket "non active tickets" by their Severity 
	*/
    public function GetAverageDifferenceTime_IEP()
    {
        $this->query_GetAverageDifferenceTimeInEachPriority->execute();
        return $this->query_GetAverageDifferenceTimeInEachPriority->fetchAll();
    }

	/**
	* Database Queries to collect the data
	*
	*/
    public function SetUpQueries()
    {
        parent::SetUpQueries();

        $this->sql_GetActiveTicketsInEachPriority = "
            SELECT
                pri.name as NAME, COUNT(*) as COUNT
            FROM
                StTktInst tkt
            INNER JOIN
                StLfeCyclConf lf
            ON
                lf.life_cycl_id = tkt.life_cycl_id
            INNER JOIN
                StPriMtxConf mtx
            ON
                mtx.aff_level = tkt.aff_level AND mtx.severity = tkt.severity
            INNER JOIN
                StPriConf pri
            ON
                mtx.priority = pri.priority
            WHERE
                tkt.logl_del = FALSE AND lf.is_timed
            GROUP BY
                pri.priority";
        $this->query_GetActiveTicketsInEachPriority = $this->db->prepare( $this->sql_GetActiveTicketsInEachPriority );

        $this->sql_GetNewTicketsInLastMonthInEachPriority = "
            SELECT
                pri.name as NAME, COUNT(*) as COUNT
            FROM
                StTktInst tkt
            INNER JOIN
                StPriMtxConf mtx
            ON
                mtx.aff_level = tkt.aff_level AND mtx.severity = tkt.severity
            INNER JOIN
                StPriConf pri
            ON
                mtx.priority = pri.priority
            WHERE
                tkt.insrt_tmst > DATE_ADD(CURRENT_TIMESTAMP,INTERVAL -30 DAY)
            GROUP BY
                pri.priority";
        $this->query_GetNewTicketsInLastMonthInEachPriority = $this->db->prepare( $this->sql_GetNewTicketsInLastMonthInEachPriority );

        $this->sql_GetAverageTicketTimeForNonActiveInEachPriorty = "
            SELECT
                pri.name as NAME, SUM(tkt.last_open_time) as SUM_TIME, COUNT(*) as COUNT
            FROM
                StTktInst tkt
            INNER JOIN
                StLfeCyclConf lf
            ON
                lf.life_cycl_id = tkt.life_cycl_id
            INNER JOIN
                StPriMtxConf mtx
            ON
                mtx.aff_level = tkt.aff_level AND mtx.severity = tkt.severity
            INNER JOIN
                StPriConf pri
            ON
                mtx.priority = pri.priority
            WHERE
                tkt.logl_del = FALSE AND not lf.is_timed
            GROUP BY
                pri.priority";
        $this->query_GetAverageTicketTimeForNonActiveInEachPriorty = $this->db->prepare( $this->sql_GetAverageTicketTimeForNonActiveInEachPriorty );

        $this->sql_GetAverageDifferenceTimeInEachPriority = "
            SELECT
                pri.name as NAME, SUM(tkt.last_open_time) as SUM_TIME, tkt.last_mdfd_tmst, SUM(tkt.expct_hours) as SUM_EXPCT, COUNT(*) as COUNT
            FROM
                StTktInst tkt
            INNER JOIN
                StLfeCyclConf lf
            ON
                lf.life_cycl_id = tkt.life_cycl_id
            INNER JOIN
                StPriMtxConf mtx
            ON
                mtx.aff_level = tkt.aff_level AND mtx.severity = tkt.severity
            INNER JOIN
                StPriConf pri
            ON
                mtx.priority = pri.priority
            WHERE
                tkt.logl_del = FALSE AND not lf.is_timed
            GROUP BY
                pri.priority";
        $this->query_GetAverageDifferenceTimeInEachPriority = $this->db->prepare( $this->sql_GetAverageDifferenceTimeInEachPriority );
    }
}
?>