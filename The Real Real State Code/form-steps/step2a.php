<h3 class="isting-house-heading">List Your House?</h3>
<form action="#" id="listingStepTwoA">
    <div class="row">
        <div class="col-md-6">
            <div class="field-wrapper">
                <input class="field" type="text" name="physical_address" placeholder="Address" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="field-wrapper">
                <input class="field" type="text" name="city_state" placeholder="City" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="field-wrapper">
                <input class="field" type="number" name="zip_code" placeholder="Zip Code" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="field-wrapper">
                <input class="field" type="text" name="area_squarefeet" placeholder="Area Sqft" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="field-wrapper">
                <select name="number_of_bedrooms" class="field" required>
                    <option disabled selected>Bedrooms</option>
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="field-wrapper">
                <select name="number_of_bathrooms" class="field" required>
                    <option disabled selected>Bathrooms</option>
                    <option value="1">1</option>
                    <option value="1 1/2">1 1/2</option>
                    <option value="2">2</option>
                    <option value="2 1/2">2 1/2</option>
                    <option value="3">3</option>
                    <option value="3 1/2">3 1/2</option>
                    <option value="4">4</option>
                    <option value="4 1/2">4 1/2</option>
                    <option value="5">5</option>
                    <option value="5 1/5">5 1/5</option>
                    <option value="6 +">6 +</option>
                </select>
            </div>
        </div>
        <div class="col-md-12 btn-grp">
            <div class="button-wrapper">
                <button id="backwardBtn" data-goto="2">Back</button>
            </div>
            <div class="submit-wrapper">
                <?php wp_nonce_field( 'secure_listing_2a', 'secure_listing_2a' ); ?>
                <input type="submit" value="Proceed to Next Step" class="submit-btn">
            </div>
        </div>
    </div>
</form>
    