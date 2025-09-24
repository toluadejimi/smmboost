@extends(template() . 'layouts.user')
@section('title', trans('Services'))

@section('content')
    @guest
        <div id="block_173">
            <div class="block-bg"></div>
            <div class="container">
                <div class="text-block-with-button">
                    <div class="row">
                        <div class="col-12">
                            <div class="text-block-with-button__description">
                                <h2 class="text-center">
                                    <span style="text-align: CENTER">top smm services available
                                        today</span>
                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="text-block-with-button__button component_button_link">
                                <div class="">
                                    <a class="btn btn-big-primary" target="_self" href="{{ route('register') }}">
                                        <p>Get started&nbsp;</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @php
            $currencyRes = request()->cookie('currency');
            $currencyCookie = json_decode($currencyRes);
        @endphp

        <div id="block_108">
            <div class="block-bg"></div>
            <div id="services_app" style="width: 100%;">
                <div class="container">
                    <div class="service-list">
                        <div class="row">
                            <div class="col">
                                <form action="" method="get">
                                    <div class="services-filters component_filter_form_group component_filter_card mb-3">
                                        <div class="card">
                                            <div class="row">
                                                <div class="col-md-auto mb-3 mb-md-0">
                                                    <div class="component_filter_button">
                                                        <div class="dropdown">
                                                            <a class="btn btn-big-primary w-sm-auto w-100 dropdown-toggle"
                                                                href="#" role="button"
                                                                @click.prevent="showDropdown = !showDropdown"
                                                                aria-haspopup="true" aria-expanded="false">
                                                                <span class="fal fa-filter"></span>
                                                                <span class="services-filter__active-category"
                                                                    data-filter-active-category="true">
                                                                    @{{ getCategoryName(selectedCategory) || 'Select Category' }}
                                                                </span>
                                                            </a>
                                                            <div class="dropdown-menu show" v-if="showDropdown">
                                                                <a class="dropdown-item" href="#"
                                                                    @click.prevent="selectCategory('')">
                                                                    All
                                                                </a>
                                                                <a v-for="category in categoriesSearch" :key="category.id"
                                                                    class="dropdown-item d-flex align-items-center text-decoration-none"
                                                                    href="#" @click.prevent="selectCategory(category.id)">
                                                                    <div>@{{ category.category_title }}</div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-auto mb-3 mb-md-0">
                                                    <div class="component_filter_currency_button">
                                                        @php
                                                            $currencyRes = request()->cookie('currency');
                                                            $currencyCookie = json_decode($currencyRes);
                                                        @endphp

                                                        <div class="dropdown dropdown-currency"
                                                            @click.outside="currencyDropdownOpen = false">
                                                            <a class="btn btn-big-primary w-sm-auto w-100 dropdown-toggle"
                                                                href="#" role="button"
                                                                @click.prevent="currencyDropdownOpen = !currencyDropdownOpen"
                                                                aria-haspopup="true" aria-expanded="false">
                                                                <span class="services-filter__active-currency">
                                                                    @{{ selectedCurrency.symbol }} @{{ selectedCurrency.code }}
                                                                </span>
                                                            </a>
                                                            <div class="dropdown-menu show" v-if="currencyDropdownOpen"
                                                                id="currencies-list">
                                                                <a v-for="currency in currencies" :key="currency.code"
                                                                    class="dropdown-item" href="#"
                                                                    @click.prevent="changeCurrency(currency)">
                                                                    @{{ currency.code }} @{{ currency.symbol }}
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" v-model="searchQuery"
                                                            @input="handleInput" placeholder="Search"
                                                            data-search-service="#service-table-108">
                                                        <span class="input-group-append component_button_search">
                                                            <button class="btn btn-big-secondary" type="button"
                                                                data-filter-serch-btn="true">
                                                                <i class="fas fa-search"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="services-list__table">
                                    <div class="table-bg component_table">
                                        <div class="table-wr table-responsive-classic editor__component-wrapper">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th class="nowrap">Service</th>
                                                        <th class="nowrap">Rate per 1000</th>
                                                        <th class="nowrap">Min order</th>
                                                        <th class="nowrap">Max order</th>
                                                        <th class="nowrap service-description__th">Description</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <template v-for="(category, key) in categories" :key="category.id">
                                                        <tr class="services-list-category-title">
                                                            <td colspan="6"
                                                                class="style-bg-primary-alpha-20 style-text-primary services-category editor__component-wrapper">
                                                                <div class="w-100">
                                                                    <h4>
                                                                        <span class="align-middle">@{{ category.category_title }}</span>
                                                                    </h4>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        <tr v-for="service in category.service" :key="service.id">
                                                            <td data-label="ID">@{{ service.id }}</td>
                                                            <td data-label="Service" class="table-service">
                                                                @{{ service.service_title }}
                                                            </td>
                                                            <td data-label="Rate per 1000">
                                                                <span v-if="service.priceSelectedCurrency">≈
                                                                    @{{ service.priceSelectedCurrency }}</span>
                                                                <span v-else>≈ @{{ service.price }}</span>
                                                            </td>
                                                            <td data-label="Min order">@{{ service.min_amount }}</td>
                                                            <td data-label="Max order">@{{ service.max_amount }}</td>
                                                            <td data-label="Description" class="services-list__description">
                                                                <div class="component_button_view">
                                                                    <button
                                                                        class="btn details btn-actions btn-view-service-description"
                                                                        data-toggle="modal" data-target="#describeModal"
                                                                        :data-id="service.id"
                                                                        :data-title="service.service_title"
                                                                        :data-description="service.description">
                                                                        View
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </template>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="describeModal" tabindex="-1" role="dialog"
                        aria-labelledby="describeModal" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    <h4 class="modal-title" id="title"></h4>
                                    <div id="service-description-content">

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="" type="submit"
                                        class="btn btn-block btn-big-primary order-now">@lang('Order Now')</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="block_171">
            <div class="block-bg"></div>
            <div class="container">
                <div class="header-with-text">
                    <div class="row">
                        <div class="col-12">
                            <div class="text-block__title">
                                <h2 class="text-center">
                                    <span style="text-align: CENTER">Watch this video to get
                                        started</span>
                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="text-block__description">
                                <p class="text-center">
                                    Use this tutorial &nbsp;video to
                                    get a hang of how it all works
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="block_170">
            <div class="block-bg"></div>
            <div class="container">
                <div class="video">
                    <div class="row">
                        <div class="col-12">
                            <div class="video-container">
                                <div class="video-block">
                                    <div class="video-frame">
                                        <div class="video-frame__empty"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="block_204">
            <div class="block-bg"></div>
            <div class="container">
                <div class="header-with-text">
                    <div class="row">
                        <div class="col-12">
                            <div class="text-block__title">
                                <h2 class="text-center">
                                    <span style="font-size: 40px"><span
                                            style="
                                            color: var(
                                                --color-id-186
                                            );
                                        "><span
                                                style="
                                                text-align: CENTER;
                                            ">how
                                                it works</span></span></span>
                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="text-block__description">
                                <p class="text-center">
                                    <span style="font-size: 20px"><span
                                            style="
                                            text-align: CENTER;
                                        "><span
                                                style="
                                                color: var(
                                                    --color-id-186
                                                );
                                            ">Step
                                                by step guide
                                                on how to place your
                                                first order</span></span></span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="block_183">
            <div class="block-bg"></div>
            <div class="container">
                <div class="text-block-with-image">
                    <div class="row">
                        <div class="col">
                            <div class="d-md-flex align-items-start">
                                <div class="text-block__description">
                                    <h3 class="text-left">
                                        <span style="font-size: 30px"><span
                                                style="
                                                text-align: LEFT;
                                            ">Fund
                                                your
                                                account</span></span>
                                    </h3>
                                    <p class="text-left">
                                        <span style="font-size: 20px"><span
                                                style="
                                                text-align: LEFT;
                                            ">To
                                                place an order
                                                for followers, likes
                                                or subscribers you
                                                need to fund your
                                                ReallySimpleSocial
                                                account.</span></span>
                                    </p>
                                    <p class="text-left">
                                        <span style="font-size: 20px"><span
                                                style="
                                                text-align: LEFT;
                                            ">Click
                                                &nbsp;the
                                                menu button top left
                                                and then select add
                                                funds.</span></span>
                                    </p>
                                    <p class="text-left">
                                        <span style="font-size: 20px"><span
                                                style="
                                                text-align: LEFT;
                                            ">Input
                                                how much
                                                you'd like to add
                                                &nbsp;then click
                                                pay</span></span>
                                    </p>
                                    <p class="text-left">
                                        <span style="font-size: 20px"><span
                                                style="
                                                text-align: LEFT;
                                            ">&nbsp;</span></span>
                                    </p>
                                    <p class="text-left">
                                        <span style="font-size: 20px"><span
                                                style="
                                                text-align: LEFT;
                                            ">You'll
                                                be taken to
                                                our secure payments
                                                gateway,
                                                Flutterwave. Pay
                                                with your card or
                                                transfer and your
                                                account will be
                                                automatically
                                                credited</span></span><span style="text-align: LEFT">&nbsp;</span>
                                    </p>
                                    <h4 class="text-left">
                                        <br />
                                    </h4>
                                    <h4 class="text-left">
                                        <span style="text-align: LEFT"><u
                                                style="
                                                text-decoration: underline;
                                            ">Payment
                                                options</u></span>
                                    </h4>
                                    <p class="text-left">
                                        <span style="text-align: LEFT">Y</span><span style="font-size: 20px"><span
                                                style="
                                                text-align: LEFT;
                                            ">ou
                                                can either pay
                                                with your card or
                                                via transfer</span></span>
                                    </p>
                                    <p><br /></p>
                                </div>
                                <div class="text-block__image">
                                    <img src="https://storage.perfectcdn.com/9z8eus/t2y0pwrcp32dufa1.jpg" alt=""
                                        title="" class="img-fluid" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="block_184">
            <div class="block-bg"></div>
            <div class="container">
                <div class="text-block-with-image">
                    <div class="row">
                        <div class="col">
                            <div class="d-md-flex align-items-start">
                                <div class="text-block__description">
                                    <h3 class="text-left">
                                        <span style="font-size: 30px"><span
                                                style="
                                                text-align: LEFT;
                                            ">Place
                                                an order -
                                                categories and
                                                services</span></span>
                                    </h3>
                                    <p class="text-left">
                                        <span style="font-size: 20px"><span
                                                style="
                                                text-align: LEFT;
                                            ">Once
                                                your account
                                                is funded simply
                                                click the MENU
                                                button once again
                                                and select NEW
                                                ORDER.</span></span>
                                    </p>
                                    <p class="text-left">
                                        <span style="font-size: 20px"><span
                                                style="
                                                text-align: LEFT;
                                            ">This
                                                should take
                                                you to the order
                                                page.</span></span>
                                    </p>
                                    <p class="text-left">
                                        <span style="font-size: 20px"><span
                                                style="
                                                text-align: LEFT;
                                            ">&nbsp;</span></span>
                                    </p>
                                    <p class="text-left">
                                        <span style="font-size: 20px"><span
                                                style="
                                                text-align: LEFT;
                                            ">Click
                                                the CATEGORY
                                                option and select
                                                the relevant
                                                category. For
                                                instance, if you
                                                want to buy
                                                Instagram followers
                                                click the INSTAGRAM
                                                FOLLOWERS
                                                category.</span></span>
                                    </p>
                                    <p class="text-left">
                                        <span style="font-size: 20px"><span
                                                style="
                                                text-align: LEFT;
                                            ">&nbsp;</span></span>
                                    </p>
                                    <p class="text-left">
                                        <span style="font-size: 20px"><span
                                                style="
                                                text-align: LEFT;
                                            ">Next,
                                                click the
                                                &nbsp;SERVICE option
                                                to choose the
                                                particular service
                                                you want.</span></span>
                                    </p>
                                    <p class="text-left">
                                        <span style="text-align: LEFT">&nbsp;</span>
                                    </p>
                                    <h4 class="text-left">
                                        <span style="text-align: LEFT"><u
                                                style="
                                                text-decoration: underline;
                                            ">Service
                                                type</u></span>
                                    </h4>
                                    <p class="text-left">
                                        <span style="font-size: 20px"><span
                                                style="
                                                text-align: LEFT;
                                            ">There
                                                are a couple
                                                different services
                                                for each
                                                category.&nbsp;</span></span>
                                    </p>
                                    <p class="text-left">
                                        <span style="font-size: 20px"><span
                                                style="
                                                text-align: LEFT;
                                            ">For
                                                instance, you
                                                can have good
                                                followers, high
                                                quality followers
                                                and best quality
                                                followers.
                                                &nbsp;</span></span>
                                    </p>
                                    <p class="text-left"><br /></p>
                                    <p class="text-left">
                                        <span style="font-size: 20px"><span
                                                style="
                                                text-align: LEFT;
                                            ">Read
                                                the
                                                description and
                                                select the best
                                                option based on your
                                                preference</span></span>
                                    </p>
                                </div>
                                <div class="text-block__image">
                                    <img src="https://storage.perfectcdn.com/9z8eus/rn3bcwyxqqxjkipz.jpg" alt=""
                                        title="" class="img-fluid" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="block_185">
            <div class="block-bg"></div>
            <div class="container">
                <div class="text-block-with-image">
                    <div class="row">
                        <div class="col">
                            <div class="d-md-flex align-items-start">
                                <div class="text-block__description">
                                    <h3 class="text-left">
                                        <span style="font-size: 30px"><span
                                                style="
                                                text-align: LEFT;
                                            ">Place
                                                an order -
                                                Getting your
                                                Instagram
                                                link.</span></span>
                                    </h3>
                                    <p class="text-left">
                                        <span style="font-size: 20px"><span
                                                style="
                                                text-align: LEFT;
                                            ">Getting
                                                your
                                                Instagram link is
                                                simple and
                                                straightforward.</span></span>
                                    </p>
                                    <p class="text-left"><br /></p>
                                    <p class="text-left">
                                        <span style="font-size: 20px"><span
                                                style="
                                                text-align: LEFT;
                                            ">If
                                                you know your
                                                Instagram username,
                                                your link is &nbsp;*
                                                instagram.com/username*</span></span>
                                    </p>
                                    <p class="text-left"><br /></p>
                                    <p class="text-left">
                                        <span style="font-size: 20px"><span
                                                style="
                                                text-align: LEFT;
                                            ">If
                                                you don't have
                                                the username of the
                                                account simple
                                                search for them
                                                using thier profile
                                                name.&nbsp;</span></span>
                                    </p>
                                    <p class="text-left">
                                        <span style="font-size: 20px"><span
                                                style="
                                                text-align: LEFT;
                                            ">From
                                                the Instagram
                                                app click the search
                                                button and search
                                                for the specific
                                                profile.&nbsp;</span></span>
                                    </p>
                                    <p class="text-left"><br /></p>
                                    <p class="text-left">
                                        <span style="font-size: 20px"><span
                                                style="
                                                text-align: LEFT;
                                            ">Once
                                                you've found
                                                it, click the
                                                profile. That should
                                                take you to the
                                                profile
                                                page.&nbsp;</span></span>
                                    </p>
                                    <p class="text-left">
                                        <span style="font-size: 20px"><span
                                                style="
                                                text-align: LEFT;
                                            ">Click
                                                the button
                                                with the three dots
                                                on the top right
                                                panel then select
                                                copy profile URL
                                                from the drop down
                                                menu.&nbsp;</span></span>
                                    </p>
                                    <p class="text-left">
                                        <span style="font-size: 20px"><span
                                                style="
                                                text-align: LEFT;
                                            ">Next
                                                paste the
                                                copied link in the
                                                LINK section.</span></span>
                                    </p>
                                    <p><br /></p>
                                </div>
                                <div class="text-block__image">
                                    <img src="https://storage.perfectcdn.com/9z8eus/9457ff68iz2aggcb.jpg" alt=""
                                        title="" class="img-fluid" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="block_186">
            <div class="block-bg"></div>
            <div class="container">
                <div class="text-block-with-image">
                    <div class="row">
                        <div class="col">
                            <div class="d-md-flex align-items-start">
                                <div class="text-block__description">
                                    <h3 class="text-left">
                                        <span style="font-size: 30px"><span
                                                style="
                                                text-align: LEFT;
                                            ">Place
                                                an order -
                                                quantity</span></span>
                                    </h3>
                                    <p class="text-left">
                                        <span style="font-size: 20px"><span
                                                style="
                                                text-align: LEFT;
                                            ">You
                                                can select
                                                exactly how many
                                                followers, likes,
                                                views or subscribers
                                                you want by inputing
                                                the desired number
                                                in the QUANTITY
                                                section.</span></span>
                                    </p>
                                    <p class="text-left"><br /></p>
                                    <p class="text-left">
                                        <span style="font-size: 20px"><span
                                                style="
                                                text-align: LEFT;
                                            ">Note
                                                that &nbsp;you
                                                must have enough
                                                money in your
                                                balance to fund the
                                                quantity of a
                                                service you want to
                                                purchase.&nbsp;</span></span>
                                    </p>
                                    <p class="text-left">
                                        <span style="font-size: 20px"><span
                                                style="
                                                text-align: LEFT;
                                            ">Each
                                                service has a
                                                'cost per thousand
                                                rate , so you can
                                                have an idea of how
                                                much you need to
                                                place the
                                                order</span></span>
                                    </p>
                                </div>
                                <div class="text-block__image">
                                    <img src="https://storage.perfectcdn.com/9z8eus/bjpbxkfsmmmg5dpz.jpg" alt=""
                                        title="" class="img-fluid" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="block_187">
            <div class="block-bg"></div>
            <div class="container">
                <div class="text-block-with-image">
                    <div class="row">
                        <div class="col">
                            <div class="d-md-flex align-items-start">
                                <div class="text-block__description">
                                    <h3 class="text-left">
                                        <span style="font-size: 30px"><span
                                                style="
                                                text-align: LEFT;
                                            ">Finalizing
                                                your
                                                order</span></span>
                                    </h3>
                                    <p class="text-left">
                                        <span style="font-size: 20px"><span
                                                style="
                                                text-align: LEFT;
                                            ">Click
                                                the SUBMIT
                                                Button to place your
                                                order.</span></span>
                                    </p>
                                    <p class="text-left"><br /></p>
                                    <p class="text-left">
                                        <span style="font-size: 20px"><span
                                                style="
                                                text-align: LEFT;
                                            ">Sit
                                                back, relax and
                                                watch us do the
                                                magic.</span></span>
                                    </p>
                                    <p class="text-left">
                                        <span style="font-size: 20px"><span
                                                style="
                                                text-align: LEFT;
                                            ">You
                                                can always
                                                visit your ORDER
                                                page to check the
                                                status of your
                                                order.</span></span>
                                    </p>
                                    <p class="text-left">
                                        <span style="font-size: 20px"><span
                                                style="
                                                text-align: LEFT;
                                            ">If,
                                                you've got any
                                                issues please drop a
                                                message on Whastapp
                                                by clicking this
                                            </span></span><a target="_self" href="https://wa.me/message/MOOCY6SPZVBTH1"><span
                                                style="
                                                font-size: 20px;
                                            "><span
                                                    style="
                                                    text-align: LEFT;
                                                "><strong
                                                        style="
                                                        font-weight: bold;
                                                    ">LINK</strong></span></span></a>
                                    </p>
                                </div>
                                <div class="text-block__image">
                                    <img src="https://storage.perfectcdn.com/9z8eus/e1me0agg7hex16cd.jpg" alt=""
                                        title="" class="img-fluid" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="block_205">
            <div class="block-bg"></div>
            <div class="container">
                <div class="text-block-with-button">
                    <div class="row">
                        <div class="col-12">
                            <div class="text-block-with-button__description">
                                <h2 class="text-center">
                                    <span
                                        style="
                                        color: var(
                                            --color-id-186
                                        );
                                    "><span
                                            style="
                                            text-align: CENTER;
                                        ">Seen
                                            enough?&nbsp;</span></span>
                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="text-block-with-button__button component_button_link">
                                <div class="">
                                    <a class="btn btn-big-primary" target="_self" href="/signup">
                                        <p>Get started</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="block_172">
            <div class="block-bg"></div>
            <div class="container">
                <div class="faq">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="faq-block__card">
                                        <div class="card" style="">
                                            <div class="faq-block__header collapsed" data-toggle="collapse"
                                                data-target="#faq-block-172-1" aria-expanded="false"
                                                aria-controls="#faq-block-172-1">
                                                <div class="faq-block__header-title">
                                                    <h4>
                                                        What does
                                                        refill mean?
                                                    </h4>
                                                </div>
                                                <div class="faq-block__header-icon">
                                                    <div class="style-text-dark faq-block__icon" style=""></div>
                                                </div>
                                            </div>
                                            <div class="faq-block__body collapse" id="faq-block-172-1">
                                                <div class="faq-block__body-description"
                                                    style="
                                                    padding-top: 8px;
                                                ">
                                                    <p>
                                                        Over time
                                                        some of the
                                                        followers,
                                                        likes and
                                                        comment we
                                                        drive to
                                                        your profile
                                                        might 'drop'
                                                        as they do
                                                        naturally.
                                                        Any order
                                                        with the
                                                        refill
                                                        option on
                                                        allows you
                                                        to top off
                                                        the lost
                                                        followers or
                                                        engagement
                                                        at no extra
                                                        charge.&nbsp;
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="faq-block__card">
                                        <div class="card" style="">
                                            <div class="faq-block__header collapsed" data-toggle="collapse"
                                                data-target="#faq-block-172-2" aria-expanded="false"
                                                aria-controls="#faq-block-172-2">
                                                <div class="faq-block__header-title">
                                                    <h4>
                                                        Drip-feed —
                                                        what does it
                                                        mean?
                                                    </h4>
                                                </div>
                                                <div class="faq-block__header-icon">
                                                    <div class="style-text-dark faq-block__icon" style=""></div>
                                                </div>
                                            </div>
                                            <div class="faq-block__body collapse" id="faq-block-172-2">
                                                <div class="faq-block__body-description"
                                                    style="
                                                    padding-top: 8px;
                                                ">
                                                    <p>
                                                        Drip feed
                                                        allows you
                                                        to grow your
                                                        account at a
                                                        steady pace.
                                                        Rather than
                                                        blast all
                                                        the
                                                        followers or
                                                        likes to
                                                        your profile
                                                        at once,
                                                        drip feed
                                                        allows you
                                                        to send them
                                                        in
                                                        batches.&nbsp;
                                                    </p>
                                                    <p><br /></p>
                                                    <p>
                                                        For example,
                                                        if you want
                                                        2000 likes
                                                        on your
                                                        Instagram
                                                        post, you
                                                        can either
                                                        get all 2000
                                                        right away
                                                        or make it
                                                        happen
                                                        gradually —
                                                        &nbsp;200
                                                        likes per
                                                        day for 10
                                                        days or so.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="faq-block__card">
                                        <div class="card" style="">
                                            <div class="faq-block__header collapsed" data-toggle="collapse"
                                                data-target="#faq-block-172-3" aria-expanded="false"
                                                aria-controls="#faq-block-172-3">
                                                <div class="faq-block__header-title">
                                                    <h4>
                                                        What do
                                                        people use
                                                        SMM panels
                                                        for?
                                                    </h4>
                                                </div>
                                                <div class="faq-block__header-icon">
                                                    <div class="style-text-dark faq-block__icon" style=""></div>
                                                </div>
                                            </div>
                                            <div class="faq-block__body collapse" id="faq-block-172-3">
                                                <div class="faq-block__body-description"
                                                    style="
                                                    padding-top: 8px;
                                                ">
                                                    <p>
                                                        An SMM panel
                                                        is an online
                                                        shop that
                                                        offers SMM
                                                        services at
                                                        affordable
                                                        prices.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="faq-block__card">
                                        <div class="card" style="">
                                            <div class="faq-block__header collapsed" data-toggle="collapse"
                                                data-target="#faq-block-172-4" aria-expanded="false"
                                                aria-controls="#faq-block-172-4">
                                                <div class="faq-block__header-title">
                                                    <h4>
                                                        What types
                                                        of SMM
                                                        services do
                                                        you provide
                                                        here?
                                                    </h4>
                                                </div>
                                                <div class="faq-block__header-icon">
                                                    <div class="style-text-dark faq-block__icon" style=""></div>
                                                </div>
                                            </div>
                                            <div class="faq-block__body collapse" id="faq-block-172-4">
                                                <div class="faq-block__body-description"
                                                    style="
                                                    padding-top: 8px;
                                                ">
                                                    <p>
                                                        On our panel
                                                        you can find
                                                        different
                                                        types of SMM
                                                        services:
                                                        views,
                                                        followers,
                                                        likes and so
                                                        on.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="faq-block__card">
                                        <div class="card" style="">
                                            <div class="faq-block__header collapsed" data-toggle="collapse"
                                                data-target="#faq-block-172-5" aria-expanded="false"
                                                aria-controls="#faq-block-172-5">
                                                <div class="faq-block__header-title">
                                                    <h4>
                                                        Are your SMM
                                                        services
                                                        safe to buy?
                                                    </h4>
                                                </div>
                                                <div class="faq-block__header-icon">
                                                    <div class="style-text-dark faq-block__icon" style=""></div>
                                                </div>
                                            </div>
                                            <div class="faq-block__body collapse" id="faq-block-172-5">
                                                <div class="faq-block__body-description"
                                                    style="
                                                    padding-top: 8px;
                                                ">
                                                    <p>
                                                        Don't worry,
                                                        it's 100%
                                                        safe, your
                                                        accounts
                                                        won't get
                                                        banned.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="faq-block__card">
                                        <div class="card" style="">
                                            <div class="faq-block__header collapsed" data-toggle="collapse"
                                                data-target="#faq-block-172-6" aria-expanded="false"
                                                aria-controls="#faq-block-172-6">
                                                <div class="faq-block__header-title">
                                                    <h4>
                                                        A mass order
                                                        — what is
                                                        it?
                                                    </h4>
                                                </div>
                                                <div class="faq-block__header-icon">
                                                    <div class="style-text-dark faq-block__icon" style=""></div>
                                                </div>
                                            </div>
                                            <div class="faq-block__body collapse" id="faq-block-172-6">
                                                <div class="faq-block__body-description"
                                                    style="
                                                    padding-top: 8px;
                                                ">
                                                    <p>
                                                        A mass order
                                                        is a feature
                                                        that helps
                                                        place
                                                        several
                                                        orders with
                                                        different
                                                        links at
                                                        once.
                                                    </p>
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
    @else
        @php
            $currencyRes = request()->cookie('currency');
            $currencyCookie = json_decode($currencyRes);
        @endphp

        <div id="block_108">
            <div class="block-bg"></div>
            <div id="services_app" style="width: 100%;">
                <div class="container">
                    <div class="service-list">
                        <div class="row">
                            <div class="col">
                                <form action="" method="get">
                                    <div class="services-filters component_filter_form_group component_filter_card mb-3">
                                        <div class="card">
                                            <div class="row">
                                                <div class="col-md-auto mb-3 mb-md-0">
                                                    <div class="component_filter_button">
                                                        <div class="dropdown">
                                                            <a class="btn btn-big-primary w-sm-auto w-100 dropdown-toggle"
                                                                href="#" role="button"
                                                                @click.prevent="showDropdown = !showDropdown"
                                                                aria-haspopup="true" aria-expanded="false">
                                                                <span class="fal fa-filter"></span>
                                                                <span class="services-filter__active-category"
                                                                    data-filter-active-category="true">
                                                                    @{{ getCategoryName(selectedCategory) || 'Select Category' }}
                                                                </span>
                                                            </a>
                                                            <div class="dropdown-menu show" v-if="showDropdown">
                                                                <a class="dropdown-item" href="#"
                                                                    @click.prevent="selectCategory('')">
                                                                    All
                                                                </a>
                                                                <a v-for="category in categoriesSearch" :key="category.id"
                                                                    class="dropdown-item d-flex align-items-center text-decoration-none"
                                                                    href="#"
                                                                    @click.prevent="selectCategory(category.id)">
                                                                    <div>@{{ category.category_title }}</div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-auto mb-3 mb-md-0">
                                                    <div class="component_filter_currency_button">
                                                        @php
                                                            $currencyRes = request()->cookie('currency');
                                                            $currencyCookie = json_decode($currencyRes);
                                                        @endphp

                                                        <div class="dropdown dropdown-currency"
                                                            @click.outside="currencyDropdownOpen = false">
                                                            <a class="btn btn-big-primary w-sm-auto w-100 dropdown-toggle"
                                                                href="#" role="button"
                                                                @click.prevent="currencyDropdownOpen = !currencyDropdownOpen"
                                                                aria-haspopup="true" aria-expanded="false">
                                                                <span class="services-filter__active-currency">
                                                                    @{{ selectedCurrency.symbol }} @{{ selectedCurrency.code }}
                                                                </span>
                                                            </a>
                                                            <div class="dropdown-menu show" v-if="currencyDropdownOpen"
                                                                id="currencies-list">
                                                                <a v-for="currency in currencies" :key="currency.code"
                                                                    class="dropdown-item" href="#"
                                                                    @click.prevent="changeCurrency(currency)">
                                                                    @{{ currency.code }} @{{ currency.symbol }}
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" v-model="searchQuery"
                                                            @input="handleInput" placeholder="Search"
                                                            data-search-service="#service-table-108">
                                                        <span class="input-group-append component_button_search">
                                                            <button class="btn btn-big-secondary" type="button"
                                                                data-filter-serch-btn="true">
                                                                <i class="fas fa-search"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="services-list__table">
                                    <div class="table-bg component_table">
                                        <div class="table-wr table-responsive-classic editor__component-wrapper">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th class="nowrap">Service</th>
                                                        <th class="nowrap">Rate per 1000</th>
                                                        <th class="nowrap">Min order</th>
                                                        <th class="nowrap">Max order</th>
                                                        <th class="nowrap service-description__th">Description</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <template v-for="(category, key) in categories" :key="category.id">
                                                        <tr class="services-list-category-title">
                                                            <td colspan="6"
                                                                class="style-bg-primary-alpha-20 style-text-primary services-category editor__component-wrapper">
                                                                <div class="w-100">
                                                                    <h4>
                                                                        <span
                                                                            class="align-middle">@{{ category.category_title }}</span>
                                                                    </h4>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        <tr v-for="service in category.service" :key="service.id">
                                                            <td data-label="ID">@{{ service.id }}</td>
                                                            <td data-label="Service" class="table-service">
                                                                @{{ service.service_title }}
                                                            </td>
                                                            <td data-label="Rate per 1000">
                                                                <span v-if="service.priceSelectedCurrency">≈
                                                                    @{{ service.priceSelectedCurrency }}</span>
                                                                <span v-else>≈ @{{ service.price }}</span>
                                                            </td>
                                                            <td data-label="Min order">@{{ service.min_amount }}</td>
                                                            <td data-label="Max order">@{{ service.max_amount }}</td>
                                                            <td data-label="Description" class="services-list__description">
                                                                <div class="component_button_view">
                                                                    <button
                                                                        class="btn details btn-actions btn-view-service-description"
                                                                        data-toggle="modal" data-target="#describeModal"
                                                                        :data-id="service.id"
                                                                        :data-title="service.service_title"
                                                                        :data-description="service.description">>
                                                                        View
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </template>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="describeModal" tabindex="-1" role="dialog"
                        aria-labelledby="describeModal" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header ">
                                    <h4 class="modal-title" id="title"></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                        &times;
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p id="service-description-content">

                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-secondary btn-padding close"
                                        data-dismiss="modal">@lang('Close')</button>
                                    <a href="" type="submit"
                                        class="btn btn-block btn-big-primary order-now">@lang('Order Now')</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endguest
@endsection

@push('script')
    <script src="{{ asset('assets/global/js/vue.global.prod.min.js') }}"></script>
    <script src="{{ asset('assets/global/js/axios.min.js') }}"></script>
@endpush

@push('script')
    <script>
        "use strict";
        $(document).on('click', '.details', function() {
            let title = $(this).data('title');
            $('#title').text(title);
            let description = $(this).data('description');
            if (description) {
                $('#service-description').html(description);
            } else {
                $('#service-description').html('The description is not available.');
            }

            let id = $(this).data('id');
            let orderRoute = "{{ route('home') }}" + '?serviceId=' + id;
            $('.order-now').attr('href', orderRoute);
        });
    </script>

    <script>
        const app = Vue.createApp({
            data() {
                return {
                    categories: [],
                    pagination: [],
                    links: [],
                    socialMedia: @json($socialMedia),
                    isActive: 0,
                    categoriesSearch: [],
                    selectedCategory: '',
                    searchQuery: '',
                    showDropdown: false,
                    currencyDropdownOpen: false,
                    currencies: @json($currencies),
                    selectedCurrency: {
                        code: '{{ $currencyCookie->code ?? 'USD' }}',
                        symbol: '{{ $currencyCookie->symbol ?? "$" }}'
                    },
                };
            },
            mounted() {
                $('#category').on('change', (event) => {
                    this.selectedCategory = event.target.value;
                    this.searchCategory();
                });

                this.getServices();
                this.getCategory();

            },
            methods: {
                getCategory(social_media_id) {
                    let app = this;
                    let url = "{{ route('get.category') }}";
                    axios.get(url, {
                            params: {
                                social_media_id: social_media_id,
                            }
                        })
                        .then(function(res) {
                            app.categoriesSearch = res.data;
                        })
                },
                changeCurrency(currency) {
                    this.selectedCurrency = currency;
                    this.currencyDropdownOpen = false;

                    axios.post("{{ route('set.currency') }}", {
                            _token: '{{ csrf_token() }}',
                            currency: currency.code
                        })
                        .then(response => {
                            if (response.data.success) {
                                window.location.reload();
                            }
                        })
                        .catch(error => {
                            console.error("Currency change failed:", error);
                        });
                },
                // toggleActive(id) {
                //     let socialMedia = this.socialMedia.find(media => media.id == id);
                //     this.isActive = socialMedia.id;
                //     this.getCategory(id);
                // },
                fetchData(params) {
                    let app = this;
                    let url = "{{ route('get.services') }}";
                    axios.get(url, {
                            params
                        })
                        .then(function(res) {
                            app.categories = res.data.data;
                            app.pagination = res.data;
                            app.links = res.data.links.slice(1, -1);
                        });
                },
                searchCategory() {
                    this.fetchData({
                        social_media_id: this.isActive,
                        category: this.selectedCategory,
                    });
                },
                selectCategory(id) {
                    this.selectedCategory = id;
                    this.showDropdown = false;
                    this.searchCategory(); // Triggers the filtered search
                },

                getCategoryName(id) {
                    console.log(id);
                    if (id === '') return 'All';
                    const cat = this.categoriesSearch.find(c => c.id == id);
                    return cat ? cat.category_title : '';
                },
                handleInput(event) {
                    this.fetchData({
                        social_media_id: this.isActive,
                        category: this.selectedCategory,
                        search: event.target.value,
                    });
                },
                getServices(id) {
                    this.fetchData({
                        social_media_id: id,
                        currency: '{{ $currencyCookie->code ?? null }}',
                    });
                },
                updateItems(page) {
                    let app = this;
                    let url = '';
                    if (page == 'back') {
                        url = this.pagination.prev_page_url;

                    } else if (page == 'next') {
                        url = this.pagination.next_page_url;

                    } else {
                        url = page.url;
                    }
                    axios.get(url)
                        .then(function(res) {
                            app.categories = res.data.data;
                            app.pagination = res.data;
                            app.links = res.data.links;
                        })
                },
            },
        });
        app.mount('#services_app');
    </script>
@endpush
