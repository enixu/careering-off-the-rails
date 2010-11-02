<form action="<?php echo $ro->gen(null); ?>" method="post">
	<div style="padding: 1em">
		<p style="margin-bottom: 1em"><?php echo $tm->_('Delete job for position %s?', null, null, array(htmlspecialchars($t['job']['position']))); ?></p>
		<button type="submit"><?php echo $tm->_('Delete'); ?></button> <a href="<?php echo $ro->gen('jobs.job.show'); ?>" style="color: red; font-size: 9pt"><?php echo $tm->_('Cancel'); ?></a>
	</div>
</form>