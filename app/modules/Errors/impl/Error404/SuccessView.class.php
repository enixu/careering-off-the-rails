<?php

class Errors_Error404_SuccessView extends JobeetErrorsBaseView
{
	public function executeHtml(AgaviRequestDataHolder $rd)
	{
		$this->setAttribute('_title', '404 Not Found');
		
		$this->setupHtml($rd);

		$this->getResponse()->setHttpStatusCode('404');
	}
}

?>