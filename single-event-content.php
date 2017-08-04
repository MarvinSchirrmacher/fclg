<div class="module unpadded">

	<article id="post-#_EVENTPOSTID" class="post event">

		<div class="post-thumbnail">
			#_EVENTIMAGE
		</div>	

		<header class="post-header">

			<h1 class="post-title">#_EVENTNAME</h1>

			<div class="post-meta">

				<span class="post-date">
					<time datetime="<?php esc_attr( get_the_date( 'c' ) ); ?>">#_EVENTDATES #_EVENTTIMES</time>
				</span>

				<span class="post-location">#_LOCATIONNAME</span>

			</div><!-- .post-meta -->

		</header><!-- .post-header -->

		<div class="post-content">
			#_EVENTNOTES
			#_LOCATIONMAP
			<a class="location-map-image" href="http://maps.google.com/maps?daddr=#_LOCATIONADDRESS,+#_LOCATIONPOSTCODE+#_LOCATIONTOWN" target="_blank">
				<img src="http://maps.googleapis.com/maps/api/staticmap?markers=#_LOCATIONLATITUDE,#_LOCATIONLONGITUDE&zoom=15&size=640x640&scale=2&visual_refresh=false&sensor=false">
			</a>
		</div><!-- .post-content -->

	</article><!-- #post-## -->

</div>