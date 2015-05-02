<?php
require APP . 'model\Base_Model.php';

class Hardware_Model Extends Base_Model
{
    public function showAllHardware($start)
    {
        $this->query_ShowAllHardware->bindParam(':start',$start,PDO::PARAM_INT);
        $this->query_ShowAllHardware->execute();
        return $this->query_ShowAllHardware->fetchAll();
    }
    
    public function getHardware( $eid )
    {
        $this->query_GetHardware->execute( array( ':eid' => $eid ) );
        return $this->query_GetHardware->fetch();
    }

    public function addHardware($name, $vendor, $model, $serial, $type, $loc, $status, $user)
    {
        $this->query_InsertHardware->execute(
            array( ':name'              => $name
                 , ':vendor'            => $vendor
                 , ':model'             => $model
                 , ':serial'            => $serial
                 , ':type'              => $type
                 , ':loc'               => $loc
                 , ':status'            => $status
                 , ':last_mdfd_user'    => $user
                 )
        );
    }
    
    public function deleteHardware( $eid, $user )
    {
        $this->query_DeleteHardware->execute( 
            array( ":eid"               => $eid 
                 , ":last_mdfd_user"    => $user
                 )   
        );
    }
    
    public function updateHardware( $eid, $name, $vendor, $model, $serial, $type, $loc, $status, $user)
    {
        $this->query_UpdateHardware->execute(
            array(':eid'                => $eid
                , ':name'               => $name
                , ':vendor'             => $vendor
                , ':model'              => $model
                , ':serial'             => $serial
                , ':type'               => $type
                , ':loc'                => $loc
                , ':status'             => $status
                , ':last_mdfd_user'     => $user
                )
        );
    }

    protected function SetUpQueries()
    {
        parent::SetUpQueries();
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
                :start, 10";
        $this->query_ShowAllHardware = $this->db->prepare($this->sql_ShowAllHardware);

        $this->sql_InsertHardware = "
            INSERT INTO 
                `StEqpInst` 
                ( `name`
                , `vendor`
                , `model`
                , `serial`
                , `type`
                , `loc`
                , `status`
                , `last_mdfd_user` 
                ) 
                VALUES 
                ( :name
                , :vendor
                , :model
                , :serial
                , :type
                , :loc
                , :status
                , :last_mdfd_user
                )";
        $this->query_InsertHardware = $this->db->prepare($this->sql_InsertHardware);
        
        $this->sql_GetHardware = "
             SELECT
                *
             FROM
                `StEqpInst`
             WHERE
                eid = :eid";
        $this->query_GetHardware = $this->db->prepare($this->sql_GetHardware);

        $this->sql_UpdateHardware = "
            UPDATE
                `StEqpInst`
            SET
                `name` = :name
              , `vendor` = :vendor
              , `model` = :model
              , `serial` = :serial
              , `type` = :type
              , `loc` = :loc
              , `status` = :status
              , `last_mdfd_user` = :last_mdfd_user
            WHERE
                `eid` = :eid";
        $this->query_UpdateHardware = $this->db->prepare($this->sql_UpdateHardware);

        $this->sql_DeleteHardware = "
            UPDATE
                `StEqpInst`
            SET
                `logl_del` = TRUE
              , `last_mdfd_user` = :last_mdfd_user
            WHERE
                `eid` = :eid;";
        $this->query_DeleteHardware = $this->db->prepare($this->sql_DeleteHardware);
    }
}

?>
