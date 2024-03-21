@extends('public.layouts.parent')

@section('title', 'Order | CAN')

@section('banner')
    <!--Inner Home Banner Start-->
    <div class="wt-haslayout wt-innerbannerholder">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-xs-12 col-sm-12 col-md-8 push-md-2 col-lg-6 push-lg-3">
                    <div class="wt-innerbannercontent">
                        <div class="wt-title">
                            <h2>Place Order</h2>
                        </div>
                        <ol class="wt-breadcrumb">
                            <li><a href="{{ route('public.home') }}">Home</a></li>
                            <li><a href="{{ route('public.search') }}">Gig</a></li>
                            <li class="wt-active">Order</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Inner Home End-->

@endsection

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!--Main Start-->
    <main id="wt-main" class="wt-main wt-haslayout wt-innerbgcolor">
        <div class="wt-haslayout wt-main-section">
            <!-- User Listing Start-->
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 push-lg-2">
                        <div class="wt-jobalertsholder">
                            <ul class="wt-jobalerts">
                                {{-- <li class="alert alert-warning alert-dismissible fade show">
                                    <span><em>Alert:</em> You’ve consumed all you points to apply new job,</span>
                                    <a href="javascript:void(0)" class="wt-alertbtn warning">Buy Now</a>
                                    <a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="Close"><i class="fa fa-close"></i></a>
                                </li>
                                <li class="alert alert-primary alert-dismissible fade show">
                                    <span><em>info: </em> You’ve no skills of “PHP” but still you can apply for this job.</span>
                                    <a href="javascript:void(0)" class="wt-alertbtn primary">View</a>
                                    <a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="Close"><i class="fa fa-close"></i></a>
                                </li> --}}

                                {{-- <li class="alert alert-danger alert-dismissible fade show">
                                    <span><em>You’re Late:</em> We’re sorry but the job you want to apply is no longer available You’re Late:  for public/freelancers anymore.</span>
                                    <a href="javascript:void(0)" class="wt-alertbtn danger">Got It</a>
                                    <a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="Close"><i class="fa fa-close"></i></a>
                                </li> --}}
                            </ul>
                        </div>
                        <div class="wt-proposalholder">
                            <span class="wt-featuredtag"><img src="{{ asset('images/featured.png') }}" alt="img description"
                                    data-tipso="Plus Member" class="template-content tipso_style"></span>
                            <div class="wt-proposalhead">
                                <h2>{{ $gig->title }}</h2>
                                <ul class="wt-userlisting-breadcrumb wt-userlisting-breadcrumbvtwo">
                                    <li><span><i class="fa fa-dollar-sign"></i><i class="fa fa-dollar-sign"></i><i
                                                class="fa fa-dollar-sign"></i> {{ $gig->price }}</span></li>
                                    <li><span><img src="{{ asset('images/flag/img-02.png') }}" alt="img description"> United
                                            States</span></li>
                                    <li><span><i class="far fa-folder"></i> Category: {{ $gig->category->name }}</span></li>
                                    {{-- <li><span><i class="far fa-clock"></i> Duration: 15 Days</span></li> --}}
                                </ul>
                            </div>
                        </div>
                        <div class="wt-proposalamount-holder">
                            <div class="wt-title">
                                <h2>Gig Price</h2>
                            </div>
                            <div class="wt-proposalamount accordion">
                                <div class="form-group">
                                    <span>( <i class="fa fa-dollar-sign"></i> )</span>
                                    <input type="number" name="amount" class="form-control" value="{{ $gig->price }}"
                                        readonly disabled>
                                    <a href="javascript:void(0);" class="collapsed" id="headingOne" data-toggle="collapse"
                                        data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><i
                                            class="lnr lnr-chevron-up"></i></a>
                                    <em>Total amount you will be paying to freelancer.</em>
                                </div>
                                <ul class="wt-totalamount collapse show" id="collapseOne" aria-labelledby="headingOne">
                                    <li>
                                        <h3>( <i class="fa fa-dollar-sign"></i> ) <em>- 4% </em></h3>
                                        <span><strong>“ Coporate Artisan Net's ”</strong> Service Fee<i
                                                class="fa fa-exclamation-circle template-content tipso_style"
                                                data-tipso="Platform's fees"></i></span>
                                    </li>
                                    {{-- <li>
                                        <h3>( <i class="fa fa-dollar-sign"></i> ) <em>- 00.00</em></h3>
                                        <span>Amount You’ll Recive after <strong>“ Worktern ”</strong> Service Fee deduction<i class="fa fa-exclamation-circle template-content tipso_style" data-tipso="Plus Member"></i></span>
                                    </li> --}}
                                </ul>
                            </div>
                            <form class="wt-formtheme wt-formproposal" method="POST" action="{{ route('orders.store') }}"
                                id="orderForm">
                                @csrf
                                <input type="hidden" name="gig_id" value="{{ $gig->id }}">
                                <input type="hidden" name="freelancer_id" value="{{ $gig->freelancer->id }}">
                                <input type="hidden" name="company_id" value="{{ request()->company->id }}">
                                <input type="hidden" name="amount" value="{{ $gig->price }}">

                                <fieldset>
                                    <div class="form-group">
                                        <span class="wt-select">
                                            <select name="time" required>
                                                <option value="" style="display: none;">Select Time</option>
                                                <option value="1">I Want This Order Finished In: 01 Months</option>
                                                <option value="2">I Want This Order Finished In: 02 Months</option>
                                                <option value="3">I Want This Order Finished In: 03 Months</option>
                                                <option value="4">I Want This Order Finished In: 04 Months</option>
                                            </select>
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" name="description" required placeholder="Add Description*"></textarea>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <div class="wt-attachments wt-attachmentsvtwo">
                                        {{-- <div class="wt-title">
                                            <h3>Upload File (Optional)</h3>
                                            <label for="afile">
                                                <span><i class="lnr lnr-link"></i> Attach File(s)</span>
                                                <input type="file" name="file" id="afile">
                                            </label>
                                        </div>
                                        <ul class="wt-attachfile">
                                            <li class="wt-uploading">
                                                <span>Logo.jpg</span>
                                                <em>File size: 300 kb<a href="javascript:void(0);" class="lnr lnr-trash"></a></em>
                                            </li>
                                            <li>
                                                <span>Wireframe Document.doc</span>
                                                <em>File size: 512 kb<a href="javascript:void(0);" class="lnr lnr-trash"></a></em>
                                            </li>
                                            <li>
                                                <span>Requirments.pdf</span>
                                                <em>File size: 110 kb<a href="javascript:void(0);" class="lnr lnr-trash"></a></em>
                                            </li>
                                            <li>
                                                <span>Company Intro.docx</span>
                                                <em>File size: 224 kb<a href="javascript:void(0);" class="lnr lnr-trash"></a></em>
                                            </li>
                                        </ul> --}}
                                        <div class="wt-btnarea">
                                            {{-- <button type="submit" form="orderForm" class="wt-btn">Place Order</button> --}}
                                            {{-- <button type="button" class="btn  wt-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                Place Order
                                            </button> --}}
                                            <button type="button" class=" wt-btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                Place Order
                                            </button>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- User Listing End-->
        </div>
    </main>
    <!--Main End-->
    
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Contract and Rights of each party.</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>
                    <h5>Rights of Freelancer:</h5> 
                    <ul>
                        <li>Right to receive fair compensation for services rendered.</li>
                        <li>Right to control their own work schedule and methods of working.</li>
                        <li>Right to refuse work that goes against personal or professional ethics.</li>
                        <li>Right to be credited for their work in any published materials.</li>
                        <li>Right to negotiate terms and conditions of the contract.</li>
                        <li>Right to request clear project specifications and expectations.</li>
                        <li>Right to protection against discrimination or harassment.</li>
                        <li>Right to request timely feedback and communication from the company.</li>
                        <li>Right to withdraw from the project if the terms of the contract are not upheld.</li>
                        <li>Right to seek legal recourse in case of contract violations or disputes.</li>
                    </ul>
                </p>
                
                <p>
                    <h5>Rights of Company:</h5> 
                    <ul>
                        <li>Right to expect timely delivery of high-quality work.</li>
                        <li>Right to specify project requirements and deadlines.</li>
                        <li>Right to confidentiality of sensitive company information.</li>
                        <li>Right to terminate the contract if the freelancer fails to meet agreed-upon standards.</li>
                        <li>Right to request revisions or modifications to the delivered work.</li>
                        <li>Right to expect professionalism and dedication from the freelancer.</li>
                        <li>Right to protection of intellectual property rights related to the project.</li>
                        <li>Right to monitor progress and performance of the freelancer.</li>
                        <li>Right to negotiate payment terms and methods.</li>
                        <li>Right to terminate the contract if the freelancer breaches confidentiality or non-disclosure agreements.</li>
                    </ul>
                    
                </p>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
            <button type="submit" form="orderForm" class="wt-btn">Understood</button>
            </div>
        </div>
        </div>
    </div>
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
@endsection
