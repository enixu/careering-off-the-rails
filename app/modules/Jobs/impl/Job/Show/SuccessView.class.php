<?php

class Jobs_Job_Show_SuccessView extends JobeetJobsBaseView
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
		$job = $rd->getParameter('job');

		$this->setupHtml($rd);

		$this->setAttribute('_title', $job->getCompany());
		$this->setAttribute('job', $job);

		if ($rd->hasParameter('token')) {
			$this->getLayer('content')->setSlot('admin', $this->createSlotContainer('Jobs', 'Job/Admin', array('job' => $job)));
		}

		$this->getContext()->getUser()->addJobToHistory($job);
	}
}

?>