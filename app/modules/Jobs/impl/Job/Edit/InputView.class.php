<?php

class Jobs_Job_Edit_InputView extends JobeetJobsBaseView
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
		$tm   = $this->getContext()->getTranslationManager();
		$job  = $rd->getParameter('job');

		$this->setupHtml($rd);
		$this->setAttribute('_page_title', $tm->_('Edit Job'));
		$this->setAttribute('categories', $this->getEntityManager()->getRepository('Jobeet\Category')->findAll());

		// Populate form
		$populate =& $this->getContext()->getRequest()->getAttribute('populate', 'org.agavi.filter.FormPopulationFilter');
		$populate = new AgaviParameterHolder(array(
			'category_id'  => $job->getCategory()->getId(),
			'type'         => $job->getType(),
			'company'      => $job->getCompany(),
			'url'          => $job->getUrl(),
			'position'     => $job->getPosition(),
			'location'     => $job->getLocation(),
			'description'  => $job->getDescription(),
			'how_to_apply' => $job->getHowToApply(),
			'is_public'    => (bool)($job->getStatus() & \Jobeet\Job::STATUS_PUBLIC),
			'email'        => $job->getEmail()
		));

		$this->getLayer('content')->setTemplate('Add/Input');
	}
}

?>