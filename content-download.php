<?php
/**
 * Theme-like button with title, file type and file size.
 */

if (download_is_accessed_directly()) { exit; } // is_accessed_directly

$type = end(explode('.', $dlm_download->get_the_filename()));
$size = $dlm_download->get_the_filesize();
$title = $dlm_download->get_the_title();
$version = $dlm_download->has_version_number()
	? sprintf( __( 'Version %s', 'download-monitor' ), $dlm_download->get_the_version_number())
	: '';
$link = $dlm_download->get_the_download_link();
$image = $dlm_download->get_the_image();
$meta = 'data-filetype="'.$type.' / '.$size.'" title="'.$title.' ('.$version . ')" href="'.$link.'" rel="nofollow"';
?>

<?php if (download_has_image($image)): ?>
<a class="download-link post-preview" <?php echo $meta; ?>>
	<div class="post-thumbnail"><?php echo $image; ?></div>
	<!-- <figcaption class="post-meta">
		<span class="post-title"><?php // echo $title; ?></span>
	</figcaption> -->
</a>
<?php else: ?>
<a class="download-link button sub left" <?php echo $meta; ?>>
	<?php echo $title; ?>
</a>
<?php endif; ?>