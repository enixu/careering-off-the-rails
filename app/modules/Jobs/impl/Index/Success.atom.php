<?xml version="1.0" encoding="utf-8"?>
<feed xmlns="http://www.w3.org/2005/Atom">
	<title><?php echo AgaviConfig::get('core.app_name'); ?></title>
	<subtitle>Latest Jobs</subtitle>
	<link href="<?php echo $ro->gen(null, array(), array('relative' => false)); ?>" rel="self" />
	<link href="<?php echo $ro->gen('index', array(), array('relative' => false)); ?>" />
	<updated><?php if (isset($t['created_at'])) echo $t['created_at']->format(DateTime::ATOM); ?></updated>
	<author>
		<name>Jobeet</name>
	</author>
	<id><?php echo sha1($ro->gen(null)); ?></id>

	<?php echo $slots['jobs']; ?>
</feed>