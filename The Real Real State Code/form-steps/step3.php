<h3 class="isting-house-heading">List Your House?</h3>
<form action="#" id="listingStepThree" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-12">
            <div class="file-field-wrapper">
                <div class="file-field-desc">
                    <img src="<?php echo site_url() . '/wp-content/uploads/2022/05/image-gallery-1.png'; ?>">
                    <p>Drag and drop photos here to upload (Photo Should Be Less Than 300 KBs)</p>
                </div>
                <div id="singleFileUpload" class="input-file-wrapper">
                    <label for="fImage" id="fImageLabel"><span>Click To Choose Feature Image</span> <input type="file" name="featured_images" id="fImage" accept="image/png, image/jpeg"></label>
                    <span class="single-upload-progress"><span class="perc">0%</span></span>
                </div>
                <div id="multiFileUpload" class="input-file-wrapper">
                    <label for="gImage" id="gImageLabel"><span>Click To Add Gallery</span> <input type="file" name="gallery_images[]" id="gImage" accept="image/png, image/jpeg" multiple></label>
                    <span class="multi-upload-progress"><span class="perc">0%</span></span>
                </div>
            </div>
            <div class="agree-with-terms">
                <div class="checkbox-group">
                    <label for="doAgree"><input type="checkbox" name="do_agree" id="doAgree" value="Agree" required>I Agree With Terms & Conditions</label>
                </div>
            </div>
        </div>
        <div class="col-md-12 btn-grp">
            <div class="button-wrapper">
                <button id="backwardBtn" data-goto="3">Back</button>
            </div>
            <div class="submit-wrapper">
                <?php wp_nonce_field( 'secure_listing_3', 'secure_listing_3' ); ?>
                <input type="hidden" name="featured_image_id" value="">
                <input type="hidden" name="gallery_image_id" value="">
                <input type="submit" value="Publish Your Home" id="FinalSubmit" class="submit-btn">
            </div>
        </div>
    </div>
</form>