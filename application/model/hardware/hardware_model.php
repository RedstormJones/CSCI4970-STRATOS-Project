<?php
require_once('../../globals.php');
require APP . 'model\Base_Model.php';

class Hardware_Model Extends Base_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->sql_ShowAllHardware = "
                        SELECT
                                `eid`
                              , `name`
                              , `vendor`
                              , `model`
                              , `serial`
                              , `type`
                              , `loc`
                              , `status`
                              , `last_mdfd_tmst`
                            FROM
                                `StEqpInst`
                            WHERE
                                logl_del = FALSE
                            LIMIT
                                :start, 10;";

        $this->sql_InsertHardware = "
                        INSERT INTO 
                                `StEqpInst` 
                                        ( `eid`
                                        , `name`
                                        , `vendor`
                                        , `model`
                                        , `serial`
                                        , `type`
                                        , `loc`
                                        , `status`
                                        , `last_mdfd_tmst` 
                                    ) 
                        VALUES 
                                        ( :eid
                                        , :name
                                        , :vendor
                                        , :model
                                        , :serial
                                        , :type
                                        , :loc
                                        , :status
                                        , CURRENT_TIME
                                        );";
        $this->sql_GetHardware ="
                         SELECT
                            *
                         FROM
                            `StEqpInst`
                         WHERE
                            eid = :eid";
        $this->sql_UpdateHardware =
            "UPDATE
                `StEqpInst`
             SET
                `name` = :name
              , `vendor` = :vendor
              , `model` = :model
              , `serial` = :serial
              , `type` = :type
              , `loc` = :loc
              , `status` = :status
             WHERE
                `eid` = :eid;";
        $this->sql_DeleteHardware = 
            "UPDATE
                `StEqpInst`
             SET
                `logl_del` = TRUE
             WHERE
                `eid` = :eid;";

        $this->query_ShowAllHardware = $this->db->prepare($this->sql_ShowAllHardware);
        $this->query_InsertHardware = $this->db->prepare($this->sql_InsertHardware);
        $this->query_GetHardware = $this->db->prepare($this->sql_GetHardware);
        $this->query_UpdateHardware = $this->db->prepare($this->sql_UpdateHardware);
        $this->query_DeleteHardware = $this->db->prepare($this->sql_DeleteHardware);
    }

    public function showAllHardware($start)
    {
        $this->query_ShowAllHardware->bindParam(':start',$start,PDO::PARAM_INT);
        $this->query_ShowAllHardware->execute();
        return $this->query_ShowAllHardware->fetchAll();
    }
    
    public function getHardware( $eid )
    {
        $this->query_GetHardware->execute( array( ':eid' => $eid ) );
        return $this->query_GetHardware->fetchAll();
    }

    public function getMenu($table)
    {
            $sql = "SELECT * FROM " . $table;
            $query = $this->db->prepare($sql);
            $query->execute();
            return $query->fetchAll();
    }

    public function addHardware($name, $vendor, $model, $serial, $type, $loc, $status)
    {
        
        $eid = $this->GetAndUpdateNextKey('steqpinst');
        $result = $this->query_InsertHardware->execute(
                array( ':eid'           => $eid
                         , ':name'      => $name
                         , ':vendor'    => $vendor
                         , ':model'     => $model
                         , ':serial'    => $serial
                         , ':type'      => $type
                         , ':loc'       => $loc
                         , ':status'    => $status
                         )
                );
        return $result;
    }
    
    public function deleteHardware( $eid )
    {
        $result = $this->query_DeleteHardware->execute( array( ":eid" => $eid ) );
        return $result;
    }
    
    public function updateHardware( $eid, $name, $vendor, $model, $serial, $type, $loc, $status)
    {
        $result = $this->query_UpdateHardware->execute(
            array(':eid'       => $eid
                , ':name'      => $name
                , ':vendor'    => $vendor
                , ':model'     => $model
                , ':serial'    => $serial
                , ':type'      => $type
                , ':loc'       => $loc
                , ':status'    => $status
                 )
            );
        return $result;
    }
}

?>
