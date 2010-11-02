<?php

class Default_Language_SuccessView extends JobeetDefaultBaseView
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
		$this->getResponse()->setRedirect(
			$this->getContext()->getRouting()->gen('index', array('locale' => $rd->getParameter('lang', 'en')))
		);
	}
}

?>