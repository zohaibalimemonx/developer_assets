<h3 class="isting-house-heading">List Your House?</h3>
<form action="#" id="listingStepTwo">
    <div class="row">
        <div class="col-md-6">
            <div class="field-wrapper">
                <input class="field" type="text" name="house_name" placeholder="Name Your Home" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="field-wrapper">
                <input class="field" type="text" name="dream_price" placeholder="Name Your Dream Price" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="field-wrapper">
                <select name="style_of_house" class="field" required>
                    <option disabled selected>Style of House</option>
                    <option value="Single Family Home">Single Family Home</option>
                    <option value="Duplex">Duplex</option>
                    <option value="Multi-Family Home">Multi-Family Home</option>
                    <option value="Apartment">Apartment</option>
                    <option value="Condo">Condo</option>
                    <option value="Townhouse">Townhouse</option>
                    <option value="Other">Other</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="field-wrapper">
                <label>Amenities:</label>
                <div class="checkbox-group">
                    <label for="amen1"><input type="checkbox" name="amenities[]" id="amen1" value="School District">School District</label>
                    <label for="amen2"><input type="checkbox" name="amenities[]" id="amen2" value="Nearby Restaurants">Nearby Restaurants</label>
                    <label for="amen3"><input type="checkbox" name="amenities[]" id="amen3" value="Access to Highway">Access to Highway</label>
                    <label for="amen4"><input type="checkbox" name="amenities[]" id="amen4" value="Nearby Nature / Parks">Nearby Nature / Parks</label>
                    <label for="amen5"><input type="checkbox" name="amenities[]" id="amen5" value="Close to Hospital">Close to Hospital</label>
                    <label for="amen6"><input type="checkbox" name="amenities[]" id="amen6" value="Close to Fire Station">Close to Fire Station</label>
                    <label for="amen7"><input type="checkbox" name="amenities[]" id="amen7" value="Hardwood floors">Hardwood floors</label>
                    <label for="amen8"><input type="checkbox" name="amenities[]" id="amen8" value="Pool / Jacuzzi">Pool / Jacuzzi</label>
                    <label for="amen9"><input type="checkbox" name="amenities[]" id="amen9" value="Big Yard">Big Yard</label>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="field-wrapper">
                <textarea name="sell_your_hourse" placeholder="Sell Your Home (description)" class="field field-textarea" required></textarea>
            </div>
        </div>
        <div class="col-md-12 btn-grp">
            <div class="button-wrapper">
                <button id="backwardBtn" data-goto="1">Back</button>
            </div>
            <div class="submit-wrapper">
                <?php wp_nonce_field( 'secure_listing_2', 'secure_listing_2' ); ?>
                <input type="submit" value="Proceed to Next Step" class="submit-btn">
            </div>
        </div>
    </div>
</form>
    