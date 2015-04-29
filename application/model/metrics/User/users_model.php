<?php
require APP . 'model/metrics/Base_Model_Metrics.php';

class Users_Model extends Base_Model_Metrics
{
    public function GetActiveTicketsInEachPriorityByUser( $target_user_pid )
    {
        $this->query_GetActiveTicketsInEachPriorityByUser->execute( array( ':target_user_pid' => $target_user_pid) );
        return $this->query_GetActiveTicketsInEachPriority->fetchAll();
    }

    public function GetNonActiveTicketTimeInEachPriorityByUser( $target_user_pid )
    {
        $this->query_GetNonActiveTicketTimeInEachPriorityByUser->execute( array( ':target_user_pid' => $target_user_pid) );
        return $this->query_GetNonActiveTicketTimeInEachPriorityByUser->fetchAll();
    }

    public function GetAverageDifferenceTimeInEachPriortyByUser( $target_user_pid )
    {
        $this->query_GetAverageDifferenceTimeInEachPriortyByUser->execute( array( ':target_user_pid' => $target_user_pid) );
        return $this->query_GetAverageDifferenceTimeInEachPriortyByUser->fetchAll();
    }

    public function GetAllUsers()
    {
        $this->query_GetAllUsers->execute();
        return $this->query_GetAllUsers->fetchAll();
    }

    public function SetUpQueries()
    {
        parent::SetUpQueries();

        $this->sql_GetActiveTicketsInEachPriorityByUser = "
            SELECT
                pri.name, COUNT(*)
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
                tkt.logl_del = FALSE AND lf.is_timed AND tkt.assignee = :target_user_pid
            GROUP BY
                pri.priority";
        $this->query_GetActiveTicketsInEachPriorityByUser = $this->db->prepare( $this->sql_GetActiveTicketsInEachPriorityByUser );

        $this->sql_GetNonActiveTicketTimeInEachPriorityByUser = "
            SELECT
                pri.name, SUM(tkt.last_open_time) as SUM_TIME, COUNT(*) as COUNT
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
                tkt.logl_del = FALSE AND not lf.is_timed AND tkt.assignee = :target_user_pid
            GROUP BY
                pri.priority";
        $this->query_GetNonActiveTicketTimeInEachPriorityByUser = $this->db->prepare( $this->sql_GetNonActiveTicketTimeInEachPriorityByUser );

        $this->sql_GetAverageDifferenceTimeInEachPriortyByUser = "
            SELECT
                pri.name, SUM(tkt.last_open_time) as SUM_TIME, tkt.last_mdfd_tmst, SUM(tkt.expct_hours) as SUM_EXPCT, COUNT(*) as COUNT
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
                tkt.logl_del = FALSE AND not lf.is_timed AND tkt.assignee = :target_user_pid
            GROUP BY
                pri.priority";
        $this->query_GetAverageDifferenceTimeInEachPriortyByUser = $this->db->prepare( $this->sql_GetAverageDifferenceTimeInEachPriortyByUser );

        $this->sql_GetAllUsers = "
            SELECT
                StPrsnInst.pid, StPrsnInst.fname, StPrsnInst.lname
            FROM
                StPrsnInst
            INNER JOIN
                StUserInst
            ON
                StPrsnInst.pid = StUserInst.pid
            WHERE
                not StUserInst.logl_del";
        $this->query_GetAllUsers = $this->db->prepare( $this->sql_GetAllUsers );
    }
}
?>