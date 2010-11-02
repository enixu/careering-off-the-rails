<?php

class CategoryValidator extends AgaviValidator
{
	protected function validate()
	{
		$category = $this->getData($this->getArgument());

		if (!$category instanceof \Jobeet\Category) {
			$em = $this->getContext()->getDatabaseManager()->getDatabase()->getEntityManager();
			$category = $em->find('Jobeet\Category', $category);
		}

		if (!$category) {
			$this->throwError();
			return false;
		}

		$this->export($category);
		return true;
	}
}
?>