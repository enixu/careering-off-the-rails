<?php

namespace Jobeet;

/**
 * Job
 *
 * @Table(name="categories")
 * @Entity(repositoryClass="Jobeet\CategoryRepository")
 */
class Category extends \DomainObject
{
	/**
	 * @var integer $id
	 *
	 * @Column(name="id", type="integer", length=4)
	 * @Id
	 * @GeneratedValue
	 */
	protected $id;

	/**
	 * @var DateTime $createdAt
	 *
	 * @Column(name="created_at", type="datetime")
	 */
	protected $createdAt;

	/**
	 * @var DateTime $jobAddedAt
	 *
	 * @Column(name="job_added_at", type="datetime")
	 */
	protected $jobAddedAt;

	/**
	 * @var array translations
	 *
	 * @OneToMany(targetEntity="CategoryTranslation", mappedBy="category", cascade={"detach", "merge"})
	 */
	protected $translations;

	/**
	 * @var array jobs
	 *
	 * @OneToMany(targetEntity="Job", mappedBy="category")
	 */
	protected $jobs;

	protected $lang = 'en';

	const STATUS_PUBLIC = 1;

	public function __construct()
	{
		$this->createdAt = new \DateTime();
		$this->jobAddedAt = new \DateTime();
	}

	/**
	 * @preUpdate
	 */
	public function preUpdate()
	{
		$this->updatedAt = new \DateTime();
	}

	public function getId()
	{
		return $this->id;
	}

	public function getName()
	{
		$lang = $this->getContext()->getTranslationManager()->getCurrentLocale()->getLocaleLanguage();

		foreach($this->translations as $translation) {
			if ($translation->getLang() == $lang)
				return $translation->getName();
		}
		return $this->translations[0]->getName();
	}

	public function getSlugName()
	{
		foreach($this->translations as $translation) {
			if ($translation->getLang() == 'en')
				return strtolower($translation->getName());
		}
	}

	public function getTranslations()
	{
		return $this->translations;
	}

	public function getJobs()
	{
		return $this->jobs;
	}

	public function setJobAddedAt(\DateTime $datetime)
	{
		$this->jobAddedAt = $datetime;
	}

	public function getJobAddedAt()
	{
		return $this->jobAddedAt;
	}
}

?>