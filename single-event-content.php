<section class="grid-1-1">
	<div class="module unpadded">

		<article id="post-#_EVENTPOSTID" class="post event">

			<div class="post-thumbnail">
				#_EVENTIMAGE
			</div>	

			<header class="post-header">

				<h1 class="post-title">#_EVENTNAME</h1>
				<div class="post-meta">
					<span class="post-meta-date">
						<time datetime="<?php esc_attr( get_the_date( 'c' ) ); ?>">#_EVENTDATES #_EVENTTIMES</time>
					</span>
					<span class="post-meta-location">#_LOCATIONNAME</span>
				</div>

			</header>

			<div class="post-content">
				#_EVENTNOTES
				#_LOCATIONMAP
			</div>

		</article>
	</div>
</section>