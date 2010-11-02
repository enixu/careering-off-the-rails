<?php

class Categories_Category_ShowAction extends JobeetCategoriesBaseAction
{


	/**
	 * Handles the Read request method.
	 *
	 * @parameter  AgaviRequestDataHolder the (validated) request data
	 *
	 * @return     mixed <ul>
	 *                     <li>A string containing the view name associated
	 *                     with this action; or</li>
	 *                     <li>An array with two indices: the parent module
	 *                     of the view to be executed and the view to be
	 *                     executed.</li>
	 *                   </ul>^
	 */
	public function executeRead(AgaviRequestDataHolder $rd)
	{
		$page = $rd->getParameter('page', 1);

		$em = $this->getEntityManager();
		$jobRepository = $em->getRepository('Jobeet\Job');
		$category = $rd->getParameter('category');

		$this->setAttribute('jobs', $jobRepository->getActiveJobsByCategory($category, AgaviConfig::get('jobeet.jobs_per_page'), $page));
		$this->setAttribute('job_count', $jobRepository->getActiveJobsByCategoryCount($category));

		return 'Success';
	}

	/**
	 * Returns the default view if the action does not serve the request
	 * method used.
	 *
	 * @return     mixed <ul>
	 *                     <li>A string containing the view name associated
	 *                     with this action; or</li>
	 *                     <li>An array with two indices: the parent module
	 *                     of the view to be executed and the view to be
	 *                     executed.</li>
	 *                   </ul>
	 */
	public function getDefaultViewName()
	{
		return 'Error';
	}
}

?>