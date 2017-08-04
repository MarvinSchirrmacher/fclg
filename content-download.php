<?php
// Shows title and file information.
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly
$file_type = end(explode('.', $dlm_download->get_the_filename()));
?>
<a class="download-link button" data-filetype="<?php echo $file_type; ?> / <?php $dlm_download->the_filesize(); ?>" title="<?php if ( $dlm_download->has_version_number() ) {
	printf( __( 'Version %s', 'download-monitor' ), $dlm_download->get_the_version_number() );
} ?>" href="<?php $dlm_download->the_download_link(); ?>" rel="nofollow">
	<?php $dlm_download->the_title(); ?>
</a>