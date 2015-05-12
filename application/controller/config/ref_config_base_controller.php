<?php
require APP . 'controller\Base_Controller.php';

class Ref_Config_Base_Controller Extends Base_Controller
{
   #---------------------------------------------#
   # Instructs the model to update configuration #
   # data and remove the old data                #
   #---------------------------------------------#
   public function Reassign_and_Delete()
   {
      $original = $this->globals->getParam( 'original' , null );
      $reassign = $this->globals->getParam( 'reassign' , null );
      $this->model->reassignAndDelete( $original, $reassign, $this->user );
      $this->startFresh();
   }
   
   #-------------#
   # Update form #
   #-------------#
   public function Update()
   {
      $this->addOrUpdate( true );
   }

   #----------#
   # New form #
   #----------# 
   public function Add()
   {
      $this->addOrUpdate( false );
   } 
}

?>
