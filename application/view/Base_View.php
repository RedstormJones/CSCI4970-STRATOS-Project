<?php

class Base_View
{
	public function __construct()
	{
		#$this->renderHome();
	}

	public function renderBody($body)
	{
		echo '<html>
		    <head>
		        <meta charset="utf-8"/>
		        <title>PKI - STRATOS</title>
		        <link rel="stylesheet" type="text/css" href="/public/css/style.css" /> 
		    </head>
			<body>
				<div id="header">';
					require APP . 'view\_templates\header.php';
		echo   '</div>
				<div id="bottom">
					<div id="menu">';
						require APP . 'view\_templates\MenuBar.php';
						echo '<div id="body" class="pagebody">';
						echo $body;
						echo '</div>
					</div>
				</div>
			</body>
		</html>';

		#require APP . 'view\_templates\theBetterPage.php';
		
		#$this->overwrite("<html>Hello World</html>");
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

	public function append()
	{
		;
	}

	public function clear()
	{
		;
	}
}

?>