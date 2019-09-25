<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        <header class="site-header">
            <div class="site-header-bar">
                <div class="hd-left">
                    <button class="nav-trigger">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="site-logo">
                        <a class="site-logo-text" href="{{ url('/home') }}">
                            <img src="{{ asset('/images/') }}/logo.png" alt="40 by 48" />
                        </a>
                    </div>
                </div>
                <nav class="hd-right">
                    <ul class="list-hd">
                        @guest
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        @if (Route::currentRouteName() == 'trailer.list')
                            <li class="nav-item homeClass">
                                <a class="nav-link" href="{{ route('create.trailer') }}">
                                    {{ __('Create New') }}
                                </a>    
                            </li>
                            <li class="nav-item docsClass download_documents" style="display: none;">
                                <a href="javascript:" class="nav-link download-all-documents">Download All documents</a>
                            </li>
                            <li class="nav-item docsClass upload_documents" style="display: none;">
                                <a href="javascript:" class="nav-link upload-documents">Upload Document</a>
                            </li>
                            <li class="nav-item docsClass search_documents" style="display: none;">
                                <a href="javascript:" class="nav-link search-docs-form">
                                    Search Docs
                                </a>
                            </li>
                        @elseif(Route::currentRouteName() == 'create.trailer')
                            <li class="nav-item docsClass download_documents" style="display: none;">
                                <a href="javascript:" class="nav-link download-all-documents">Download All documents</a>
                            </li>
                            <li class="nav-item docsClass upload_documents" style="display: none;">
                                <a href="javascript:" class="nav-link upload-documents">Upload Document</a>
                            </li>
                            <li class="nav-item docsClass search_documents" style="display: none;">
                                <a href="javascript:" class="nav-link search-docs-form">
                                    Search Docs
                                </a>
                            </li>
                        @elseif(Route::currentRouteName() == 'view.trailer')
                            <li class="nav-item homeClass">
                                <a class="nav-link" href="{{ route('create.trailer') }}">
                                    {{ __('Create New') }}
                                </a>    
                            </li>
                            <li class="nav-item homeClass">
                                <a class="nav-link" href="{{ route('edit.trailer', $data->TrailerSerialNo) }}">
                                    {{ __('Edit') }}
                                </a>    
                            </li>
                            <li class="nav-item docsClass download_documents" style="display: none;">
                                <a href="javascript:" class="nav-link download-all-documents">Download All documents</a>
                            </li>
                            <li class="nav-item docsClass upload_documents" style="display: none;">
                                <a href="javascript:" class="nav-link upload-documents">Upload Document</a>
                            </li>
                            <li class="nav-item docsClass search_documents" style="display: none;">
                                <a href="javascript:" class="nav-link search-docs-form">
                                    Search Docs
                                </a>
                            </li>
                            <li class="nav-item add_financial_invoice_top" style="display: none;">
                                <a href="{{route('create.invoice', $data->TrailerSerialNo)}}" class="nav-link">
                                    Add Invoice
                                </a>
                            </li>
                        @elseif(Route::currentRouteName() == 'edit.trailer')
                            <li class="nav-item homeClass">
                                <a class="nav-link" href="{{ route('create.trailer') }}">
                                    {{ __('Create New') }}
                                </a>    
                            </li>
                            <li class="nav-item docsClass download_documents" style="display: none;">
                                <a href="javascript:" class="nav-link download-all-documents">Download All documents</a>
                            </li>
                            <li class="nav-item docsClass upload_documents" style="display: none;">
                                <a href="javascript:" class="nav-link upload-documents">Upload Document</a>
                            </li>
                            <li class="nav-item docsClass search_documents" style="display: none;">
                                <a href="javascript:" class="nav-link search-docs-form">
                                    Search Docs
                                </a>
                            </li>
                            <li class="nav-item add_financial_invoice_top" style="display: none;">
                                <a href="{{route('create.invoice', $data->TrailerSerialNo)}}" class="nav-link">
                                    Add Invoice
                                </a>
                            </li>
                            @elseif(Route::currentRouteName() == 'users.list')
                            <li class="nav-item">
                                <a href="{{route('create.user')}}" class="nav-link">
                                    Add New User
                                </a>
                            </li>
                            @elseif(Route::currentRouteName() == 'create.user')
                            <li class="nav-item">
                                <a href="{{route('users.list')}}" class="nav-link">
                                    Users
                                </a>
                            </li>
                            @elseif(Route::currentRouteName() == 'invoice.list')
                            <li class="nav-item">
                                <a href="{{route('create.invoice')}}" class="nav-link">Add Invoice</a>
                            </li>
                            @if(count($data))
                            <li class="nav-item">
                                <a href="{{route('invoice.list')}}" class="nav-link">Search</a>
                            </li>
                            @php
                                $invoiceIds = [];
                                foreach($data as $invoiceId) {
                                    array_push($invoiceIds, $invoiceId->InvoiceNo);
                                }
                            @endphp
                            <li class="nav-item">
                                <a href="{{route('export.headCSV', implode(',',$invoiceIds))}}" class="nav-link">
                                    Download Header CSV
                                </a>
                            </li>
                            <li class="nav-item">    
                                <a href="{{route('export.lineCSV', implode(',',$invoiceIds))}}" class="nav-link">
                                    Download Line Item CSV
                                </a>
                            </li>    
                                @endif
                            @elseif (Route::currentRouteName() == 'edit.invoice')
                                @if(isset($data)) 
                            <li class="nav-item">
                                    <a href="{{route('edit.invoice.line', $data->InvoiceNo)}}" class="nav-link">Edit Line Items</a> 
                            </li>
                                  @endif
                        @endif    
                        @endguest
                    </ul>
                </nav>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
        </header>

        <main role="main">
            <div class="site-sidebar">
                @include('includes.navigation')

            </div>        
            <div class="site-contents">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
            <div class="nav-overlay"></div>
        </main>
        
    </div>

    <script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
