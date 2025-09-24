
@extends(template() . 'layouts.app')
@section('title', 'Home')

@section('content')
    @auth
        <div class="pulse-loader">
            <div id="block_304">
                <div class="block-bg"></div>
                <div class="container">
                    <div class="text-block-with-card ">
                        <div class="row">
                            <div class="col-12">
                                <div class="component_card_1">
                                    <div class="card">
                                        <div class="text-block__description">
                                            <p>Please create a site ticket for order issues. That's the fastest way to get
                                                resolution.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="block_303">
                <div class="block-bg"></div>
                <div class="container">
                    <div class="text-block-with-card ">
                        <div class="row">
                            <div class="col-12">
                                <div class="component_card_1">
                                    <div class="card">
                                        <div class="text-block__description">
                                            <p class="text-justify"><span style="color: var(--color-id-200)"><span
                                                        style="line-height: 27px"><span style="text-align: JUSTIFY"><span
                                                                style="font-size: 14px"><strong
                                                                    style="font-weight: bold">|</strong></span></span></span></span><span
                                                    style="line-height: 27px"><span style="text-align: JUSTIFY"><span
                                                            style="font-size: 14px"><strong style="font-weight: bold">
                                                                &nbsp;&nbsp;</strong></span></span></span><a target="_self"
                                                    href="#"><span style="line-height: 27px"><span
                                                            style="text-align: JUSTIFY"><span style="font-size: 14px"><strong
                                                                    style="font-weight: bold">TUTORIALS TO GET YOU
                                                                    STARTED</strong></span></span></span></a></p>
                                            <p class="text-justify"><span style="color: var(--color-id-200)"><span
                                                        style="line-height: 27px"><span style="text-align: JUSTIFY"><span
                                                                style="font-size: 14px"><strong style="font-weight: bold">|
                                                                    &nbsp;</strong></span></span></span></span><span
                                                    style="color: var(--color-id-186)"><span style="line-height: 27px"><span
                                                            style="text-align: JUSTIFY"><span style="font-size: 14px"><strong
                                                                    style="font-weight: bold">&nbsp;</strong></span></span></span></span><a
                                                    target="_self" href="#"><span style="line-height: 27px"><span
                                                            style="text-align: JUSTIFY"><span style="font-size: 14px"><strong
                                                                    style="font-weight: bold">UNDERSTANDING OUR
                                                                    DESCRIPTIONS</strong></span></span></span></a></p>
                                            <p class="text-justify"><span style="color: var(--color-id-200)"><span
                                                        style="line-height: 27px"><span style="text-align: JUSTIFY"><span
                                                                style="font-size: 14px"><strong style="font-weight: bold">|
                                                                    &nbsp;&nbsp;</strong></span></span></span></span><a
                                                    target="_self" href="#"><span style="line-height: 27px"><span
                                                            style="text-align: JUSTIFY"><span style="font-size: 14px"><strong
                                                                    style="font-weight: bold">UNDERSTANDING YOUR ORDER
                                                                    STATUS</strong></span></span></span></a></p>
                                            <p class="text-justify"><span style="color: var(--color-id-200)"><span
                                                        style="line-height: 27px"><span style="text-align: JUSTIFY"><span
                                                                style="font-size: 14px"><strong style="font-weight: bold">|
                                                                </strong></span></span></span></span><span
                                                    style="color: var(--color-id-186)"><span style="line-height: 27px"><span
                                                            style="text-align: JUSTIFY"><span style="font-size: 14px"><strong
                                                                    style="font-weight: bold">&nbsp;&nbsp;</strong></span></span></span></span><a
                                                    target="_self" href="#"><span style="line-height: 27px"><span
                                                            style="text-align: JUSTIFY"><span style="font-size: 14px"><strong
                                                                    style="font-weight: bold">WHY IS
                                                                    YOUR ORDER NOT DELIVERING</strong></span></span></span></a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div id="block_247">
                <div class="block-bg"></div>
                <div class="container" id="app">
                    <div class="new_order-block ">
                        <div class="row new-order-form">
                            <div class="col-lg-8">
                                <div class="component_form_group component_card component_radio_button">
                                    <div class="card ">
                                        <form @submit.prevent="submitOrder" id="order-form">
                                            <div class="component_button_forms">
                                                <div class="form-group">
                                                    <div class="search-dropdown select2-container--default select2-container--below"
                                                        style="position: relative;">
                                                        <div class="input-wrapper"><button type="button"
                                                                class="input-wrapper__prepend"><span
                                                                    class="fas fa-search"></span></button> <input
                                                                placeholder="Search"
                                                                class="select2-selection select2-selection--single form-control">
                                                            <!---->
                                                        </div> <!---->
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="orderform-category" class="control-label">Category</label>
                                                    <select class="form-control select2-hidden-accessible"
                                                        id="orderform-category" name="categories" data-select="true"
                                                        data-select-search="true" data-select-search-placeholder="Search"
                                                        data-select-container="#select-category-container" tabindex="-1"
                                                        aria-hidden="true" v-model="selectedCategory" @change="fetchServices">
                                                        <option v-for="category in categories" :value="category.id">
                                                            {{ category . category_title }}
                                                        </option>
                                                    </select>
                                                    <div id="select-category-container" class="position-relative"></div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="orderform-service" class="control-label">Service</label>
                                                    <div class="d-flex">
                                                        <div class="w-100 new_order-block__services-list">
                                                            <select class="form-control select2-hidden-accessible"
                                                                id="orderform-service" name="OrderForm[service]"
                                                                data-select="true" data-select-search="true"
                                                                data-select-search-placeholder="Search"
                                                                data-select-container="#select-service-container"
                                                                tabindex="-1" aria-hidden="true">
                                                                <option data-type="0" value="10729"
                                                                    data-template="{{ service_name }} - {{ rate_formatted }}"
                                                                    data-id="10729"
                                                                    data-name="Instagram Followers | 99 Day Refill"
                                                                    data-rate_formatted="NGN 2500.00 per 1000">Instagram
                                                                    Followers | 99 Day Refill - NGN 2500.00 per 1000</option>
                                                            </select>
                                                            <div id="select-service-container" class="position-relative">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group fields component_service_description"
                                                    id="service_description">
                                                    <label for="service_description" class="control-label">Description</label>
                                                    <div class="panel-description">ADMIN NIOTE | Drops possible with this
                                                        service. <br>
                                                        Refill button inactive</div>
                                                </div>
                                                <div id="fields">
                                                    <div class="form-group hidden fields" id="order_user_name">
                                                        <label class="control-label"
                                                            for="field-orderform-fields-user_name">Username</label>
                                                        <input class="form-control w-full" name="OrderForm[user_name]"
                                                            value="" type="text"
                                                            id="field-orderform-fields-user_name">
                                                    </div>
                                                    <div class="form-group fields" id="order_link">
                                                        <label class="control-label"
                                                            for="field-orderform-fields-link">Link</label>
                                                        <input class="form-control" name="OrderForm[link]" value=""
                                                            type="text" id="field-orderform-fields-link">
                                                    </div>
                                                    <div class="form-group fields" id="order_quantity">
                                                        <label class="control-label"
                                                            for="field-orderform-fields-quantity">Quantity</label>
                                                        <input class="form-control" name="OrderForm[quantity]" value=""
                                                            type="text" id="field-orderform-fields-quantity"><small
                                                            class="help-block min-max">Min: 10 - Max: 20&nbsp;000</small>
                                                    </div>
                                                    <div id="dripfeed">
                                                        <div class="form-group fields hidden" id="order_check">
                                                            <div class="form-group__checkbox">
                                                                <label class="form-group__checkbox-label">
                                                                    <input name="OrderForm[check]" value="1"
                                                                        type="checkbox" id="field-orderform-fields-check">
                                                                    <span class="checkmark"></span>
                                                                </label>
                                                                <label for="field-orderform-fields-check"
                                                                    class="form-group__label-title">
                                                                    Drip-feed
                                                                </label>
                                                            </div>
                                                            <div class="hidden depend-fields" id="dripfeed-options"
                                                                data-depend="field-orderform-fields-check">
                                                                <div class="form-group">
                                                                    <label class="control-label"
                                                                        for="field-orderform-fields-runs">Runs</label>
                                                                    <input class="form-control" name="OrderForm[runs]"
                                                                        value="" type="text"
                                                                        id="field-orderform-fields-runs">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="control-label"
                                                                        for="field-orderform-fields-interval">Interval
                                                                        (minutes)</label>
                                                                    <input class="form-control" name="OrderForm[interval]"
                                                                        value="" type="text"
                                                                        id="field-orderform-fields-interval">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="control-label"
                                                                        for="field-orderform-fields-total-quantity">Total
                                                                        quantity</label>
                                                                    <input class="form-control"
                                                                        name="OrderForm[total_quantity]" value=""
                                                                        type="text"
                                                                        id="field-orderform-fields-total-quantity"
                                                                        readonly="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group hidden fields" id="order_posts">
                                                        <label class="control-label" for="field-orderform-fields-posts">New
                                                            posts</label>
                                                        <input class="form-control" name="OrderForm[posts]" value=""
                                                            type="text" id="field-orderform-fields-posts">
                                                    </div>
                                                    <div class="form-group hidden fields" id="order_old_posts">
                                                        <label class="control-label"
                                                            for="field-orderform-fields-old_posts">Old posts</label>
                                                        <input class="form-control" name="OrderForm[old_posts]"
                                                            value="" type="text"
                                                            id="field-orderform-fields-old_posts">
                                                        <small class="help-block max"></small>
                                                    </div>
                                                    <div class="form-group hidden fields" id="order_min">
                                                        <label class="control-label" for="order_count">Quantity</label>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <input type="text" class="form-control" id="order_count"
                                                                    name="OrderForm[min]" value=""
                                                                    placeholder="Min"><small class="help-block min-max">Min:
                                                                    10 - Max: 20&nbsp;000</small>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <input type="text" class="form-control" id="order_count"
                                                                    name="OrderForm[max]" value="" placeholder="Max">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group fields" id="order_average_time" style="">
                                                        <label class="control-label"
                                                            for="field-orderform-fields-average_time">Average time
                                                            <span class="ml-1 mr-1 fa fa-exclamation-circle"
                                                                data-toggle="tooltip" data-placement="right" title=""
                                                                data-original-title="The average completion time is calculated based on the completion times of the latest orders.">
                                                            </span>
                                                        </label>
                                                        <input class="form-control" readonly="" value=""
                                                            type="text" id="field-orderform-fields-average_time"
                                                            disabled="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="charge" class="control-label">Charge</label>
                                                    <input type="text" class="form-control" id="charge" value=""
                                                        readonly="">
                                                </div>
                                            </div>
                                            <input type="hidden" name="_csrf"
                                                value="wgLhBg2RDTpB4QlKaspSNgn0rEkWt6dGG9o6OMLUgjykR5tVSeV7DzWnWjlchiBsZJv1BknD4jxekUJyp6fKfw==">
                                            <div class="new-order-button-submit component_button_submit ">
                                                <button type="submit" class="btn btn-block btn-big-primary">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div id="block_247">
                <div class="block-bg"></div>
                <div id="new-order-app" style="width: 100%;">
                    <div class="container">
                        <div class="new_order-block">
                            <div class="row new-order-form">
                                <div class="col-lg-8">
                                    <div class="component_form_group component_card component_radio_button">
                                        <div class="card">
                                            <form @submit.prevent="placeOrder">
                                                <div class="component_button_forms">
                                                    <!-- Search Bar -->
                                                    {{-- <div class="form-group">
                                                        <input type="text" class="form-control" v-model="search"
                                                            placeholder="Search">
                                                    </div> --}}
                                                    <div v-if="orderSuccessData" class="alert alert-dismissible alert-success mb-3">
                                                        <button type="button" class="close" @click="orderSuccessData = null">×</button>
                                                        <strong>Your Order Received</strong><br>
                                                        <div>ID: @{{ orderSuccessData.id }}</div>
                                                        <div>Service: @{{ orderSuccessData.service }}</div>
                                                        <div>Link: @{{ orderSuccessData.link }}</div>
                                                        <div>Quantity: @{{ orderSuccessData.quantity }}</div>
                                                        <div>Charge: @{{ orderSuccessData.currency }} @{{ orderSuccessData.charge }}</div>
                                                        <div>Balance: @{{ orderSuccessData.currency }} @{{ orderSuccessData.balance }}</div>
                                                    </div>
                                                    <!-- Category Dropdown -->
                                                    <div class="form-group">
                                                        <label class="control-label">Category</label>
                                                        <select class="form-control" v-model="selectedCategory"
                                                            @change="handleCategoryChange">
                                                            <option disabled value="">Select Category</option>
                                                            <option v-for="category in categories" :key="category.id"
                                                                :value="category.id">
                                                                @{{ category.category_title }}
                                                            </option>
                                                        </select>
                                                        <span class="text-danger category" style="color: red;"></span>
                                                    </div>

                                                    <!-- Service Dropdown -->
                                                    <div class="form-group">
                                                        <label class="control-label">Service</label>
                                                        <select class="form-control" v-model="selectedService"
                                                            @change="handleServiceChange">
                                                            <option disabled value="">Select Service</option>
                                                            <option v-for="service in services" :key="service.id"
                                                                :value="service.id">
                                                                @{{ service.service_title }}
                                                            </option>
                                                        </select>
                                                        <span class="text-danger service" style="color: red;"></span>
                                                    </div>

                                                    <!-- Description -->
                                                    <div class="form-group" v-if="description">
                                                        <label class="control-label">Description</label>
                                                        <div class="panel-description">@{{ description }}</div>
                                                    </div>

                                                    <!-- Link Input -->
                                                    <div class="form-group">
                                                        <label class="control-label">Link</label>
                                                        <input type="text" class="form-control" v-model="link"
                                                            placeholder="https://example.com/profile">
                                                            <span class="text-danger link error-link" style="color: red;"></span>
                                                    </div>

                                                    <!-- Quantity Input -->
                                                    <div class="form-group">
                                                        <label class="control-label">Quantity</label>
                                                        <input type="number" class="form-control" v-model.number="quantity">
                                                        <small class="help-block min-max">Min: @{{ minAmount }} - Max: @{{ maxAmount }}</small>
                                                        <span class="text-danger quantity" style="color: red;"></span>
                                                    </div>

                                                    <div id="dripfeed" :class="{ show: isDripFeed, hidden: !isDripFeed }">
                                                        <div class="form-group fields" id="order_check">
                                                            <div class="form-group__checkbox">
                                                                <label class="form-group__checkbox-label">
                                                                    <input name="drip_feed" value="1"
                                                                        v-model="isChecked"
                                                                        disabled
                                                                        type="checkbox" id="field-orderform-fields-check">
                                                                    <span class="checkmark"></span>
                                                                </label>
                                                                <label for="field-orderform-fields-check"
                                                                    class="form-group__label-title">
                                                                    Drip-feed
                                                                </label>
                                                            </div>
                                                            <div class="depend-fields" id="dripfeed-options"
                                                                data-depend="field-orderform-fields-check">
                                                                <div class="form-group">
                                                                    <label class="control-label"
                                                                        for="field-orderform-fields-runs">Runs</label>
                                                                    <input class="form-control" v-model.number="runs"
                                                                        value="{{ old('runs') }}" type="text"
                                                                        id="field-orderform-fields-runs">
                                                                        <span class="text-danger runs" style="color: red;"></span>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="control-label"
                                                                        for="field-orderform-fields-interval">Interval
                                                                        (minutes)</label>
                                                                    <input class="form-control" v-model.number="interval"
                                                                        value="" type="text"
                                                                        id="field-orderform-fields-interval">
                                                                        <span class="text-danger interval" style="color: red;"></span>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="control-label"
                                                                        for="field-orderform-fields-total-quantity">Total
                                                                        quantity</label>
                                                                    <input class="form-control"
                                                                        name="total_quantity" :value="totalQuantity"
                                                                        type="text"
                                                                        id="field-orderform-fields-total-quantity"
                                                                        readonly="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Charge Display -->
                                                    <div class="form-group">
                                                        <label class="control-label">Charge</label>
                                                        <input type="text" class="form-control" :value="totalPrice"
                                                            readonly>
                                                    </div>

                                                    <div  class="form-group">
                                                        <label class="control-label">@lang("Comments")
                                                            <sub>(@lang("Optional"))</sub></label>
                                                        <textarea class="form-control" v-model="comments"
                                                                  rows="3"></textarea>
                                                        <span class="text-danger comments" style="color: red;"></span>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="form-group__checkbox">
                                                            <div class="form-group__checkbox">
                                                                <label class="form-group__checkbox-label">
                                                                    <input class="form-check-input" type="checkbox" v-model="check"
                                                                       id="Yes, i have confirmed the order!">
                                                                    <span class="checkmark"></span>
                                                                </label>
                                                                <label class="form-group__label-title"
                                                                       for="Yes, i have confirmed the order!">
                                                                    @lang("Yes, i have confirmed the order!")
                                                                </label>
                                                            </div>
                                                            <span class="text-danger check" style="color: red;"></span>
                                                        </div>
                                                    </div>

                                                    <!-- Submit Button -->
                                                    <div class="new-order-button-submit component_button_submit ">
                                                        <button type="submit"
                                                            class="btn btn-block btn-big-primary">Submit</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div>
            <div id="block_113">
                <div class="block-bg"></div>
                <div class="block-divider-top">
                    <svg width="100%" height="100%" viewBox="0 0 1280 140" preserveAspectRatio="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <g fill="currentColor">
                            <path d="M1280 0L640 70 0 0v140l640-70 640 70V0z" fill-opacity=".5" />
                            <path d="M1280 0H0l640 70 640-70z" />
                        </g>
                    </svg>
                </div>
                <div class="block-divider-bottom">
                    <svg width="100%" height="100%" viewBox="0 0 1280 140" preserveAspectRatio="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <g fill="currentColor">
                            <path d="M0 47.44L170 0l626.48 94.89L1110 87.11l170-39.67V140H0V47.44z" fill-opacity=".5" />
                            <path d="M0 90.72l140-28.28 315.52 24.14L796.48 65.8 1140 104.89l140-14.17V140H0V90.72z" />
                        </g>
                    </svg>
                </div>
                <div class="container">
                    <div class="block-signin-text ">
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="block-signin-text__block-text">
                                    <div class="block-signin-text__block-text-title">
                                        <h1>
                                            <span style="line-height: 14px">
                                                <span style="font-size: 50px">world fastest and cheapest smm panel</span>
                                            </span>
                                        </h1>
                                    </div>
                                    <div class="block-signin-text__block-text-description">
                                        <p>
                                            <span style="font-size: 20px">Get likes, follows, views and everything else you
                                                need
                                                from the best SMM panel.&nbsp;</span>
                                        </p>
                                        <p>
                                            <span style="font-size: 20px">All at super affordable prices.</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="component_card">
                                    <div class="card">
                                        <form method="post" action="{{ route('login') }}">
                                            @csrf
                                            <div>
                                                @if ($errors->any())
                                                    <div class="alert alert-dismissible alert-danger mb-3">
                                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                                        <ul class="mb-0">
                                                            @foreach ($errors->all() as $error)
                                                                <li>{{ __($error) }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                                <div class="component_form_group">
                                                    <div class="">
                                                        <div class="form-group">
                                                            <label>Username</label>
                                                            <input type="text" name="username"
                                                                value="{{ old('username') }}" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="component_form_group">
                                                    <div class="">
                                                        <div class="form-group">
                                                            <label>Password</label>
                                                            <div class="position-relative">
                                                                <input type="password" name="password" class="form-control">
                                                                <div class="sign-in__forgot h-100 d-flex align-items-center">
                                                                    <a href="{{ route('password.request') }}">Forgot
                                                                        password?</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="component_checkbox_remember_me">
                                                    <div class="">
                                                        <div class="sign-in__remember-me">
                                                            <div class="form-group__checkbox">
                                                                <label class="form-group__checkbox-label">
                                                                    <input type="checkbox" name="remember"
                                                                        {{ old('remember') ? 'checked' : '' }}
                                                                        id="block_113_remember_me">
                                                                    <span class="checkmark"></span>
                                                                </label>
                                                                <label class="form-group__label-title"
                                                                    for="block_113_remember_me">Remember me</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if (basicControl()->reCaptcha_status_login)
                                                    <div class="g-recaptcha form-group">
                                                        {!! NoCaptcha::renderJs(session()->get('trans')) !!}
                                                        {!! NoCaptcha::display(
                                                            $basic->theme == 'deepblue' || $basic->theme == 'darkmode' ? ['data-theme' => 'dark'] : [],
                                                        ) !!}
                                                        @error('g-recaptcha-response')
                                                            <span class="text-danger mt-1">@lang($message)</span>
                                                        @enderror
                                                    </div>
                                                @endif
                                                <div class="form-group">
                                                    <div class="component_button_submit">
                                                        <div class="">
                                                            <button class="btn btn-block btn-big-primary" type="submit">Sign
                                                                in</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center d-flex justify-content-center">
                                                <div>Do not have an account?</div>
                                                <a href="{{ route('register') }}" class="block-signin-text__sign-up-link">Sign
                                                    up</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="block_161">
                <div class="block-bg"></div>
                <div class="container">
                    <div class="header-with-text ">
                        <div class="row">
                            <div class="col-12">
                                <div class="text-block__title">
                                    <h2><span style="font-size: 38px"><span style="color: var(--color-id-186)">the best SMM
                                                panel</span></span></h2>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="text-block__description">
                                    <p><span style="font-size: 18px"><span
                                                style="color: var(--color-id-186)">@lang(basicControl()->site_title)
                                                is a top SMM provider.</span></span></p>
                                    <p><span style="font-size: 18px"><span style="color: var(--color-id-186)">Get all you need
                                                to
                                                automatically grow your social media pages.</span></span></p>
                                    <p><br></p>
                                    <p><span style="font-size: 18px"><span style="color: var(--color-id-186)">We're a top SMM
                                                panel
                                                for Instagram, TikTok, Twitter and YouTube engagement from targetted, genuine
                                                audiences.</span></span></p>
                                    <p><br></p>
                                    <p><br></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="block_162">
                <div class="block-bg"></div>
                <div class="block-divider-top">
                    <svg width="100%" height="100%" viewBox="0 0 1280 140" preserveAspectRatio="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <g fill="currentColor">
                            <path d="M0 90.72l140-28.28 315.52 24.14L796.48 65.8 1140 104.89l140-14.17V0H0v90.72z"
                                fill-opacity=".5" />
                            <path d="M0 0v47.44L170 0l626.48 94.89L1110 87.11l170-39.67V0H0z" />
                        </g>
                    </svg>
                </div>
                <div class="container">
                    <div class="features-block-icons ">
                        <div class="row align-items-start justify-content-center">
                            <div class="col-lg-3 col-md-6 mb-4">
                                <div class="card features-block__card h-100"
                                    style="background: none; color: inherit; padding-left: 24px; padding-right: 24px; border-top-left-radius: 0px; border-bottom-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px;  box-shadow: 0px 8px 32px 0px var(--color-id-198);">
                                    <div class="features-block__header">
                                        <div class="features-block__header-preview style-bg-primary-alpha-10 style-border-radius-default style-text-primary"
                                            style="margin-bottom: 10px;
         height: 96px;                  font-size: 96px;                                          background: none;                                                                                                                                                                                                 ">
                                            <span class="feature-block__icon fab fa-instagram-square"
                                                style="
                            transform: rotate(0deg);
                            color: var(--color-id-232);
                            text-shadow: Array;
                            border-radius: 0px;
                            background: none;
                            padding: 10px;
                            "></span>
                                        </div>
                                        <div class="features-block__header-title"
                                            style="margin-bottom: 10px; padding-left: 0px; padding-right: 0px;">
                                            <h3 class="text-center">
                                                <span style="text-align: CENTER">
                                                    <strong style="font-weight: bold">Instagram SMM services &nbsp;</strong>
                                                </span>
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="features-block__body">
                                        <div class="features-block__body-description"
                                            style="padding-left: 0px; padding-right: 0px;">
                                            <p class="text-justify">
                                                <span style="text-align: JUSTIFY">Engagement, likes and follows to boost
                                                    your Istagram profile</span>
                                            </p>
                                            <p class="text-justify">
                                                <br>
                                            </p>
                                            <p class="text-justify">
                                                <span style="text-align: JUSTIFY">✔ Real followers</span>
                                            </p>
                                            <p class="text-justify">
                                                <span style="text-align: JUSTIFY">✔ Targetted engagement</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 mb-4">
                                <div class="card features-block__card h-100"
                                    style="
      background: none;                                                                                          color: inherit;                                                                                                                                                                                  padding-left: 40px;                                                                                                                                                                                                                                                                                                                                                                                                                                                          box-shadow: none;                                             ">
                                    <div class="features-block__header">
                                        <div class="features-block__header-preview style-bg-primary-alpha-10 style-border-radius-default style-text-primary"
                                            style="margin-bottom: 10px;
         height: 96px;                  font-size: 96px;                                          background: none;                                                                                                                                                                                                 ">
                                            <span class="feature-block__icon fab fa-twitter"
                                                style="
                            transform: rotate(0deg);
                            color: var(--color-id-233);
                            text-shadow: Array;
                            border-radius: 0px;
                            background: none;
                            padding: 10px;
                            "></span>
                                        </div>
                                        <div class="features-block__header-title"
                                            style="margin-bottom: 10px; padding-left: 0px; padding-right: 0px;">
                                            <h3 class="text-center">
                                                <span style="text-align: CENTER">
                                                    <strong style="font-weight: bold">Twitter SMM services</strong>
                                                </span>
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="features-block__body">
                                        <div class="features-block__body-description"
                                            style="padding-left: 0px; padding-right: 0px;">
                                            <p class="text-justify">
                                                <span style="text-align: JUSTIFY">Relaible, non-bot Twitter likes, retweets,
                                                    and follows</span>
                                            </p>
                                            <p class="text-justify">
                                                <br>
                                            </p>
                                            <p class="text-justify">
                                                <span style="text-align: JUSTIFY">✔ Targetted audience</span>
                                            </p>
                                            <p class="text-justify">
                                                <span style="text-align: JUSTIFY">✔ Real engagement</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="block_165">
                <div class="block-bg">
                    <div class="bg-image"></div>
                </div>
                <div class="block-divider-bottom">
                    <svg width="100%" height="100%" viewBox="0 0 1280 140" preserveAspectRatio="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <g fill="currentColor">
                            <path d="M0 47.44L170 0l626.48 94.89L1110 87.11l170-39.67V140H0V47.44z" fill-opacity=".5" />
                            <path d="M0 90.72l140-28.28 315.52 24.14L796.48 65.8 1140 104.89l140-14.17V140H0V90.72z" />
                        </g>
                    </svg>
                </div>
                <div class="container">
                    <div class="text-block-with-image ">
                        <div class="row">
                            <div class="col">
                                <div class="d-md-flex align-items-start">
                                    <div class="text-block__description">
                                        <h2 class="text-left">
                                            <span style="font-size: 50px">
                                                <span style="text-align: LEFT">
                                                    <u style="text-decoration: underline">Tried and teste</u>
                                                </span>
                                            </span>
                                            <span style="font-size: 50px">
                                                <u style="text-decoration: underline">d smm panel</u>
                                            </span>
                                        </h2>
                                        <h2>
                                            <br>
                                        </h2>
                                        <p class="text-left">
                                            <span style="color: var(--color-id-200)">
                                                <span style="font-size: 40px">
                                                    <span style="text-align: LEFT">
                                                        <u style="text-decoration: underline">Over 2300 brands and social media
                                                            users rely on our SMM panel to drive value-creating engagement</u>
                                                    </span>
                                                </span>
                                            </span>
                                        </p>
                                        <p>
                                            <br>
                                        </p>
                                        <p>
                                            <br>
                                        </p>
                                    </div>
                                    <div class="text-block__image">
                                        <img src="https://storage.perfectcdn.com/9z8eus/z85tsmsotbeji753.png" alt=""
                                            title="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="block_166">
                <div class="block-bg"></div>
                <div class="container">
                    <div class="text-block-with-button ">
                        <div class="row">
                            <div class="col-12">
                                <div class="text-block-with-button__description">
                                    <h2 class="text-center">
                                        <span style="color: var(--color-id-186)">
                                            <span style="text-align: CENTER">Use our custom made social media marketing
                                                services to
                                                quickly and efficiently boost </span>
                                        </span>
                                        <span style="color: var(--color-id-186)">the growth of your social media
                                            accounts.</span>
                                    </h2>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="text-block-with-button__button component_button_link">
                                    <div class="">
                                        <a class="btn btn-big-primary" target="_self" href="#">
                                            <p>Get started</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="block_114">
                <div class="block-bg"></div>
                <div class="block-divider-top">
                    <svg width="100%" height="100%" viewBox="0 0 1280 140" preserveAspectRatio="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <g fill="currentColor">
                            <path d="M0 90.72l140-28.28 315.52 24.14L796.48 65.8 1140 104.89l140-14.17V0H0v90.72z"
                                fill-opacity=".5" />
                            <path d="M0 0v47.44L170 0l626.48 94.89L1110 87.11l170-39.67V0H0z" />
                        </g>
                    </svg>
                </div>
                <div class="block-divider-bottom">
                    <svg width="100%" height="100%" viewBox="0 0 1280 140" preserveAspectRatio="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <g fill="currentColor">
                            <path d="M0 47.44L170 0l626.48 94.89L1110 87.11l170-39.67V140H0V47.44z" fill-opacity=".5" />
                            <path d="M0 90.72l140-28.28 315.52 24.14L796.48 65.8 1140 104.89l140-14.17V140H0V90.72z" />
                        </g>
                    </svg>
                </div>
                <div class="container-fluid">
                    <div class="how-it-works ">
                        <div class="row how-it-works-row justify-content-center">
                            <div class="col-md-3 how-it-works-col">
                                <div class="card how-it-works-card"
                                    style="
 background: none;                                             											 color: inherit; 																																																																																																																																																										 box-shadow: none; 											">
                                    <div class="how-it-works-arrow-top style-svg-g-primary">
                                        <svg width="125px" height="31px" viewBox="0 0 125 31" version="1.1"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g id="Landing" stroke="none" stroke-width="1" fill="none"
                                                fill-rule="evenodd">
                                                <g transform="translate(-942.000000, -1387.000000)" fill="#1E79E4"
                                                    id="Group-10">
                                                    <g transform="translate(165.000000, 1368.000000)">
                                                        <path
                                                            d="M889.516523,26.5080119 L891.910644,20.9496585 L902,32.9164837 L886.372927,33.807873 L888.723185,28.3469617 C871.347087,21.9210849 854.507984,19.7125409 838.195168,21.7129851 C818.169006,24.1687976 798.907256,32.9719131 780.398868,48.1424468 L779.638673,48.7694781 L778.869195,49.4081513 L777.591849,47.8691952 L778.361327,47.2305219 C797.38492,31.4407805 817.252224,22.2662407 837.951732,19.7278557 C854.622929,17.6834632 871.814783,19.9463129 889.516523,26.5080119 Z"
                                                            id="Line3"></path>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="how-it-works-arrow-bottom style-svg-g-primary">
                                        <svg width="125px" height="31px" viewBox="0 0 125 31" version="1.1"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g id="Landing" stroke="none" stroke-width="1" fill="none"
                                                fill-rule="evenodd">
                                                <g transform="translate(-657.000000, -1461.000000)" fill="#1E79E4"
                                                    id="Group-10">
                                                    <g transform="translate(165.000000, 1368.000000)">
                                                        <path
                                                            d="M493.869195,93.5918487 L494.638673,94.2305219 C513.37968,109.785715 532.894675,118.797561 553.195168,121.287015 C569.507984,123.287459 586.347087,121.078915 603.723185,114.653038 L601.372927,109.192127 L617,110.083516 L606.910644,122.050341 L604.516523,116.491988 C586.814783,123.053687 569.622929,125.316537 552.951732,123.272144 C532.528218,120.767604 512.914862,111.802694 494.12272,96.3975396 L493.361327,95.7694781 L492.591849,95.1308048 L493.869195,93.5918487 Z"
                                                            id="Line2"></path>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="d-flex justify-content-center how-it-works-preview">
                                        <div class="how-it-works-number style-box-shadow-default style-bg-light style-border-radius-50 style-card-number"
                                            style="
              width: 80px; 															 height: 80px; 															 background: var(--color-id-194); 																														 border-top-left-radius: 50px; 															 border-bottom-left-radius: 50px; 															 border-top-right-radius: 50px; 															 border-bottom-right-radius: 50px; 																																																																																																									 font-size: 24px; 															 color: var(--color-id-186); ">
                                            1
                                        </div>
                                    </div>
                                    <div class="how-it-works-title"
                                        style="margin-bottom: 8px; padding-left: 0px; padding-right: 0x;">
                                        <p class="text-center">
                                            <span style="text-align: CENTER">
                                                <strong style="font-weight: bold">1. Sign up and log in</strong>
                                            </span>
                                        </p>
                                    </div>
                                    <div class="how-it-works-description" style="padding-left: 0px; padding-right: 0x;">
                                        <p class="text-center">
                                            <span style="text-align: CENTER">You need to sign up and log in to your
                                                account.</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 how-it-works-col">
                                <div class="card how-it-works-card"
                                    style="
 background: none;                                             											 color: inherit; 																																																																																																																																																										 box-shadow: none; 											">
                                    <div class="how-it-works-arrow-top style-svg-g-primary">
                                        <svg width="125px" height="31px" viewBox="0 0 125 31" version="1.1"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g id="Landing" stroke="none" stroke-width="1" fill="none"
                                                fill-rule="evenodd">
                                                <g transform="translate(-942.000000, -1387.000000)" fill="#1E79E4"
                                                    id="Group-10">
                                                    <g transform="translate(165.000000, 1368.000000)">
                                                        <path
                                                            d="M889.516523,26.5080119 L891.910644,20.9496585 L902,32.9164837 L886.372927,33.807873 L888.723185,28.3469617 C871.347087,21.9210849 854.507984,19.7125409 838.195168,21.7129851 C818.169006,24.1687976 798.907256,32.9719131 780.398868,48.1424468 L779.638673,48.7694781 L778.869195,49.4081513 L777.591849,47.8691952 L778.361327,47.2305219 C797.38492,31.4407805 817.252224,22.2662407 837.951732,19.7278557 C854.622929,17.6834632 871.814783,19.9463129 889.516523,26.5080119 Z"
                                                            id="Line3"></path>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="how-it-works-arrow-bottom style-svg-g-primary">
                                        <svg width="125px" height="31px" viewBox="0 0 125 31" version="1.1"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g id="Landing" stroke="none" stroke-width="1" fill="none"
                                                fill-rule="evenodd">
                                                <g transform="translate(-657.000000, -1461.000000)" fill="#1E79E4"
                                                    id="Group-10">
                                                    <g transform="translate(165.000000, 1368.000000)">
                                                        <path
                                                            d="M493.869195,93.5918487 L494.638673,94.2305219 C513.37968,109.785715 532.894675,118.797561 553.195168,121.287015 C569.507984,123.287459 586.347087,121.078915 603.723185,114.653038 L601.372927,109.192127 L617,110.083516 L606.910644,122.050341 L604.516523,116.491988 C586.814783,123.053687 569.622929,125.316537 552.951732,123.272144 C532.528218,120.767604 512.914862,111.802694 494.12272,96.3975396 L493.361327,95.7694781 L492.591849,95.1308048 L493.869195,93.5918487 Z"
                                                            id="Line2"></path>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="d-flex justify-content-center how-it-works-preview">
                                        <div class="how-it-works-number style-box-shadow-default style-bg-light style-border-radius-50 style-card-number"
                                            style="
              width: 80px; 															 height: 80px; 															 background: var(--color-id-194); 																														 border-top-left-radius: 50px; 															 border-bottom-left-radius: 50px; 															 border-top-right-radius: 50px; 															 border-bottom-right-radius: 50px; 																																																																																																									 font-size: 24px; 															 color: var(--color-id-186); ">
                                            2
                                        </div>
                                    </div>
                                    <div class="how-it-works-title"
                                        style="margin-bottom: 8px; padding-left: 0px; padding-right: 0x;">
                                        <p class="text-center">
                                            <span style="text-align: CENTER">
                                                <strong style="font-weight: bold">2. Deposit funds</strong>
                                            </span>
                                        </p>
                                    </div>
                                    <div class="how-it-works-description" style="padding-left: 0px; padding-right: 0x;">
                                        <p class="text-center">
                                            <span style="text-align: CENTER">Add funds to your account using a suitable payment
                                                option.</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 how-it-works-col">
                                <div class="card how-it-works-card"
                                    style="
 background: none;                                             											 color: inherit; 																																																																																																																																																										 box-shadow: none; 											">
                                    <div class="how-it-works-arrow-top style-svg-g-primary">
                                        <svg width="125px" height="31px" viewBox="0 0 125 31" version="1.1"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g id="Landing" stroke="none" stroke-width="1" fill="none"
                                                fill-rule="evenodd">
                                                <g transform="translate(-942.000000, -1387.000000)" fill="#1E79E4"
                                                    id="Group-10">
                                                    <g transform="translate(165.000000, 1368.000000)">
                                                        <path
                                                            d="M889.516523,26.5080119 L891.910644,20.9496585 L902,32.9164837 L886.372927,33.807873 L888.723185,28.3469617 C871.347087,21.9210849 854.507984,19.7125409 838.195168,21.7129851 C818.169006,24.1687976 798.907256,32.9719131 780.398868,48.1424468 L779.638673,48.7694781 L778.869195,49.4081513 L777.591849,47.8691952 L778.361327,47.2305219 C797.38492,31.4407805 817.252224,22.2662407 837.951732,19.7278557 C854.622929,17.6834632 871.814783,19.9463129 889.516523,26.5080119 Z"
                                                            id="Line3"></path>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="how-it-works-arrow-bottom style-svg-g-primary">
                                        <svg width="125px" height="31px" viewBox="0 0 125 31" version="1.1"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g id="Landing" stroke="none" stroke-width="1" fill="none"
                                                fill-rule="evenodd">
                                                <g transform="translate(-657.000000, -1461.000000)" fill="#1E79E4"
                                                    id="Group-10">
                                                    <g transform="translate(165.000000, 1368.000000)">
                                                        <path
                                                            d="M493.869195,93.5918487 L494.638673,94.2305219 C513.37968,109.785715 532.894675,118.797561 553.195168,121.287015 C569.507984,123.287459 586.347087,121.078915 603.723185,114.653038 L601.372927,109.192127 L617,110.083516 L606.910644,122.050341 L604.516523,116.491988 C586.814783,123.053687 569.622929,125.316537 552.951732,123.272144 C532.528218,120.767604 512.914862,111.802694 494.12272,96.3975396 L493.361327,95.7694781 L492.591849,95.1308048 L493.869195,93.5918487 Z"
                                                            id="Line2"></path>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="d-flex justify-content-center how-it-works-preview">
                                        <div class="how-it-works-number style-box-shadow-default style-bg-light style-border-radius-50 style-card-number"
                                            style="
              width: 80px; 															 height: 80px; 															 background: var(--color-id-194); 																														 border-top-left-radius: 50px; 															 border-bottom-left-radius: 50px; 															 border-top-right-radius: 50px; 															 border-bottom-right-radius: 50px; 																																																																																																									 font-size: 24px; 															 color: var(--color-id-186); ">
                                            3
                                        </div>
                                    </div>
                                    <div class="how-it-works-title"
                                        style="margin-bottom: 8px; padding-left: 0px; padding-right: 0x;">
                                        <p class="text-center">
                                            <span style="text-align: CENTER">
                                                <strong style="font-weight: bold">3. Place an order</strong>
                                            </span>
                                        </p>
                                    </div>
                                    <div class="how-it-works-description" style="padding-left: 0px; padding-right: 0x;">
                                        <p class="text-center">
                                            <span style="text-align: CENTER">Place your orders to help your business become
                                                more
                                                popular.</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 how-it-works-col">
                                <div class="card how-it-works-card"
                                    style="
 background: none;                                             											 color: inherit; 																																																																																																																																																										 box-shadow: none; 											">
                                    <div class="how-it-works-arrow-top style-svg-g-primary">
                                        <svg width="125px" height="31px" viewBox="0 0 125 31" version="1.1"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g id="Landing" stroke="none" stroke-width="1" fill="none"
                                                fill-rule="evenodd">
                                                <g transform="translate(-942.000000, -1387.000000)" fill="#1E79E4"
                                                    id="Group-10">
                                                    <g transform="translate(165.000000, 1368.000000)">
                                                        <path
                                                            d="M889.516523,26.5080119 L891.910644,20.9496585 L902,32.9164837 L886.372927,33.807873 L888.723185,28.3469617 C871.347087,21.9210849 854.507984,19.7125409 838.195168,21.7129851 C818.169006,24.1687976 798.907256,32.9719131 780.398868,48.1424468 L779.638673,48.7694781 L778.869195,49.4081513 L777.591849,47.8691952 L778.361327,47.2305219 C797.38492,31.4407805 817.252224,22.2662407 837.951732,19.7278557 C854.622929,17.6834632 871.814783,19.9463129 889.516523,26.5080119 Z"
                                                            id="Line3"></path>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="how-it-works-arrow-bottom style-svg-g-primary">
                                        <svg width="125px" height="31px" viewBox="0 0 125 31" version="1.1"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g id="Landing" stroke="none" stroke-width="1" fill="none"
                                                fill-rule="evenodd">
                                                <g transform="translate(-657.000000, -1461.000000)" fill="#1E79E4"
                                                    id="Group-10">
                                                    <g transform="translate(165.000000, 1368.000000)">
                                                        <path
                                                            d="M493.869195,93.5918487 L494.638673,94.2305219 C513.37968,109.785715 532.894675,118.797561 553.195168,121.287015 C569.507984,123.287459 586.347087,121.078915 603.723185,114.653038 L601.372927,109.192127 L617,110.083516 L606.910644,122.050341 L604.516523,116.491988 C586.814783,123.053687 569.622929,125.316537 552.951732,123.272144 C532.528218,120.767604 512.914862,111.802694 494.12272,96.3975396 L493.361327,95.7694781 L492.591849,95.1308048 L493.869195,93.5918487 Z"
                                                            id="Line2"></path>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="d-flex justify-content-center how-it-works-preview">
                                        <div class="how-it-works-number style-box-shadow-default style-bg-light style-border-radius-50 style-card-number"
                                            style="
              width: 80px; 															 height: 80px; 															 background: var(--color-id-194); 																														 border-top-left-radius: 50px; 															 border-bottom-left-radius: 50px; 															 border-top-right-radius: 50px; 															 border-bottom-right-radius: 50px; 																																																																																																									 font-size: 24px; 															 color: var(--color-id-186); ">
                                            4
                                        </div>
                                    </div>
                                    <div class="how-it-works-title"
                                        style="margin-bottom: 8px; padding-left: 0px; padding-right: 0x;">
                                        <p class="text-center">
                                            <span style="text-align: CENTER">
                                                <strong style="font-weight: bold">4. Fast results</strong>
                                            </span>
                                        </p>
                                    </div>
                                    <div class="how-it-works-description" style="padding-left: 0px; padding-right: 0x;">
                                        <p class="text-center">
                                            <span style="text-align: CENTER">We'll inform you as soon as your order is
                                                complete.
                                                Enjoy amazing results!</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="block_120">
                <div class="block-bg"></div>
                <div class="block-divider-bottom">
                    <svg width="100%" height="100%" viewBox="0 0 1280 140" preserveAspectRatio="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <g fill="currentColor">
                            <path d="M0 47.44L170 0l626.48 94.89L1110 87.11l170-39.67V140H0V47.44z" fill-opacity=".5" />
                            <path d="M0 90.72l140-28.28 315.52 24.14L796.48 65.8 1140 104.89l140-14.17V140H0V90.72z" />
                        </g>
                    </svg>
                </div>
                <div class="container">
                    <div class="reviews-slider ">
                        <div class="reviews-slider">
                            <div data-slider="1"
                                data-slider-options="{'dots':true,'infinite':true,'speed':500,'autoplay':true,'autoplaySpeed':5000,'slidesToShow':2,'slidesToScroll':1,'responsive':[{'breakpoint':991,'settings':{'slidesToShow':1,'slidesToScroll':1}}],'rtl':false}">
                                <div class="reviews-slider__slide">
                                    <div class="card"
                                        style="
                                                                                                                                                                                                                                                                     border-top-left-radius: 0px;                                  border-bottom-left-radius: 0px;                                  border-top-right-radius: 0px;                                  border-bottom-right-radius: 0px;                                                                                                                                                                                                 ">
                                        <div class="reviews-slider__slide-photo"
                                            style="margin-bottom: 16px; justify-content: flex-start;">
                                            <div class="reviews-slider__slide-avatar"
                                                style="background-image: url(https://storage.perfectcdn.com/9z8eus/i8enx4rugq03sunc.png);">
                                            </div>
                                        </div>
                                        <div class="reviews-slider__slide-name"
                                            style="padding-left: 0px; padding-right: 0px; margin-bottom: 10px;">
                                            <p>
                                                <strong style="font-weight: bold">Peter</strong>
                                            </p>
                                        </div>
                                        <div class="reviews-slider__slide-description"
                                            style="padding-left: 0px; padding-right: 0px;">
                                            <p>No other social media panel comes close. trust I've tried many.&nbsp;</p>
                                            <p>My number one guys for Instagram followers. Never dissapoint</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="reviews-slider__slide">
                                    <div class="card"
                                        style="
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    ">
                                        <div class="reviews-slider__slide-photo"
                                            style="margin-bottom: 16px; justify-content: flex-start;">
                                            <div class="reviews-slider__slide-avatar"
                                                style="background-image: url(https://storage.perfectcdn.com/9z8eus/7swhpnrjb7semp69.png);">
                                            </div>
                                        </div>
                                        <div class="reviews-slider__slide-name"
                                            style="padding-left: 0px; padding-right: 0px; margin-bottom: 8px;">
                                            <p>
                                                <strong style="font-weight: bold">Ibro</strong>
                                            </p>
                                        </div>
                                        <div class="reviews-slider__slide-description"
                                            style="padding-left: 0px; padding-right: 0px;">
                                            <p>They do thier best to get folowers you want. I recommend them &nbsp;</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="reviews-slider__slide">
                                    <div class="card"
                                        style="
                                                                                                                                                                                                                                                                     border-top-left-radius: 0px;                                  border-bottom-left-radius: 0px;                                  border-top-right-radius: 0px;                                  border-bottom-right-radius: 0px;                                                                                                                                                                                                 ">
                                        <div class="reviews-slider__slide-photo"
                                            style="margin-bottom: 10px; justify-content: flex-start;">
                                            <div class="reviews-slider__slide-avatar"
                                                style="background-image: url(https://storage.perfectcdn.com/9z8eus/ibpxpmsud1sqpn5s.png);">
                                            </div>
                                        </div>
                                        <div class="reviews-slider__slide-name"
                                            style="padding-left: 0px; padding-right: 0px; margin-bottom: 8px;">
                                            <p>
                                                <strong style="font-weight: bold">Samuel</strong>
                                            </p>
                                        </div>
                                        <div class="reviews-slider__slide-description"
                                            style="padding-left: 0px; padding-right: 0px;">
                                            <p>Support was extremely quick and super accomodating in helping me get the exact
                                                SMM services I wanted. Highly recommended</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="block_125">
                <div class="block-bg"></div>
                <div class="container">
                    <div class="faq ">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="faq-block__card">
                                            <div class="card"
                                                style="
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ">
                                                <div class="faq-block__header collapsed" data-toggle="collapse"
                                                    data-target="#faq-block-125-1" aria-expanded="false"
                                                    aria-controls="#faq-block-125-1">
                                                    <div class="faq-block__header-title">
                                                        <h4>What is an SMM panel?</h4>
                                                    </div>
                                                    <div class="faq-block__header-icon">
                                                        <div class="style-text-dark faq-block__icon"
                                                            style="color: var(--color-id-184);"></div>
                                                    </div>
                                                </div>
                                                <div class="faq-block__body collapse" id="faq-block-125-1">
                                                    <div class="faq-block__body-description" style="padding-top: 8px">
                                                        <p>SMM panels are online stores where people are able to purchase cheap
                                                            SMM services.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="faq-block__card">
                                            <div class="card"
                                                style="
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ">
                                                <div class="faq-block__header collapsed" data-toggle="collapse"
                                                    data-target="#faq-block-125-2" aria-expanded="false"
                                                    aria-controls="#faq-block-125-2">
                                                    <div class="faq-block__header-title">
                                                        <h4>What SMM services can I buy on your panel?</h4>
                                                    </div>
                                                    <div class="faq-block__header-icon">
                                                        <div class="style-text-dark faq-block__icon"
                                                            style="color: var(--color-id-184);"></div>
                                                    </div>
                                                </div>
                                                <div class="faq-block__body collapse" id="faq-block-125-2">
                                                    <div class="faq-block__body-description" style="padding-top: 8px">
                                                        <p>Our panel provides different types of SMM services, such as
                                                            followers, views, likes and more.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="faq-block__card">
                                            <div class="card"
                                                style="
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ">
                                                <div class="faq-block__header collapsed" data-toggle="collapse"
                                                    data-target="#faq-block-125-3" aria-expanded="false"
                                                    aria-controls="#faq-block-125-3">
                                                    <div class="faq-block__header-title">
                                                        <h4>Are SMM services offered here safe to order?</h4>
                                                    </div>
                                                    <div class="faq-block__header-icon">
                                                        <div class="style-text-dark faq-block__icon"
                                                            style="color: var(--color-id-184);"></div>
                                                    </div>
                                                </div>
                                                <div class="faq-block__body collapse" id="faq-block-125-3">
                                                    <div class="faq-block__body-description" style="padding-top: 8px">
                                                        <p>Using our SMM services is 100% safe, our panel is secure and we offer
                                                            high-quality services.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="faq-block__card">
                                            <div class="card"
                                                style="
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ">
                                                <div class="faq-block__header collapsed" data-toggle="collapse"
                                                    data-target="#faq-block-125-4" aria-expanded="false"
                                                    aria-controls="#faq-block-125-4">
                                                    <div class="faq-block__header-title">
                                                        <h4>A mass order — what is it?</h4>
                                                    </div>
                                                    <div class="faq-block__header-icon">
                                                        <div class="style-text-dark faq-block__icon"
                                                            style="color: var(--color-id-184);"></div>
                                                    </div>
                                                </div>
                                                <div class="faq-block__body collapse" id="faq-block-125-4">
                                                    <div class="faq-block__body-description" style="padding-top: 8px">
                                                        <p>A mass order allows placing multiple orders at once.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="faq-block__card">
                                            <div class="card"
                                                style="
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ">
                                                <div class="faq-block__header collapsed" data-toggle="collapse"
                                                    data-target="#faq-block-125-5" aria-expanded="false"
                                                    aria-controls="#faq-block-125-5">
                                                    <div class="faq-block__header-title">
                                                        <h4>What is the purpose of Drip-feed?</h4>
                                                    </div>
                                                    <div class="faq-block__header-icon">
                                                        <div class="style-text-dark faq-block__icon"
                                                            style="color: var(--color-id-184);"></div>
                                                    </div>
                                                </div>
                                                <div class="faq-block__body collapse" id="faq-block-125-5">
                                                    <div class="faq-block__body-description" style="padding-top: 8px">
                                                        <p>The engagement on the chosen account can be built gradually, and
                                                            Drip-feed will help you with that. For example, if you want 2000
                                                            likes on your Instagram post, you can divide them into parts for a
                                                            seamless effect: as an option, you can get 200 likes/day for 10
                                                            days.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="block_167">
                <div class="block-bg"></div>
                <div class="container">
                    <div class="text-block-2-columns-card ">
                        <div class="row">
                            <div class="col-lg-6 text-block-2-columns-col">
                                <div class="component_card_1">
                                    <div class="card">
                                        <div class="text-block__description">
                                            <h2><span style="color: var(--color-id-186)">Company</span></h2>
                                            <p><a target="_self" href="/blog"><span
                                                        style="color: var(--color-id-186)">Blog</span></a></p>
                                            <p><a target="_self" href="https://reallysimplesocial.com/refund-policy"><span
                                                        style="color: var(--color-id-186)">Refund policy</span></a></p>
                                            <p><a target="_self" href="https://reallysimplesocial.com/contact-us"><span
                                                        style="color: var(--color-id-186)">Contact Us</span></a></p>
                                            <p><a target="_self" href="https://reallysimplesocial.com/privacy-policy"><span
                                                        style="color: var(--color-id-186)">Privacy policy</span></a></p>
                                            <p><a target="_self" href="/terms"><span
                                                        style="color: var(--color-id-186)">Terms
                                                        and conditions</span></a></p>
                                            <p><span style="color: var(--color-id-186)">Email Us |
                                                    reallysimplesociallive@gmail.com</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 text-block-2-columns-col">
                                <div class="component_card_2">
                                    <div class="card">
                                        <div class="text-block__description">
                                            <h2><span style="color: var(--color-id-186)">Quick links&nbsp;</span></h2>
                                            <p><a target="_self"
                                                    href="https://reallysimplesocial.com/instagram-followers"><span
                                                        style="color: var(--color-id-186)">Get Instagram followers and
                                                        likes</span></a></p>
                                            <p><span style="color: var(--color-id-186)">Get Twitter followers and likes</span>
                                            </p>
                                            <p><span style="color: var(--color-id-186)">Get Youtube subscribers, views and
                                                    likes</span></p>
                                            <p><a target="_self" href="https://reallysimplesocial.com/tiktok-followers"><span
                                                        style="color: var(--color-id-186)">Get Tik-Tok Subscribers, views and
                                                        likes</span></a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endauth
@endsection

@auth
    @push('script')
        <script src="{{ asset('assets/global/js/notiflix-aio-3.2.6.min.js') }}"></script>
        <script src="{{ asset('assets/global/js/vue.global.prod.min.js') }}"></script>
        <script src="{{ asset('assets/global/js/axios.min.js') }}"></script>
    @endpush
    @push('script')
        <script>
            const {
                createApp
            } = Vue;

            createApp({
                data() {
                    return {
                        categories: [],
                        services: [],
                        selectedCategory: '',
                        selectedService: '',
                        serviceName: '',
                        description: '',
                        pricePer: 0,
                        quantity: 0,
                        link: '',
                        check: '',
                        comments: '',
                        currency: @json($currency),
                        fractionNumber: '{{ basicControl()->fraction_number }}',
                        // Drip-Feed Related
                        isDripFeed: false,
                        runs: 0,
                        interval: 0,
                        orderSuccessData: null
                    };
                },

                computed: {
                    totalQuantity() {
                        return this.isDripFeed ? (this.quantity * this.runs) : this.quantity == 0 ? "" : this.quantity;
                    },
                    totalPrice() {
                        const baseQuantity = this.quantity;
                        const total = (baseQuantity / 1000) * this.pricePer;
                        return total.toFixed(this.fractionNumber);
                    }
                },

                methods: {
                    getCategoryAndService(id) {
                        let url = "{{ route('user.get.category.service') }}";
                        axios.get(url, {
                                params: {
                                    social_media_id: id
                                }
                            })
                            .then(response => {
                                this.categories = response.data;

                                if (this.selectedServiceFromOrder) {
                                    this.selectedCategory = this.selectedServiceFromOrder.category_id;
                                    this.services.push(this.selectedServiceFromOrder);
                                    this.selectedService = this.selectedServiceFromOrder.id;
                                    this.serviceName = this.selectedServiceFromOrder.service_title;
                                    if (this.currency) {
                                        let formattedCurrency = parseFloat(this.selectedServiceFromOrder.price) *
                                            parseFloat(this.currency.conversion_rate);
                                        this.pricePer = formattedCurrency;
                                    } else {
                                        let formattedCurrency = parseFloat(this.selectedServiceFromOrder.price);
                                        this.pricePer = formattedCurrency;
                                    }
                                    this.minAmount = this.selectedServiceFromOrder.min_amount;
                                    this.maxAmount = this.selectedServiceFromOrder.max_amount;
                                    this.description = this.selectedServiceFromOrder.description;
                                } else {
                                    if (this.categories.length > 0) {
                                        this.selectedCategory = this.categories[0].id;
                                        this.services = this.categories[0].service;

                                        if (this.services.length > 0) {
                                            this.selectedService = this.services[0].id;
                                            this.serviceName = this.services[0].service_title;
                                            if (this.currency) {
                                                let formattedCurrency = parseFloat(this.services[0].price) *
                                                    parseFloat(this.currency.conversion_rate);
                                                this.pricePer = formattedCurrency.toFixed(2);
                                            } else {
                                                let formattedCurrency = parseFloat(this.services[0].price);
                                                this.pricePer = formattedCurrency.toFixed(2);
                                            }
                                            this.minAmount = this.services[0].min_amount;
                                            this.maxAmount = this.services[0].max_amount;
                                            this.description = this.services[0].description;
                                            if (this.services[0].drip_feed == 0) {
                                                this.isDripFeed = false
                                            } else {
                                                this.isDripFeed = true
                                            }
                                        } else {
                                            this.selectedService = '0';
                                        }
                                    } else {
                                        this.selectedCategory = '0';
                                        this.services = [];
                                        this.selectedService = '0';
                                        this.serviceName = '';
                                        this.pricePer = 0;
                                        this.minAmount = 0;
                                        this.maxAmount = 0;
                                        this.description = '';
                                    }
                                }
                            })
                            .catch(error => {});
                    },

                    handleCategoryChange() {
                        let selectedCategory = this.categories.find(category => category.id == this.selectedCategory);
                        this.services = selectedCategory.service;

                        if (this.services.length > 0) {
                            this.selectedService = this.services[0].id;
                            this.serviceName = this.services[0].service_title;
                            if (this.currency) {
                                let formattedCurrency = parseFloat(this.services[0].price) * parseFloat(this.currency.conversion_rate);
                                this.pricePer = formattedCurrency;
                            } else {
                                let formattedCurrency = parseFloat(this.services[0].price);
                                this.pricePer = formattedCurrency.toFixed(2);
                            }
                            this.minAmount = this.services[0].min_amount;
                            this.maxAmount = this.services[0].max_amount;
                            this.description = this.services[0].description;
                        } else {
                            this.selectedService = '0';
                            this.serviceName = '';
                            this.pricePer = 0;
                            this.minAmount = 0;
                            this.maxAmount = 0;
                        }
                    },

                    handleServiceChange() {
                        let selectedService = this.services.find(service => service.id == this.selectedService);
                        console.log(selectedService);
                        if (this.currency) {
                            let formattedCurrency = parseFloat(selectedService.price) * parseFloat(this.currency.conversion_rate);
                            this.pricePer = formattedCurrency.toFixed(2);
                        } else {
                            let formattedCurrency = parseFloat(selectedService.price);
                            this.pricePer = formattedCurrency.toFixed(2);
                        }
                        this.minAmount = selectedService.min_amount;
                        this.maxAmount = selectedService.max_amount;
                        this.serviceName = selectedService.service_title;
                        this.description = selectedService.description;

                        if (selectedService.drip_feed == 0) {
                            this.isDripFeed = false;
                        } else {
                            this.isDripFeed = true;
                        }
                    },

                    placeOrder() {
                        let url = "{{ route('user.order.store') }}";
                        Notiflix.Block.standard('.pulse-loader', 'Please wait a few moments.', {
                            backgroundColor: 'rgb(242 165 22 / 20%)',
                            svgColor: '#f2a516',
                            messageColor: '#002138',
                            messageFontSize: '18px',
                            fontFamily: 'Roboto, sans-serif'
                        });

                        const payload = {
                            category: this.selectedCategory,
                            service: this.selectedService,
                            link: this.link,
                            quantity: this.quantity,
                            check: this.check,
                            drip_feed: this.isDripFeed,
                            runs: this.isDripFeed ? this.runs : null,
                            interval: this.isDripFeed ? this.interval : null,
                            comments: this.comments,
                        };

                        axios.post(url, payload)
                            .then(response => {
                                Notiflix.Block.remove('.pulse-loader');

                                if (response.data.status == 'success') {
                                    this.orderSuccessData = {
                                        id: response.data.order_id,
                                        service: response.data.service_title,
                                        link: this.link,
                                        quantity: this.quantity,
                                        charge: response.data.charge,
                                        balance: response.data.balance,
                                        currency: response.data.currency_symbol
                                    };

                                    Notiflix.Notify.success(`${response.data.message}`);
                                    this.quantity = '';
                                    this.check = '';
                                    this.link = '';
                                    this.runs = '';
                                    this.drip_feed = '';
                                    this.interval = '';
                                    this.comments = '';
                                }
                                if (response.data.status == 'error') {
                                    Notiflix.Block.remove('.pulse-loader');
                                    Notiflix.Notify.failure(`${response.data.message}`);
                                }
                            })
                            .catch(error => {
                                Notiflix.Block.remove('.pulse-loader');
                                let _this = this;
                                this.makeErrorRemove();
                                let res = error.response.data
                                _this.errors = res.errors
                                for (let err in _this.errors) {
                                    let selector = document.querySelector("." + err);
                                    if (selector) {
                                        selector.innerText = `${_this.errors[err]}`;
                                    }
                                }
                            });
                    },

                    makeErrorRemove() {
                        $('.link').text('');
                        $('.quantity').text('');
                        $('.check').text('');
                        $('.runs').text('');
                        $('.interval').text('');
                    },
                },

                mounted() {
                    if (this.selectedServiceFromOrder) {
                        this.getCategoryAndService(this.selectedServiceFromOrder.category.social_media_id);
                    } else {
                        this.getCategoryAndService(0);
                    }
                }
            }).mount('#new-order-app');
        </script>
    @endpush
@endauth
