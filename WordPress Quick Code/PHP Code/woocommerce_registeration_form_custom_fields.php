<?php 
/*
*   This Form Saves The Data To 'Billing Information' Section Of The Woocommerce Account.
*   
*   Input Field -> name = "" is pre-defined by woocommerce with respects to billing info section. 
*   
*   NEED MORE RESEARCH AND PRACTICE - The Following Code Is Working Fine.
*   NOTE - Validation Code Is Not Working So Below Is JS Code For Validation
*/

// Create Custom Fields For WooCommerce Registration
function woocom_extra_register_fields() { ?>

<div class="row woo-reg-custom-field">
    <div class="col-md-6">
        <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
            <label for="reg_billing_first_name"><?php _e( 'First name', 'woocommerce' ); ?><span class="required">*</span></label>
            <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="billing_first_name" id="reg_billing_first_name" value="<?php if ( ! empty( $_POST["billing_first_name"] ) ) esc_attr_e( $_POST["billing_first_name"] ); ?>">
        </p>
    </div>
    <div class="col-md-6">
        <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
            <label for="reg_billing_last_name"><?php _e( "Last name", "woocommerce" ); ?><span class="required">*</span></label>
            <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="billing_last_name" id="reg_billing_last_name" value="<?php if ( ! empty( $_POST["billing_last_name"] ) ) esc_attr_e( $_POST["billing_last_name"] ); ?>">
        </p>
    </div>
</div>

<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
    <label for="reg_billing_company_name"><?php _e( 'Company Name', 'woocommerce' ); ?><span class="required">*</span></label>
    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="billing_company" id="reg_billing_company_name" value="<?php if ( ! empty( $_POST["billing_company"] ) ) esc_attr_e( $_POST["billing_company"] ); ?>">
</p>

<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
    <label for="reg_billing_country_name"><?php _e( 'Country', 'woocommerce' ); ?><span class="required">*</span></label>
    <select id="reg_billing_country_name" name="billing_country" class="country_select">
        <option value="" disabled <?php if( $_POST["billing_company"] == '' ){ echo 'selected'; } ?> >Select a country / region…</option>
		<option value="AF" <?php if( $_POST["billing_country"] == 'AF' ){ echo 'selected'; } ?> >Afghanistan</option>
		<option value="AX" <?php if( $_POST["billing_country"] == 'AX' ){ echo 'selected'; } ?> >Åland Islands</option>
		<option value="AL" <?php if( $_POST["billing_country"] == 'AL' ){ echo 'selected'; } ?> >Albania</option>
		<option value="DZ" <?php if( $_POST["billing_country"] == 'DZ' ){ echo 'selected'; } ?> >Algeria</option>
		<option value="AS" <?php if( $_POST["billing_country"] == 'AS' ){ echo 'selected'; } ?> >American Samoa</option>
		<option value="AD" <?php if( $_POST["billing_country"] == 'AD' ){ echo 'selected'; } ?> >Andorra</option>
		<option value="AO" <?php if( $_POST["billing_country"] == 'AO' ){ echo 'selected'; } ?> >Angola</option>
		<option value="AI" <?php if( $_POST["billing_country"] == 'AI' ){ echo 'selected'; } ?> >Anguilla</option>
		<option value="AQ" <?php if( $_POST["billing_country"] == 'AQ' ){ echo 'selected'; } ?> >Antarctica</option>
		<option value="AG" <?php if( $_POST["billing_country"] == 'AG' ){ echo 'selected'; } ?> >Antigua and Barbuda</option>
		<option value="AR" <?php if( $_POST["billing_country"] == 'AR' ){ echo 'selected'; } ?> >Argentina</option>
		<option value="AM" <?php if( $_POST["billing_country"] == 'AM' ){ echo 'selected'; } ?> >Armenia</option>
		<option value="AW" <?php if( $_POST["billing_country"] == 'AW' ){ echo 'selected'; } ?> >Aruba</option>
		<option value="AU" <?php if( $_POST["billing_country"] == 'AU' ){ echo 'selected'; } ?> >Australia</option>
		<option value="AT" <?php if( $_POST["billing_country"] == 'AT' ){ echo 'selected'; } ?> >Austria</option>
		<option value="AZ" <?php if( $_POST["billing_country"] == 'AZ' ){ echo 'selected'; } ?> >Azerbaijan</option>
		<option value="BS" <?php if( $_POST["billing_country"] == 'BS' ){ echo 'selected'; } ?> >Bahamas</option>
		<option value="BH" <?php if( $_POST["billing_country"] == 'BH' ){ echo 'selected'; } ?> >Bahrain</option>
		<option value="BD" <?php if( $_POST["billing_country"] == 'BD' ){ echo 'selected'; } ?> >Bangladesh</option>
		<option value="BB" <?php if( $_POST["billing_country"] == 'BB' ){ echo 'selected'; } ?> >Barbados</option>
		<option value="BY" <?php if( $_POST["billing_country"] == 'BY' ){ echo 'selected'; } ?> >Belarus</option>
		<option value="PW" <?php if( $_POST["billing_country"] == 'PW' ){ echo 'selected'; } ?> >Belau</option>
		<option value="BE" <?php if( $_POST["billing_country"] == 'BE' ){ echo 'selected'; } ?> >Belgium</option>
		<option value="BZ" <?php if( $_POST["billing_country"] == 'BZ' ){ echo 'selected'; } ?> >Belize</option>
		<option value="BJ" <?php if( $_POST["billing_country"] == 'BJ' ){ echo 'selected'; } ?> >Benin</option>
		<option value="BM" <?php if( $_POST["billing_country"] == 'BM' ){ echo 'selected'; } ?> >Bermuda</option>
		<option value="BT" <?php if( $_POST["billing_country"] == 'BT' ){ echo 'selected'; } ?> >Bhutan</option>
		<option value="BO" <?php if( $_POST["billing_country"] == 'BO' ){ echo 'selected'; } ?> >Bolivia</option>
		<option value="BQ" <?php if( $_POST["billing_country"] == 'BQ' ){ echo 'selected'; } ?> >Bonaire, Saint Eustatius and Saba</option>
		<option value="BA" <?php if( $_POST["billing_country"] == 'BA' ){ echo 'selected'; } ?> >Bosnia and Herzegovina</option>
		<option value="BW" <?php if( $_POST["billing_country"] == 'BW' ){ echo 'selected'; } ?> >Botswana</option>
		<option value="BV" <?php if( $_POST["billing_country"] == 'BV' ){ echo 'selected'; } ?> >Bouvet Island</option>
		<option value="BR" <?php if( $_POST["billing_country"] == 'BR' ){ echo 'selected'; } ?> >Brazil</option>
		<option value="IO" <?php if( $_POST["billing_country"] == 'IO' ){ echo 'selected'; } ?> >British Indian Ocean Territory</option>
		<option value="BN" <?php if( $_POST["billing_country"] == 'BN' ){ echo 'selected'; } ?> >Brunei</option>
		<option value="BG" <?php if( $_POST["billing_country"] == 'BG' ){ echo 'selected'; } ?> >Bulgaria</option>
		<option value="BF" <?php if( $_POST["billing_country"] == 'BF' ){ echo 'selected'; } ?> >Burkina Faso</option>
		<option value="BI" <?php if( $_POST["billing_country"] == 'BI' ){ echo 'selected'; } ?> >Burundi</option>
		<option value="KH" <?php if( $_POST["billing_country"] == 'KH' ){ echo 'selected'; } ?> >Cambodia</option>
		<option value="CM" <?php if( $_POST["billing_country"] == 'CM' ){ echo 'selected'; } ?> >Cameroon</option>
		<option value="CA" <?php if( $_POST["billing_country"] == 'CA' ){ echo 'selected'; } ?> >Canada</option>
		<option value="CV" <?php if( $_POST["billing_country"] == 'CV' ){ echo 'selected'; } ?> >Cape Verde</option>
		<option value="KY" <?php if( $_POST["billing_country"] == 'KY' ){ echo 'selected'; } ?> >Cayman Islands</option>
		<option value="CF" <?php if( $_POST["billing_country"] == 'CF' ){ echo 'selected'; } ?> >Central African Republic</option>
		<option value="TD" <?php if( $_POST["billing_country"] == 'TD' ){ echo 'selected'; } ?> >Chad</option>
		<option value="CL" <?php if( $_POST["billing_country"] == 'CL' ){ echo 'selected'; } ?> >Chile</option>
		<option value="CN" <?php if( $_POST["billing_country"] == 'CN' ){ echo 'selected'; } ?> >China</option>
		<option value="CX" <?php if( $_POST["billing_country"] == 'CX' ){ echo 'selected'; } ?> >Christmas Island</option>
		<option value="CC" <?php if( $_POST["billing_country"] == 'CC' ){ echo 'selected'; } ?> >Cocos (Keeling) Islands</option>
		<option value="CO" <?php if( $_POST["billing_country"] == 'CO' ){ echo 'selected'; } ?> >Colombia</option>
		<option value="KM" <?php if( $_POST["billing_country"] == 'KM' ){ echo 'selected'; } ?> >Comoros</option>
		<option value="CG" <?php if( $_POST["billing_country"] == 'CG' ){ echo 'selected'; } ?> >Congo (Brazzaville)</option>
		<option value="CD" <?php if( $_POST["billing_country"] == 'CD' ){ echo 'selected'; } ?> >Congo (Kinshasa)</option>
		<option value="CK" <?php if( $_POST["billing_country"] == 'CK' ){ echo 'selected'; } ?> >Cook Islands</option>
		<option value="CR" <?php if( $_POST["billing_country"] == 'CR' ){ echo 'selected'; } ?> >Costa Rica</option>
		<option value="HR" <?php if( $_POST["billing_country"] == 'HR' ){ echo 'selected'; } ?> >Croatia</option>
		<option value="CU" <?php if( $_POST["billing_country"] == 'CU' ){ echo 'selected'; } ?> >Cuba</option>
		<option value="CW" <?php if( $_POST["billing_country"] == 'CW' ){ echo 'selected'; } ?> >Curaçao</option>
		<option value="CY" <?php if( $_POST["billing_country"] == 'CY' ){ echo 'selected'; } ?> >Cyprus</option>
		<option value="CZ" <?php if( $_POST["billing_country"] == 'CZ' ){ echo 'selected'; } ?> >Czech Republic</option>
		<option value="DK" <?php if( $_POST["billing_country"] == 'DK' ){ echo 'selected'; } ?> >Denmark</option>
		<option value="DJ" <?php if( $_POST["billing_country"] == 'DJ' ){ echo 'selected'; } ?> >Djibouti</option>
		<option value="DM" <?php if( $_POST["billing_country"] == 'DM' ){ echo 'selected'; } ?> >Dominica</option>
		<option value="DO" <?php if( $_POST["billing_country"] == 'DO' ){ echo 'selected'; } ?> >Dominican Republic</option>
		<option value="EC" <?php if( $_POST["billing_country"] == 'EC' ){ echo 'selected'; } ?> >Ecuador</option>
		<option value="EG" <?php if( $_POST["billing_country"] == 'EG' ){ echo 'selected'; } ?> >Egypt</option>
		<option value="SV" <?php if( $_POST["billing_country"] == 'SV' ){ echo 'selected'; } ?> >El Salvador</option>
		<option value="GQ" <?php if( $_POST["billing_country"] == 'GQ' ){ echo 'selected'; } ?> >Equatorial Guinea</option>
		<option value="ER" <?php if( $_POST["billing_country"] == 'ER' ){ echo 'selected'; } ?> >Eritrea</option>
		<option value="EE" <?php if( $_POST["billing_country"] == 'EE' ){ echo 'selected'; } ?> >Estonia</option>
		<option value="ET" <?php if( $_POST["billing_country"] == 'ET' ){ echo 'selected'; } ?> >Ethiopia</option>
		<option value="FK" <?php if( $_POST["billing_country"] == 'FK' ){ echo 'selected'; } ?> >Falkland Islands</option>
		<option value="FO" <?php if( $_POST["billing_country"] == 'FO' ){ echo 'selected'; } ?> >Faroe Islands</option>
		<option value="FJ" <?php if( $_POST["billing_country"] == 'FJ' ){ echo 'selected'; } ?> >Fiji</option>
		<option value="FI" <?php if( $_POST["billing_country"] == 'FI' ){ echo 'selected'; } ?> >Finland</option>
		<option value="FR" <?php if( $_POST["billing_country"] == 'FR' ){ echo 'selected'; } ?> >France</option>
		<option value="GF" <?php if( $_POST["billing_country"] == 'GF' ){ echo 'selected'; } ?> >French Guiana</option>
		<option value="PF" <?php if( $_POST["billing_country"] == 'PF' ){ echo 'selected'; } ?> >French Polynesia</option>
		<option value="TF" <?php if( $_POST["billing_country"] == 'TF' ){ echo 'selected'; } ?> >French Southern Territories</option>
		<option value="GA" <?php if( $_POST["billing_country"] == 'GA' ){ echo 'selected'; } ?> >Gabon</option>
		<option value="GM" <?php if( $_POST["billing_country"] == 'GM' ){ echo 'selected'; } ?> >Gambia</option>
		<option value="GE" <?php if( $_POST["billing_country"] == 'GE' ){ echo 'selected'; } ?> >Georgia</option>
		<option value="DE" <?php if( $_POST["billing_country"] == 'DE' ){ echo 'selected'; } ?> >Germany</option>
		<option value="GH" <?php if( $_POST["billing_country"] == 'GH' ){ echo 'selected'; } ?> >Ghana</option>
		<option value="GI" <?php if( $_POST["billing_country"] == 'GI' ){ echo 'selected'; } ?> >Gibraltar</option>
		<option value="GR" <?php if( $_POST["billing_country"] == 'GR' ){ echo 'selected'; } ?> >Greece</option>
		<option value="GL" <?php if( $_POST["billing_country"] == 'GL' ){ echo 'selected'; } ?> >Greenland</option>
		<option value="GD" <?php if( $_POST["billing_country"] == 'GD' ){ echo 'selected'; } ?> >Grenada</option>
		<option value="GP" <?php if( $_POST["billing_country"] == 'GP' ){ echo 'selected'; } ?> >Guadeloupe</option>
		<option value="GU" <?php if( $_POST["billing_country"] == 'GU' ){ echo 'selected'; } ?> >Guam</option>
		<option value="GT" <?php if( $_POST["billing_country"] == 'GT' ){ echo 'selected'; } ?> >Guatemala</option>
		<option value="GG" <?php if( $_POST["billing_country"] == 'GG' ){ echo 'selected'; } ?> >Guernsey</option>
		<option value="GN" <?php if( $_POST["billing_country"] == 'GN' ){ echo 'selected'; } ?> >Guinea</option>
		<option value="GW" <?php if( $_POST["billing_country"] == 'GW' ){ echo 'selected'; } ?> >Guinea-Bissau</option>
		<option value="GY" <?php if( $_POST["billing_country"] == 'GY' ){ echo 'selected'; } ?> >Guyana</option>
		<option value="HT" <?php if( $_POST["billing_country"] == 'HT' ){ echo 'selected'; } ?> >Haiti</option>
		<option value="HM" <?php if( $_POST["billing_country"] == 'HM' ){ echo 'selected'; } ?> >Heard Island and McDonald Islands</option>
		<option value="HN" <?php if( $_POST["billing_country"] == 'HN' ){ echo 'selected'; } ?> >Honduras</option>
		<option value="HK" <?php if( $_POST["billing_country"] == 'HK' ){ echo 'selected'; } ?> >Hong Kong</option>
		<option value="HU" <?php if( $_POST["billing_country"] == 'HU' ){ echo 'selected'; } ?> >Hungary</option>
		<option value="IS" <?php if( $_POST["billing_country"] == 'IS' ){ echo 'selected'; } ?> >Iceland</option>
		<option value="IN" <?php if( $_POST["billing_country"] == 'IN' ){ echo 'selected'; } ?> >India</option>
		<option value="ID" <?php if( $_POST["billing_country"] == 'ID' ){ echo 'selected'; } ?> >Indonesia</option>
		<option value="IR" <?php if( $_POST["billing_country"] == 'IR' ){ echo 'selected'; } ?> >Iran</option>
		<option value="IQ" <?php if( $_POST["billing_country"] == 'IQ' ){ echo 'selected'; } ?> >Iraq</option>
		<option value="IE" <?php if( $_POST["billing_country"] == 'IE' ){ echo 'selected'; } ?> >Ireland</option>
		<option value="IM" <?php if( $_POST["billing_country"] == 'IM' ){ echo 'selected'; } ?> >Isle of Man</option>
		<option value="IL" <?php if( $_POST["billing_country"] == 'IL' ){ echo 'selected'; } ?> >Israel</option>
		<option value="IT" <?php if( $_POST["billing_country"] == 'IT' ){ echo 'selected'; } ?> >Italy</option>
		<option value="CI" <?php if( $_POST["billing_country"] == 'CI' ){ echo 'selected'; } ?> >Ivory Coast</option>
		<option value="JM" <?php if( $_POST["billing_country"] == 'JM' ){ echo 'selected'; } ?> >Jamaica</option>
		<option value="JP" <?php if( $_POST["billing_country"] == 'JP' ){ echo 'selected'; } ?> >Japan</option>
		<option value="JE" <?php if( $_POST["billing_country"] == 'JE' ){ echo 'selected'; } ?> >Jersey</option>
		<option value="JO" <?php if( $_POST["billing_country"] == 'JO' ){ echo 'selected'; } ?> >Jordan</option>
		<option value="KZ" <?php if( $_POST["billing_country"] == 'KZ' ){ echo 'selected'; } ?> >Kazakhstan</option>
		<option value="KE" <?php if( $_POST["billing_country"] == 'KE' ){ echo 'selected'; } ?> >Kenya</option>
		<option value="KI" <?php if( $_POST["billing_country"] == 'KI' ){ echo 'selected'; } ?> >Kiribati</option>
		<option value="KW" <?php if( $_POST["billing_country"] == 'KW' ){ echo 'selected'; } ?> >Kuwait</option>
		<option value="KG" <?php if( $_POST["billing_country"] == 'KG' ){ echo 'selected'; } ?> >Kyrgyzstan</option>
		<option value="LA" <?php if( $_POST["billing_country"] == 'LA' ){ echo 'selected'; } ?> >Laos</option>
		<option value="LV" <?php if( $_POST["billing_country"] == 'LV' ){ echo 'selected'; } ?> >Latvia</option>
		<option value="LB" <?php if( $_POST["billing_country"] == 'LB' ){ echo 'selected'; } ?> >Lebanon</option>
		<option value="LS" <?php if( $_POST["billing_country"] == 'LS' ){ echo 'selected'; } ?> >Lesotho</option>
		<option value="LR" <?php if( $_POST["billing_country"] == 'LR' ){ echo 'selected'; } ?> >Liberia</option>
		<option value="LY" <?php if( $_POST["billing_country"] == 'LY' ){ echo 'selected'; } ?> >Libya</option>
		<option value="LI" <?php if( $_POST["billing_country"] == 'LI' ){ echo 'selected'; } ?> >Liechtenstein</option>
		<option value="LT" <?php if( $_POST["billing_country"] == 'LT' ){ echo 'selected'; } ?> >Lithuania</option>
		<option value="LU" <?php if( $_POST["billing_country"] == 'LU' ){ echo 'selected'; } ?> >Luxembourg</option>
		<option value="MO" <?php if( $_POST["billing_country"] == 'MO' ){ echo 'selected'; } ?> >Macao</option>
		<option value="MG" <?php if( $_POST["billing_country"] == 'MG' ){ echo 'selected'; } ?> >Madagascar</option>
		<option value="MW" <?php if( $_POST["billing_country"] == 'MW' ){ echo 'selected'; } ?> >Malawi</option>
		<option value="MY" <?php if( $_POST["billing_country"] == 'MY' ){ echo 'selected'; } ?> >Malaysia</option>
		<option value="MV" <?php if( $_POST["billing_country"] == 'MV' ){ echo 'selected'; } ?> >Maldives</option>
		<option value="ML" <?php if( $_POST["billing_country"] == 'ML' ){ echo 'selected'; } ?> >Mali</option>
		<option value="MT" <?php if( $_POST["billing_country"] == 'MT' ){ echo 'selected'; } ?> >Malta</option>
		<option value="MH" <?php if( $_POST["billing_country"] == 'MH' ){ echo 'selected'; } ?> >Marshall Islands</option>
		<option value="MQ" <?php if( $_POST["billing_country"] == 'MQ' ){ echo 'selected'; } ?> >Martinique</option>
		<option value="MR" <?php if( $_POST["billing_country"] == 'MR' ){ echo 'selected'; } ?> >Mauritania</option>
		<option value="MU" <?php if( $_POST["billing_country"] == 'MU' ){ echo 'selected'; } ?> >Mauritius</option>
		<option value="YT" <?php if( $_POST["billing_country"] == 'YT' ){ echo 'selected'; } ?> >Mayotte</option>
		<option value="MX" <?php if( $_POST["billing_country"] == 'MX' ){ echo 'selected'; } ?> >Mexico</option>
		<option value="FM" <?php if( $_POST["billing_country"] == 'FM' ){ echo 'selected'; } ?> >Micronesia</option>
		<option value="MD" <?php if( $_POST["billing_country"] == 'MD' ){ echo 'selected'; } ?> >Moldova</option>
		<option value="MC" <?php if( $_POST["billing_country"] == 'MC' ){ echo 'selected'; } ?> >Monaco</option>
		<option value="MN" <?php if( $_POST["billing_country"] == 'MN' ){ echo 'selected'; } ?> >Mongolia</option>
		<option value="ME" <?php if( $_POST["billing_country"] == 'ME' ){ echo 'selected'; } ?> >Montenegro</option>
		<option value="MS" <?php if( $_POST["billing_country"] == 'MS' ){ echo 'selected'; } ?> >Montserrat</option>
		<option value="MA" <?php if( $_POST["billing_country"] == 'MA' ){ echo 'selected'; } ?> >Morocco</option>
		<option value="MZ" <?php if( $_POST["billing_country"] == 'MZ' ){ echo 'selected'; } ?> >Mozambique</option>
		<option value="MM" <?php if( $_POST["billing_country"] == 'MM' ){ echo 'selected'; } ?> >Myanmar</option>
		<option value="NA" <?php if( $_POST["billing_country"] == 'NA' ){ echo 'selected'; } ?> >Namibia</option>
		<option value="NR" <?php if( $_POST["billing_country"] == 'NR' ){ echo 'selected'; } ?> >Nauru</option>
		<option value="NP" <?php if( $_POST["billing_country"] == 'NP' ){ echo 'selected'; } ?> >Nepal</option>
		<option value="NL" <?php if( $_POST["billing_country"] == 'NL' ){ echo 'selected'; } ?> >Netherlands</option>
		<option value="NC" <?php if( $_POST["billing_country"] == 'NC' ){ echo 'selected'; } ?> >New Caledonia</option>
		<option value="NZ" <?php if( $_POST["billing_country"] == 'NZ' ){ echo 'selected'; } ?> >New Zealand</option>
		<option value="NI" <?php if( $_POST["billing_country"] == 'NI' ){ echo 'selected'; } ?> >Nicaragua</option>
		<option value="NE" <?php if( $_POST["billing_country"] == 'NE' ){ echo 'selected'; } ?> >Niger</option>
		<option value="NG" <?php if( $_POST["billing_country"] == 'NG' ){ echo 'selected'; } ?> >Nigeria</option>
		<option value="NU" <?php if( $_POST["billing_country"] == 'NU' ){ echo 'selected'; } ?> >Niue</option>
		<option value="NF" <?php if( $_POST["billing_country"] == 'NF' ){ echo 'selected'; } ?> >Norfolk Island</option>
		<option value="KP" <?php if( $_POST["billing_country"] == 'KP' ){ echo 'selected'; } ?> >North Korea</option>
		<option value="MK" <?php if( $_POST["billing_country"] == 'MK' ){ echo 'selected'; } ?> >North Macedonia</option>
		<option value="MP" <?php if( $_POST["billing_country"] == 'MP' ){ echo 'selected'; } ?> >Northern Mariana Islands</option>
		<option value="NO" <?php if( $_POST["billing_country"] == 'NO' ){ echo 'selected'; } ?> >Norway</option>
		<option value="OM" <?php if( $_POST["billing_country"] == 'OM' ){ echo 'selected'; } ?> >Oman</option>
		<option value="PK" <?php if( $_POST["billing_country"] == 'PK' ){ echo 'selected'; } ?> >Pakistan</option>
		<option value="PS" <?php if( $_POST["billing_country"] == 'PS' ){ echo 'selected'; } ?> >Palestinian Territory</option>
		<option value="PA" <?php if( $_POST["billing_country"] == 'PA' ){ echo 'selected'; } ?> >Panama</option>
		<option value="PG" <?php if( $_POST["billing_country"] == 'PG' ){ echo 'selected'; } ?> >Papua New Guinea</option>
		<option value="PY" <?php if( $_POST["billing_country"] == 'PY' ){ echo 'selected'; } ?> >Paraguay</option>
		<option value="PE" <?php if( $_POST["billing_country"] == 'PE' ){ echo 'selected'; } ?> >Peru</option>
		<option value="PH" <?php if( $_POST["billing_country"] == 'PH' ){ echo 'selected'; } ?> >Philippines</option>
		<option value="PN" <?php if( $_POST["billing_country"] == 'PN' ){ echo 'selected'; } ?> >Pitcairn</option>
		<option value="PL" <?php if( $_POST["billing_country"] == 'PL' ){ echo 'selected'; } ?> >Poland</option>
		<option value="PT" <?php if( $_POST["billing_country"] == 'PT' ){ echo 'selected'; } ?> >Portugal</option>
		<option value="PR" <?php if( $_POST["billing_country"] == 'PR' ){ echo 'selected'; } ?> >Puerto Rico</option>
		<option value="QA" <?php if( $_POST["billing_country"] == 'QA' ){ echo 'selected'; } ?> >Qatar</option>
		<option value="RE" <?php if( $_POST["billing_country"] == 'RE' ){ echo 'selected'; } ?> >Reunion</option>
		<option value="RO" <?php if( $_POST["billing_country"] == 'RO' ){ echo 'selected'; } ?> >Romania</option>
		<option value="RU" <?php if( $_POST["billing_country"] == 'RU' ){ echo 'selected'; } ?> >Russia</option>
		<option value="RW" <?php if( $_POST["billing_country"] == 'RW' ){ echo 'selected'; } ?> >Rwanda</option>
		<option value="ST" <?php if( $_POST["billing_country"] == 'ST' ){ echo 'selected'; } ?> >São Tomé and Príncipe</option>
		<option value="BL" <?php if( $_POST["billing_country"] == 'BL' ){ echo 'selected'; } ?> >Saint Barthélemy</option>
		<option value="SH" <?php if( $_POST["billing_country"] == 'SH' ){ echo 'selected'; } ?> >Saint Helena</option>
		<option value="KN" <?php if( $_POST["billing_country"] == 'KN' ){ echo 'selected'; } ?> >Saint Kitts and Nevis</option>
		<option value="LC" <?php if( $_POST["billing_country"] == 'LC' ){ echo 'selected'; } ?> >Saint Lucia</option>
		<option value="SX" <?php if( $_POST["billing_country"] == 'SX' ){ echo 'selected'; } ?> >Saint Martin (Dutch part)</option>
		<option value="MF" <?php if( $_POST["billing_country"] == 'MF' ){ echo 'selected'; } ?> >Saint Martin (French part)</option>
		<option value="PM" <?php if( $_POST["billing_country"] == 'PM' ){ echo 'selected'; } ?> >Saint Pierre and Miquelon</option>
		<option value="VC" <?php if( $_POST["billing_country"] == 'VC' ){ echo 'selected'; } ?> >Saint Vincent and the Grenadines</option>
		<option value="WS" <?php if( $_POST["billing_country"] == 'WS' ){ echo 'selected'; } ?> >Samoa</option>
		<option value="SM" <?php if( $_POST["billing_country"] == 'SM' ){ echo 'selected'; } ?> >San Marino</option>
		<option value="SA" <?php if( $_POST["billing_country"] == 'SA' ){ echo 'selected'; } ?> >Saudi Arabia</option>
		<option value="SN" <?php if( $_POST["billing_country"] == 'SN' ){ echo 'selected'; } ?> >Senegal</option>
		<option value="RS" <?php if( $_POST["billing_country"] == 'RS' ){ echo 'selected'; } ?> >Serbia</option>
		<option value="SC" <?php if( $_POST["billing_country"] == 'SC' ){ echo 'selected'; } ?> >Seychelles</option>
		<option value="SL" <?php if( $_POST["billing_country"] == 'SL' ){ echo 'selected'; } ?> >Sierra Leone</option>
		<option value="SG" <?php if( $_POST["billing_country"] == 'SG' ){ echo 'selected'; } ?> >Singapore</option>
		<option value="SK" <?php if( $_POST["billing_country"] == 'SK' ){ echo 'selected'; } ?> >Slovakia</option>
		<option value="SI" <?php if( $_POST["billing_country"] == 'SI' ){ echo 'selected'; } ?> >Slovenia</option>
		<option value="SB" <?php if( $_POST["billing_country"] == 'SB' ){ echo 'selected'; } ?> >Solomon Islands</option>
		<option value="SO" <?php if( $_POST["billing_country"] == 'SO' ){ echo 'selected'; } ?> >Somalia</option>
		<option value="ZA" <?php if( $_POST["billing_country"] == 'ZA' ){ echo 'selected'; } ?> >South Africa</option>
		<option value="GS" <?php if( $_POST["billing_country"] == 'GS' ){ echo 'selected'; } ?> >South Georgia/Sandwich Islands</option>
		<option value="KR" <?php if( $_POST["billing_country"] == 'KR' ){ echo 'selected'; } ?> >South Korea</option>
		<option value="SS" <?php if( $_POST["billing_country"] == 'SS' ){ echo 'selected'; } ?> >South Sudan</option>
		<option value="ES" <?php if( $_POST["billing_country"] == 'ES' ){ echo 'selected'; } ?> >Spain</option>
		<option value="LK" <?php if( $_POST["billing_country"] == 'LK' ){ echo 'selected'; } ?> >Sri Lanka</option>
		<option value="SD" <?php if( $_POST["billing_country"] == 'SD' ){ echo 'selected'; } ?> >Sudan</option>
		<option value="SR" <?php if( $_POST["billing_country"] == 'SR' ){ echo 'selected'; } ?> >Suriname</option>
		<option value="SJ" <?php if( $_POST["billing_country"] == 'SJ' ){ echo 'selected'; } ?> >Svalbard and Jan Mayen</option>
		<option value="SZ" <?php if( $_POST["billing_country"] == 'SZ' ){ echo 'selected'; } ?> >Swaziland</option>
		<option value="SE" <?php if( $_POST["billing_country"] == 'SE' ){ echo 'selected'; } ?> >Sweden</option>
		<option value="CH" <?php if( $_POST["billing_country"] == 'CH' ){ echo 'selected'; } ?> >Switzerland</option>
		<option value="SY" <?php if( $_POST["billing_country"] == 'SY' ){ echo 'selected'; } ?> >Syria</option>
		<option value="TW" <?php if( $_POST["billing_country"] == 'TW' ){ echo 'selected'; } ?> >Taiwan</option>
		<option value="TJ" <?php if( $_POST["billing_country"] == 'TJ' ){ echo 'selected'; } ?> >Tajikistan</option>
		<option value="TZ" <?php if( $_POST["billing_country"] == 'TZ' ){ echo 'selected'; } ?> >Tanzania</option>
		<option value="TH" <?php if( $_POST["billing_country"] == 'TH' ){ echo 'selected'; } ?> >Thailand</option>
		<option value="TL" <?php if( $_POST["billing_country"] == 'TL' ){ echo 'selected'; } ?> >Timor-Leste</option>
		<option value="TG" <?php if( $_POST["billing_country"] == 'TG' ){ echo 'selected'; } ?> >Togo</option>
		<option value="TK" <?php if( $_POST["billing_country"] == 'TK' ){ echo 'selected'; } ?> >Tokelau</option>
		<option value="TO" <?php if( $_POST["billing_country"] == 'TO' ){ echo 'selected'; } ?> >Tonga</option>
		<option value="TT" <?php if( $_POST["billing_country"] == 'TT' ){ echo 'selected'; } ?> >Trinidad and Tobago</option>
		<option value="TN" <?php if( $_POST["billing_country"] == 'TN' ){ echo 'selected'; } ?> >Tunisia</option>
		<option value="TR" <?php if( $_POST["billing_country"] == 'TR' ){ echo 'selected'; } ?> >Turkey</option>
		<option value="TM" <?php if( $_POST["billing_country"] == 'TM' ){ echo 'selected'; } ?> >Turkmenistan</option>
		<option value="TC" <?php if( $_POST["billing_country"] == 'TC' ){ echo 'selected'; } ?> >Turks and Caicos Islands</option>
		<option value="TV" <?php if( $_POST["billing_country"] == 'TV' ){ echo 'selected'; } ?> >Tuvalu</option>
		<option value="UG" <?php if( $_POST["billing_country"] == 'UG' ){ echo 'selected'; } ?> >Uganda</option>
		<option value="UA" <?php if( $_POST["billing_country"] == 'UA' ){ echo 'selected'; } ?> >Ukraine</option>
		<option value="AE" <?php if( $_POST["billing_country"] == 'AE' ){ echo 'selected'; } ?> >United Arab Emirates</option>
		<option value="GB" <?php if( $_POST["billing_country"] == 'GB' ){ echo 'selected'; } ?> >United Kingdom (UK)</option>
		<option value="US" <?php if( $_POST["billing_country"] == 'US' ){ echo 'selected'; } ?> >United States (US)</option>
		<option value="UM" <?php if( $_POST["billing_country"] == 'UM' ){ echo 'selected'; } ?> >United States (US) Minor Outlying Islands</option>
		<option value="UY" <?php if( $_POST["billing_country"] == 'UY' ){ echo 'selected'; } ?> >Uruguay</option>
		<option value="UZ" <?php if( $_POST["billing_country"] == 'UZ' ){ echo 'selected'; } ?> >Uzbekistan</option>
		<option value="VU" <?php if( $_POST["billing_country"] == 'VU' ){ echo 'selected'; } ?> >Vanuatu</option>
		<option value="VA" <?php if( $_POST["billing_country"] == 'VA' ){ echo 'selected'; } ?> >Vatican</option>
		<option value="VE" <?php if( $_POST["billing_country"] == 'VE' ){ echo 'selected'; } ?> >Venezuela</option>
		<option value="VN" <?php if( $_POST["billing_country"] == 'VN' ){ echo 'selected'; } ?> >Vietnam</option>
		<option value="VG" <?php if( $_POST["billing_country"] == 'VG' ){ echo 'selected'; } ?> >Virgin Islands (British)</option>
		<option value="VI" <?php if( $_POST["billing_country"] == 'VI' ){ echo 'selected'; } ?> >Virgin Islands (US)</option>
		<option value="WF" <?php if( $_POST["billing_country"] == 'WF' ){ echo 'selected'; } ?> >Wallis and Futuna</option>
		<option value="EH" <?php if( $_POST["billing_country"] == 'EH' ){ echo 'selected'; } ?> >Western Sahara</option>
		<option value="YE" <?php if( $_POST["billing_country"] == 'YE' ){ echo 'selected'; } ?> >Yemen</option>
		<option value="ZM" <?php if( $_POST["billing_country"] == 'ZM' ){ echo 'selected'; } ?> >Zambia</option>
		<option value="ZW" <?php if( $_POST["billing_country"] == 'ZW' ){ echo 'selected'; } ?> >Zimbabwe</option>
    </select>
</p>

<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
    <label for="reg_billing_state_name"><?php _e( 'State', 'woocommerce' ); ?><span class="required">*</span></label>
    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="billing_state" id="reg_billing_state_name" value="<?php if ( ! empty( $_POST["billing_state"] ) ) esc_attr_e( $_POST["billing_state"] ); ?>">
</p>

<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
    <label for="reg_billing_city_name"><?php _e( 'City', 'woocommerce' ); ?><span class="required">*</span></label>
    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="billing_city" id="reg_billing_city_name" value="<?php if ( ! empty( $_POST["billing_city"] ) ) esc_attr_e( $_POST["billing_city"] ); ?>">
</p>

<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
    <label for="reg_billing_postcode"><?php _e( 'Zip Code', 'woocommerce' ); ?><span class="required">*</span></label>
    <input type="number" class="woocommerce-Input woocommerce-Input--text input-text" name="billing_postcode" id="reg_billing_postcode" value="<?php if ( ! empty( $_POST["billing_postcode"] ) ) esc_attr_e( $_POST["billing_postcode"] ); ?>">
</p>

<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
    <label for="reg_billing_phone"><?php _e( 'Phone Number', 'woocommerce' ); ?><span class="required">*</span></label>
    <input type="number" class="woocommerce-Input woocommerce-Input--text input-text" name="billing_phone" id="reg_billing_phone" value="<?php if ( ! empty( $_POST["billing_phone"] ) ) esc_attr_e( $_POST["billing_phone"] ); ?>">
</p>

<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
    <label for="reg_billing_physical_address_name"><?php _e( 'Physical Address', 'woocommerce' ); ?><span class="required">*</span></label>
    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="billing_address_1" id="reg_billing_physical_address_name" value="<?php if ( ! empty( $_POST["billing_address_1"] ) ) esc_attr_e( $_POST["billing_address_1"] ); ?>">
</p>

<?php
}
add_action( "woocommerce_register_form_start", "woocom_extra_register_fields" );


// Validate Custom Fields Of WooCommerce Registration
function woocom_validate_extra_register_fields( $username, $email, $validation_errors ){

    if (empty($_POST["billing_first_name"]) ) {

        $validation_errors->add("billing_first_name_error", __("First Name is required!", "woocommerce"));
    }

    if (isset($_POST["billing_last_name"]) && empty($_POST["billing_last_name"]) ) {

        $validation_errors->add("billing_last_name_error", __("Last Name is required!", "woocommerce"));
    }

    if (isset($_POST["billing_phone"]) && empty($_POST["billing_phone"]) ) {

        $validation_errors->add("billing_phone_error", __(" Phone Number is required!", "woocommerce"));
    }
    
    if (isset($_POST["billing_company"]) && empty($_POST["billing_company"]) ) {

        $validation_errors->add("billing_company_error", __("Company Name is required!", "woocommerce"));
    }

    if (isset($_POST["billing_country"]) && empty($_POST["billing_country"]) ) {

        $validation_errors->add("billing_country_error", __("Country is required!", "woocommerce"));
    }

    if (isset($_POST["billing_state"]) && empty($_POST["billing_state"]) ) {

        $validation_errors->add("billing_state_error", __("State is required!", "woocommerce"));
    }

    if (isset($_POST["billing_city"]) && empty($_POST["billing_city"]) ) {

        $validation_errors->add("billing_city_error", __("City is required!", "woocommerce"));
    }

    if (isset($_POST["billing_postcode"]) && empty($_POST["billing_postcode"]) ) {

        $validation_errors->add("billing_postcode_error", __("Zip Code is required!", "woocommerce"));
    }

    if (isset($_POST["billing_address_1"]) && empty($_POST["billing_address_1"]) ) {

        $validation_errors->add("billing_address_1_error", __("Physical Address is required!", "woocommerce"));
    }

    return $validation_errors;
}
add_action("woocommerce_register_post", "woocom_validate_extra_register_fields", 10, 3);


// Update Custom Fields Of WooCommerce Registration
function woocom_save_extra_register_fields($customer_id) { 

    if (isset($_POST["billing_first_name"])) {

        update_user_meta($customer_id, "billing_first_name", sanitize_text_field($_POST["billing_first_name"]));
    }

	if (isset($_POST["billing_last_name"])) {

        update_user_meta($customer_id, "billing_last_name", sanitize_text_field($_POST["billing_last_name"]));
    }
	
    if (isset($_POST["billing_phone"])) {

        update_user_meta($customer_id, "billing_phone", sanitize_text_field($_POST["billing_phone"]));
    }

    if (isset($_POST["billing_company"])) {

        update_user_meta($customer_id, "billing_company", sanitize_text_field($_POST["billing_company"]));
    }

    if (isset($_POST["billing_country"])) {

        update_user_meta($customer_id, "billing_country", sanitize_text_field($_POST["billing_country"]));
    }

    if (isset($_POST["billing_state"])) {

        update_user_meta($customer_id, "billing_state", sanitize_text_field($_POST["billing_state"]));
    }

    if (isset($_POST["billing_city"])) {

        update_user_meta($customer_id, "billing_city", sanitize_text_field($_POST["billing_city"]));
    }

    if (isset($_POST["billing_postcode"])) {

        update_user_meta($customer_id, "billing_postcode", sanitize_text_field($_POST["billing_postcode"]));
    }

    if (isset($_POST["billing_address_1"])) {

        update_user_meta($customer_id, "billing_address_1", sanitize_text_field($_POST["billing_address_1"]));
    }

}

add_action("woocommerce_created_customer", "woocom_save_extra_register_fields");

?>

<!-- Custom Fields Validation -->
<script type="text/javascript">
    
    jQuery('.page-id-20 .woocommerce-form-register button.woocommerce-Button').on('click', function(e){

        var firstName	= jQuery('input#reg_billing_first_name').val(),
            lastName	= jQuery('#reg_billing_last_name').val(),
            companyName	= jQuery('#reg_billing_company_name').val(),
            phoneNo		= jQuery('#reg_billing_phone').val(),
            stateName	= jQuery('#reg_billing_state_name').val(),
            zipCode		= jQuery('#reg_billing_postcode').val(),
            cityName	= jQuery('#reg_billing_city_name').val(),
            phyAddress	= jQuery('#reg_billing_physical_address_name').val(),
            emailAddress	= jQuery('#reg_email').val();


        if(firstName == '' || lastName == '' || companyName == '' || phoneNo == '' || stateName == '' || zipCode == '' || cityName == '' || phyAddress == '' || emailAddress == '' ){

            e.preventDefault();
            alert('All Fields Are Required!')
        }

    });

</script>
