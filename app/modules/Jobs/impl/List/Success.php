<table class="jobs">
	<?php foreach ($t['jobs'] as $i => $job): ?>
		<tr class="<?php echo ($i % 2) ? 'even' : 'odd' ?>">
			<td class="location">
				<?php echo htmlspecialchars($job['location']); ?>
			</td>
			<td class="position">
				<a href="<?php echo $ro->gen('jobs.job.show_user', array('job' => $job)); ?>"><?php echo htmlspecialchars($job['position']); ?></a>
			</td>
			<td class="company">
				<?php echo htmlspecialchars($job['company']); ?>
			</td>
		</tr>
	<?php endforeach; ?>
</table>