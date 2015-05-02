<?php
require APP . 'model\Base_Model.php';

class Tickets_Model Extends Base_Model
{
    public function showAllTickets($start)
    {
        $this->query_ShowAllTickets->bindParam(':start',$start,PDO::PARAM_INT);
        $this->query_ShowAllTickets->execute();
        return $this->query_ShowAllTickets->fetchAll();
    }

    public function getAllPersons()
    {
        $this->query_GetAllPersons->execute();
        return $this->query_GetAllPersons->fetchAll();
    }

    public function getAllCategories()
    {
        $this->query_GetAllCategories->execute();
        return $this->query_GetAllCategories->fetchAll();
    }

    public function getAllAffectedLevels()
    {
        $this->query_GetAllAffectedLevels->execute();
        return $this->query_GetAllAffectedLevels->fetchAll();
    }

    public function getAllSeverityLevels()
    {
        $this->query_GetAllSeverityLevels->execute();
        return $this->query_GetAllSeverityLevels->fetchAll();
    }

    public function getAllLifecycles()
    {
        $this->query_GetAllLifecycles->execute();
        return $this->query_GetAllLifecycles->fetchAll();
    }

    public function getTicket( $tid )
    {
        $this->query_GetTicket->execute( array( ':tid' => $tid ) );
        return $this->query_GetTicket->fetch();
    }



    public function updateTicket( $tid, $title, $description, $opener, $assignee, $category, $aff_level, $severity, $expct_hours, $life_cycl_id, $user )
    {
        $this->query_UpdateTicket->execute(
            array( ':tid'                => $tid
                 , ':opener'             => $opener
                 , ':assignee'           => $assignee
                 , ':aff_level'          => $aff_level
                 , ':severity'           => $severity
                 , ':title'              => $title
                 , ':description'        => $description
                 , ':catg'               => $category
                 , ':life_cycl_id'       => $life_cycl_id
                 , ':expct_hours'        => $expct_hours
                 , ':last_open_time'     => $this->GetUpdatedTicketTimeByTid( $tid )
                 , ':last_mdfd_user'     => $user
                 )
        );
        $this->MailUpdateorAdd(TRUE, $title, $customer, $assignee);
    }

    public function deleteTicket( $tid, $user )
    {
        $this->query_DeleteTicket->execute( 
            array( ':tid'               => $tid 
                 , ':last_open_time'    => $this->GetUpdatedTicketTimeByTid( $tid )
                 , ':last_mdfd_user'    => $user
                 )   
        );
    }

    public function addTicket($title, $description, $customer, $assignee, $category, $affLvl, $severity, $lifecycle, $estTime, $user)
    {
        $this->query_InsertTicket->execute(
            array( ':opener'             => $customer
                 , ':assignee'           => $assignee
                 , ':aff_level'          => $affLvl
                 , ':severity'           => $severity
                 , ':title'              => $title
                 , ':description'        => $description
                 , ':catg'               => $category
                 , ':life_cycl_id'       => $lifecycle
                 , ':expct_hours'        => $estTime 
                 , ':last_mdfd_user'     => $user
                 )
            );
        $this->MailUpdateorAdd(FALSE, $title, $customer, $assignee);
    }

    protected function SetUpQueries()
    {
        parent::SetUpQueries();
        $this->sql_ShowAllTickets = "
            SELECT 
                  t.tid, t.title
                , c.name AS cname
                , p.name AS pname
                , l.name AS lname
                , t.insrt_tmst
                , t.last_mdfd_tmst 
            FROM 
                StTktInst AS t 
            INNER JOIN 
                StLfeCyclConf AS l 
            ON 
                t.life_cycl_id = l.life_cycl_id 
            INNER JOIN 
                StCatgConf AS c 
            ON 
                t.catg = c.cid 
            INNER JOIN 
                StPriMtxConf AS mtx 
            ON 
                t.aff_level = mtx.aff_level 
                AND 
                t.severity = mtx.severity 
            INNER JOIN 
                StPriConf AS p 
            ON 
                mtx.priority = p.priority 
            WHERE 
                t.logl_del = FALSE 
            ORDER BY 
                t.tid ASC
            LIMIT
                :start, 10";
        $this->query_ShowAllTickets = $this->db->prepare($this->sql_ShowAllTickets);

        $this->sql_InsertTicket = "
            INSERT INTO 
                `StTktInst` 
                ( `opener`
                , `assignee`
                , `aff_level`
                , `severity`
                , `title`
                , `description`
                , `catg`
                , `life_cycl_id`
                , `insrt_tmst`
                , `expct_hours`
                , `last_open_time`
                , `logl_del`
                , `last_mdfd_user`
                ) 
                VALUES 
                ( :opener
                , :assignee
                , :aff_level
                , :severity
                , :title
                , :description
                , :catg
                , :life_cycl_id
                , CURRENT_TIME
                , :expct_hours
                , 0
                , FALSE
                , :last_mdfd_user
                )";
        $this->query_InsertTicket = $this->db->prepare($this->sql_InsertTicket);

        $this->sql_GetAllPersons = "
            SELECT
                StPrsnInst.pid, fname, lname, user
            FROM
                `StPrsnInst`
            LEFT OUTER JOIN
                `StUserInst`
            ON
                StPrsnInst.pid = StUserInst.pid
            WHERE
                StPrsnInst.logl_del = FALSE";
        $this->query_GetAllPersons = $this->db->prepare($this->sql_GetAllPersons);

        $this->sql_GetAllCategories = "
            SELECT
                cid, name
            FROM
                `StCatgConf`
            WHERE
                logl_del = FALSE";
        $this->query_GetAllCategories = $this->db->prepare($this->sql_GetAllCategories);

        $this->sql_GetAllAffectedLevels = "
            SELECT
                aff_level, name
            FROM
                `StAffLvlConf`
            WHERE
                logl_del = FALSE";
        $this->query_GetAllAffectedLevels = $this->db->prepare($this->sql_GetAllAffectedLevels);

        $this->sql_GetAllSeverityLevels = "
            SELECT
                severity, name
            FROM
                `StSvrLvlConf`
            WHERE
                logl_del = FALSE";
        $this->query_GetAllSeverityLevels = $this->db->prepare($this->sql_GetAllSeverityLevels);

        $this->sql_GetAllLifecycles = "
            SELECT
                life_cycl_id, name
            FROM
                `StLfeCyclConf`
            WHERE
                logl_del = FALSE";
        $this->query_GetAllLifecycles = $this->db->prepare($this->sql_GetAllLifecycles);

        $this->sql_GetTicket = "
            SELECT
                *
            FROM
                `StTktInst`
            WHERE
                tid = :tid";
        $this->query_GetTicket = $this->db->prepare($this->sql_GetTicket);

        $this->sql_UpdateTicket = "
            UPDATE
                `StTktInst`
            SET
                `opener` = :opener
              , `assignee` = :assignee
              , `aff_level` = :aff_level
              , `severity` = :severity
              , `title` = :title
              , `description` = :description
              , `catg` = :catg
              , `life_cycl_id` = :life_cycl_id
              , `expct_hours` = :expct_hours
              , `last_open_time` = :last_open_time
              , `last_mdfd_user` = :last_mdfd_user
            WHERE
                `tid` = :tid";
        $this->query_UpdateTicket = $this->db->prepare($this->sql_UpdateTicket);

        $this->sql_DeleteTicket = "
            UPDATE
                `StTktInst`
            SET
                `logl_del` = TRUE
              , `last_open_time` = :last_open_time
              , `last_mdfd_user` = :last_mdfd_user
            WHERE
                `tid` = :tid;";
        $this->query_DeleteTicket = $this->db->prepare($this->sql_DeleteTicket);
        
        $this->sql_GetEmail = "
            SELECT 
                email
            FROM
                `StPrsnInst`
            WHERE
                `pid` = :pid;";
        $this->query_GetEmail = $this->db->prepare($this->sql_GetEmail);
    }
}

?>
