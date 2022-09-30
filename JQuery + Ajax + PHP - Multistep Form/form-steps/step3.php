<!-- form step 3 -->
<div class="gcf-form form-step-3">
    <div class="form-title-wrapper">
        <h4 class="form-title">Step 3.</h4>
        <p class="form-after-title-text">Trademark Information</p>
    </div>
    <form id="formStep3" action="">
        <div class="row cf-field">
            <div class="col-md-12">
                <p class="custom-text-after-title">Do you have the registered/unregistered
                    trademarks?</p>
                <div class="radio-field-wrapper">
                    <input type="radio" id="yes" name="trademark" value="yes" required>
                    <label for="yes">Yes</label>
                    <input type="radio" id="no" name="trademark" value="no" required>
                    <label for="no">No</label>
                </div>
            </div>
            <div class="col-md-8">
                <input type="text" name="what_national_or_international_class_it_was_registered"
                    class="field"
                    placeholder="What International/National Class it was registered">
            </div>
            <div class="col-md-4">
                <input type="text" name="trade_registration_date" class="field"
                    placeholder="Date of its registration">
            </div>
            <div class="col-md-12">
                <div class="row form-btn-row">
                    <div class="col-md-4 form-btn">
                        <input type="button" value="back" id="backBtn" data-goto="2" class="back-step-btn">
                    </div>
                    <div class="col-md-8 form-btn">
                        <input type="submit" value="Go to Step 4" id="nextStep"
                            class="next-step-btn">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>