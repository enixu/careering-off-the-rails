<?php

class Jobs_Job_Delete_InputView extends JobeetJobsBaseView
{


	/**
	 * Handles the Html output type.
	 *
	 * @parameter  AgaviRequestDataHolder the (validated) request data
	 *
	 * @return     mixed <ul>
	 *                     <li>An AgaviExecutionContainer to forward the execution to or</li>
	 *                     <li>Any other type will be set as the response content.</li>
	 *                   </ul>
	 */
	public function executeHtml(AgaviRequestDataHolder $rd)
	{
		$this->setupHtml($rd);

		$this->setAttribute('_page_title', $this->getContext()->getTranslationManager()->_('Delete Job'));
		$this->setAttribute('job', $rd->getParameter('job'));
	}
}

?>