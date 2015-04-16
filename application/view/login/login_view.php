<?php
require_once("../../globals.php");
include "..\Base_View.php";


class Login_View Extends Base_View
{
	public function showLogin()
	{
		$body = 
			'<div class="container">
					<section id="content">
						<form action="login_index.php" method="post">
							<h1>PKI LOGIN</h1>
							<div>
								<input type="text" placeholder="Username" required="" id="username" name="username" />
							</div>
							<div>
								<input type="password" placeholder="Password" required="" id="password" name="passwd" />
							</div>
							<div>
								<input type="submit" value="Log In" name="action"/>
							</div>
						</form><!-- form -->
					</section><!-- content -->
				</div><!-- container -->';
		#echo $body;
		$this->_render($body);
	}
}