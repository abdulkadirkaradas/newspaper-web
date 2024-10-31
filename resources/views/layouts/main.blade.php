<!DOCTYPE html>
<html lang="en">
@include('layouts.partials.head')

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background-color: #f4f4f4;
    }

    .main-layout-container {
        width: 100%;
    }

    header {
        width: 100%;
    }

    .sidebar {
        width: 250px;
        background-color: #2d2d2d;
        color: #fff;
        padding: 20px;
        position: relative;
        height: calc(100vh - 60px);
        overflow-y: auto;
    }

    .timeline-container {
        flex: 1;
        padding: 20px;
        background-color: #fff;
        overflow-y: auto;
        margin: 0 auto auto auto;
        max-width: 1200px;
    }

    @media (min-width: 768px) {
        .sidebar {
            display: block;
        }
    }

    @media (max-width: 768px) {
        #menu-toggle-btn {
            display: block !important;
        }

        .sidebar.show {
            transform: translateX(0);
        }

        .timeline-container {
            margin-left: 0;
        }

        /* Menü butonu */
        .menu-toggle {
            display: block;
            position: fixed;
            top: 15px;
            left: 15px;
            background-color: #2d2d2d;
            color: #fff;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            z-index: 1000;
        }
    }
</style>

<body>
    <main>
        <div class="main-layout-container">
            @include('layouts.partials.header')

            <div class="d-flex justify-content-center">
                @include('layouts.partials.sidebar')

                <div class="timeline-container">
                    @include('dashboard.main')
                </div>
            </div>
        </div>

        @include('layouts.partials.footer')
    </main>
</body>

</html>
