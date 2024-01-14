@extends('admin.layouts.parent')

@section('title', 'Dashboard | Admin')

@section('content')
    
    <main class="page-content">
        <div class="container">

            {{-- Page Title --}}
            <div class="page-header">
                <h1 class="page-header__title">At the Glance</h1>
            </div>

            {{-- Bread Crumbs --}}
            <div class="page-tools">
                <div class="page-tools__breadcrumbs">
                    <div class="breadcrumbs">
                        <div class="breadcrumbs__container">
                            <ol class="breadcrumbs__list">

                                <li class="breadcrumbs__item">
                                    <a class="breadcrumbs__link" href="{{ route("admin.dashboard") }}">
                                        <svg class="icon-icon-home breadcrumbs__icon">
                                            <use xlink:href="#icon-home"></use>
                                        </svg>
                                        <svg class="icon-icon-keyboard-right breadcrumbs__arrow">
                                            <use xlink:href="#icon-keyboard-right"></use>
                                        </svg>
                                    </a>
                                </li>

                                <li class="breadcrumbs__item active">
                                    <a class="breadcrumbs__link" href="{{ route("admin.dashboard") }}">
                                        <span>Dashboard</span>
                                    </a>
                                </li>

                            </ol>
                        </div>
                    </div>
                </div>

                {{-- <div class="page-tools__right">
                    <div class="page-tools__right-row">
                        <div class="page-tools__right-item"><a class="button-icon" href="#"><span class="button-icon__icon">
                <svg class="icon-icon-print">
                    <use xlink:href="#icon-print"></use>
                </svg></span></a>
                        </div>
                        <div class="page-tools__right-item"><a class="button-icon" href="#"><span class="button-icon__icon">
                <svg class="icon-icon-import">
                    <use xlink:href="#icon-import"></use>
                </svg></span></a>
                        </div>
                    </div>
                </div> --}}

            </div>

            <div class="widgets">
                <div class="widgets__row row gutter-bottom-xl">

                    {{-- Number of freelancers widget --}}
                    <div class="col-12 col-md-6 col-xl-4 d-flex">
                        <div class="widget">
                            <div class="widget__wrapper">
                                <div class="widget__row">
                                    <div class="widget__left">
                                        <h3 class="widget__title">
                                            Total Freelancers
                                        </h3>
                                        <div class="widget__status-title text-grey">
                                            Total freelancers working right now
                                        </div>
                                        <div class="widget__trade">
                                            <span class="widget__trade-count">{{ $freelancerCount }}</span>

                                            <span class="trade-icon trade-icon--up">
                                                <svg class="icon-icon-trade-up">
                                                    <use xlink:href="#icon-trade-up"></use>
                                                </svg>
                                            </span>
                                            <span class="badge badge--sm badge--green">7%</span>

                                        </div>
                                        <div class="widget__details">
                                            <a class="link-under text-grey" href="{{ route("admin.freelancers.index") }}">Detail</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Number of companies widget --}}
                    <div class="col-12 col-md-6 col-xl-4 d-flex">
                        <div class="widget">
                            <div class="widget__wrapper">
                                <div class="widget__row">
                                    <div class="widget__left">
                                        <h3 class="widget__title">
                                            Total Companies
                                        </h3>
                                        <div class="widget__status-title text-grey">
                                            Total companies working right now
                                        </div>
                                        <div class="widget__trade">
                                            <span class="widget__trade-count">{{ $companyCount }}</span>
                                            
                                            <span class="trade-icon trade-icon--down">
                                                <svg class="icon-icon-trade-down">
                                                    <use xlink:href="#icon-trade-down"></use>
                                                </svg>
                                            </span>
                                            <span class="badge badge--sm badge--red">3%</span>
                                        </div>
                                        <div class="widget__details">
                                            <a class="link-under text-grey" href="{{ route("admin.companies.index") }}">Detail</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Number of transactions widget --}}
                    <div class="col-12 col-md-6 col-xl-4 d-flex">
                        <div class="widget">
                            <div class="widget__wrapper">
                                <div class="widget__row">
                                    <div class="widget__left">
                                        <h3 class="widget__title">
                                            Total Transactions
                                        </h3>
                                        <div class="widget__status-title text-grey">
                                            Transactions made today
                                        </div>
                                        <div class="widget__trade">
                                            <span class="widget__trade-count">{{ $transactionCount }}</span>

                                            <span class="trade-icon trade-icon--up">
                                                <svg class="icon-icon-trade-up">
                                                    <use xlink:href="#icon-trade-up"></use>
                                                </svg>
                                            </span>
                                            <span class="badge badge--sm badge--green">9%</span>
                                        </div>
                                        <div class="widget__details">
                                            <a class="link-under text-grey" href="{{ route("admin.finances.transactions") }}">Detail</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <section class="section">
                <div class="section__title d-none">
                    <h2>Section</h2>
                </div>
                <div class="row gutter-bottom-xl">
                
                    {{-- Bank Balance --}}
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
                                            <span class="card-widget__count">${{$currentAmount}}</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
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
                                                                <span class="text-nowrap">Tranaction No.</span>
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
                                                            {{-- <th class="table__actions"></th> --}}
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
                                                                        @if ($lastTransaction->status == "paid" )
                                                                            <span class="table__status-icon color-green"></span>
                                                                            Paid
                                                                        @endif
                                                                        @if ($lastTransaction->status == "cancelled" )
                                                                            <span class="table__status-icon color-red"></span>
                                                                            Canceled
                                                                        @endif
                                                                        @if ($lastTransaction->status == "pending" )
                                                                            <span class="table__status-icon color-blue"></span>
                                                                            Pending
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                                {{-- <td class="table__td table__actions">
                                                                    <div class="items-more">
                                                                        <button class="items-more__button">
                                                                            <svg class="icon-icon-more">
                                                                                <use xlink:href="#icon-more"></use>
                                                                            </svg>
                                                                        </button>
                                                                        <div
                                                                            class="dropdown-items dropdown-items--right">
                                                                            <div class="dropdown-items__container">
                                                                                <ul class="dropdown-items__list">
                                                                                    <li class="dropdown-items__item">
                                                                                        <a
                                                                                            class="dropdown-items__link"><span
                                                                                                class="dropdown-items__link-icon">
                                                                                                <svg
                                                                                                    class="icon-icon-view">
                                                                                                    <use
                                                                                                        xlink:href="#icon-view">
                                                                                                    </use>
                                                                                                </svg></span>Details</a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td> --}}
                                                            </tr>
                                                        @endforeach
                                                        {{-- <tr class="table__row">
                                                            <td class="table__td">
                                                                <span class="text-grey">987120</span>
                                                            </td>
                                                            <td class="table__td">
                                                                <div class="media-item">
                                                                    <div class="media-item__icon color-green">
                                                                        <div class="media-item__icon-text">
                                                                            PG
                                                                        </div>
                                                                        <img class="media-item__thumb"
                                                                            src="{{asset("img/content/humans/item-3.jpg")}}"
                                                                            alt="#" />
                                                                    </div>
                                                                    <div class="media-item__right">
                                                                        <h5 class="media-item__title">
                                                                            Pamela
                                                                            Garza
                                                                        </h5>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="table__td">
                                                                <span class="text-grey">17.07.2018</span>
                                                            </td>
                                                            <td class="table__td">
                                                                <span>$800</span>
                                                            </td>
                                                            <td class="table__td">
                                                                <span class="text-grey">
                                                                    Facebook LLC
                                                                </span>
                                                            </td>
                                                            <td class="table__td">
                                                                <div class="table__status">
                                                                    <span class="table__status-icon color-red"></span>
                                                                    Canceled
                                                                </div>
                                                            </td>
                                                            <td class="table__td table__actions">
                                                                <div class="items-more">
                                                                    <button class="items-more__button">
                                                                        <svg class="icon-icon-more">
                                                                            <use xlink:href="#icon-more"></use>
                                                                        </svg>
                                                                    </button>
                                                                    <div
                                                                        class="dropdown-items dropdown-items--right">
                                                                        <div class="dropdown-items__container">
                                                                            <ul class="dropdown-items__list">
                                                                                <li class="dropdown-items__item">
                                                                                    <a
                                                                                        class="dropdown-items__link"><span
                                                                                            class="dropdown-items__link-icon">
                                                                                            <svg
                                                                                                class="icon-icon-view">
                                                                                                <use
                                                                                                    xlink:href="#icon-view">
                                                                                                </use>
                                                                                            </svg></span>Details</a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr class="table__row">
                                                            <td class="table__td">
                                                                <span class="text-grey">922309</span>
                                                            </td>
                                                            <td class="table__td">
                                                                <div class="media-item">
                                                                    <div class="media-item__icon color-blue">
                                                                        <div class="media-item__icon-text">
                                                                            SA
                                                                        </div>
                                                                    </div>
                                                                    <div class="media-item__right">
                                                                        <h5 class="media-item__title">
                                                                            Stephen
                                                                            Allen
                                                                        </h5>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="table__td">
                                                                <span class="text-grey">25.07.2018</span>
                                                            </td>
                                                            <td class="table__td">
                                                                <span>$3,000</span>
                                                            </td>
                                                            <td class="table__td">
                                                                <span class="text-grey">
                                                                    Butt 🍑 Brothers
                                                                </span>
                                                            </td>
                                                            <td class="table__td">
                                                                <div class="table__status">
                                                                    <span class="table__status-icon color-blue"></span>
                                                                    Pending
                                                                </div>
                                                            </td>
                                                            <td class="table__td table__actions">
                                                                <div class="items-more">
                                                                    <button class="items-more__button">
                                                                        <svg class="icon-icon-more">
                                                                            <use xlink:href="#icon-more"></use>
                                                                        </svg>
                                                                    </button>
                                                                    <div
                                                                        class="dropdown-items dropdown-items--right">
                                                                        <div class="dropdown-items__container">
                                                                            <ul class="dropdown-items__list">
                                                                                <li class="dropdown-items__item">
                                                                                    <a
                                                                                        class="dropdown-items__link"><span
                                                                                            class="dropdown-items__link-icon">
                                                                                            <svg
                                                                                                class="icon-icon-view">
                                                                                                <use
                                                                                                    xlink:href="#icon-view">
                                                                                                </use>
                                                                                            </svg></span>Details</a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr> --}}
                                                        
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
            </section>
        </div>

    </main>

@endsection