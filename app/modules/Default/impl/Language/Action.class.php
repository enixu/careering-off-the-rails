<?php

class Default_LanguageAction extends JobeetDefaultBaseAction
{

	/**
	 * Handles all request methods.
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
	public function execute(AgaviRequestDataHolder $rd)
	{
		return 'Success';
	}

	/**
	 * Handle an error.
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
	public function handleError(AgaviRequestDataHolder $rd)
	{
		return 'Success';
	}
}

?>