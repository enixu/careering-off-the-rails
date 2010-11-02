<?php

class Jobs_Search_SuccessView extends JobeetJobsBaseView
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
		$jobs = $this->getEntityManager()->getRepository('Jobeet\Job')->getForLuceneQuery($rd->getParameter('query'));

		if (in_array('ajax', $this->getContext()->getRequest()->getAttribute('matched_routes', 'org.agavi.routing'))) {
			// Don't load the decorators
			$this->setupHtml($rd, 'slot');
		} else {
			$this->setupHtml($rd);
		}

		$this->setAttribute('_title', 'Search');
		$this->setAttribute('jobs', $jobs);

		$this->getLayer('content')->setTemplate('List/Success');
	}
}

?>