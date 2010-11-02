<?php

class Jobs_AddAction extends JobeetJobsBaseAction
{

	/**
	 * Handles the Write request method.
	 *
	 * @parameter  AgaviRequestDataHolder the (validated) request data
	 *
	 * @return     mixed <ul>
	 *                     <li>A string containing the view name associated
	 *                     with this action; or</li>
	 *                     <li>
	 *                     An array with two indices: the parent module
	 *                     of the view to be executed and the view to be
	 *                     executed.</li>
	 *                   </ul>^
	 */
	public function executeWrite(AgaviRequestDataHolder $rd)
	{
		$em = $this->getEntityManager();

		$job = new \Jobeet\Job($this->getContext());

		$job->setCategory($rd->getParameter('category'));
		$job->setType($rd->getParameter('type'));
		$job->setCompany($rd->getParameter('company'));
		$job->setUrl($rd->getParameter('url'));
		$job->setPosition($rd->getParameter('position'));
		$job->setLocation($rd->getParameter('location'));
		$job->setDescription($rd->getParameter('description'));
		$job->setHowToApply($rd->getParameter('how_to_apply'));
		$job->setEmail($rd->getParameter('email'));

		if ($rd->hasParameter('is_public')) {
			$job->setStatus(\Jobeet\Job::STATUS_PUBLIC);
		}

		if ($rd->hasFile('logo')) {
			$job->setLogoFile($rd->getFile('logo'));
		}

		$em->persist($job);
		$em->flush();

		$this->setAttribute('job', $job);

		return 'Success';
	}

	/**
	 * Handles the Write request method's errors.
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
	public function handleWriteError(AgaviRequestDataHolder $rd)
	{
		return 'Input';
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
		return 'Input';
	}
}

?>