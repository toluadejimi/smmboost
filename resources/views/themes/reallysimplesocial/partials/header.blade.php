<div id="block_102">
    <div class="block-wrapper">
        <div class="component_navbar ">
            <div class="component-navbar__wrapper ">
                <div
                    class="sidebar-block__top component-navbar component-navbar__navbar-public editor__component-wrapper ">
                    <div>
                        <nav class="navbar navbar-expand-lg navbar-light container-fluid">
                            <div class="navbar-public__header">
                                <div class="sidebar-block__top-brand">
                                    <div class="component-navbar-logo">
                                        <a href="{{ route('home') }}">
                                            <img src="{{ getFile(basicControl()->logo_driver,basicControl()->logo) }}"
                                                class="sidebar-block__top-logo" alt="@lang('Logo')" title="">
                                        </a>
                                    </div>
                                </div>
                                <button class="navbar-toggler" type="button" data-toggle="collapse"
                                    data-target="#navbar-collapse-102" aria-controls="navbar-collapse-102"
                                    aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-burger">
                                        <span class="navbar-burger-line"></span>
                                    </span>
                                </button>
                            </div>
                            <div class="collapse navbar-collapse" id="navbar-collapse-102">
                                <div class="component-navbar-collapse-divider"></div>
                                <div class="d-flex component-navbar-collapse">
                                    <ul class="navbar-nav">
                                        <li
                                            class="nav-item component-navbar-nav-item component_navbar component-navbar-public-nav-item">
                                            <a class="component-navbar-nav-link component-navbar-nav-link__navbar-public {{ menuActive('home', 4) }}"
                                                href="{{ route('home') }}">Sign in</a>
                                        </li>
                                        <li
                                            class="nav-item component-navbar-nav-item component_navbar component-navbar-public-nav-item">
                                            <a class="component-navbar-nav-link component-navbar-nav-link__navbar-public {{ menuActive('instagram', 4) }}"
                                                href="{{ route('instagram') }}">Instagram followers</a>
                                        </li>
                                        <li
                                            class="nav-item component-navbar-nav-item component_navbar component-navbar-public-nav-item">
                                            <a class="component-navbar-nav-link component-navbar-nav-link__navbar-public {{ menuActive('tiktok', 4) }}"
                                                href="{{ route('tiktok') }}">TikTok Followers</a>
                                        </li>
                                        <li
                                            class="nav-item component-navbar-nav-item component_navbar component-navbar-public-nav-item">
                                            <a class="component-navbar-nav-link component-navbar-nav-link__navbar-public {{ menuActive('twitter', 4) }}"
                                                href="{{ route('twitter') }}">Twitter Followers</a>
                                        </li>
                                        <li
                                            class="nav-item component-navbar-nav-item component_navbar component-navbar-public-nav-item">
                                            <a class="component-navbar-nav-link component-navbar-nav-link__navbar-public {{ menuActive('services', 4) }}"
                                                href="{{ route('services') }}">Services</a>
                                        </li>
                                        <li
                                            class="nav-item component-navbar-nav-item component_navbar component-navbar-public-nav-item">
                                            <a class="component-navbar-nav-link component-navbar-nav-link__navbar-public {{ menuActive('howto', 4) }}"
                                                href="{{ route('howto') }}">How Tos</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="component_navbar"></div>
</div>