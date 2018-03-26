			</section>
			<!-- <div class="module" data-heading="Backtrace"><pre><?php // print_r(debug_backtrace()) ?></pre></div> -->
			<footer id="page-footer">
				<?php get_sidebar('footer'); ?>
				<div id="site-info" class="strip">
					<section class="inside">
						<?php $current_date = getdate(); ?>
						<span>Copyright &copy; <?php echo $current_date['year']; ?> FC Löhne-Gohfeld e.V.</span>
					</section>
				</div>

			</footer>
		</section>

		<?php include("photoswipe.php"); ?>
		<?php wp_footer(); ?>
	</body>
</html>