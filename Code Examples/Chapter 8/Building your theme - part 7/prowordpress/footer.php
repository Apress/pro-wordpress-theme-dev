			</div> <!-- /.main -->

			<footer>
				<nav class="footer-navigation menu">
					<ul>
						<?php if( is_user_logged_in() && current_user_can( 'publish_posts' ) ): ?>
							
							<li><a href="<?php echo home_url( 'profile' ); ?>">Your profile</a></li>
						<?php else: ?>
							<li><a href="<?php echo home_url( 'login' ); ?>">Login</a></li>
							<li><a href="<?php echo home_url( 'register' ); ?>">Register</a></li>
						<?php endif; ?>

						<li><a href="<?php echo home_url( 'contact-us' ); ?>">Contact</a></li>
					</ul>
				</nav>
				<p><?php simple_copyright(); ?></p>
			</footer>

		</div> <!-- /.container -->

		<?php wp_footer(); ?>
	</body>
</html>