 <nav class="navbar navbar-expand-lg main-navbar">
    
          <ul class="navbar-nav mr-auto icon-menu">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            
          </ul>
      
        <ul class="navbar-nav navbar-right">

         <li>
             <a target="_blank" href="" class="nav-link nav-link-lg"><i class="fas fa-home pr-1"></i></a>
         </li>
        
        
          
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="{{getPhoto(admin()->photo)}}" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">{{admin()->email}}</div></a>
            <div class="dropdown-menu dropdown-menu-right">
             <a href="{{route('admin.profile')}}" class="dropdown-item has-icon">
                <i class="far fa-user"></i> @lang('Profile Setting')
              </a>
             <a href="{{route('admin.password')}}" class="dropdown-item has-icon">
                <i class="fas fa-key"></i> @lang('Change Password')
              </a>
          
              <div class="dropdown-divider"></div>
              <a href="{{route('admin.logout')}}" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> @lang('Logout')
              </a>
            </div>
          </li>
        </ul>
      </nav>