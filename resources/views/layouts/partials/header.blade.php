<header class="p-3 bg-dark text-white">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="#" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                <span>{{ env('APP_NAME') }}</span>
            </a>

            <div class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                {{-- TODO: Categories will be added in the future --}}
            </div>

            <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                <input type="search" class="form-control form-control-dark" placeholder="Search..." aria-label="Search" />
            </form>

            @if (session()->has('auth_token'))
                {{-- TODO: User quick actions should be shown when the user click icon --}}
                <div class="user-icon-container">
                    <div class="user-icon">
                        <i class="fa-solid fa-circle-user fa-2xl"></i>
                    </div>
                </div>
            @else
                <div class="text-end">
                    {{-- TODO: Login should be pop-up so that user can easily log in --}}
                    <a href="#" class="btn btn-outline-light me-2">Login</a>
                    {{-- TODO: Register process must be maded with pop-up --}}
                    <a href="{{ route('register.view') }}" class="btn btn-warning">Sign-up</a>
                </div>
            @endif
        </div>
    </div>
</header>

<style>
    .user-icon-container {
        cursor: pointer;
    }
</style>