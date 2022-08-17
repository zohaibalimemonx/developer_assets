<?php 
    if( is_user_logged_in() ): 
        wp_safe_redirect( get_permalink( $std_page_id = 1526 ) );
        exit;
    endif;
?>
<?php /* Template Name: Custom Login Template */ get_header(); ?>

<div class="login-form-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="login-form-inner">
                    <div class="form-title">
                        <h3>Login</h3>
                    </div>
                    <div class="form-wrapper">
                        <form autocomplete="off" method="POST" id="UserLoginForm">
                            <div class="custom-fields">
                                <input type="text" name="username" class="cs-field" placeholder="Username" required>
                            </div>
                            <div class="custom-fields mb-15">
                                <input type="password" name="password" class="cs-field" placeholder="Password" required>
                            </div>
                            <div class="custom-help">
                                <div class="forgot-pass">
                                    <a href="#">Forget Password?</a>
                                </div>
                            </div>
                            <div class="custom-submit-btn">
                                <button type="submit" class="submit-btn">Log In</button>
                                <button type="button" class="register-btn" onclick="window.location.href='<?php echo get_permalink( $login_page_id = 1526 ); ?>'">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo do_shortcode('[wpsbx_html_block id=1492]'); get_footer(); ?>
