
<header id="wt-header" class="wt-header wt-haslayout">
    <div class="wt-navigationarea">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <strong class="wt-logo" style="border-right: 1px solid #ddd;">
                        <a href="{{ route("public.home") }}"><img src="{{asset("img/content/logo-dark.svg")}}" alt="company logo here"></a>
                        {{-- <a href="{{ route("public.home") }}"><img src="img/content/favicons/favicon-64x64.png" alt="company logo here"></a> --}}
                    </strong>
                    <form class="wt-formtheme wt-formbanner wt-formbannervtwo" action="{{ route("public.search") }}">
                        <fieldset>
                            <div class="form-group">
                                <input type="text" name="query" class="form-control" placeholder="Search">
                                <div class="wt-formoptions">
                                    {{-- <div class="wt-dropdown">
                                        <span>In: <em class="selected-search-type">Freelancers </em><i class="lnr lnr-chevron-down"></i></span>
                                    </div>
                                    <div class="wt-radioholder">
                                        <span class="wt-radio">
                                            <input id="wt-freelancers" data-title="Freelancers" type="radio" name="searchtype" value="freelancer" checked="">
                                            <label for="wt-freelancers">Freelancers</label>
                                        </span>
                                        <span class="wt-radio">
                                            <input id="wt-jobs" data-title="Jobs" type="radio" name="searchtype" value="job">
                                            <label for="wt-jobs">Jobs</label>
                                        </span>
                                        <span class="wt-radio">
                                            <input id="wt-companies" data-title="Companies" type="radio" name="searchtype" value="job">
                                            <label for="wt-companies">Companies</label>
                                        </span>
                                    </div> --}}
                                    <button type="submit" class="wt-searchbtn"><i class="lnr lnr-magnifier"></i></button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                    <div class="wt-rightarea">
                        <nav id="wt-nav" class="wt-nav navbar-expand-lg">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                <i class="lnr lnr-menu"></i>
                            </button>
                            <div class="collapse navbar-collapse wt-navigation" id="navbarNav">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a href="{{ route("public.home") }}">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route("public.team") }}">Team</a>
                                    </li>
                                    
                                    <li class="nav-item">
                                        <a href="{{ route("public.search") }}">Gigs</a>
                                    </li>

                                    <li class="menu-item-has-children page_item_has_children">
                                        <a href="">Categories</a>
                                        <ul class="sub-menu" style="max-height: 85vh;overflow: auto;">
                                            {{-- <li class="menu-item-has-children page_item_has_children wt-notificationicon"><span class="wt-dropdowarrow"><i class="lnr lnr-chevron-right"></i></span>
                                                <a href="javascript:void(0);">Home</a>
                                                <ul class="sub-menu">
                                                    <li><a href="index-2.html">Home v1</a></li>
                                                    <li class="wt-newnoti"><a href="indexvtwo.html">Home v2<em>without login</em></a></li>
                                                </ul>
                                            </li>
                                            <li class="menu-item-has-children page_item_has_children"><span class="wt-dropdowarrow"><i class="lnr lnr-chevron-right"></i></span>
                                                <a href="javascript:void(0);">Article</a>
                                                <ul class="sub-menu">
                                                    <li><a href="articlelist.html">Article List</a></li>
                                                    <li><a href="articlegrid.html">Article Grid</a></li>
                                                    <li><a href="articlesingle.html">Article Single</a></li>
                                                    <li><a href="articleclassic.html">Article Classic</a></li>
                                                </ul>
                                            </li>
                                            <li class="menu-item-has-children page_item_has_children"><span class="wt-dropdowarrow"><i class="lnr lnr-chevron-right"></i></span>
                                                <a href="javascript:void(0);">Company</a>
                                                <ul class="sub-menu">
                                                    <li><a href="companygrid.html">Company Grid</a></li>
                                                    <li><a href="companysigle.html">Company Sigle</a></li>
                                                </ul>
                                            </li> --}}
                                            @foreach ($categories as $category)
                                                <li>
                                                    <a href="{{ route('public.search', ['category' => $category->id]) }}">{{ $category->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>

                                    {{-- <li class="menu-item-has-children page_item_has_children">
                                        <a href="javascript:void(0);">Browse Jobs</a>
                                        <ul class="sub-menu">
                                            <li>
                                                <a href="joblisting.html">Job Listing</a>
                                            </li>
                                            <li class="current-menu-item">
                                                <a href="jobsingle.html">Job Single</a>
                                            </li>
                                            <li>
                                                <a href="jobproposal.html">Job Proposal</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children page_item_has_children">
                                        <a href="javascript:void(0);">View Freelancers</a>
                                        <ul class="sub-menu">
                                            <li>
                                                <a href="userlisting.html">User Listing</a>
                                            </li>
                                            <li class="current-menu-item">
                                                <a href="usersingle.html">User Single</a>
                                            </li>
                                        </ul>
                                    </li> --}}
                                </ul>
                            </div>
                        </nav>

                        @if (session()->has("LoggedCompany"))
                            <div class="wt-userlogedin" style="display: block">
                                <figure class="wt-userimg">
                                    <img src="{{request()->company->img}}" alt="image description">
                                </figure>
                                <div class="wt-username">
                                    <h3>{{request()->company->name}}</h3>
                                    <span>{{request()->company->name}} Tech</span>
                                </div>
                                <nav class="wt-usernav">
                                    <ul>
                                        {{-- <li class="menu-item-has-children page_item_has_children">
                                            <a href="javascript:void(0);">
                                                <span>Insights</span>
                                            </a>
                                            <ul class="sub-menu children">
                                                <li><a href="dashboard-insights.html">Insights</a></li>
                                                <li><a href="dashboard-insightsuser.html">Insights User</a></li>
                                            </ul>
                                        </li> --}}
                                        <li>
                                            <a href="{{ route("companies.dashboard") }}">
                                                <span>Dashboard</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route("companies.profile") }}">
                                                <span>My Profile</span>
                                            </a>
                                        </li>
                                        {{-- <li class="menu-item-has-children">
                                            <a href="javascript:void(0);">
                                                <span>All Jobs</span>
                                            </a>
                                            <ul class="sub-menu">
                                                <li><a href="dashboard-completejobs.html">Completed Jobs</a></li>
                                                <li><a href="dashboard-canceljobs.html">Cancelled Jobs</a></li>
                                                <li><a href="dashboard-ongoingjob.html">Ongoing Jobs</a></li>
                                                <li><a href="dashboard-ongoingsingle.html">Ongoing Single</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="dashboard-managejobs.html">
                                                <span>Manage Jobs</span>
                                            </a>
                                        </li>
                                        <li class="wt-notificationicon menu-item-has-children">
                                            <a href="javascript:void(0);">
                                                <span>Messages</span>
                                            </a>
                                            <ul class="sub-menu">
                                                <li><a href="dashboard-messages.html">Messages</a></li>
                                                <li><a href="dashboard-messages2.html">Messages V 2</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="dashboard-saveitems.html">
                                                <span>My Saved Items</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="dashboard-invocies.html">
                                                <span>Invoices</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="dashboard-category.html">
                                                <span>Category</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="dashboard-packages.html">
                                                <span>Packages</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="dashboard-proposals.html">
                                                <span>Proposals</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="dashboard-accountsettings.html">
                                                <span>Account Settings</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="dashboard-helpsupport.html">
                                                <span>Help &amp; Support</span>
                                            </a>
                                        </li> --}}
                                        <li>
                                            <a href="{{ route("companies.logout") }}">
                                                <span>Logout</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                                
                            </div>
                        @else
                            <div class="wt-loginarea">
                                {{-- <figure class="wt-userimg">
                                    <img src="{{asset("images/user-login.png")}}" alt="img description">
                                </figure> --}}
                                {{-- <div class="wt-loginoption">
                                    <a href="{{ route("freelancers.login") }}" id="wt-loginbtn" class="wt-loginbtn">Freelancer Login</a>
                                    <div class="wt-loginformhold">
                                        <form class="wt-formtheme wt-loginform do-forgot-password-form wt-hide-form">
                                            <fieldset>
                                                <div class="form-group">
                                                    <input type="email" name="email" class="form-control get_password" placeholder="Email">
                                                </div>
                                            
                                                <div class="wt-logininfo">
                                                    <a href="javascript:;" class="wt-btn do-get-password">Get Pasword</a>
                                                </div>     
                                            </fieldset>
                                            <div class="wt-loginfooterinfo">
                                                <a href="javascript:void(0);" class="wt-show-login">Login</a>
                                                <a href="register.html">Create account</a>
                                            </div>
                                        </form>
                                    </div>
                                </div> --}}
                                <a href="{{ route("freelancers.login") }}" class="wt-btn">Freelancer Login</a>
                                <a href="{{ route("companies.login") }}" class="wt-btn">Company Login</a>
                                {{-- <a href="register.html" classs="wt-btn">Join Now</a> --}}
                            </div>
                        @endif
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>