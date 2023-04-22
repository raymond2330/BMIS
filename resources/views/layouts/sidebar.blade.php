<div class="col-auto px-0 shadow-lg" style="background-color: #353c4e;">
    <div id="sidebar" class="collapse collapse-horizontal show border-end">
        <div id="sidebar-nav" class="list-group border-0 rounded-0 text-sm-start min-vh-100">
            <!-- <div class="container">
                <div class="py-3 mb-3 row justify-content-center">
                    <img src="https://doheny.org/wp-content/uploads/2019/03/placeholder-person.png" class="w-50 rounded-circle mb-3" alt="">
                    @if(auth()->user()->is_verified == 1)
                    <a href="#" class="text-white text-center fw-bold text-decoration-none">{{auth()->user()->first_name}} {{auth()->user()->last_name}} </span></a>
                    @endif
                    @if(auth()->user()->user_type == 0)
                    <p class="text-center text-light small">Client</p>
                    @endif
                    @if(auth()->user()->user_type == 3)
                    <p class="text-center text-light small">ROC.PH Talent</p>
                    @endif
                    @if(auth()->user()->user_type == 4)
                    <p class="text-center text-light small">You are an admin</p>
                    @endif
                    <hr>
                </div>
            </div> -->
            <div class="d-grid">
                <a class=" text-decoration-none text-light fw-bold text-center mt-5 mb-4" href="/welcome-user">System Control Panel</a>
            </div>
            <span class="ms-3 mt-2 text-secondary text-uppercase fw-bold" style="font-size:11px">Official Website</span>
            <a class="sidebar-item list-group-item border-bottom-0 border-end-0 d-inline-block text-truncate" data-bs-parent="#sidebar" href="/"><i class="ms-2 fa-solid fa-house me-2"></i>Barangay 385 Home</a>
            @if(Auth::user()->user_type == 0)
            <span class="ms-3 mt-2 text-secondary text-uppercase fw-bold" style="font-size:11px">User Management</span>
            <a class="sidebar-item list-group-item border-bottom-0 border-end-0 d-inline-block text-truncate {{ (request()->is('users/*')) ? 'active-link' : '' }}" data-bs-parent="#sidebar" href="/users/index"><i class="ms-2 fa-solid fa-users me-2"></i>System Users</a>
            <span class="ms-3 mt-2 text-secondary text-uppercase fw-bold" style="font-size:11px">Database Summary</span>
            <a class="sidebar-item list-group-item border-bottom-0 border-end-0 d-inline-block text-truncate {{ (request()->is('dashboard')) ? 'active-link' : '' }}" data-bs-parent="#sidebar" href="/dashboard"><i class="ms-2 fa-solid fa-chart-line me-2"></i>Dashboard</a>
            @endif
            @if(Auth::user()->user_type == 2 || Auth::user()->user_type == 0)
            <span class="ms-3 mt-2 text-secondary text-uppercase fw-bold" style="font-size:11px">Edit the Barangay Home page</span>
            <a class="sidebar-item list-group-item border-bottom-0 border-end-0 d-inline-block text-truncate {{ (request()->is('links/*')) ? 'active-link' : '' }}" data-bs-parent="#sidebar" href="/links/index"><i class="ms-2 fa-solid fa-link me-2"></i>Quick Links</a>
            <a class="sidebar-item list-group-item border-bottom-0 border-end-0 d-inline-block text-truncate {{ (request()->is('videos/*')) ? 'active-link' : '' }}" data-bs-parent="#sidebar" href="/videos/index"><i class="ms-2 fa-brands fa-youtube me-2"></i>Featured Videos</a>
            <a class="sidebar-item list-group-item border-bottom-0 border-end-0 d-inline-block text-truncate {{ (request()->is('announcements/*')) ? 'active-link' : '' }}" data-bs-parent="#sidebar" href="/announcements/index"><i class="ms-2 fa-solid fa-bullhorn me-2"></i>Announcements</a>
            @endif
            @if(Auth::user()->user_type == 1 || Auth::user()->user_type == 0)
            <span class="ms-3 mt-2 text-secondary text-uppercase fw-bold" style="font-size:11px">Local Statistics</span>
            <a class="sidebar-item list-group-item border-bottom-0 border-end-0 d-inline-block text-truncate {{ (request()->is('streets/*')) ? 'active-link' : '' }}" data-bs-parent="#sidebar" href="/streets/index"><i class="ms-2 fa-solid fa-house-user me-2"></i>Household Profiling</a>
            <span class="ms-3 mt-2 text-secondary text-uppercase fw-bold" style="font-size:11px">Tables</span>
            <a class="sidebar-item list-group-item border-bottom-0 border-end-0 d-inline-block text-truncate {{ (request()->is('households_list')) ? 'active-link' : '' }}" data-bs-parent="#sidebar" href="/households_list"><i class="ms-2 fa-solid fa-house-circle-check me-2"></i>Households</a>
            <a class="sidebar-item list-group-item border-bottom-0 border-end-0 d-inline-block text-truncate {{ (request()->is('residents/*')) ? 'active-link' : '' }}" data-bs-parent="#sidebar" href="/residents/index"><i class="ms-2 fa-solid fa-users-line me-2"></i>Residents</a>
            @if(Auth::user()->user_type == 0)
            <a class="sidebar-item list-group-item border-bottom-0 border-end-0 d-inline-block text-truncate {{ (request()->is('archive/residents')) ? 'active-link' : '' }}" data-bs-parent="#sidebar" href="/archive/residents"><i class="ms-2 fa-solid fa-box-archive me-2"></i>Archives</a>
            @endif
            @endif
            @if(Auth::user()->user_type == 3 || Auth::user()->user_type == 0)
            <span class="ms-3 mt-2 text-secondary text-uppercase fw-bold" style="font-size:11px">Forms</span>
            <a class="sidebar-item list-group-item border-bottom-0 border-end-0 d-inline-block text-truncate {{ (request()->is('certificates/index')) ? 'active-link' : '' }}" data-bs-parent="#sidebar" href="/certificates/index"><i class="ms-2 fa-solid fa-print me-2"></i>Form Logs</a>
            <a class="sidebar-item list-group-item border-bottom-0 border-end-0 d-inline-block text-truncate {{ (request()->is('forms')) || (request()->is('forms/*')) ? 'active-link' : '' }}" data-bs-parent="#sidebar" href="/forms"><i class="ms-2 fa-solid fa-file-signature me-2"></i>Generate Forms</a>
            @endif
            <span class="ms-3 mt-2 text-secondary text-uppercase fw-bold" style="font-size:11px">Help</span>
            <a class="sidebar-item list-group-item border-bottom-0 border-end-0 d-inline-block text-truncate {{ (request()->is('welcome-user')) ? 'active-link' : '' }}" data-bs-parent="#sidebar" href="/welcome-user"><i class="ms-2 fa-solid fa-clipboard-question me-2"></i>User Manual</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <div class="d-grid">
                    <button class="btn btn-light m-3 fw-bold text-secondary" type="submit"> Log out</button>
                </div>
            </form>


        </div>
    </div>
</div>

<!-- class="sidebar-item list-group-item border-bottom-0 border-end-0 d-inline-block text-truncate" data-bs-parent="#sidebar" -->