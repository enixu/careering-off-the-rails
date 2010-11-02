<?php

class LuceneJobModel extends JobeetBaseModel implements AgaviISingletonModel
{
	private $index;

	public function __construct()
	{
		$indexFile = AgaviConfig::get('core.app_dir').'/data/'.AgaviConfig::get('core.environment').'.index';

		if (file_exists($indexFile)) {
			$this->index = Zend_Search_Lucene::open($indexFile);
		} else {
			$this->index = Zend_Search_Lucene::create($indexFile);
		}
	}

	public function getIndex()
	{
		return $this->index;
	}
}

?>