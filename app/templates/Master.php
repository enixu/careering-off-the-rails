<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<base href="<?php echo $ro->getBaseHref(); ?>" />
		<title>
			<?php if(isset($t['_title'])): ?>
				<?php echo htmlspecialchars($t['_title']) . ' - '; ?>
			<?php elseif(isset($t['_page_title'])): ?>
				<?php echo htmlspecialchars($t['_page_title']) . ' - '; ?>
			<?php endif; ?>
			<?php echo AgaviConfig::get('core.app_name'); ?>
		</title>
		<link rel="shortcut icon" href="/favicon.ico" />
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script>
		<script type="text/javascript" src="/js/search.js"></script>
		<link rel="stylesheet" type="text/css" media="screen" href="/css/main.css" />
		<link rel="alternate" type="application/atom+xml" title="Latest Jobs" href="<?php echo $ro->gen('index.feed'); ?>" />
	</head>
	<body>
		<div id="container">
			<div id="header">
				<div class="content">
					<a class="post" href="<?php echo $ro->gen('jobs.add'); ?>"><?php echo $tm->_('Post a job'); ?></a>
					
					<h1>
						<a href="<?php echo $ro->gen('index'); ?>"><img src="/images/logo.png" alt="<?php echo AgaviConfig::get('core.app_name'); ?>" /></a>
					</h1>
					
					<div id="sub_header">
						<div id="search">
							<form action="<?php echo $ro->gen('jobs.search'); ?>" method="get">
								<input type="text" name="query" value="<?php echo $tm->_('Enter some keywords (city, country, position, ...)'); ?>" id="search_keywords" />
								<button type="submit"><?php echo $tm->_('Search', 'site.form'); ?></button>
								<img id="loader" src="/images/loader.gif" style="vertical-align: middle; display: none" />
							</form>
						</div>
					</div>
				</div>
			</div>

			<div id="content">
				<?php if ($us->hasFlash('notice')): ?>
					<div class="flash_notice">
						<?php echo $us->getFlash('notice') ?>
					</div>
				<?php endif; ?>

				<?php if ($us->getJobHistory()): ?>
				<div id="job_history">
					<?php echo $tm->_('Recently viewed jobs'); ?>:
					<ul>
						<?php foreach ($us->getJobHistory() as $job): ?>
							<li><a href="<?php echo $ro->gen('jobs.job.show_user', array('job' => $job)); ?>"><?php echo htmlspecialchars($job->getPosition().' - '.$job->getCompany()); ?></a></li>
						<?php endforeach; ?>
					</ul>
				</div>
				<?php endif; ?>

				<div class="content" id="main-content">
					<?php if(isset($t['_page_title'])) echo '<h1>' . htmlspecialchars($t['_page_title']) . '</h1>'; ?>
					<?php echo $inner; ?>
				</div>
			</div>

			<div id="footer">
				<div class="content">
					<span class="agavi">
						<?php echo AgaviConfig::get('core.app_name'); ?>
						is powered by
						<a href="http://www.agavi.org/">
							<img src="/images/agavi.png" alt="Agavi Framework" />
						</a>
					</span>
					
					<p>
						<?php echo AgaviConfig::get('core.app_name'); ?> is a port of <a href="http://www.jobeet.org">Jobeet</a> from the
						<a href="http://www.symfony-project.org">Symfony Framework</a> to Agavi.
					</p>
					
					<ul>
						<li class="feed last">
							<a href="<?php echo $ro->gen('index.feed'); ?>"><?php echo $tm->_('Full feed'); ?></a>
						</li>
					</ul>

					<form action="<?php echo $ro->gen('language'); ?>">
						<tr>
							<th><label for="language"><?php echo $tm->_('Language'); ?></label></th>
							<td>
								<select name="lang" id="language">
									<?php foreach ($tm->getAvailableLocales() as $locale): ?>
										<option value="<?php echo $locale['identifierData']['language']; ?>" <?php if ($tm->getCurrentLocaleIdentifier() == $locale['identifier']) echo 'selected="selected"'; ?>>
											<?php echo htmlspecialchars($locale['parameters']['description']); ?>
										</option>
									<?php endforeach; ?>
								</select>
							</td>
						</tr>
						<button type="submit">OK</button>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>