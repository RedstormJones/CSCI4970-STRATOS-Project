<?php
require_once('../../globals.php');
require APP . 'model\Base_Model.php';
#include "..\Base_Model.php";

class Software_Model Extends Base_Model
{
    public function showAllSoftware($start)
    {
        $this->query_ShowAllSoftware->bindParam(':start',$start,PDO::PARAM_INT);
        $this->query_ShowAllSoftware->execute();
        return $this->query_ShowAllSoftware->fetchAll();
    }
    
    public function getSoftware( $sid )
    {
        $this->query_GetSoftware->execute( array( ':sid' => $sid ) );
        return $this->query_GetSoftware->fetch();
    }

    public function addSoftware($name)
    {
        $this->query_InsertSoftware->execute(
            array( ':sid'               => $sid
                 , ':name'              => $name
                 , ':last_mdfd_user'    => $last_mdfd_user
                 )
        );
    }
    
    public function deleteSoftware( $sid )
    {
        $this->query_DeleteSoftware->execute( 
            array( ":sid"               => $sid 
                 , ":last_mdfd_user"    => getCurrentUserName()
                 )             
        );
    }
    
    public function updateSoftware( $sid, $name)
    {
        $this->query_UpdateSoftware->execute(
            array( ':sid'               => $sid
                 , ':name'              => $name
                 , ':last_mdfd_user'    => getCurrentUserName()
                 )
        );
    }

    protected function SetUpQueries()
    {
        parent::SetUpQueries();
        $this->sql_ShowAllSoftware = "
            SELECT
                `sid`
              , `name`
              , `last_mdfd_user`
              , `last_mdfd_tmst`
            FROM
                `StSftInst`
            WHERE
                `logl_del` = FALSE
            LIMIT
                 :start, 10";
        $this->query_ShowAllSoftware = $this->db->prepare($this->sql_ShowAllSoftware);

        $this->sql_InsertSoftware = "
            INSERT INTO 
                `StSftInst` 
                ( `sid`
                , `name`
                , `last_mdfd_user`
                ) 
                VALUES 
                ( :sid
                , :name
                , :last_mdfd_user
                )";
        $this->query_InsertSoftware = $this->db->prepare($this->sql_InsertSoftware);

        $this->sql_GetSoftware ="
             SELECT
                *
             FROM
                `StSftInst`
             WHERE
                sid = :sid";
        $this->query_GetSoftware = $this->db->prepare($this->sql_GetSoftware);

        $this->sql_UpdateSoftware = "
            UPDATE
                `StSftInst`
            SET
                `name` = :name
              , `last_mdfd_user` = :last_mdfd_user
            WHERE
                `sid` = :sid";
        $this->query_UpdateSoftware = $this->db->prepare($this->sql_UpdateSoftware);

        $this->sql_DeleteSoftware = "
            UPDATE
                `StSftInst`
            SET
                `logl_del` = TRUE
              , `last_mdfd_user` = :last_mdfd_user
            WHERE
                `sid` = :sid";
        $this->query_DeleteSoftware = $this->db->prepare($this->sql_DeleteSoftware);                
    }
}
?>