@switch(Session::get('role'))
@case(10)
<li class="nav-item">
    <a class="nav-link" href="{{ route('admin.dash') }}">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Dashboard</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" data-toggle="collapse" href="#sites" aria-expanded="false" aria-controls="sites">
        <i class="icon-grid-2 menu-icon"></i>
        <span class="menu-title">Location</span>
        <i class="menu-arrow"></i>
    </a>
    <div class="collapse" id="sites">
        <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.site.create') }}">Add new</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.site.index') }}">List all</a></li>
        </ul>
    </div>
</li>
<li class="nav-item">
    <a class="nav-link" data-toggle="collapse" href="#admins" aria-expanded="false" aria-controls="admins">
        <i class="icon-head menu-icon"></i>
        <span class="menu-title">Admins</span>
        <i class="menu-arrow"></i>
    </a>
    <div class="collapse" id="admins">
        <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.site-admin.create') }}">Add new</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.site-admin.index') }}">List all</a></li>
        </ul>
    </div>
</li>
<li class="nav-item">
    <a class="nav-link" data-toggle="collapse" href="#employees" aria-expanded="false" aria-controls="employees">
        <i class="icon-head menu-icon"></i>
        <span class="menu-title">Employees</span>
        <i class="menu-arrow"></i>
    </a>
    <div class="collapse" id="employees">
        <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.employess.create') }}">Add new</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.employess.index') }}">List all</a></li>
        </ul>
    </div>
</li>


{{-- <li class="nav-item">
        <a class="nav-link" href="pages/documentation/documentation.html">
            <i class="icon-paper menu-icon"></i>
            <span class="menu-title">Documentation</span>
        </a>
    </li> --}}
@break
@case(1)
<li class="nav-item">
    <a class="nav-link" href="{{ route('admin.site.dash') }}">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Dashboard</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('admin.tests') }}">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Test Results</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" data-toggle="collapse" href="#employees" aria-expanded="false" aria-controls="employees">
        <i class="icon-head menu-icon"></i>
        <span class="menu-title">Employees</span>
        <i class="menu-arrow"></i>
    </a>
    <div class="collapse" id="employees">
        <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.manage.addinsite') }}">Add new</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.manage.List') }}">List all</a></li>
        </ul>
    </div>
</li>
{{-- <li class="nav-item">
        <a class="nav-link" href="scan-qr.html">
            <i class="icon-contract menu-icon"></i>
            <span class="menu-title">Scan QR</span>
        </a>
    </li> --}}
{{-- <li class="nav-item">
    <a class="nav-link" href="{{ route('admin.package.export') }}">
        <i class="icon-paper menu-icon"></i>
        <span class="menu-title">Export sheet</span>
    </a>
</li> --}}
{{-- <li class="nav-item">
    <a class="nav-link" href="{{ route('admin.package.index')  }}">
        <i class="icon-bar-graph menu-icon"></i>
        <span class="menu-title">Test status</span>
    </a>
</li> --}}

@break

@case(2)
<!-- <li class="nav-item">
    <a class="nav-link" href="{{ route('employee.lookup') }}">
        <i class="icon-bar-graph menu-icon"></i>
        <span class="menu-title">Lookup Customer</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="#">
        <i class="icon-bar-graph menu-icon"></i>
        <span class="menu-title">Collect Test Sample</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="#">
        <i class="icon-bar-graph menu-icon"></i>
        <span class="menu-title">Enter test result</span>
    </a>
</li> -->

<li class="nav-item">
    <a class="nav-link" href="{{ route('employee.lookup') }}">
        <i class="icon-bar-graph menu-icon"></i>
        <span class="menu-title">Lookup Customer</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('employee.customeradd') }}">
        <i class="icon-bar-graph menu-icon"></i>
        <span class="menu-title">Create Customer</span>
    </a>
</li>


<li class="nav-item">
    <a class="nav-link" href="{{ route('employee.package.requested') }}">
        <i class="icon-bar-graph menu-icon"></i>
        <span class="menu-title">Requests
<br>
                <small>(Sample not taken)</small>
        </span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('employee.package.pending') }}">
        <i class="icon-bar-graph menu-icon"></i>
        <span class="menu-title">Approved Requests</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('employee.package.completed') }}">
        <i class="icon-bar-graph menu-icon"></i>
        <span class="menu-title">Enter test result</span>
    </a>
</li>
@break


@case(3)

<li class="nav-item">
    <a class="nav-link" href="{{ route('customer.dash') }}">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Dashboard</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('customer.antigen') }}">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Antigen Test</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('customer.pcr') }}">
        <i class="icon-paper menu-icon"></i>
        <span class="menu-title">PCR Test </span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('customer.results') }}">
        <i class="icon-bar-graph menu-icon"></i>
        <span class="menu-title">Recent tests</span>
    </a>
</li>
{{--
<li class="nav-item">
    <a class="nav-link" data-toggle="collapse" href="#employees" aria-expanded="false" aria-controls="employees">
        <i class="icon-head menu-icon"></i>
        <span class="menu-title">Employees</span>
        <i class="menu-arrow"></i>
    </a>
    <div class="collapse" id="employees">
        <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.manage.addinsite') }}">Add new</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.manage.List') }}">List all</a></li>
        </ul>
    </div>
</li>
--}}

{{-- <li class="nav-item">
        <a class="nav-link" href="scan-qr.html">
            <i class="icon-contract menu-icon"></i>
            <span class="menu-title">Scan QR</span>
        </a>
    </li> --}}

@break
@default

@endswitch
