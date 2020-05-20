
<div class="wpcake-settings">

  <div class="wpcake-sidebar right">

      <div class="options-inner">

        <div class="column-wrap wpcake-pro">

          <div class="column-inner">

            <h3 class="title"><i class="dashicons dashicons-admin-appearance"></i><?php esc_html_e('Want more designs?', 'wpcake'); ?></h3>
            <p class="desc"><?php esc_html_e('Gain access to an huge extra gallery of world class websites demos to choose from.', 'wpcake'); ?></p>
            <img class="wpcake-starter-sites-img" src="<?php echo esc_url(WPCAKE_THEME_URI) . '/assets/images/wpcake-starter-sites.png'; ?>">
            <div class="bottom-column">
              <?php
                echo sprintf('<a href="%s" class="button button-dark" target="_blank">%s</a>', esc_url('https://wpcake.com/demosites/'), esc_html('Read More', 'wpcake'));
              ?>
            </div>

          </div>

        </div>

        <div class="wpcake-buttons">
          <?php
            echo sprintf('<a href="%s" class="button wpcake-button wpcake-doc-btn" target="_blank">%s</a>', esc_url('https://www.wpcake.com/docs/'), esc_html('Documentation', 'wpcake'));
            echo sprintf('<a href="%s" class="button wpcake-button wpcake-support-btn" target="_blank">%s</a>', esc_url('https://wordpress.org/support/theme/wpcake/'), esc_html('Support', 'wpcake'));
          ?>
    		</div>

      </div><!-- .options-inner -->

  </div>

  <div class="wpcake-main left">

    <h2 class="wpcake-title"><?php esc_html_e('Pick a beautiful design', 'wpcake'); ?></h2>
    <p class="wpcake-desc"><?php esc_html_e('We\'ve taken our time to create fantastic pre-built free and premium websites to save you hours and hours of setup time.', 'wpcake'); ?></p>
    <?php
      echo sprintf('<a href="%s" class="button wpcake-button wpcake-doc-btn" target="_blank">%s</a>', esc_url('https://wpcake.com/demosites/'), esc_html('Check out our fantastic Free demos', 'wpcake'));
    ?>
    <p><br /></p>
    <h2 class="wpcake-title"><?php esc_html_e('Customize the base theme', 'wpcake'); ?></h2>
    <p class="wpcake-desc"><?php esc_html_e('Although we have designed the theme to be built with a page builder like Elementor, this theme looks great on its own. Take a look in the options of the Customizer and see yourself how easy and quick to customize your website as you wish.', 'wpcake'); ?></p>

    <div class="options-inner">


				<div class="column-wrap">

					<div class="column-inner clr">

						<h3 class="title"><?php esc_html_e('Upload your logo', 'wpcake'); ?></h3>
						<p class="desc"><?php esc_html_e('Simply upload and add your own custom logo to your website.', 'wpcake'); ?></p>

						<div class="bottom-column">
							<a class="button" href="<?php echo esc_url( admin_url( 'customize.php?autofocus%5Bcontrol%5D=custom_logo' ) ); ?>"><?php esc_html_e('Go to the option', 'wpcake'); ?></a>
						</div>

					</div>

				</div>


				<div class="column-wrap">

					<div class="column-inner clr">

						<h3 class="title"><?php esc_html_e('Add your favicon', 'wpcake'); ?></h3>
						<p class="desc"><?php esc_html_e('The favicon is used as a browser and app icon for your website.', 'wpcake'); ?></p>

						<div class="bottom-column">
                <a class="button" href="<?php echo esc_url( admin_url( 'customize.php?autofocus%5Bcontrol%5D=site_icon' ) ); ?>"><?php esc_html_e('Go to the option', 'wpcake'); ?></a>
						</div>

					</div>

				</div>


				<div class="column-wrap">

					<div class="column-inner clr">

						<h3 class="title"><?php esc_html_e('Choose your typography', 'wpcake'); ?></h3>
						<p class="desc"><?php esc_html_e('Choose your own typography for any parts of your website.', 'wpcake'); ?></p>

						<div class="bottom-column">
              <a class="button" href="<?php echo esc_url( admin_url( 'customize.php?autofocus%5Bpanel%5D=wpcake_typography' ) ); ?>"><?php esc_html_e('Go to the option', 'wpcake'); ?></a>
						</div>

					</div>

				</div>

        <div class="column-wrap">

          <div class="column-inner clr">

            <h3 class="title"><?php esc_html_e('Customize the Top Bar', 'wpcake'); ?></h3>
            <p class="desc"><?php esc_html_e('Set the layout and add your social media menu and secondary menu.', 'wpcake'); ?></p>

            <div class="bottom-column">
                <a class="button" href="<?php echo esc_url( admin_url( 'customize.php?autofocus%5Bcontrol%5D=wpcake_enable_topbar' ) ); ?>"><?php esc_html_e('Go to the option', 'wpcake'); ?></a>
            </div>

          </div>

        </div>


				<div class="column-wrap">

					<div class="column-inner clr">

						<h3 class="title"><?php esc_html_e('Header options', 'wpcake'); ?></h3>
						<p class="desc"><?php esc_html_e('Choose the style for your site header.', 'wpcake'); ?></p>

						<div class="bottom-column">
              <a class="button" href="<?php echo esc_url( admin_url( 'customize.php?autofocus%5Bcontrol%5D=wpcake_header_layout' ) ); ?>"><?php esc_html_e('Go to the option', 'wpcake'); ?></a>
						</div>

					</div>

				</div>


        <div class="column-wrap">

          <div class="column-inner clr">

            <h3 class="title"><?php esc_html_e('Sidebar options', 'wpcake'); ?></h3>
            <p class="desc"><?php esc_html_e('Choose the layout for the sidebars.', 'wpcake'); ?></p>

            <div class="bottom-column">
              <a class="button" href="<?php echo esc_url( admin_url( 'customize.php?autofocus%5Bcontrol%5D=wpcake_site_sidebar' ) ); ?>"><?php esc_html_e('Go to the option', 'wpcake'); ?></a>
            </div>

          </div>

        </div>


				<div class="column-wrap">

					<div class="column-inner clr">

						<h3 class="title"><?php esc_html_e('Footer options', 'wpcake'); ?></h3>
						<p class="desc"><?php esc_html_e('Choose the columns number and layout style for the footer area.', 'wpcake'); ?></p>

						<div class="bottom-column">
              <a class="button" href="<?php echo esc_url( admin_url( 'customize.php?autofocus%5Bcontrol%5D=wpcake_footer_layout' ) ); ?>"><?php esc_html_e('Go to the option', 'wpcake'); ?></a>
						</div>

					</div>

				</div>


				<div class="column-wrap">

					<div class="column-inner clr">

						<h3 class="title"><?php esc_html_e('Header Color options', 'wpcake'); ?></h3>
						<p class="desc"><?php esc_html_e('Choose the colors you need for the primary header of the site.', 'wpcake'); ?></p>

						<div class="bottom-column">
              <a class="button" href="<?php echo esc_url( admin_url( 'customize.php?autofocus%5Bcontrol%5D=wpcake_header_bg_color' ) ); ?>"><?php esc_html_e('Go to the option', 'wpcake'); ?></a>
						</div>

					</div>

				</div>


		</div><!-- .options-inner -->

  <div><!-- .wpcake-main -->

</div>
