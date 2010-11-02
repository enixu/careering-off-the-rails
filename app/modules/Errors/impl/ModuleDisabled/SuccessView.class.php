<?php

class Errors_ModuleDisabled_SuccessView extends JobeetErrorsBaseView
{
	public function executeHtml(AgaviRequestDataHolder $rd)
	{
		$this->setAttribute('_title', 'Module Disabled');
		
		$this->setupHtml($rd);
		
		$this->getResponse()->setHttpStatusCode('503');
	}
}

?>
