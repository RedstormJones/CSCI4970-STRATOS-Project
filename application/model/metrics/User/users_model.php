<?php
require APP . 'model/metrics/Base_Model_Metrics.php';

class Users_Model extends Base_Model_Metrics
{
    public function GetActiveTickets_IEP_ByUser( $target_user_pid )
    {
        $this->query_GetActiveTickets_IEP_ByUser->execute( array( ':target_user_pid' => $target_user_pid) );
        return $this->query_GetActiveTickets_IEP_ByUser->fetchAll();
    }

    public function GetNonActiveTicketTime_IEP_ByUser( $target_user_pid )
    {
        $this->query_GetNonActiveTicketTime_IEP_ByUser->execute( array( ':target_user_pid' => $target_user_pid) );
        return $this->query_GetNonActiveTicketTime_IEP_ByUser->fetchAll();
    }

    public function GetAverageDifferenceTime_IEP_ByUser( $target_user_pid )
    {
        $this->query_GetAverageDifferenceTime_IEP_ByUser->execute( array( ':target_user_pid' => $target_user_pid) );
        return $this->query_GetAverageDifferenceTime_IEP_ByUser->fetchAll();
    }

    public function GetAllUsers()
    {
        $this->query_GetAllUsers->execute();
        return $this->query_GetAllUsers->fetchAll();
    }

    public function SetUpQueries()
    {
        parent::SetUpQueries();

        $this->sql_GetActiveTickets_IEP_ByUser = "
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
                tkt.logl_del = FALSE AND lf.is_timed AND tkt.assignee = :target_user_pid
            GROUP BY
                pri.priority";
        $this->query_GetActiveTickets_IEP_ByUser = $this->db->prepare( $this->sql_GetActiveTickets_IEP_ByUser );

        $this->sql_GetNonActiveTicketTime_IEP_ByUser = "
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
                tkt.logl_del = FALSE AND not lf.is_timed AND tkt.assignee = :target_user_pid
            GROUP BY
                pri.priority";
        $this->query_GetNonActiveTicketTime_IEP_ByUser = $this->db->prepare( $this->sql_GetNonActiveTicketTime_IEP_ByUser );

        $this->sql_GetAverageDifferenceTime_IEP_ByUser = "
            SELECT
                pri.name as NAME, SUM(tkt.last_open_time) as SUM_TIME, SUM(tkt.expct_hours) as SUM_EXPCT, COUNT(*) as COUNT
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
        $this->query_GetAverageDifferenceTime_IEP_ByUser = $this->db->prepare( $this->sql_GetAverageDifferenceTime_IEP_ByUser );

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