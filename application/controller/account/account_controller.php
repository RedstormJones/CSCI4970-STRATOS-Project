<?php
require_once('../../globals.php');
require APP . 'controller\Base_Controller.php';
class Account_Controller Extends Base_Controller
{
	public function showUserSettings()
	{
		$_pid               = $_SESSION['pid'];
		$Account_Settings   = $this->model->showUserSettings( $_pid );
		$rows               = array();
        $fname              = isset($Account_Settings->fname)   ? $Account_Settings->fname : "";
		$lname              = isset($Account_Settings->lname)   ? $Account_Settings->lname : "";
		$user               = isset($Account_Settings->user)    ? $Account_Settings->user : "";
		$email              = isset($Account_Settings->email)   ? $Account_Settings->email : "";
		
		$phones = $this->model->showPhoneSettings( $_pid );
		foreach( $phones as $phone )
		{
            $type           = isset($phone->type)   ? $phone->type      : "";
            $intl           = isset($phone->intl)   ? $phone->intl      : "";
            $area           = isset($phone->area)   ? $phone->area      : "";
            $phone1         = isset($phone->phone1) ? $phone->phone1    : "";
            $phone2         = isset($phone->phone2) ? $phone->phone2    : "";
            $rows[]         = array( $type, $intl, $area, $phone1, $phone2 );
        }
        $this->view->renderForm($_pid, $fname, $lname, $user, $email, $rows);
    }

    public function noAction()
    {
        $this->showUserSettings();
    }
    
    public function Update_Account_Settings()
    {
        $pid                = getParam("pid");
        $fname              = $this->validateInputNotEmpty(         getParam("fname",null));
        $lname              = $this->validateInputNotEmpty(         getParam("lname",null));
        $email              = $this->validateInputNotEmpty(         getParam("email",null));
        
        $phones = array();
        
        for ( $i = 0; $i < 3; ++$i )
        {
            $type           = $this->validateInput(                 getParam("phone_type_".$i,null));
            $intl           = $this->validateInput(                 getParam("phone_intl_".$i,null));
            $area           = $this->validateInput(                 getParam("phone_area_".$i,null));
            $phone1         = $this->validateInputNotEmpty(         getParam("phone_phone1_".$i,null));
            $phone2         = $this->validateInputNotEmpty(         getParam("phone_phone2_".$i,null));

            $deleted        = $this->validateInput(                 getParam("phone_del_".$i,null));
            
            if ( !$deleted )
                if ( $phone1 != '' && $phone2 != '' )
                    $phones[] = array( $type, $intl, $area, $phone1, $phone2 );
        }
        

        $this->model->UpdateAccountSettingsUser($pid, $fname, $lname, $email);
        $this->model->UpdateAccountSettingsPhone( $pid, $phones );
        $this->startFresh();
    }
}

?>
