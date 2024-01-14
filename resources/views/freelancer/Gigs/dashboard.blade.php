@extends('freelancer.layouts.parent')

@section('title', 'Gigs | Freelancer')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <main class="page-content">
        <div class="container">

            {{-- Page Title --}}
            <div class="page-header">
                <h1 class="page-header__title">Gigs</h1>
            </div>

            {{-- Bread Crumbs --}}
            <div class="page-tools" style="justify-content: space-between;">
                <div class="page-tools__breadcrumbs">
                    <div class="breadcrumbs">
                        <div class="breadcrumbs__container">
                            <ol class="breadcrumbs__list">

                                <li class="breadcrumbs__item">
                                    <a class="breadcrumbs__link" href="{{ route('freelancers.dashboard') }}">
                                        <svg class="icon-icon-home breadcrumbs__icon">
                                            <use xlink:href="#icon-home"></use>
                                        </svg>
                                        <svg class="icon-icon-keyboard-right breadcrumbs__arrow">
                                            <use xlink:href="#icon-keyboard-right"></use>
                                        </svg>
                                    </a>
                                </li>

                                <li class="breadcrumbs__item active">
                                    <a class="breadcrumbs__link" href="{{ route('freelancers.gigs.index') }}">
                                        <span>Gigs</span>
                                    </a>
                                </li>

                            </ol>
                        </div>
                    </div>
                </div>

                <div class="toolbox__right col-12 col-lg-auto">
                    <div class="toolbox__right-row row row--xs flex-nowrap">
                        {{-- <div class="col col-lg-auto">
                            <form class="toolbox__search" method="GET">
                                <div class="input-group input-group--white input-group--prepend">
                                    <div class="input-group__prepend">
                                        <svg class="icon-icon-search">
                                            <use xlink:href="#icon-search"></use>
                                        </svg>
                                    </div>
                                    <input class="input" type="text" placeholder="Search Customer">
                                </div>
                            </form>
                        </div> --}}
                        <div class="col-auto">
                            <a href="{{ route("freelancers.gigs.create") }} " class="button-add button-add--blue" data-modal="#">
                                <span class="button-add__icon">
                                    <svg class="icon-icon-plus">
                                        <use xlink:href="#icon-plus"></use>
                                    </svg>
                                </span>
                                <span class="button-add__text"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            @if (Session::has('success'))
                <div class="alert alert-success some-space-upNdown" role="alert">
                    <center style="">
                        {{ session("success") }}
                        <br>
                    </center> 
                </div>
            @endif

            @if (Session::has('fail'))
                <div class="alert alert-danger some-space-upNdown" role="alert">
                    <center style="">
                        {{ session("fail") }}
                        <br>
                    </center> 
                </div>
            @endif
            <div id="alertBox">

            </div>

            <div class="cart card">
                <div class="card__wrapper">
                    <div class="card__body">
                        <div class="cart__header">
                            <div class="cart__header-title">Gig Info</div>
                            <div class="cart__header-title text-center">Status</div>
                            <div class="cart__header-title text-center">Price</div>
                            <div class="cart__header-title"></div>
                        </div>
                        <div class="cart__items">
                            @foreach ($gigs as $index => $gig)
                                <div class="product-cart" data-gig-id="{{ $gig->id }}">
                                    <div class="product-cart__column product-cart__column--item-1">
                                        <div class="product-cart__item">
                                            <img src="{{ asset('storage/' . $gig->images[0]) }}" alt="#">
                                            <ul class="product-cart__params">
                                                <li><b>{{ $gig->title }}</b></li>
                                                {{-- <li>Gig UUID: {{ $gig->uuid }}</li> --}}
                                                <li>Category: {{ $gig->category->name }}</li>
                                                <li>
                                                    <span class="label label--primary" id="statusLabel-{{ $loop->index }}">
                                                        {{ $gig->status }}
                                                    </span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-cart__column">
                                        <div class="product-cart__quantity input-group input-group--white">
                                            <div class="input-group">
                                                <label class="checkbox-toggle {{ $gig->status == 'active' ? 'is-active' : '' }}" 
                                                    for="checkbox-status-toggle-{{ $loop->index }}"
                                                    onclick="toggleCheckboxStatus('{{ $gig->id }}', 'checkbox-status-toggle-{{ $loop->index }}', 'statusLabel-{{ $loop->index }}')">
                                                    <input type="checkbox" class="checkbox-toggle is-active" id="checkbox-status-toggle-{{ $loop->index }}"
                                                        {{ $gig->status == 'active' ? 'checked' : '' }}
                                                    >
                                                    <span class="checkbox-toggle__range"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-cart__column">
                                        <div class="product-cart__price">${{ $gig->price }}</div>
                                    </div>
                                    <div class="product-cart__column">
                                        <button class="product-cart__remove" >
                                            <a href="{{ route('public.gig.show', ['id'=> $gig->id]) }}" target="_blank">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><path d="M320 0c-17.7 0-32 14.3-32 32s14.3 32 32 32h82.7L201.4 265.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L448 109.3V192c0 17.7 14.3 32 32 32s32-14.3 32-32V32c0-17.7-14.3-32-32-32H320zM80 32C35.8 32 0 67.8 0 112V432c0 44.2 35.8 80 80 80H400c44.2 0 80-35.8 80-80V320c0-17.7-14.3-32-32-32s-32 14.3-32 32V432c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16V112c0-8.8 7.2-16 16-16H192c17.7 0 32-14.3 32-32s-14.3-32-32-32H80z"/></svg>
                                            </a>
                                        </button>
                                        <a href="{{ route('freelancers.gigs.edit', ['gig' => $gig->id]) }}" class="product-cart__remove" >
                                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><path d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z"/></svg>
                                        </a>
                                        <button class="product-cart__remove" onclick="deleteGig(event)">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>
                                        </button>
                                    </div>
                                </div>
                            @endforeach

                            {{-- <div class="product-cart">
                                <div class="product-cart__column product-cart__column--item-1">
                                    <div class="product-cart__item">
                                            <img src="{{ asset("storage/gig-images/default/0_I'll be your worker.png") }}" alt="#">
                                        <ul class="product-cart__params">
                                            <li><b>Gig Title</b></li>
                                            <li>Gig UUID: 790841</li>
                                            <li>Category: Web Development</li>
                                            <li>
                                                <span class="label label--primary" id="statusLabel">Active</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-cart__column">
                                    <div class="product-cart__quantity input-group input-group--white">
                                        <div class="input-group">
                                            <label class="checkbox-toggle " for="checkbox-status-toggle">
                                                <input type="checkbox" class="checkbox-toggle is-active" id="checkbox-status-toggle">
                                                <span class="checkbox-toggle__range"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-cart__column">
                                    <div class="product-cart__price">$399</div>
                                </div>
                                <div class="product-cart__column">
                                    <button class="product-cart__remove" type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><path d="M320 0c-17.7 0-32 14.3-32 32s14.3 32 32 32h82.7L201.4 265.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L448 109.3V192c0 17.7 14.3 32 32 32s32-14.3 32-32V32c0-17.7-14.3-32-32-32H320zM80 32C35.8 32 0 67.8 0 112V432c0 44.2 35.8 80 80 80H400c44.2 0 80-35.8 80-80V320c0-17.7-14.3-32-32-32s-32 14.3-32 32V432c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16V112c0-8.8 7.2-16 16-16H192c17.7 0 32-14.3 32-32s-14.3-32-32-32H80z"/></svg>
                                    </button>
                                    <button class="product-cart__remove" type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><path d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z"/></svg>
                                    </button>
                                    <button class="product-cart__remove" type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>
                                    </button>
                                </div>
                            </div> --}}
                            {{-- <div class="product-cart product-cart--light">
                                <div class="product-cart__column product-cart__column--item-1">
                                    <div class="product-cart__item">
                                        <a class="product-cart__image" href="#">
                                            <img src="img/content/product/item-2.jpg" srcset="img/content/product/item-2.jpg 2x" alt="#">
                                        </a>
                                        <ul class="product-cart__params">
                                            <li><b>Apple Watch Series 4</b>
                                            </li>
                                            <li>Product ID: 790841</li>
                                            <li>Color: Gold</li>
                                            <li>Size: 44mm</li>
                                            <li><span class="label label--primary">In Stock</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-cart__column">
                                    <div class="product-cart__quantity input-group">
                                        <input class="input" type="number" min="0" max="99" value="0">
                                    </div>
                                </div>
                                <div class="product-cart__column">
                                    <div class="product-cart__price">$499</div>
                                </div>
                                <div class="product-cart__column">
                                    <button class="product-cart__remove" type="button">
                                        <svg class="icon-icon-trash">
                                            <use xlink:href="#icon-trash"></use>
                                        </svg>
                                    </button>
                                </div>
                            </div> --}}
                            {{-- <div class="product-cart">
                                <div class="product-cart__column product-cart__column--item-1">
                                    <div class="product-cart__item">
                                        <a class="product-cart__image" href="#">
                                            <img src="img/content/product/item-3.jpg" srcset="img/content/product/item-3.jpg 2x" alt="#">
                                        </a>
                                        <ul class="product-cart__params">
                                            <li><b>Apple Watch Series 4</b>
                                            </li>
                                            <li>Product ID: 790841</li>
                                            <li>Color: Gold</li>
                                            <li>Size: 44mm</li>
                                            <li><span class="label label--primary">In Stock</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-cart__column">
                                    <div class="product-cart__quantity input-group input-group--white">
                                        <input class="input" type="number" min="0" max="99" value="0">
                                    </div>
                                </div>
                                <div class="product-cart__column">
                                    <div class="product-cart__price">$199</div>
                                </div>
                                <div class="product-cart__column">
                                    <button class="product-cart__remove" type="button">
                                        <svg class="icon-icon-trash">
                                            <use xlink:href="#icon-trash"></use>
                                        </svg>
                                    </button>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>

            {{-- <section class="section">
                <div class="section__title d-none">
                    <h2>Section</h2>
                </div>
                <div class="row gutter-bottom-xl">
                
                    <div class="col-12 col-md-6 col-xl-4 d-flex">
                        <div class="widget">
                            <div class="widget__wrapper">
                                <div class="widget__row">
                                    <div class="widget__left">
                                        <h3 class="widget__title">
                                            Bank Balance
                                        </h3>
                                        <div class="widget__status-title text-grey">
                                            Total amount at the moment
                                        </div>
                                        <div class="card-widget__trade">
                                            <span class="card-widget__count">${{$currentBalance}}</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-xl-4 d-flex" style="flex-direction: column;">
                        <a href="{{ route("admin.finances.deposit") }}" class="button button--secondary" type="button">
                            <span class="button__icon button__icon--left">
                                <svg class="icon-icon-plus">
                                    <use xlink:href="#icon-plus"></use>
                                </svg>
                            </span>
                            <span class="button__text">Deposit Money</span>
                        </a>
                        <br>
                        <a href="{{ route("admin.finances.withdraw") }}" class="button button--secondary" type="button">
                            <span class="button__icon button__icon--left">
                                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="20" viewBox="0 0 640 512"><path d="M535 41c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l64 64c4.5 4.5 7 10.6 7 17s-2.5 12.5-7 17l-64 64c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l23-23L384 112c-13.3 0-24-10.7-24-24s10.7-24 24-24l174.1 0L535 41zM105 377l-23 23L256 400c13.3 0 24 10.7 24 24s-10.7 24-24 24L81.9 448l23 23c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0L7 441c-4.5-4.5-7-10.6-7-17s2.5-12.5 7-17l64-64c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9zM96 64H337.9c-3.7 7.2-5.9 15.3-5.9 24c0 28.7 23.3 52 52 52l117.4 0c-4 17 .6 35.5 13.8 48.8c20.3 20.3 53.2 20.3 73.5 0L608 169.5V384c0 35.3-28.7 64-64 64H302.1c3.7-7.2 5.9-15.3 5.9-24c0-28.7-23.3-52-52-52l-117.4 0c4-17-.6-35.5-13.8-48.8c-20.3-20.3-53.2-20.3-73.5 0L32 342.5V128c0-35.3 28.7-64 64-64zm64 64H96v64c35.3 0 64-28.7 64-64zM544 320c-35.3 0-64 28.7-64 64h64V320zM320 352a96 96 0 1 0 0-192 96 96 0 1 0 0 192z"/></svg>
                            </span>
                            <span class="button__text">Withdraw Money</span>
                        </a>
                    </div>
                    <div class="col-12 col-md-6 col-xl-4 d-flex" style="flex-direction: column;">
                        <a href="{{ route("admin.profile") }}" class="button button--secondary" type="button">
                            <span class="button__icon button__icon--left">
                                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="18" viewBox="0 0 576 512"><path d="M64 32C28.7 32 0 60.7 0 96v32H576V96c0-35.3-28.7-64-64-64H64zM576 224H0V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V224zM112 352h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16zm112 16c0-8.8 7.2-16 16-16H368c8.8 0 16 7.2 16 16s-7.2 16-16 16H240c-8.8 0-16-7.2-16-16z"/></svg>
                            </span>
                            <span class="button__text">Edit Financial Information</span>
                        </a>
                        <br>
                    </div>

                    

                </div>
            </section>

            <section class="section">
                <div class="section__title d-none">
                    <h2>Section</h2>
                </div>
                <div class="row gutter-bottom-xl">
                    <div class="col-12 d-flex">
                        <div class="card pb-0">
                            <div class="card__wrapper">
                                <div class="card__container">
                                    <div class="card__header">
                                        <div class="card__header-left">
                                            <h3 class="card__header-title">
                                                Recent Transactions
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="card__body">
                                        <div class="card__scrollbar card__table">
                                            <div class="card__table-transactions scrollbar-thin scrollbar-visible"
                                                data-simplebar="data-simplebar">
                                                <table class="table table--lines table--striped">
                                                    <colgroup>
                                                        <col class="colgroup-1" />
                                                        <col class="colgroup-2" />
                                                        <col class="colgroup-3" />
                                                        <col class="colgroup-4" />
                                                        <col class="colgroup-5" />
                                                        <col class="colgroup-6" />
                                                        <col />
                                                    </colgroup>
                                                    <thead class="table__header table__header--sticky">
                                                        <tr>
                                                            <th>
                                                                <span class="text-nowrap">Tranaction
                                                                    No.</span>
                                                            </th>
                                                            <th>
                                                                <span>To</span>
                                                            </th>
                                                            <th>
                                                                <span>Date</span>
                                                            </th>
                                                            <th>
                                                                <span>Amount</span>
                                                            </th>
                                                            <th>
                                                                <span>From</span>
                                                            </th>
                                                            <th>
                                                                <span>Status</span>
                                                            </th>
                                                            <th class="table__actions"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($lastTransactions as $lastTransaction)
                                                            <tr class="table__row">
                                                                <td class="table__td">
                                                                    <span class="text-grey">{{$lastTransaction->number}}</span>
                                                                </td>
                                                                <td class="table__td">
                                                                    <div class="media-item">
                                                                        <div class="media-item__icon color-orange">
                                                                            <div class="media-item__icon-text">
                                                                                WS
                                                                            </div>
                                                                            <img class="media-item__thumb"
                                                                                src="{{ asset($lastTransaction->freelancer->img) }}"
                                                                                alt="#" />
                                                                                {{ $lastTransaction->freelancer->img  }}
                                                                        </div>
                                                                        <div class="media-item__right">
                                                                            <h5 class="media-item__title">
                                                                                {{$lastTransaction->freelancer->name}}
                                                                            </h5>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="table__td">
                                                                    <span class="text-grey">{{ \Carbon\Carbon::parse($lastTransaction->created_at)->format('d-m-Y h:i:s A') }} </span>
                                                                </td>
                                                                <td class="table__td">
                                                                    <span>${{ $lastTransaction->amount }}</span>
                                                                </td>
                                                                <td class="table__td">
                                                                    <span class="text-grey">
                                                                        {{ $lastTransaction->company->name }}
                                                                    </span>
                                                                </td>
                                                                <td class="table__td">
                                                                    <div class="table__status">
                                                                        @if ($lastTransaction->status == 'paid')
                                                                            <span class="table__status-icon color-green"></span>
                                                                            Paid
                                                                        @endif
                                                                        @if ($lastTransaction->status == 'cancelled')
                                                                            <span class="table__status-icon color-red"></span>
                                                                            Canceled
                                                                        @endif
                                                                        @if ($lastTransaction->status == 'pending')
                                                                            <span class="table__status-icon color-blue"></span>
                                                                            Pending
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section> --}}
        </div>

    </main>

    <script>
        function toggleCheckboxStatus(gigId, checkboxId, labelId) {
            var checkbox = document.getElementById(checkboxId);
            var statusLabel = document.getElementById(labelId);
            
            checkbox.checked = !checkbox.checked;
            statusLabel.textContent = checkbox.checked ? 'active' : 'disabled';

            // Use axios or another method to update the gig status in the database
            axios.put(`/freelancers/gigs/${gigId}/update-status`, { status: checkbox.checked ? 'active' : 'disabled' })
            .then(response => {
                    console.log(response.data.message);
                })
                .catch(error => {
                    console.error('Error updating gig status:', error);
            });
        }

        function deleteGig(event) {
            event.preventDefault();

            const gigId = event.currentTarget.closest('.product-cart').dataset.gigId;

            axios.delete(`/freelancers/gigs/${gigId}`)
            .then(response => {
                showAlert('success', response.data.message);
                // Optionally, you can remove the deleted gig from the UI
                event.target.closest('.product-cart').remove();
            })
            .catch(error => {
                console.error('Error deleting gig:', error);
                showAlert('fail', 'Error deleting gig. Please try again.');
            });
        }

        function showAlert(type, message) {
            // Set the alert type based on the parameter
            const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';

            // Create and append the alert element
            const alertElement = document.createElement('div');
            alertElement.classList.add('alert', alertClass, 'some-space-upNdown');
            alertElement.setAttribute('role', 'alert');
            alertElement.innerHTML = `
                <center style="">
                    ${message}
                    <br>
                </center>
            `;
            document.querySelector("#alertBox").appendChild(alertElement);

            // Set a timeout to remove the alert after 1.5 seconds
            setTimeout(function () {
                alertElement.remove();
            }, 2000);
        }
    </script>

@endsection
