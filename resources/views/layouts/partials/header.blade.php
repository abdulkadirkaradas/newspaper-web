<?php $newsCategories = json_decode($newsCategories); ?>

<header class="p-3 bg-dark text-white" style="position: fixed; top: 0; left: 0;">
    <span id="menu-toggle-btn" class="menu-toggle d-lg-none"
        style="display: none; background-color: unset; border: 1px solid white;">☰</span>
    <div class="container">
        <div class="col-12 d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <div class="col-lg-1 text-start">
                <a href="#" class="col-2 d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <span>{{ strtoupper(env('APP_NAME')) }}</span>
                </a>
            </div>

            <div class="nav col-4 mb-md-0">
                {{-- TODO: Categories will be added in the future --}}
                @foreach ($newsCategories as $key => $category)
                    <a href="#"
                        class="header-category category-{{ $key }} text-white text-decoration-none"
                        style="margin-left: 10px;">
                        <span class="text-white">n\</span>{{ $category->name }}
                    </a>
                @endforeach
            </div>

            <div class="col-4">
                <input type="search" class="form-control form-control-dark" placeholder="Search..."
                    aria-label="Search" />
            </div>

            <div class="col-lg-3">
                @if (session()->has('auth_token'))
                    {{-- TODO: User quick actions should be shown when the user click icon --}}
                    <div class="user-icon-container text-end">
                        <div id="user-icon" class="d-flex align-items-center justify-content-center"
                            style="width: 32px; height: 32px; float: right; cursor: pointer;">
                            <i class="fa-solid fa-circle-user fa-2xl"></i>
                        </div>
                    </div>
                @else
                    <div class="text-end">
                        {{-- TODO: Login should be pop-up so that user can easily log in --}}
                        <a href="{{ route('login.view') }}" class="btn btn-outline-light me-2">Login</a>
                        {{-- TODO: Register process must be maded with pop-up --}}
                        <a href="{{ route('register.view') }}" class="btn btn-warning">Sign-up</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</header>

<script>
    $(document).ready(function() {
        $('#menu-toggle-btn').on('click', function() {
            const sidebar = $('.sidebar');
            const dashboardContainer = $('.dashboard-container');
            let sidebarVisibility = sidebar.css('display');

            sidebar.css('display', sidebarVisibility === 'block' ? 'none' : 'block');
            dashboardContainer.css('margin-left', sidebarVisibility === 'block' ? 0 :
                setDashboardContainerMargin());
        });

        // TODO: Logout action will be moved to proper place in the future
        $('#user-icon').on('click', function() {
            $.ajax({
                method: "POST",
                url: "{{ route('auth.logout') }}",
                cache: false,
                data: {
                    "_token": "{{ csrf_token() }}",
                },
            }).done(function(response) {
                if (response.status === 200) {
                    window.location.href = "{{ route('dashboard') }}"
                }

                // This alert will be removed in the future
                alert(response.message);
            });
        });
    });
</script>
