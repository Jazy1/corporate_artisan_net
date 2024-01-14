<aside class="sidebar">
    <div class="sidebar__backdrop"></div>
    <div class="sidebar__container">
        <div class="sidebar__top">
            <div class="container container--sm">
                <a class="sidebar__logo" href="{{ route('companies.dashboard') }}">
                    <div class="sidebar__logo-text"> Company</div>
                </a>
            </div>
        </div>
        <div class="sidebar__content" data-simplebar="data-simplebar">
            <nav class="sidebar__nav">
                <ul class="sidebar__menu">

                    <li class="sidebar__menu-item">
                        <a class="sidebar__link " href="{{ route('companies.dashboard') }}" aria-expanded="true">
                            <span class="sidebar__link-icon">
                                <i class="fa-solid fa-gauge"></i>
                            </span>
                            <span class="sidebar__link-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar__menu-item">
                        <a class="sidebar__link" data-toggle="collapse" data-target="#orders"
                            aria-expanded="false">
                            <span class="sidebar__link-icon">
                                <i class="fa-solid fa-square-poll-horizontal"></i>
                            </span>
                            <span class="sidebar__link-text">Orders</span>
                            <span class="sidebar__link-arrow">
                                <svg class="icon-icon-keyboard-down">
                                    <use xlink:href="#icon-keyboard-down"></use>
                                </svg>
                            </span>
                        </a>

                        <div class="collapse" id="orders">
                            <ul class="sidebar__collapse-menu">
                                <li class="sidebar__menu-item">
                                    <a class="sidebar__link" href="{{route("companies.orders.index")}}"><span
                                            class="sidebar__link-signal"></span><span
                                            class="sidebar__link-text">Dashboard</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    {{-- <li class="sidebar__menu-item">
                        <a class="sidebar__link" data-toggle="collapse" data-target="#companies"
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
                    </li> --}}
                    <li class="sidebar__menu-item">
                        <a class="sidebar__link" data-toggle="collapse" data-target="#finances"
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
                                    <a class="sidebar__link" href="{{ route("companies.finances.index") }}">
                                        <span class="sidebar__link-signal"></span>
                                        <span class="sidebar__link-text">Dashboard</span>
                                    </a>
                                </li>
                                <li class="sidebar__menu-item">
                                    <a class="sidebar__link" href="{{ route("companies.finances.deposit") }}">
                                        <span class="sidebar__link-signal"></span>
                                        <span class="sidebar__link-text">Deposit Money</span>
                                    </a>
                                </li>
                                <li class="sidebar__menu-item">
                                    <a class="sidebar__link" href="{{ route("companies.finances.withdraw") }}">
                                        <span class="sidebar__link-signal"></span>
                                        <span class="sidebar__link-text">Withdraw Money</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</aside>
