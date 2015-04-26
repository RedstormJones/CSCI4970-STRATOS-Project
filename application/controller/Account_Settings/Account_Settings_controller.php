<?php
require_once('../../globals.php');
require APP . 'controller\Base_Controller.php';
class Account_Settings_Controller Extends Base_Controller
{
	public function showUserSettings()
	{
		$_pid = $_SESSION['pid'];
		$Account_Settings = $this->model->showUserSettings( $_pid );
		$rows = array();
        $fname           = isset($Account_Settings->fname) ? $Account_Settings->fname : "";
		$lname           = isset($Account_Settings->lname) ? $Account_Settings->lname : "";
		$user           = isset($Account_Settings->user) ? $Account_Settings->user : "";
		$email           = isset($Account_Settings->email) ? $Account_Settings->email : "";
		
		$phones = $this->model->showPhoneSettings( $_pid );
		foreach( $phones as $phone )
		{
			$type 			 = isset($phone->type) ? $phone->type : "";
            $intl 			 = isset($phone->intl) ? $phone->intl : "";
            $area         		= isset($phone->area) ? $phone->area : "";
            $phone1           = isset($phone->phone1) ? $phone->phone1 : "";
            $phone2            = isset($phone->phone2) ? $phone->phone2 : "";
			$rows[]         = array( $type, $intl, $area, $phone1, $phone2 );
		}
		$this->view->render_Account_Settings($_pid, $fname, $lname, $user, $email, $rows);
	}
        
    public function showAccountSettingsForm()
	{
		$this->view->renderForm($fname, $lname, $user, $email);
	}
	public function noAction()
	{
		$this->showUserSettings();
	}
	
	public function Update_Account_Settings()
	{
		$pid					= $this->validate_input(		getParam("pid") );
		$fname 					= $this->validate_input(		getParam("fname",null));
		$lname 					= $this->validate_input(		getParam("lname",null));
		$email 					= $this->validate_input(		getParam("email",null));
		
		$phones = array();
		
		for ( $i = 0; $i < 5; ++$i )
		{
			$type 					= $this->validate_input( 		getParam("phone_type_".$i,null));
			$intl 					= $this->validate_input(		getParam("phone_intl_".$i,null));
			$area 					= $this->validate_input(		getParam("phone_area_".$i,null));
			$phone1 				= $this->validate_input(		getParam("phone_phone1_".$i,null));
			$phone2 				= $this->validate_input(		getParam("phone_phone2_".$i,null));
			
			if ( $type != '' or $intl != '' or $area != '' or $phone1 != '' or $phone1 != '' )
				$phones[] = array( $type, $intl, $area, $phone1, $phone2 );
		}
        

        $result = $this->model->UpdateAccountSettingsUser($pid, $fname, $lname, $email);
		if ( $result ) $result = $this->model->UpdateAccountSettingsPhone( $pid, $phones );
        if(!$result)
        {
            $this->view->renderBody("Error: Edit user failed in database");
        }
        else
        {
            ?>
                <script type="text/javascript">
					alert("Your account has been updated");
                    window.location.href = 'Account_Settings_index.php';
                </script>
            <?php
			
        }
	}

    public function validate_input($data)
    {
        if(!$data)
        {
             return "";
        }
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}

?>
