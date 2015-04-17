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
                
        $this->query_ShowAllSoftware = $this->db->prepare($this->sql_ShowAllSoftware);
        $this->query_InsertSoftware = $this->db->prepare($this->sql_InsertSoftware);
    }

    public function showAllSoftware($start)
    {
        $this->query_ShowAllSoftware->bindParam(':start',$start,PDO::PARAM_INT);
        $this->query_ShowAllSoftware->execute();
        return $this->query_ShowAllSoftware->fetchAll();
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
                array( ':sid'			=> $sid
                         , ':name'              => $name
                         , ':last_mdfd_user'	=> $last_mdfd_user)
                         );
        return $result;

    }
}

?>
