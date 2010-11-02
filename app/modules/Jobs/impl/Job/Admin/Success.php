<div id="job_actions">
	<h3><?php echo $tm->_('Admin'); ?></h3>
	<ul>
		<?php if (!($t['job']['status'] & \Jobeet\Job::STATUS_ACTIVATED)): ?>
			<li><a href="<?php echo $ro->gen('jobs.job.edit'); ?>"><?php echo $tm->_('Edit'); ?></a></li>
			<li>
				<form action="<?php echo $ro->gen('jobs.job.publish'); ?>" method="post" class="form-link">
					<button type="submit"><?php echo $tm->_('Publish'); ?></button>
				</form>
			</li>
		<?php endif; ?>
		<li><a href="<?php echo $ro->gen('jobs.job.delete'); ?>"><?php echo $tm->_('Delete'); ?></a></li>
		<?php if ($t['job']['status'] & \Jobeet\Job::STATUS_ACTIVATED): ?>
			<li<?php if ($t['job']['daysBeforeExpires'] < 5) echo ' class="expires_soon"'; ?>>
				<?php if ($t['job']['daysBeforeExpires'] < 0): ?>
					<?php echo $tm->_('Expired'); ?>
				<?php else: ?>
					<?php echo $tm->_('Expires in %s days', null, null, array('<strong>'.$t['job']['daysBeforeExpires'].'</strong>')); ?>
				<?php endif; ?>

				<?php if ($t['job']['daysBeforeExpires'] < 5): ?>
					-
					<form action="<?php echo $ro->gen('jobs.job.extend'); ?>" method="post" class="form-link">
						<button type="submit"><?php echo $tm->_('Extend'); ?></button> <?php echo $tm->_('for another %s days', null, null, array(AgaviConfig::get('jobeet.active_days'))); ?>
					</form>
				<?php endif; ?>
			</li>
		<?php else: ?>
			<li>
				[<?php echo $tm->_('Bookmark this %s to manage this job in the future', null, null, array('<a href="'.$ro->gen('jobs.job.show', array(), array('relative' => false)).'">URL</a>')); ?>]
			</li>
		<?php endif; ?>
	</ul>
</div>