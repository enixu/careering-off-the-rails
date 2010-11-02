<?php if (isset($slots['admin'])): ?>
	<?php echo $slots['admin']; ?>
<?php endif; ?>

<div id="job">
	<h1><?php echo htmlspecialchars($t['job']['company']); ?></h1>
	<h2><?php echo htmlspecialchars($t['job']['location']); ?></h2>
	
	<?php if ($t['job']['logo']): ?>
		<div class="logo">
			<a href="<?php echo htmlspecialchars($t['job']['url']); ?>">
				 <img width="300px" src="/upload/<?php echo $t['job']['logo']; ?>" alt="<?php echo htmlspecialchars($t['job']['company']); ?> logo" />
			</a>
		</div>
	<?php endif; ?>
	
	<h3>
		<?php echo htmlspecialchars($t['job']['position']); ?>
		<small> - <?php echo $tm->_($t['job']['typename']); ?></small>
	</h3>


	<div class="description">
		<?php echo nl2br(htmlspecialchars($t['job']['description'])); ?>
	</div>

	<h4><?php echo $tm->_('How to apply?', 'site.form'); ?></h4>
	<p class="how_to_apply"><?php echo nl2br(htmlspecialchars($t['job']['howtoapply'])); ?></p>

	<div class="meta">
		<small><?php echo $tm->_('posted on'); ?> <?php echo $tm->_d($t['job']['createdat']); ?></small>
	</div>
</div>