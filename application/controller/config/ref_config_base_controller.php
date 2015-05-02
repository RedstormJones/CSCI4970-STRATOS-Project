<?php
require APP . 'controller\Base_Controller.php';

class Ref_Config_Base_Controller Extends Base_Controller
{
   public function Reassign_and_Delete()
   {
      $original = $this->globals->getParam( 'original' , null );
      $reassign = $this->globals->getParam( 'reassign' , null );
      $this->model->reassignAndDelete( $original, $reassign, $this->user );
      $this->startFresh();
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
