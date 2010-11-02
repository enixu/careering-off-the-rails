<?php

namespace Jobeet;

class JobRepository extends \Doctrine\ORM\EntityRepository
{
	public function getForLuceneQuery($query)
	{
		$index = $this->getEntityManager()->getConfiguration()->getContext()->getModel('LuceneJob')->getIndex();
		$keys  = array_map(function($v) { return $v->pk; }, $index->find($query));

		// Doctrine 2 fails if you give it an empty array for whereIn.
		if (!count($keys)) {
			return array();
		}

		$q = $this->createQueryBuilder('j');
		
		$q->where($q->expr()->in('j.id', $keys))->setMaxResults(20);

		$q = $this->addActiveJobsQuery($q)->getQuery();
		
		return $q->getResult();
	}

	public function getActiveJobs($max = 10)
	{
		$q = $this->createQueryBuilder('j')
			->setMaxResults($max);

		$q = $this->addActiveJobsQuery($q)->getQuery();

		return $q->getResult();
	}

	public function getActiveJobsByCategory(\Jobeet\Category $category, $max = 10, $page = 1)
	{
		$q = $this->createQueryBuilder('j')
			->where('j.category = :category')
			->setFirstResult(($page - 1) * $max)
			->setParameter('category', $category);

		if ($max !== null) {
			$q->setMaxResults($max);
		}

		$q = $this->addActiveJobsQuery($q)->getQuery();

		return $q->getResult();
	}

	public function getActiveJobsByCategoryCount(\Jobeet\Category $category)
	{
		$q = $this->createQueryBuilder('j')
			->select('COUNT(j.id)')
			->where('j.category = :category')
			->setParameter('category', $category);

		$count = $this->addActiveJobsQuery($q)->getQuery()->getResult();

		return $count[0][1];
	}

	protected function addActiveJobsQuery(\Doctrine\ORM\QueryBuilder $q = null)
	{
		if (is_null($q)) {
			$q = $this->createQueryBuilder('j');
		}

		$alias = $q->getRootAlias();

		$q->andWhere($alias .'.expiresAt > :expires_at')
			->andWhere($alias .'.status = :status')
			->addOrderBy($alias .'.expiresAt', 'DESC')
			->setParameter('expires_at', date('Y-m-d h:i:s', time()))
			->setParameter('status', \Jobeet\Job::STATUS_ACTIVATED | \Jobeet\Job::STATUS_PUBLIC);

		return $q;
	}
}

?>
