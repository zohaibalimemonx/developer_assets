<div class="gcf-form form-step-1">
    <div class="form-title-wrapper">
        <h4 class="form-title">Step 1.</h4>
        <p class="form-after-title-text">Information about the company</p>
    </div>
    <form id="formStep1" action="#">
        <div class="row cf-field">
            <div class="col-md-12">
                <input type="text" name="full_name" class="field" placeholder="Name" required>
            </div>
            <div class="col-md-6">
                <input type="tel" name="phone_number" class="field"
                    placeholder="Your Phone Number" required>
            </div>
            <div class="col-md-6">
                <input type="email" name="your_email" class="field" placeholder="Your Email" required>
            </div>
            <div class="col-md-12">
                <textarea name="about_your_business" class="field"
                    placeholder="Tell us more about your business or company, what kind of industry are you involved in?" required></textarea>
            </div>
            <div class="col-md-12">
                <div class="row form-btn-row">
                    <div class="col-md-8 form-btn">
                        <?php wp_nonce_field('valid_submission', 'valid_submission' ); ?>
                        <input type="submit" value="Go to Step 2" id="nextStep"
                            class="next-step-btn">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>