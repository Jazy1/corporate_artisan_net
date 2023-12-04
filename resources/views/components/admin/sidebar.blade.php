<aside class="sidebar">
    <div class="sidebar__backdrop"></div>
    <div class="sidebar__container">
        <div class="sidebar__top">
            <div class="container container--sm">
                <a class="sidebar__logo" href="{{ route('admin.dashboard') }}">
                    <div class="sidebar__logo-text"> Admin</div>
                </a>
            </div>
        </div>
        <div class="sidebar__content" data-simplebar="data-simplebar">
            <nav class="sidebar__nav">
                <ul class="sidebar__menu">

                    <li class="sidebar__menu-item">
                        <a class="sidebar__link " href="{{ route('admin.dashboard') }}" aria-expanded="true">
                            <span class="sidebar__link-icon">
                                <i class="fa-solid fa-gauge"></i>
                            </span>
                            <span class="sidebar__link-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar__menu-item">
                        <a class="sidebar__link" href="products.html" data-toggle="collapse" data-target="#freelancers"
                            aria-expanded="false">
                            <span class="sidebar__link-icon">
                                <i class="fa-solid fa-laptop"></i>
                            </span>
                            <span class="sidebar__link-text">Freelancers</span>
                            <span class="sidebar__link-arrow">
                                <svg class="icon-icon-keyboard-down">
                                    <use xlink:href="#icon-keyboard-down"></use>
                                </svg></span>
                        </a>

                        <div class="collapse" id="freelancers">
                            <ul class="sidebar__collapse-menu">
                                <li class="sidebar__menu-item">
                                    <a class="sidebar__link" href="products.html"><span
                                            class="sidebar__link-signal"></span><span
                                            class="sidebar__link-text">Products</span></a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="sidebar__menu-item">
                        <a class="sidebar__link" href="products.html" data-toggle="collapse" data-target="#companies"
                            aria-expanded="false">
                            <span class="sidebar__link-icon">
                                <i class="fa-solid fa-building"></i>
                            </span>
                            <span class="sidebar__link-text">Companies</span>
                            <span class="sidebar__link-arrow">
                                <svg class="icon-icon-keyboard-down">
                                    <use xlink:href="#icon-keyboard-down"></use>
                                </svg></span>
                        </a>

                        <div class="collapse" id="companies">
                            <ul class="sidebar__collapse-menu">
                                <li class="sidebar__menu-item">
                                    <a class="sidebar__link" href="products.html"><span
                                            class="sidebar__link-signal"></span><span
                                            class="sidebar__link-text">Products</span></a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="sidebar__menu-item">
                        <a class="sidebar__link" href="products.html" data-toggle="collapse" data-target="#finances"
                            aria-expanded="false">
                            <span class="sidebar__link-icon">
                                <i class="fa-solid fa-coins"></i>
                            </span>
                            <span class="sidebar__link-text">Finances</span>
                            <span class="sidebar__link-arrow">
                                <svg class="icon-icon-keyboard-down">
                                    <use xlink:href="#icon-keyboard-down"></use>
                                </svg></span>
                        </a>

                        <div class="collapse" id="finances">
                            <ul class="sidebar__collapse-menu">
                                <li class="sidebar__menu-item">
                                    <a class="sidebar__link" href="products.html"><span
                                            class="sidebar__link-signal"></span><span
                                            class="sidebar__link-text">Products</span></a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</aside>
