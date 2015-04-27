<?php
require_once("../../globals.php");
include "..\Base_View.php";


class Login_View Extends Base_View
{
	public function showLogin()
	{
        $body  = '<link rel="stylesheet" type="text/css" href="/public/css/style.css" />';
        $body .= '<div class="container">';
        $body .= '  <section id="content">';
        $body .= '      <form action="login_index.php" method="post">';
        $body .= '          <h1>PKI LOGIN</h1>';
        $body .= '          <div>';
        $body .= '              <input type="text" placeholder="Username" required="" id="username" name="username" />';
        $body .= '          </div>';
        $body .= '          <div>';
        $body .= '              <input type="password" placeholder="Password" required="" id="password" name="passwd" />';
        $body .= '          </div>';
        $body .= '          <div>';
        $body .= '              <input type="submit" value="Log In" name="action"/>';
        $body .= '          </div>';
        $body .= '      </form>';
        $body .= '  </section>';
        $body .= '</div>';

        echo $body;
	}
}