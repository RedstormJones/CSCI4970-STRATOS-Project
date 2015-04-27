<?php

class Base_View
{
	public function __construct()
	{

	}

	public function renderBody($body)
	{
        $head  = '<html>';
        $head .= '  <head>';
        $head .= '      <meta charset="utf-8"/>';
        $head .= '      <title>PKI - STRATOS</title>';
        $head .= '      <link rel="stylesheet" type="text/css" href="/public/css/style.css" />';
        $head .= '  </head>';
        $head .= '  <body>';
        $head .= '      <div id="header">';
        $head .= '          <img src="/public/imgs/Header.jpg" alt="Header" width=100% height=7%>';
        $head .= '      </div>';
        $head .= '      <div id="bottom">';
        $head .= '          <div id="menu">';

        $tail  = '              <input type="text" src="/application/view/_templates/MenuBar.php">';
        $tail .= '          </div>';
        $tail .= '          <div id="body" class="pagebody">';
        $tail .=                $body;
        $tail .= '          </div>';
        $tail .= '      </div>';
        $tail .= '  </body>';
        $tail .= '</html>';

        echo $head;
            require_once(APP . 'view\_templates\MenuBar.php');
        echo $tail;
	}
}

?>