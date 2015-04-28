<?php

class Base_Controller
{
	protected $model;
	protected $view;
	protected $index;

	public function __construct(Base_Model $model, Base_View $view, $index)
	{
		$this->model = $model;
		$this->view = $view;
		$this->index = $index;
	}

	public function noAction()
	{
		$this->view->renderBody("ERR: No action");
	}

	public function renderBody($body)
	{
		$this->view->renderBody($body);
	}

	public function simpleRedirect( $url )
	{
		echo '<script type="text/javascript"> window.location.href = "' . $url . '" </script>';
    }

	public function startFresh()
	{
		$this->simpleRedirect( $this->index );
	}

    public function validateInputNotEmpty( $data )
    {
        $data = $this->validateInput( $data );
        if ( $data == '' )
        {
            return $data;
        }
        else
        {
            return $data;
        }
    }

    public function validateInput( $data, $allowNull = false )
    {
        if( $data == null )
        {
            if ( $allowNull ) return null;
            else return "";
        }

        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function preCall()
    {
        $this->model->startTransaction();
    }

    public function postCall( $succeeded )
    {
        $this->model->endTransaction( $succeeded );
    }

    public function handleException( $e )
    {
        $this->renderBody( $e );
    }
}

?>
