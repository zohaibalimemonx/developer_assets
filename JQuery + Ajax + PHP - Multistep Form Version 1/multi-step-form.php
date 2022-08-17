<style>
.multi-step-wrapper,
.multi-step-wrapper > div,
.multi-step-wrapper > div > div {
    height: 100%;
}
.multi-step-wrapper .multi-step-form,
.multi-step-wrapper .multi-step-form .form-wrap,
.multi-step-wrapper .multi-step-form .form-wrap .step-wrap {
    height: 100%;
	display: flex;
	flex-direction: column;
}
.multi-step-wrapper .multi-step-form .form-wrap,
.multi-step-wrapper .multi-step-form .form-wrap .step-wrap {
	flex: 1 1 auto;
}
.progress--bar {
    display: flex;
    align-items: center;
    justify-content: center;
}
.progress--bar span {
    background: #E4E4E4;
    width: 20px;
    height: 20px;
    display: block;
    border-radius: 50%;
    margin: 16px;
    position: relative;
}
.progress--bar span:not(:last-child)::after {
    content: '';
    width: 32px;
    height: 1px;
    background: #E4E4E4;
    position: absolute;
    display: block;
    left: 100%;
    top: 50%;
    transform: translateY(-50%);
}
.progress--bar span.active {
    background: #1D6CAA
}
.progress--bar span.active::after {
    background: #1D6CAA;
}
.progress--bar span.current::before {
    content: '';
    width: 32px;
    height: 1px;
    background: #E4E4E4;
    position: absolute;
    display: block;
    right: 100%;
    top: 50%;
    transform: translateY(-50%);
    z-index: 1;
}
.multi-step-wrapper .multi-step-form .form-wrap {
    font-family: 'Montserrat';
}
.multi-step-wrapper .multi-step-form .form-wrap .step-wrap {
	padding: 20px 40px 40px 40px;
}
.multi-step-wrapper .multi-step-form .form-wrap .step-wrap.step4 {
	padding: 20px 25px 40px 25px;
}
.multi-step-wrapper .multi-step-form .form-wrap .step-wrap .fields {
    /*display: flex;*/
    /*flex-direction: column;*/
    /*justify-content: center;*/
    margin-bottom: 15px;
}
.multi-step-wrapper .multi-step-form .form-wrap .step-wrap .step-title {
    font-size: 28px;
    color: #000;
    font-family: 'Montserrat';
    margin-bottom: 15px;
}
.multi-step-wrapper .multi-step-form .form-wrap .step-wrap .fields .radio-wrap {
    display: flex;
    flex-wrap: wrap;
}
.multi-step-wrapper .multi-step-form .form-wrap .step-wrap .fields .radio-wrap label {
    flex: 0 0 50%;
}
.multi-step-wrapper .multi-step-form .form-wrap .step-wrap .fields .radio-wrap label span.text {
    font-size: 16px;
    font-weight: 600;
    color: #7B7B7B
}
.multi-step-wrapper .multi-step-form .form-wrap .step-wrap .fields .radio-wrap label input:checked + span.text {
    color: #000;
}
.multi-step-wrapper .multi-step-form .form-wrap .step-wrap .fields .field-wrap select {
    width: 100%;
    background: none;
    border: 1px solid #CFCFCF;
    color: #8F8F8F;
    padding: 15px;
    height: auto;
}
.multi-step-wrapper .multi-step-form .form-wrap .step-wrap .fields .field-wrap select option {
    color: #000;
}
.multi-step-wrapper .multi-step-form .form-wrap .step-wrap .actions {
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.multi-step-wrapper .multi-step-form .form-wrap .step-wrap .actions a {
	opacity: 0.6;
	color: #000;
	font-size: 14px;
	display: flex;
	align-items: center;
	transition: 0.25s ease-in-out;
}
.multi-step-wrapper .multi-step-form .form-wrap .step-wrap .actions a img {
	margin: 0 5px;
}
.multi-step-wrapper .multi-step-form .form-wrap .step-wrap .actions a.back-btn img {
	transform: rotate(180deg);
}
.multi-step-wrapper .multi-step-form .form-wrap .step-wrap .actions a:hover {
	opacity: 1;
}
.multi-step-wrapper .multi-step-form .form-wrap .step-wrap p {
    font-size: 14px;
    color: #000;
    line-height: 1.4;
    margin: 0px;
    margin-bottom: 15px;
}
.multi-step-wrapper .multi-step-form .form-wrap .step-wrap.step4 .step-title {
    font-size: 22px;
    margin-bottom: 10px;
}
.multi-step-wrapper .multi-step-form .form-wrap .step-wrap .fields .text-field {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}
.multi-step-wrapper .multi-step-form .form-wrap .step-wrap .fields .text-field .field {
    display: flex;
    gap: 10px;
    flex: 1 1 auto;
}
.multi-step-wrapper .multi-step-form .form-wrap .step-wrap .fields .text-field label {
    flex: 0 0 80px;
    color: #000;
    font-weight: 600;
    font-size: 14px;
}
.multi-step-wrapper .multi-step-form .form-wrap .step-wrap .fields .text-field .field input {
    width: 100%;
    background: none;
    border: 1px solid #CFCFCF;
    color: #000;
    padding: 12px;
    height: auto;
}
.multi-step-wrapper .multi-step-form .form-wrap .step-wrap .fields .text-field .field input::placeholder {
    color: #8F8F8F;
}
.multi-step-wrapper .multi-step-form .form-wrap .step-wrap p.agreement {
    font-size: 12px;
}
.multi-step-wrapper .multi-step-form .form-wrap .step-wrap p.agreement a {
    color: #1D6CAA;
    text-decoration: underline;
}
.multi-step-wrapper .multi-step-form .form-wrap .step-wrap p.safetag {
    color: #1D6CAA;
    margin-bottom: -15px;
    font-size: 12px;
}
.multi-step-wrapper .multi-step-form .form-wrap .step-wrap input[type=submit] {
    background: #ABD778;
    padding: 12px 30px;
    font-size: 14px;
    font-weight: 600;
    font-family: "Montserrat";
    border: none;
    color: #fff;
    display: block;
    margin-bottom: 15px;
    cursor: pointer !important;
}
.multi-step-wrapper .multi-step-form .form-wrap .step-wrap input[type=submit]:active {
    box-shadow: 0 0 50px 0px rgb(0 0 0 / 20%) inset;
}
.multi-step-wrapper button.next-btn {
    background-color: transparent!important;
    outline: none!important;
    border: none!important;
    cursor: pointer;
}
button.next-btn img {
    vertical-align: baseline;
}
</style>

<div class="multi-step-form">
    <div id="ajax-content">
    	
    	<div class="progress--bar">
    		<span class="active"></span>
    		<span class="current"></span>
    		<span class="current"></span>
    		<span class="current"></span>
    	</div>
    	
    	<form class="form-wrap" id="step1-form">
    		<div class="step1 step-wrap">
    			<div class="fields">
    				<h4 class="step-title">How Much Do You Owe?</h4>
    				<div class="radio-wrap">
    						<label>
    						<input type="radio" name="how_much_do_you_owe" value="$0 - 9,999" checked="checked">
    						<span class="text">$0 - 9,999</span>
    					</label>
    					<label>
    						<input type="radio" name="how_much_do_you_owe" value="$19,999 - 49,999">
    						<span class="text">$19,999 - 49,999</span>
    					</label>
    					<label>
    						<input type="radio" name="how_much_do_you_owe" value="$10,000 - 19,999">
    						<span class="text">$10,000 - 19,999</span>
    					</label>
    					<label>
    						<input type="radio" name="how_much_do_you_owe" value="$50,000+">
    						<span class="text">$50,000+</span>
    					</label>
    				</div>
    			</div>
    			<div class="actions">
    				<a href="javascript:void(0)" class="back-btn" style="visibility: hidden;">
    					<img src="https://www.globalgatecpa.com/wp-content/uploads/2021/12/Arrow-1.svg">
    					Back
    				</a>
    			    <button type="submit" class="next-btn">
    				    Next
    					<img src="https://www.globalgatecpa.com/wp-content/uploads/2021/12/Arrow-1.svg">
    				</button>
    			</div>
    		</div>
    	</form>
    	
    </div>
</div>