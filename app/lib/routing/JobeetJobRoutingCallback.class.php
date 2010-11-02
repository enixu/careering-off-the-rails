<?php

class JobeetJobRoutingCallback extends AgaviRoutingCallback
{
	private function clean($str)
	{
		$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
		$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
		$clean = strtolower(trim($clean, '-'));
		$clean = preg_replace("/[\/_|+ -]+/", '-', $clean);

		if (empty($clean)) {
			return 'n-a';
		}
		return $clean;
	}

	public function onGenerate(array $defaultParameters, array &$userParameters, array &$options)
	{
		if (isset($userParameters['job'])) {
			$job = $userParameters['job']->getValue();

			if ($job instanceof \Jobeet\Job) {
				$userParameters['id']       = $job->getId();
				$userParameters['company']  = $this->clean($job->getCompany());
				$userParameters['location'] = $this->clean($job->getLocation());
				$userParameters['position'] = $this->clean($job->getPosition());
			}
			$userParameters['job'] = null;
		}

		return parent::onGenerate($defaultParameters, $userParameters, $options);
	}
}

?>