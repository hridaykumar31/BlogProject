        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                   <img src="{{asset('images/asset_img/logo.png')}}" alt="" style="width: 40px">
                </div>
                <div class="sidebar-brand-text mx-3">Programming Blog<sup></sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item @if($page == 'Dashboard') active @endif">
                <a class="nav-link" href="{{route('admin.dashboard')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                core
            </div>
             <!-- Nav Item - Tables -->
             <li class="nav-item @if($page == 'Categories') active @endif">
                <a class="nav-link" href="{{route('category.index')}}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Category</span></a>
            </li>
            <li class="nav-item @if($page == 'posts') active @endif">
                <a class="nav-link" href="{{route('post.index')}}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>posts</span></a>
            </li>
            <li class="nav-item @if ($page == 'messages') active @endif">
                <a class="nav-link" href={{ route('messages.index') }}>
                    <i class="fas fa-fw fa-envelope"></i>
                    <span>Contact Messages</span></a>
            </li>
            <li class="nav-item  @if ($page == 'subscriber') active @endif"">
                <a class="nav-link" href={{route('subscribe')}}>
                    <i class="fas fa-fw fa-envelope"></i>
                    <span>Subscriber List</span></a>
            </li>

            <li class="nav-item @if ($page == 'ok') active @endif">
                <a class="nav-link" href={{ route('generateToken') }}>
                    <i class="fas fa-fw fa-envelope"></i>
                    <span>Generate Token</span></a>
            </li>

            


           

            <!-- Nav Item - Pages Collapse Menu -->
            {{-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="login.html">Login</a>
                        <a class="collapse-item" href="register.html">Register</a>
                        <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Other Pages:</h6>
                        <a class="collapse-item" href="404.html">404 Page</a>
                        <a class="collapse-item" href="blank.html">Blank Page</a>
                    </div>
                </div>
            </li> --}}

           
        </ul>
        <!-- End of Sidebar -->