<?php
require APP . 'controller\Base_Controller.php';

class Ref_Config_Base_Controller Extends Base_Controller
{
   /**
   * Uses the getParam() method to find the original config value and the new config value to
   * a reassign the setting to, then commands the model to update this information in the database.
   * Lastly, calls startFresh() to refreshed the application for displaying updated values
   */
   public function Reassign_and_Delete()
   {
      $original = $this->globals->getParam( 'original' , null );
      $reassign = $this->globals->getParam( 'reassign' , null );
      $this->model->reassignAndDelete( $original, $reassign, $this->user );
      $this->startFresh();
   }
   
   /**
   * Calls the addOrUpdate() method in the Base_Controller.php file and 
   * passes true as the parameter to indicate this is an update
   */
   public function Update()
   {
      $this->addOrUpdate( true );
   }

   /**
   * Calls the addOrUpdate() method in the Base_Controller.php file and 
   * passes false as the parameter to indicate this is a new addition
   */
   public function Add()
   {
      $this->addOrUpdate( false );
   } 
}

?>
