<?php 
    if( is_user_logged_in() ): 
        wp_safe_redirect( get_permalink( $std_page_id = 1526 ) );
        exit;
    endif;
?>
<?php /* Template Name: Custom Register Template */ get_header(); ?>

<div class="register-form-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="register-form-inner">
                    <div class="form-title">
                        <h3>Register</h3>
                    </div>
                    <div class="form-wrapper">
                        <form autocomplete="off" method="POST" id="UserRegisterForm">
                            <div class="row register-row">
                                <div class="col-md-6">
                                    <div class="custom-fields">
                                        <input type="text" name="first_name" class="cs-field" placeholder="First Name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="custom-fields">
                                        <input type="text" name="last_name" class="cs-field" placeholder="Last Name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="custom-fields">
                                        <input type="tel" name="phone_number" class="cs-field" placeholder="Phone Number" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="custom-fields">
                                        <input type="email" name="email_address" class="cs-field" placeholder="Email Address" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="custom-fields">
                                        <input type="text" name="username" class="cs-field" placeholder="Username" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="custom-fields">
                                        <input type="password" name="password" id="password" class="cs-field" placeholder="Password" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="custom-fields">
                                        <input type="password" name="cpassword" class="cs-field" placeholder="Re-Enter Password" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="custom-submit-btn">
                                        <button type="button" class="submit-btn" onclick="window.location.href='<?php echo get_permalink( $login_page_id = 1488 ); ?>'">Log In</button>
                                        <button type="submit" class="register-btn">Register</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo do_shortcode('[wpsbx_html_block id=1492]'); get_footer(); ?>