<!-- form step 2 -->
<div class="gcf-form form-step-2">
    <div class="form-title-wrapper">
        <h4 class="form-title">Step 2.</h4>
        <p class="form-after-title-text">Company domain name information</p>
    </div>
    <form id="formStep2" action="">
        <div class="row cf-field">
            <div class="col-md-12">
                <p class="custom-text-after-title">Do you have your own registered domain
                    names?</p>
                <div class="radio-field-wrapper">
                    <input type="radio" id="yes" name="registered_domain" value="yes" required>
                    <label for="yes">Yes</label>
                    <input type="radio" id="no" name="registered_domain" value="no" required>
                    <label for="no">No</label>
                </div>
            </div>
            <div class="col-md-8">
                <input type="text" name="domain_names" class="field" placeholder="Domain names">
            </div>
            <div class="col-md-4">
                <input type="text" name="registration_date" class="field" placeholder="Date of its registration">
            </div>
            <div class="col-md-12">
                <div class="row form-btn-row">
                    <div class="col-md-4 form-btn">
                        <input type="button" value="back" id="backBtn" data-goto="1" class="back-step-btn">
                    </div>
                    <div class="col-md-8 form-btn">
                        <input type="submit" value="Go to Step 3" id="nextStep" class="next-step-btn">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>