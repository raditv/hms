<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{!! access()->user()->picture !!}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>{!! access()->user()->name !!}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('strings.backend.general.status.online') }}</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="{{ trans('strings.backend.general.search_placeholder') }}"/>
                  <span class="input-group-btn">
                    <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                  </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">{{ trans('menus.backend.sidebar.general') }}</li>

            <!-- Optionally, you can add icons to the links -->
            <li class="{{ Active::pattern('admin/dashboard') }}">
                <a href="{!! route('admin.dashboard') !!}"><i class="fa fa-hotel"></i><span>{{ trans('menus.backend.sidebar.dashboard') }}</span></a>
            </li>

            @permission('view-access-management')
            <li class="{{ Active::pattern('admin/access/*') }} treeview">
                <a href="#">
                    <i class="fa fa-group"></i>
                    <span>{{ trans('menus.backend.access.title') }}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu {{ Active::pattern('admin/access*', 'menu-open') }}" style="display: none; {{ Active::pattern('admin/access*', 'display: block;') }}">
                <li class="{{ Active::pattern('admin/access/users') }}">
                    <a href="{!!url('admin/access/users')!!}">
                    <i class="fa fa-bolt"></i>
                    <span>User Management</span>
                    </a>
                </li>
                </ul>
            </li>
            @endauth
            @permission('view-report')
            <li class="{{ Active::pattern('admin/report/*') }}">
                <a href="#">
                    <i class="fa fa-bar-chart"></i>
                    <span>Report</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ Active::pattern('admin/report/sales/dailysales*') }}">
                        <a href="#">
                            <i class="fa fa-bed"></i>
                            <span>Daily Sales</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ Active::pattern('admin/report/sales/dailysales') }}">
                                <a href="{!! url('admin/report/sales/dailysales') !!}">
                                    <i class="fa fa-paperclip"></i>
                                    <span>Sales Report</span>
                                </a>
                            </li>
                            <li class="{{ Active::pattern('admin/report/sales/dailysales/chart') }}">
                                <a href="{!! url('admin/report/sales/dailysales/chart') !!}">
                                    <i class="fa fa-area-chart"></i>
                                    <span>Sales Chart</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="{{ Active::pattern('admin/report/sales/dailysalesout') }}">
                        <a href="#">
                            <i class="fa fa-coffee"></i>
                            <span>Outlet Sales</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ Active::pattern('admin/report/sales/dailysalesout') }}">
                                <a href="{!! url('admin/report/sales/dailysalesout') !!}">
                                    <i class="fa fa-paperclip"></i>
                                    <span>Outlet Report</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            @endauth
            @permission('view-access-management')
            <li class="{{ Active::pattern('admin/log-viewer*') }} treeview">
                <a href="#">
                    <i class="fa fa-archive"></i>
                    <span>{{ trans('menus.backend.log-viewer.main') }}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu {{ Active::pattern('admin/log-viewer*', 'menu-open') }}" style="display: none; {{ Active::pattern('admin/log-viewer*', 'display: block;') }}">
                    <li class="{{ Active::pattern('admin/log-viewer') }}">
                        <a href="{!! url('admin/log-viewer') !!}">
                        <i class="fa fa-bolt"></i>
                        <span>{{ trans('menus.backend.log-viewer.dashboard') }}</span>
                        </a>
                    </li>
                    <li class="{{ Active::pattern('admin/log-viewer/logs') }}">
                        <a href="{!! url('admin/log-viewer/logs') !!}">
                        <i class="fa fa-bolt"></i>
                        <span>{{ trans('menus.backend.log-viewer.logs') }}</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endauth

        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>