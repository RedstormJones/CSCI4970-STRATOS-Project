<?php
require APP . 'view\Base_View.php';

class Home_View Extends Base_View
{
	public function renderHome($body)
	{
		$body .= '<br><br><br>';
		$body .= '<div align="center"><iframe src="https://www.google.com/calendar/embed?src=stpkiproject%40gmail.com&ctz=America/Chicago" style="border: 0" width="800" height="600" frameborder="0" scrolling="no" align="middle"></iframe></div>';
		$this->renderBody($body);
	}
}

?>