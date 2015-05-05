<?php
require APP . 'view\Base_View.php';

class Home_View Extends Base_View
{
	public function renderHome($body)
	{
        #------------------------------------------------#
        # Uncomment the addition to $body below to make  #
        # the search bar appear on the STRATOS Home page #
        #------------------------------------------------#
        #$body .= '<div class="pull-right">
        #        <form class="form-inline" role="form">
        #            <div class="form-group">
        #                <label class="sr-only" for="search-text">Search Active Tickets :</label>
        #                <input type="text" id="search-text" placeholder="Enter Ticket #">
        #                <button type="button" id="search-btn">Search</button>
        #           </div>
        #        </form>
        #    </div>';
        
        $email = urlencode( "stpkiproject@gmail.com" );
		$body .= '<br><br>';
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