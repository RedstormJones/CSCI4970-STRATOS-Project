<?php
require_once('../../../globals.php');
require APP . 'controller\Base_Controller.php';

class Ref_Config_Base_Controller Extends Base_Controller
{
   public function Reassign_and_Delete()
   {
      $original = getParam( 'original' , null );
      $reassign = getParam( 'reassign' , null );
      $this->model->reassignAndDelete( $original, $reassign );
      $this->noAction();
   }
   
   public function Update()
   {
      $this->addOrUpdate( true );
   }

   public function Add()
   {
      $this->addOrUpdate( false );
   } 
}

?>
