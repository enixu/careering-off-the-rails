<?php

namespace Jobeet;

/**
 * Job
 *
 * @Table(name="jobs")
 * @Entity(repositoryClass="Jobeet\JobRepository")
 * @HasLifecycleCallbacks
 */
class Job extends \DomainObject
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
	 * @var integer $type
	 *
	 * @Column(name="type", type="integer", length=1)
	 */
	protected $type;

	/**
	 * @var string $company
	 *
	 * @Column(name="company", type="string", length=255)
	 */
	protected $company;

	/**
	 * @var string $logo
	 *
	 * @Column(name="logo", type="string", nullable="true", length=255)
	 */
	protected $logo;

	/**
	 * @var string $url
	 *
	 * @Column(name="url", type="string", length=255)
	 */
	protected $url;

	/**
	 * @var string $position
	 *
	 * @Column(name="position", type="string", length=255)
	 */
	protected $position;

	/**
	 * @var string $location
	 *
	 * @Column(name="location", type="string", length=255)
	 */
	protected $location;

	/**
	 * @var string $description
	 *
	 * @Column(name="description", type="string", length=255)
	 */
	protected $description;

	/**
	 * @var string $howToApply
	 *
	 * @Column(name="how_to_apply", type="string", length=255)
	 */
	protected $howToApply;

	/**
	 * @var string $token
	 *
	 * @Column(name="token", type="string", length=255)
	 */
	protected $token;

	/**
	 * @var string $email
	 *
	 * @Column(name="email", type="string", length=255)
	 */
	protected $email;

	/**
	 * @var integer $status
	 *
	 * @Column(name="status", type="integer", length=1)
	 */
	protected $status;

	/**
	 * @var DateTime $createdAt
	 *
	 * @Column(name="created_at", type="datetime")
	 */
	protected $createdAt;

	/**
	 * @var DateTime $expiresAt
	 *
	 * @Column(name="expires_at", type="datetime")
	 */
	protected $expiresAt;

	/**
	 * @ManyToOne(targetEntity="Category", inversedBy="jobs"), cascade={"detach", "merge"})
	 */
	protected $category;

	const STATUS_PUBLIC    = 1;
	const STATUS_ACTIVATED = 2;

	public function __construct(\AgaviContext $context)
	{
		parent::__construct($context);

		$this->createdAt = new \DateTime();
		$this->expiresAt = new \DateTime('+'.\AgaviConfig::get('jobeet.active_days').' days');
		$this->token     = bin2hex(openssl_random_pseudo_bytes(20));
	}

	/**
	 * @postPersist
	 * @postUpdate
	 */
	public function postUpdate()
	{
		$this->category->setJobAddedAt(new \DateTime());
	}

	/**
	 * @postUpdate
	 * @postRemove
	 */
	public function updateIndex()
	{
		$index = $this->getContext()->getModel('LuceneJob')->getIndex();

		// remove an existing entry
		if ($hit = $index->find('pk:'.$this->getId())) {
			$index->delete($hit->id);
		}

		// don't index expired and non-activated jobs
		if ($this->isExpired() || !($this->getStatus() & self::STATUS_ACTIVATED)) {
			return;
		}

		$doc = new \Zend_Search_Lucene_Document();

		// store job primary key URL to identify it in the search results
		$doc->addField(\Zend_Search_Lucene_Field::UnIndexed('pk', $this->getId()));

		// index job fields
		$doc->addField(\Zend_Search_Lucene_Field::UnStored('position', $this->getPosition(), 'utf-8'));
		$doc->addField(\Zend_Search_Lucene_Field::UnStored('company', $this->getCompany(), 'utf-8'));
		$doc->addField(\Zend_Search_Lucene_Field::UnStored('location', $this->getLocation(), 'utf-8'));
		$doc->addField(\Zend_Search_Lucene_Field::UnStored('description', $this->getDescription(), 'utf-8'));

		// add job to the index
		$index->addDocument($doc);
		$index->commit();
	}

	public function getId()
	{
		return $this->id;
	}

	public function getType()
	{
		return $this->type;
	}

	public function setType($type)
	{
		$this->type = $type;
	}

	public function getCompany()
	{
		return $this->company;
	}

	public function setCompany($company)
	{
		$this->company = $company;
	}

	public function getLogo()
	{
		return $this->logo;
	}

	public function setLogoFile(\AgaviUploadedFile $file)
	{
		$formats = array(IMAGETYPE_GIF => 'gif', IMAGETYPE_JPEG => 'jpeg', IMAGETYPE_PNG => 'png');

		$type = @getimagesize($file->getTmpName());

		$this->logo = md5_file($file->getTmpName()).'.'.$formats[$type[2]];

		$file->move(\AgaviConfig::get('core.upload_dir').'/'.$this->logo);
	}

	public function getUrl()
	{
		return $this->url;
	}

	public function setUrl($url)
	{
		if (substr(strtolower($url), 0, 4) == 'http') {
			$this->url = $url;
		} else {
			$this->url = 'http://'.$url;
		}
	}

	public function getPosition()
	{
		return $this->position;
	}

	public function setPosition($position)
	{
		$this->position = $position;
	}

	public function getLocation()
	{
		return $this->location;
	}

	public function setLocation($location)
	{
		$this->location = $location;
	}

	public function getDescription()
	{
		return $this->description;
	}

	public function setDescription($description)
	{
		$this->description = $description;
	}

	public function getHowToApply()
	{
		return $this->howToApply;
	}

	public function setHowToApply($howToApply)
	{
		$this->howToApply = $howToApply;
	}

	public function getToken()
	{
		return $this->token;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function setEmail($email)
	{
		$this->email = $email;
	}

	public function getStatus()
	{
		return $this->status;
	}

	public function setStatus($status)
	{
		$this->status = $status;
	}

	public function getCreatedAt()
	{
		return $this->createdAt;
	}

	public function setCreatedAt($createdAt)
	{
		$this->createdAt = $createdAt;
	}

	public function getExpiresAt()
	{
		return $this->expiresAt;
	}

	public function setExpiresAt($expiresAt)
	{
		$this->expiresAt = $expiresAt;
	}

	public function getCategory()
	{
		return $this->category;
	}

	public function setCategory($category)
	{
		$this->category = $category;
	}

	public function getTypeName()
	{
		switch ($this->type) {
			case 1:  return 'Part time';
			case 2:  return 'Freelance';
			default: return 'Full time';
		}
	}

	public function isExpired()
	{
		return $this->getDaysBeforeExpires() < 0;
	}

	public function isExpiring()
	{
		return $this->getDaysBeforeExpires() < 5;
	}

	public function getDaysBeforeExpires()
	{
		return floor(($this->expiresAt->getTimestamp() - time()) / 86400);
	}

	public function extend()
	{
		$this->expiresAt = new \DateTime('+'.\AgaviConfig::get('jobeet.active_days').' days');
	}

	public function activate()
	{
		$this->extend();
		$this->status = $this->status | self::STATUS_ACTIVATED;
	}

	public function __toString()
	{
		return sprintf('%s @ %s (%s)', $this->getPosition(), $this->getCompany(), $this->getLocation());
	}
}

?>