
<header id="wt-header" class="wt-header wt-haslayout">
    <div class="wt-navigationarea">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    
                        <strong class="wt-logo" style="border-right: 1px solid #ddd;">
                            <a href="{{ route("public.home") }}"><img src="{{asset("img/content/logo-dark.svg")}}" alt="company logo here"></a>
                        </strong>

                        <form class="wt-formtheme wt-formbanner wt-formbannervtwo" style="width: 35%" action="{{ route("public.search") }}">
                            <fieldset>
                                <div class="form-group">
                                    
                                    <style>
                                        .search-suggestions{
                                            right: 0;
                                            left: auto;
                                            width: 571.547px;
                                        }
                                    </style>
                                    {{-- Orignal --}}
                                    {{-- <input type="text" name="query" class="form-control wt-dropdown" style="width: inherit" placeholder="Search">
                                    <div class="wt-formoptions">

                                        <div class="wt-radioholder search-suggestions" >
                                            <span class="wt-radio" >
                                                <input id="wt-freelancers" data-title="Freelancers" type="radio" name="searchtype" value="freelancer" >
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
                                        </div>
                                        <button type="submit" class="wt-searchbtn"><i class="lnr lnr-magnifier"></i></button>
                                    </div> --}}

                                    <input type="text" name="query" id="query" class="form-control wt-dropdown" style="width: inherit; padding-right:70px" placeholder="Search">
                                    <div class="wt-formoptions" >

                                        <div class="wt-radioholder search-suggestions" >
                                            {{-- <span class="wt-radio" >
                                                <input id="wt-freelancers" data-title="Freelancers" type="radio" name="searchtype" value="freelancer" >
                                                <label for="wt-freelancers">Freelancers</label>
                                            </span>
                                            <span class="wt-radio">
                                                <input id="wt-jobs" data-title="Jobs" type="radio" name="searchtype" value="job">
                                                <label for="wt-jobs">Jobs</label>
                                            </span>
                                            <span class="wt-radio">
                                                <input id="wt-companies" data-title="Companies" type="radio" name="searchtype" value="job">
                                                <label for="wt-companies">Companies</label>
                                            </span> --}}
                                        </div>  
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
                                            @foreach ($categories as $category)
                                                <li>
                                                    <a href="{{ route('public.search', ['category' => $category->id]) }}">{{ $category->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>

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
                                <a href="{{ route("freelancers.login") }}" class="wt-btn">Freelancer Login</a>
                                <a href="{{ route("companies.login") }}" class="wt-btn">Company Login</a>
                            </div>
                        @endif
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
    document.getElementById('query').addEventListener('input', function() {
        var query = this.value.trim();
        if (query.length > 0) {
            // Make an AJAX request to your Laravel backend
            fetchSearchSuggestions(query);
        } else {
            // Clear the search suggestions box if the query is empty
            document.querySelector('.search-suggestions').innerHTML = '';
        }
    });

    function fetchSearchSuggestions(query) {
        // Make an AJAX request to your Laravel backend
        fetch('{{route("public.search.suggestions")}}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ query: query })
        })
        .then(response => response.json())
        .then(data => {
            // Populate the search suggestions box with the returned suggestions
            var suggestionsHTML = data.map(item => 

            `
            
            <span class="wt-radio">
                <input id="wt-${item.id}" data-title="${item.title}" type="radio" name="searchtype" value="${item.title}">
                <label for="wt-${item.id}">${item.title}</label>
            </span>
            
            `).join('');
            document.querySelector('.search-suggestions').innerHTML = suggestionsHTML;
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    document.querySelector('.search-suggestions').addEventListener('click', function(event) {
        // Check if the clicked element is an input element
        if (event.target.tagName === 'INPUT') {
            // Get the title of the clicked suggestion
            var title = event.target.getAttribute('data-title');
            
            // Update the value of the search box with the title of the clicked suggestion
            document.getElementById('query').value = title;
        }
    });
</script>