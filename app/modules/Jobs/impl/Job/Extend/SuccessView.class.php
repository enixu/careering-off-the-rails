<?php

class Jobs_Job_Extend_SuccessView extends JobeetJobsBaseView
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
		$ctx = $this->getContext();
		$tm  = $ctx->getTranslationManager();

		$ctx->getUser()->setFlash('notice',
			$tm->_('Your job validity has been extend until %s.', null, null, array($tm->_d($rd->getParameter('job')->getExpiresAt())))
		);

		$this->getResponse()->setRedirect($ctx->getRouting()->gen('jobs.job.show'));
	}
}

?>