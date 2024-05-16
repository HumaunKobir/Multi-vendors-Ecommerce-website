
<form action="javascript:;"method="post" id="addressAddEditForm">@csrf
    <input type="hidden" name="delivery_id">
    <div class="checkbox-form">
        <div class="different-address">
            <h3>Add Delivery Address</h3>
            <div class="row">
                <div class="col-md-6">
                    <div class="checkout-form-list">
                        <label>Name <span class="required">*</span></label>
                        <input id="delivery_name" name="delivery_name" placeholder="" type="text">
                        <p id="delivery-delivery_name"></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="checkout-form-list">
                        <label>Address <span class="required">*</span></label>
                        <input id="delivery_address" name="delivery_address" placeholder="" type="text">
                        <p id="delivery-delivery_address"></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="checkout-form-list">
                        <label>City</label>
                        <input id="delivery_city" name="delivery_city" placeholder="" type="text">
                        <p id="delivery-delivery_city"></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="checkout-form-list">
                        <label>State <span class="required">*</span></label>
                        <input id="delivery_state" name="delivery_state" placeholder="Street address" type="text">
                        <p id="delivery-delivery_state"></p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="country-select clearfix">
                        <label>Country <span class="required">*</span></label>
                        <select id="delivery_country" name="delivery_country" class="nice-select wide">
                            <option value="">Select Country</option>
                            @foreach($countries as $country)
                            <option value="{{ $country['country_name']}}" @if(isset(Auth::user()->country) && $country['country_name'] == Auth::user()->country) selected @endif>{{ $country['country_name']}}</option>
                            @endforeach
                        </select>
                        <p id="delivery-delivery_country"></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="checkout-form-list">
                        <label>Pincode <span class="required">*</span></label>
                        <input id="delivery_pincode" name="delivery_pincode" type="text">
                        <p id="delivery-delivery_pincode"></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="checkout-form-list">
                        <label>Mobile <span class="required">*</span></label>
                        <input id="delivery_mobile" name="delivery_mobile" placeholder="" type="text">
                        <p id="delivery-delivery_mobile"></p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="order-button-payment">
                        <input value="Save Information" type="submit">
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
                