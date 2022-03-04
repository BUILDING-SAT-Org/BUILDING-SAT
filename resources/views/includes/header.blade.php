<!-- Header -->
<header class="p-3 bg-dark">
    <div class="row  flex-nowrap">
        <div class="col-auto mr-auto">
            <a href="/" class="">
                <img src="/images/logo.png" alt="bsat-logo" title="bsat-logo" style="width: 180px;height: 60px;">
            </a>
        </div>
        <div class="col-auto" style="align-self: center;">
            @auth
                <a href="/dashboard" class="px-2 link-text-white">Dashboard</a>
                <a href="http://building-sat.com" class="px-2 link-text-white">About</a>
                <span class="dropdown">
                    <a class="px-2 dropdown-toggle link-text-white" href="#" role="button" id="dropdownHelpLink"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        Help
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="dropdownHelpLink">
                        <li><a href="http://building-sat.com/faq/" class="dropdown-item">FAQs</a></li>
                        <li><a href="http://building-sat.com/help-videos/" class="dropdown-item">Help Videos</a></li>
                        <li><a href="http://building-sat.com/contact-us/" class="dropdown-item">Contact Us</a></li>
                    </ul>
                </span>
                @if (Auth::user()->role == "admin")
                    <a class="btn btn-outline-light" href="/manage-bsat-resources">Manage BSAT Resources</a>
                @endif
                <a href="/signout" class="btn btn-outline-light">Logout</a>
            @endauth
            @guest
                <a href="http://building-sat.com/about" class="px-2 link-text-white">About</a>
                <span class="dropdown">
                    <a class="px-2 dropdown-toggle link-text-white" href="#" role="button" id="dropdownHelpLink"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        Help
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="dropdownHelpLink">
                        <li><a href="http://building-sat.com/faq/" class="dropdown-item">FAQs</a></li>
                        <li><a href="http://building-sat.com/help-videos/" class="dropdown-item">Help Videos</a></li>
                        <li><a href="http://building-sat.com/contact-us/" class="dropdown-item">Contact Us</a></li>
                    </ul>
                </span>
                <a href="/login" class="btn btn-outline-light me-2">Login</a>
                <a href="/register" class="btn btn-warning">Sign-up</a>
            @endguest
        </div>
    </div>
</header>
@auth
    @if (Request::is('project/*'))
        <div class="bsat-nav-bar">
            <div class="row" style="justify-content: flex-end;">
                <div class="col-auto">
                    <a class="px-2 btn btn-secondary text-white" type="button"
                       id="dropdownMenuButton" onclick="editProject({{$project_id}})">General Information</a>

                    <span class="dropdown">
                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            Construction Phase
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item"
                                   onclick="navigate('/project/{{ Auth::user()->id }}/{{ $project_id}}/earthworks')"
                                >EarthWorks</a></li>
                        <li><a class="dropdown-item"
                               onclick="navigate('/project/{{ Auth::user()->id }}/{{$project_id}}/sub-structure')"
                            >Substructure</a></li>
                        <li><a class="dropdown-item"
                               onclick="navigate('/project/{{ Auth::user()->id }}/{{$project_id}}/super-structure')"
                            >Superstructure</a></li>
                        <li><a class="dropdown-item"
                               onclick="navigate('/project/{{ Auth::user()->id }}/{{$project_id}}/internal-and-external-finishes')"
                            >Internal and External Finishes</a></li>
                        <li>
                            <a class="dropdown-item"
                               onclick="navigate('/project/{{ Auth::user()->id }}/{{ $project_id}}/construction-site-operations')"
                            >Construction Site Operations</a>
                        </li>
                        </ul>
                    </span>

                    <span class="dropdown">
                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            Operation Phase
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item"
                                   onclick="navigate('/project/{{ Auth::user()->id }}/{{ $project_id}}/energy-consumption')"
                                >Energy Consumption</a></li>
                            <li><a class="dropdown-item"
                                   onclick="navigate('/project/{{ Auth::user()->id }}/{{ $project_id}}/water-consumption')"
                                >Water Consumption</a></li>
                            <div class="dropdown-divider"></div>
                            <li><a class="dropdown-item"
                                   onclick="navigate('/project/{{ Auth::user()->id }}/{{ $project_id}}/maintenance-replacement')"
                                >Maintenance and Replacement</a></li>
                        </ul>
                    </span>

                    <a class="px-2 btn btn-secondary text-white"
                       onclick="navigate('/project/{{ Auth::user()->id }}/{{$project_id}}/demolition-phase')"
                    >Demolition Phase</a>
                    <a class="px-2 btn btn-secondary text-white"
                       onclick="navigate('/project/{{ Auth::user()->id }}/{{$project_id}}/manage-resources')"
                    >Manage Project Resources</a>
                    <a class="px-2 btn btn-secondary text-white"
                       onclick="navigate('/project/{{ Auth::user()->id }}/{{$project_id}}/results')"
                    >Results</a>
                    @if (!Request::is('*/results') && !Request::is('*/manage-resources'))
                        <button type="button" id="btnSave" class="btn btn-primary"
                                style="">Save
                        </button>
                    @endif
                </div>
            </div>
        </div>
        <div class="" style="margin-left: 25px;">
            <h1>Project: {{$project_name}}</h1>
        </div>
        @include('popups.projectModal')
    @endif

    <div class="loading">
        <div class='uil-ring-css' style='transform:scale(0.79);'>
            <div></div>
        </div>
    </div>

    <script>
        var loadingOverlay = document.querySelector('.loading');
    </script>
@endauth
<!-- end: Header -->
