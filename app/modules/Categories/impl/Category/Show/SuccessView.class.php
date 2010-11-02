<?php

class Categories_Category_Show_SuccessView extends JobeetCategoriesBaseView
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

		$category = $rd->getParameter('category');
		$page = $rd->getParameter('page');

		$this->setAttribute('category', $category);
		$this->setAttribute('page_next', ceil($this->getAttribute('job_count') / AgaviConfig::get('jobeet.jobs_per_page')) > $page ? $page + 1 : $page);
		$this->setAttribute('page_prev', ($page > 1) ? $page - 1 : $page);
		$this->setAttribute('page_last', ceil($this->getAttribute('job_count') / AgaviConfig::get('jobeet.jobs_per_page')));
		$this->setAttribute('page', $page);

		$tm = $this->getContext()->getTranslationManager();

		$this->setAttribute('_title', $tm->_('Jobs in the %s category', null, null, array($category->getName())));
		$this->getLayer('content')->setSlot('jobs', $this->createSlotContainer('Jobs', 'List', array('jobs' => $this->getAttribute('jobs'))));
	}

	public function executeAtom(AgaviRequestDataHolder $rd)
	{
		$this->setupAtom($rd);

		$this->setAttribute('category', $rd->getParameter('category'));
		$this->getLayer('content')->setSlot('jobs', $this->createSlotContainer('Jobs', 'List', array('jobs' => $this->getAttribute('jobs'))));
	}
}

?>