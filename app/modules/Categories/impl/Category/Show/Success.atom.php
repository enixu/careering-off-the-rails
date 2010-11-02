<?xml version="1.0" encoding="utf-8"?>
<feed xmlns="http://www.w3.org/2005/Atom">
	<title><?php echo AgaviConfig::get('core.app_name'); ?> (<?php echo $t['category']['name']; ?>)</title>
	<subtitle>Latest Jobs</subtitle>
	<link href="<?php echo $ro->gen(null, array(), array('relative' => false)); ?>" rel="self" />
	<link href="<?php echo $ro->gen('categories.category.show', array(), array('relative' => false)); ?>" />
	<updated><?php echo $t['category']['jobaddedat']->format(DateTime::ATOM); ?></updated>
	<author>
	<name>Jobeet</name>
	</author>
	<id><?php echo sha1($ro->gen(null)); ?></id>

	<?php echo $slots['jobs']; ?>
</feed>