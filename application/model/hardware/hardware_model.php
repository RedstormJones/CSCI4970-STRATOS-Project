<?php
require APP . 'model\Base_Model.php';

class Hardware_Model Extends Base_Model
{

	/**
	* Collect all hardware information from the hardware table 
	* 
	* @param $start : String ( hold the table information)
	*/
    public function showAllHardware($start)
    {
        $this->query_ShowAllHardware->bindParam(':start',$start,PDO::PARAM_INT);
        $this->query_ShowAllHardware->execute();
        return $this->query_ShowAllHardware->fetchAll();
    }
    
	/**
	* Collect specific hardware information from the database using the hardware number
	* 
	* @param $eid : Integer ( hold the hardware number )
	*/
    public function getHardware( $eid )
    {
        $this->query_GetHardware->execute( array( ':eid' => $eid ) );
        return $this->query_GetHardware->fetch();
    }

	/**
	* Add a new hardware to the database
	* 
	* @param $name : String ( hold the new hardware's name )
	* @param $vendor : String ( hold the new hardware's vendor)
	* @param $model : String ( hold the new hardware's model)
	* @param $serial : String ( hold the new hardware's serial number)
	* @param $type : String ( hold the new hardware's type)
	* @param $loc : String ( hold the new hardware's location)
	* @param $status : String ( hold the new hardware's status)
	* @param $user : String ( hold the name of the user who commit the addition) 
	*/
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

	/**
	* delete a hardware from the database
	* 
	* @param $eid : Integer ( hold the hardware number)
	* @param $user : String ( hold the name of the user who commit the deletion) 
	*/
    public function deleteHardware( $eid, $user )
    {
        $this->query_DeleteHardware->execute( 
            array( ":eid"               => $eid 
                 , ":last_mdfd_user"    => $user
                 )   
        );
    }
    

	/**
	* Update a hardware information to the database
	* 
	* @param $eid : Integer ( hold the hardware number)
	* @param $name : String ( hold the hardware's name)
	* @param $vendor : String ( hold the hardware's vendor)
	* @param $model : String ( hold the hardware's model)
	* @param $serial : String ( hold the hardware's serial number)
	* @param $type : String ( hold the hardware's type)
	* @param $loc : String ( hold the hardware's location)
	* @param $status : String ( hold the hardware's status)
	* @param $user : String ( hold the name of the user who commit the addition) 
	*/
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

	/**
	* Database Queries
	* Display hardware
	* Delete, update, and add hardware
	*/
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
