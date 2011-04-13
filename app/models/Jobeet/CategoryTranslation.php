<?php

namespace Jobeet;

/**
 * CategoryTranslation
 *
 * @Table(name="categories_translations")
 * @Entity
 */
class CategoryTranslation extends \DomainObject
{
	/**
	 * @var integer $id
	 *
	 * @Column(name="id", type="integer", length=4)
	 * @Id
	 */
	protected $id;

	/**
	 * @var string $lang
	 *
	 * @Column(name="lang", type="string", length=2)
	 * @Id
	 */
	protected $lang;

	/**
	 * @var string $name
	 *
	 * @Column(name="name", type="string", length=255)
	 */
	protected $name;

	/**
	 * @ManyToOne(targetEntity="Category", inversedBy="translations")
	 * @JoinColumn(name="id", referencedColumnName="id")
	 */
	protected $category;

	public function getId()
	{
		return $this->id;
	}

	public function getLang()
	{
		return $this->lang;
	}

	public function setLang($lang)
	{
		$this->lang = $lang;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setName($name)
	{
		$this->name = $name;
	}
}

?>