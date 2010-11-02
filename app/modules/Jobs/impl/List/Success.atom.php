<?php foreach ($t['jobs'] as $job): ?>
	<entry>
		<title><?php echo htmlspecialchars($job['position']); ?> (<?php echo htmlspecialchars($job['location']); ?>)</title>
		<link href="<?php echo $ro->gen('jobs.job.show_user', array('job' => $job)); ?>" />
		<id><?php echo sha1($job['id']); ?></id>
		<updated><?php echo $job['createdat']->format(DateTime::ATOM); ?></updated>
		<summary type="xhtml">
			<div xmlns="http://www.w3.org/1999/xhtml">
				<?php if ($job['logo']): ?>
					<div>
						<a href="<?php echo htmlspecialchars($job['url']); ?>">
							<img src="<?php echo $ro->getBaseHref().'/upload/'.$job['logo']; ?>"
							alt="<?php echo htmlspecialchars($job['company']); ?> logo" />
						</a>
					</div>
				<?php endif; ?>

				<div>
					<?php echo nl2br(htmlspecialchars($job['description'])); ?>
				</div>

				<h4>How to apply?</h4>

				<p><?php echo nl2br(htmlspecialchars($job['howtoapply'])); ?></p>
			</div>
		</summary>
		<author>
			<name><?php echo htmlspecialchars($job['company']); ?></name>
		</author>
	</entry>
<?php endforeach; ?>