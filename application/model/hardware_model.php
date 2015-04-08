<?php
include "Base_Model.php";

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
                                        logl_del = FALSE;";
                
                $this->sql_InsertTicket = "
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
        
        $this->query_ShowAllHardware = $this->db->prepare($this->sql_ShowAllHardware);
        $this->query_InsertTicket = $this->db->prepare($this->sql_InsertTicket);

    }

    public function showAllHardware()
    {
        $this->query_ShowAllHardware->execute();
        return $this->query_ShowAllHardware->fetchAll();
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
            $result = $this->query_InsertTicket->execute(
                    array( ':eid'			=> $eid
                             , ':name'                  => $name
                             , ':vendor'		=> $vendor
                             , ':model'         	=> $model
                             , ':serial'		=> $serial
                             , ':type'			=> $type
                             , ':loc'                   => $loc
                             , ':status'		=> $status
                             )
                    );
            return $result;
    }
}

?>
