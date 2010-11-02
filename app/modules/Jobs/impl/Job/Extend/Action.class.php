<?php

class Jobs_Job_ExtendAction extends JobeetJobsBaseAction
{


	/**
	 * Handles the Write request method.
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
	public function executeWrite(AgaviRequestDataHolder $rd)
	{
		$rd->getParameter('job')->extend();

		$this->getEntityManager()->flush();

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