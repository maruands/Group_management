<!-- Navbar -->
<style>
.logo{
    width:35px;
}
</style>
<nav class="main-header navbar navbar-expand-lg navbar-light navbar-white">
        <div class="container">
            <a href="#" class="navbar-brand">
                <img src="{{ asset('dist/img/logo.jpeg') }}"  alt="Logo" class="brand-image logo img-circle elevation-2" style="opacity: .8">
                <span class="brand-text font-weight-light">GroupApp Name here</span>
            </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <!-- Right navbar links -->
            <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                <!-- Messages Dropdown Menu -->
                @if (Route::has('login'))
                    @auth
                    
                    <li class="nav-item">
                        <form action="{{route('logout')}}" method="post" >
                            @csrf
                            <button type="submit" class="btn btn-primary text-white nav-link">Logout</button>
                        </form>
                    </li>
                    @else
                    <li class="nav-item">
                        <a href="{{route('login')}}" class="btn btn-primary text-white nav-link">Login</a>
                    </li>
                    @endauth
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
<!-- /.navbar -->