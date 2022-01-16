<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Welcome</div>
                    <a class="nav-link" href="/dashboard">
                        <div class="sb-nav-link-icon"><i class="fas fa-blog"></i></div>
                        Blog
                    </a>

                    <a class="nav-link" href="/testimonial">
                        <div class="sb-nav-link-icon"><i class="fas fa-video"></i></div>
                        Testimonial
                    </a>

                    <a class="nav-link" href="/dashboard/trash">
                        <div class="sb-nav-link-icon"><i class="fas fa-trash"></i></div>
                      Blog  Trash
                    </a>

                    
          
                    <a class="nav-link" href="/dashboard/jobs">
                        <div class="sb-nav-link-icon"><i class="fas fa-eye"></i></div>
                        View Jobs
                    </a>
            
                </div>
            </div>


            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                {{Auth()->user()->name}}
            </div>
        </nav>
    </div>