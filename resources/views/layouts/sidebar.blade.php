<aside id="menubar" class="menubar light">
  <div class="app-user">
    <div class="media">
      <div class="media-left">
        <div class="avatar avatar-md avatar-circle">
          <a href="javascript:void(0)"><img class="img-responsive" src="{{ user_avatar(Auth::user()->image) }}" alt="avatar"/></a>
        </div><!-- .avatar -->
      </div>
      <div class="media-body">
        <div class="foldable">
          <h5><a href="javascript:void(0)" class="username">{{ call_user(Auth::user()) }}</a></h5>
          <ul>
            <li class="dropdown">
              <a href="javascript:void(0)" class="dropdown-toggle usertitle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <small>Web Developer</small>
                <span class="caret"></span>
              </a>
              <ul class="dropdown-menu animated flipInY">
                <li>
                  <a class="text-color" href="/index.html">
                    <span class="m-r-xs"><i class="fa fa-home"></i></span>
                    <span>Home</span>
                  </a>
                </li>
                <li>
                  <a class="text-color" href="profile.html">
                    <span class="m-r-xs"><i class="fa fa-user"></i></span>
                    <span>Profile</span>
                  </a>
                </li>
                <li>
                  <a class="text-color" href="settings.html">
                    <span class="m-r-xs"><i class="fa fa-gear"></i></span>
                    <span>Settings</span>
                  </a>
                </li>
                <li role="separator" class="divider"></li>
                <li>
                  <a class="text-color" href="logout.html">
                    <span class="m-r-xs"><i class="fa fa-power-off"></i></span>
                    <span>Home</span>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div><!-- .media-body -->
    </div><!-- .media -->
  </div><!-- .app-user -->

  <div class="menubar-scroll">
    <div class="menubar-scroll-inner">
      <ul class="app-menu">
        <li class="has-submenu">
          <a href="{{ route('dashboard') }}">
            <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>
            <span class="menu-text">Dashboards</span>
          </a>
        </li>
        
        <li class="has-submenu">
          <a href="javascript:void(0)" class="submenu-toggle">
            <i class="menu-icon zmdi zmdi-layers zmdi-hc-lg"></i>
            <span class="menu-text">Layouts</span>
            <span class="label label-warning menu-label">2</span>
            <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
          </a>
          <ul class="submenu">
            <li><a href="../default/index.html"><span class="menu-text">Default</span></a></li>
            <li><a href="../topbar/index.html"><span class="menu-text">Topbar</span></a></li>
          </ul>
        </li>

        <li class="has-submenu">
          <a href="javascript:void(0)" class="submenu-toggle">
            <i class="menu-icon zmdi zmdi-puzzle-piece zmdi-hc-lg"></i>
            <span class="menu-text">Project</span>
            <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
          </a>
          <ul class="submenu">
            <li><a href="{{ route('new_project') }}"><span class="menu-text">Add New Project</span></a></li>
            <li><a href="{{ route('projects') }}"><span class="menu-text">Projects List</span></a></li>
            <li><a href="{{ route('projects_archive') }}"><span class="menu-text">Archive</span></a></li>
            <li><a href="{{ route('projects_structure') }}"><span class="menu-text">Projects Structure</span></a></li>
          </ul>
        </li>
        <li class="has-submenu">
          <a href="javascript:void(0)" class="submenu-toggle">
            <i class="menu-icon zmdi zmdi-puzzle-piece zmdi-hc-lg"></i>
            <span class="menu-text">Tasks</span>
            <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
          </a>
          <ul class="submenu">
            <li><a href="{{ route('create_task') }}"><span class="menu-text">Add New Task</span></a></li>
            <li><a href="{{ route('all_tasks') }}"><span class="menu-text">Tasks List</span></a></li>
          </ul>
        </li>
        <li>
          <a href="{{ route('file_manager') }}">
            <i class="menu-icon zmdi zmdi-file-text zmdi-hc-lg"></i>
            <span class="menu-text">File Manager</span>
          </a>
        </li>

        <li class="menu-separator"><hr></li>

        <li>
          <a href="documentation.html">
            <i class="menu-icon zmdi zmdi-file-text zmdi-hc-lg"></i>
            <span class="menu-text">Documentation</span>
          </a>
        </li>

        <li>
          <a href="{{ route('settings') }}">
            <i class="menu-icon zmdi zmdi-settings zmdi-hc-lg"></i>
            <span class="menu-text">Settings</span>
          </a>
        </li>
        
        <li>
            <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <i class="menu-icon fa fa-sign-out "></i>
                <span class="menu-text">Logout</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>
      </ul><!-- .app-menu -->
    </div><!-- .menubar-scroll-inner -->
  </div><!-- .menubar-scroll -->
</aside>