<?php

namespace Jobeet;

class CategoryRepository extends \Doctrine\ORM\EntityRepository
{
	public function getWithJobs()
	{
		$query = $this->createQueryBuilder('c')
			->select('c, j')
			->leftJoin('c.jobs', 'j')
			->where('j.expiresAt > ?1 AND j.status = ?2')
			->setParameter(1, date('Y-m-d h:i:s', time()))
			->setParameter(2, \Jobeet\Job::STATUS_ACTIVATED | \Jobeet\Job::STATUS_PUBLIC)
			->getQuery();

		return $query->getResult();
	}

	public function findOneBySlugName($name) {
		$query = $this->createQueryBuilder('c')
			->leftJoin('c.translations', 't')
			->where('t.name = ?1 AND t.lang = ?2')
			->setParameter(1, $name)
			->setParameter(2, 'en')
			->setMaxResults(1)
			->getQuery();

		return $query->getSingleResult();
	}
}

?>