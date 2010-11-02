<?php

class Jobs_Add_InputView extends JobeetJobsBaseView
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
		$lang = $tm->getCurrentLocale()->getLocaleLanguage();

		$this->setupHtml($rd);
		$this->setAttribute('_page_title', $tm->_('New Job'));
		$this->setAttribute('categories', $this->getEntityManager()->getRepository('Jobeet\Category')->findAll());
	}
}

?>