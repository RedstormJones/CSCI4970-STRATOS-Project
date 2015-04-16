<?php

class Base_View
{
	public function __construct()
	{
		#$this->renderHome();
	}

	public function _render($body)
	{
		echo   '<html>
				    <head>
				        <meta charset="utf-8"/>
				        <title>PKI - STRATOS</title>
				        <link rel="stylesheet" type="text/css" href="/public/css/style.css" /> 
				    </head>
				    <body> ' . 
				    	$body .
				    ' </body>
			    </html>';
	}

	public function renderBody($body)
	{
		$render = '';

			$render .=   '<div id="header">';
					$render .= '<img src="/public/imgs/Header.jpg" alt="Header" width=100% height=7%>';
			$render .=   '</div>
						<div id="bottom">
							<div id="menu">';
								require APP . 'view\_templates\MenuBar.php';
								$render .= '<div id="body" class="pagebody">';
									$render .= $body;
								$render .= '</div>
							</div>
						</div>';
		$this->_render($render);
	}

	public function getbody()
	{
		$dom = new DOMDocument();
		return $dom->getElementById("body");		
	}

	public function overwrite($str)
	{
		$body = $this->getbody();
		$body->loadHTML( $str );
	}

	public function append($str)
	{
		$body = $this->getbody();
		$newbod = $body . $str;

		$body->loadHTML( $newbod );
	}

	public function clear()
	{
		;
	}
}

?>