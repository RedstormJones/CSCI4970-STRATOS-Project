<?php
require_once('../../globals.php');
require APP . 'model\Base_Model.php';
class Account_Settings_model Extends Base_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->sql_showUserSettings = "
				SELECT
                                        `fname` AS fname
                                      , `lname` AS lname
                                      , `user` AS user
                                      , `email` AS email
                                    FROM
										`StUserInst`
									INNER JOIN
									    `StPrsnInst`
									ON
										StPrsnInst.pid = StUserInst.pid
									WHERE
										StPrsnInst.pid = :pid;";
										
		$this->sql_showPhoneNumber = "
				SELECT
                                        `pid`
                                      , `type`
                                      , `intl`
                                      , `area`
                                      , `phone1`
                                      , `phone2`
                                    FROM
                                        `StPhneInst`
									WHERE
										StPhneInst.pid = :pid;";
        $this->sql_UpdateUser = "
				UPDATE `StPrsnInst` 
									SET
									  `fname` = :fname
									, `lname` = :lname
									, `email` = :email
									where
										StPrsnInst.pid = :pid;";

        $this->sql_InsertPhone= "
				INSERT INTO
					`StPhneInst` 
					( `pid`
					, `type`
					, `intl`
					, `area`
					, `phone1`
					, `phone2`
					, `last_mdfd_user`
					)
					VALUES
					(
					  :pid
					, :type
					, :intl
					, :area
					, :phone1
					, :phone2
					, :last_mdfd_user
					);";
		$this->sql_DeletePhonesForUser = "
				DELETE FROM
					`StPhneInst`
				WHERE
					pid = :pid";
			
						
        
        $this->query_showUserSettings = $this->db->prepare($this->sql_showUserSettings);
		$this->query_showPhoneNumber = $this->db->prepare($this->sql_showPhoneNumber);
        $this->query_UpdateUser = $this->db->prepare($this->sql_UpdateUser);		
		$this->query_DeletePhonesForUser = $this->db->prepare($this->sql_DeletePhonesForUser);
		$this->query_InsertPhone = $this->db->prepare( $this->sql_InsertPhone );
    }
	
	public function showPhoneSettings( $pid )
	{
		$this->query_showPhoneNumber->execute( array(":pid" => $pid) );
		return $this->query_showPhoneNumber->fetchAll();
	}

    public function showUserSettings( $pid )
    {
        $this->query_showUserSettings->execute( array(":pid" => $pid) );
		$result = $this->query_showUserSettings->fetchAll();
		if ( count($result) )
			return $result[0];
        return $result;
    }
	public function UpdateAccountSettingsUser($pid, $fname, $lname, $email)
    {
			$result = $this->query_UpdateUser->execute(
						array(   ':fname'           	=> $fname
								 , ':lname'				=> $lname
								 , ':email'				=> $email
								 , ':pid'				=> $pid
								)
							);
			return $result;
	}
	public function UpdateAccountSettingsPhone($pid, $phones)
	{
			$this->query_DeletePhonesForUser->execute( array( ':pid' => $pid ) );
			foreach ( $phones as $phone )
			{
				$type = $phone[0];
				$intl = $phone[1];
				$area = $phone[2];
				$phone1 = $phone[3];
				$phone2 = $phone[4];
				$this->query_InsertPhone->execute(	
						array( 		':pid'				=> $pid
								  , ':type'             => $type
								  , ':intl'				=> $intl
								  , ':area'				=> $area
								  , ':phone1'         	=> $phone1
								  , ':phone2'			=> $phone2
								  , ':last_mdfd_user'	=> 'JVosik'
								 )			
						);
			}
			return true;
	}
	
	
}

?>
