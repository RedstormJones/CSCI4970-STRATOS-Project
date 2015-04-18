<?php

class Base_View
{
	public function __construct()
	{

	}


/*
	public function _render($body)
	{
		echo   '<html>
				    <head>
				        <meta charset="utf-8"/>
				        <title>PKI - STRATOS</title>
				        <link rel="stylesheet" type="text/css" href="/public/css/style.css" /> 
				    </head>
				    <body>' . 
				    	$body .
				    '</body>
			    </html>';
	}
*/


	public function renderBody($body)
	{
		echo   '<html>
		    		<head>
		        		<meta charset="utf-8"/>
		        		<title>PKI - STRATOS</title>
		        		<link rel="stylesheet" type="text/css" href="/public/css/style.css" /> 
		    		</head>
		    		<body>
						<div id="header">
							<img src="/public/imgs/Header.jpg" alt="Header" width=100% height=7%>
						</div>
						<div id="bottom">
							<div id="menu">';
								require_once(APP . 'view\_templates\MenuBar.php');
		echo				   '<input type="text" src="/application/view/_templates/MenuBar.php">
								<div id="body" class="pagebody">';
		echo						$body;
		echo				   '</div>
							</div>
						</div>
					</body>
				</html>';
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