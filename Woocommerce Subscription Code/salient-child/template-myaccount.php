<?php 
    if( !is_user_logged_in() ): 
        wp_safe_redirect( get_permalink( $std_page_id = 1488 ) );
        exit;
    endif;
?>

<?php /* Template Name: Custom My Account Page */ 

    get_header();
    
    $current_user = wp_get_current_user();
?>

<section class="account-info-section">
    <div class="container">
        <p class="logout-wrapper"><a href="<?php echo wp_logout_url(); ?>" class="logout-tag">Logout</a></p>
        <div class="row myaccount-row">
            <div class="col-md-12">
                <div class="account-info-wrapper">
                    <div class="account-info-title">
                        <h3>My Account Infomation</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="account-detail">
                                <p class="label">First Name</p>
                                <h4>
                                    <?php 
                                        if( !empty( get_user_meta( $current_user->ID, 'first_name', true ) ) ):
                                            echo get_user_meta( $current_user->ID, 'first_name', true );
                                        else:
                                            echo 'N/A';
                                        endif;
                                    ?>
                                </h4>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="account-detail">
                                <p class="label">Last Name</p>
                                <h4>
                                    <?php 
                                        if( !empty( get_user_meta( $current_user->ID, 'last_name', true ) ) ):
                                            echo get_user_meta( $current_user->ID, 'last_name', true );
                                        else:
                                            echo 'N/A';
                                        endif;
                                    ?>
                                </h4>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="account-detail">
                                <p class="label">Phone Number</p>
                                <h4>
                                    <?php 
                                        if( !empty( get_user_meta( $current_user->ID, 'billing_phone', true ) ) ):
                                            echo get_user_meta( $current_user->ID, 'billing_phone', true );
                                        else:
                                            echo 'N/A';
                                        endif;
                                    ?>
                                </h4>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="account-detail">
                                <p class="label">Email Address</p>
                                <h4>
                                    <?php 
                                        if( !empty( $current_user->user_email ) ):
                                            echo $current_user->user_email;
                                        else:
                                            echo 'N/A';
                                        endif;
                                    ?>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row myaccount-events-row">
            <div class="col-md-12">
                <div class="account-info-title">
                    <h3>Events</h3>
                </div>
                <div class="events-tabs-wrapper">
                    <table class="table">
                        <tr>
                            <td>
                                <button type="button" class="custom-tab-btn" id="getMyEvents">My Events</button>
                            </td>
                            <td>
                                <button type="button" class="custom-tab-btn" id="getPastEvents">Past Events</button>
                            </td>
                        </tr>
                    </table>
                    <div class="events-tab-content" id="eventsTabContent"></div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php echo do_shortcode('[wpsbx_html_block id=1492]'); get_footer(); ?>