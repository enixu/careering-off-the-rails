<?php

class Jobs_List_SuccessView extends JobeetJobsBaseView
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
		$this->setupHtml($rd, 'slot');
		$this->setAttribute('jobs', $rd->getParameter('jobs'));
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
		$this->setAttribute('jobs', $rd->getParameter('jobs'));
	}
}

?>