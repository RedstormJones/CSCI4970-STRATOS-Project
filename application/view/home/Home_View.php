<?php
require APP . 'view\Base_View.php';

class Home_View Extends Base_View
{
	public function renderHome($body)
	{
        $email = urlencode( "stpkiproject@gmail.com" );
		$body .= '<br><br><br>';
		$body .= '<div align="center">';
        $body .= '  <iframe src="https://www.google.com/calendar/embed?src=' . $email . '&ctz=America/Chicago" 
                            style="border: 0" 
                            width="800" 
                            height="600" 
                            frameborder="0" 
                            scrolling="no" 
                            align="middle"
                    >;';
        $body .= '  </iframe>';
        $body .= '</div>';

		$this->renderBody($body);
	}
}

?>