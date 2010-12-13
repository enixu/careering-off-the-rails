<?php

class Jobs_Index_SuccessView extends JobeetJobsBaseView
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
		$em = $this->getEntityManager();

		$categories = $em->getRepository('Jobeet\Category')->getWithJobs();
		$jobsCount = array();

		// find active jobs for each category
		$jobRepository = $em->getRepository('Jobeet\Job');
		foreach($categories as $category) {
			$slot = $this->createSlotContainer('Jobs', 'List', array('jobs' =>
				$jobRepository->getActiveJobsByCategory($category, AgaviConfig::get('jobeet.jobs_per_index_category'))));

			$this->getLayer('content')->setSlot(sprintf('category[%d]', $category->getId()), $slot);

			$jobsCount[$category->getId()] = $jobRepository->getActiveJobsByCategoryCount($category);
		}

		$this->setAttribute('_title', $this->getContext()->getTranslationManager()->_('Your best job board'));
		$this->setAttribute('categories', $categories);
		$this->setAttribute('job_count', $jobsCount);
	}

	/**
	 * Handles the Atom output type.
	 *
	 * @parameter  AgaviRequestDataHolder the (validated) request data
	 *
	 * @return     mixed <ul>
	 *                     <li>An AgaviExecutionContainer to forward the execution to or</li>
	 *                     <li>Any other type will be set as the response content.</li>
	 *                   </ul>
	 */
	public function executeAtom(AgaviRequestDataHolder $rd)
	{
		$this->setupAtom($rd);

		$jobs = $this->getEntityManager()->getRepository('Jobeet\Job')->getActiveJobs(AgaviConfig::get('jobeet.jobs_per_page'));

		$this->getLayer('content')->setSlot('jobs', $this->createSlotContainer('Jobs', 'List', array('jobs' => $jobs)));

		if (count($jobs)) {
			$this->setAttribute('created_at', $jobs[0]->getCreatedAt());
		}
	}
}

?>