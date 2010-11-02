<?php

class JobeetUser extends AgaviSecurityUser
{
	public function setFlash($type, $message)
	{
		return $this->setAttribute($type, $message, 'flash');
	}

	public function hasFlash($type)
	{
		return $this->hasAttribute($type, 'flash');
	}

	public function getFlash($type)
	{
		return $this->removeAttribute($type, 'flash');
	}

	public function addJobToHistory(\Jobeet\Job $job)
	{
		$history = $this->getAttribute('job_history', null, array());

		$free = true;
		foreach($history as $oldJob) {
			if ($oldJob->getId() == $job->getId()) {
				$free = false; break;
			}
		}

		if ($free) {
			array_unshift($history, $job);
			$this->setAttribute('job_history', array_slice($history, 0, 3));
		}
	}

	public function getJobHistory()
	{
		return $this->getAttribute('job_history', null, array());
	}
}

?>