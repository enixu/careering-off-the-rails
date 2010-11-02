<?php

class JobValidator extends AgaviValidator
{
	protected function validate()
	{
		$job = $this->getData($this->getArgument());

		if (!$job instanceof \Jobeet\Job) {
			$em = $this->getContext()->getDatabaseManager()->getDatabase()->getEntityManager();

			if (!$this->getParameter('by_token')) {
				$job = $em->find('Jobeet\Job', $job);
			} else {
				$job = $em->getRepository('Jobeet\Job')->findOneBy(array('token' => $job));
			}
		}

		if (!$job) {
			$this->throwError();
			return false;
		}

		$this->export($job);
		return true;
	}
}
?>