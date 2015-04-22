<?php
require_once('../../globals.php');
require APP . 'model\Base_Model.php';
#include "..\Base_Model.php";

class Software_Model Extends Base_Model
{
    public function __construct()
    {
        parent::__construct();
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
                                 :start, 10;";

        $this->sql_InsertSoftware = "
                            INSERT INTO 
                                    `StSftInst` 
                                            ( `sid`
                                            , `name`
                                            , `last_mdfd_user`
                                            , `last_mdfd_tmst` 
                                        ) 
                            VALUES 
                                            ( :sid
                                            , :name
                                            , :last_mdfd_user
                                            , CURRENT_TIME
                                            );";
        $this->sql_GetSoftware ="
                         SELECT
                            *
                         FROM
                            `StSftInst`
                         WHERE
                            sid = :sid";
        $this->sql_UpdateSoftware =
                        "UPDATE
                            `StSftInst`
                         SET
                            `name` = :name
                         WHERE
                            `sid` = :sid;";
        $this->sql_DeleteSoftware = 
                        "UPDATE
                            `StSftInst`
                         SET
                            `logl_del` = TRUE
                         WHERE
                            `sid` = :sid;";
                
        $this->query_ShowAllSoftware = $this->db->prepare($this->sql_ShowAllSoftware);
        $this->query_InsertSoftware = $this->db->prepare($this->sql_InsertSoftware);
        $this->query_GetSoftware = $this->db->prepare($this->sql_GetSoftware);
        $this->query_UpdateSoftware = $this->db->prepare($this->sql_UpdateSoftware);
        $this->query_DeleteSoftware = $this->db->prepare($this->sql_DeleteSoftware);
    }

    public function showAllSoftware($start)
    {
        $this->query_ShowAllSoftware->bindParam(':start',$start,PDO::PARAM_INT);
        $this->query_ShowAllSoftware->execute();
        return $this->query_ShowAllSoftware->fetchAll();
    }
    
    public function getSoftware( $sid )
    {
        $this->query_GetSoftware->execute( array( ':sid' => $sid ) );
        return $this->query_GetSoftware->fetchAll();
    }
    
    public function getMenu($table)
    {
            $sql = "SELECT * FROM " . $table;
            $query = $this->db->prepare($sql);
            $query->execute();
            return $query->fetchAll();
    }

    public function addSoftware($name)
    {
        $sid = $this->GetAndUpdateNextKey('stsftinst');
        $last_mdfd_user = 'TestDataLoad';
        $result = $this->query_InsertSoftware->execute(
                array( ':sid'           => $sid
                         , ':name'              => $name
                         , ':last_mdfd_user'    => $last_mdfd_user)
                         );
        return $result;
    }
    
    public function deleteSoftware( $sid )
    {
        $result = $this->query_DeleteSoftware->execute( array( ":sid" => $sid ) );
        return $result;
    }
    
    public function updateSoftware( $sid, $name)
    {
        $result = $this->query_UpdateSoftware->execute(
            array(':sid'       => $sid
                , ':name'      => $name
                 )
            );
        return $result;
    }
}
?>