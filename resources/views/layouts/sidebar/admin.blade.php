<li>
    <a href="{{ route('admin.dashboard') }}">
        <div class="parent-icon"><i class='bx bx-home-circle'></i>
        </div>
        <div class="menu-title">Dashboard</div>
    </a>
</li>
<li>
    <a href="{{ route('admin.requests.index') }}">
        <div class="parent-icon">
            <i class='bx bx-message-error'></i>
        </div>
        <div class="menu-title">New Requests</div>
    </a>
</li>
<li>
    <a href="{{ route('admin.stocks.index') }}">
        <div class="parent-icon">
            <i class='bx bx-coin-stack'></i>
        </div>
        <div class="menu-title">New Stocks</div>
    </a>
</li>
<li>
    <a href="{{ route('admin.purchasing.index') }}">
        <div class="parent-icon">
            <i class='bx bx-extension'></i>
        </div>
        <div class="menu-title">Stock Management</div>
    </a>
</li>
<li>
    <a href="{{ route('admin.categories.index') }}">
        <div class="parent-icon"><i class='bx bx-list-ul'></i>
        </div>
        <div class="menu-title">Categories</div>
    </a>
</li>
<li>
    <a href="{{ route('admin.units.index') }}">
        <div class="parent-icon"><i class='bx bx-list-ol'></i>
        </div>
        <div class="menu-title">Units</div>
    </a>
</li>
<li>
    <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class="bx bx-note"></i>
        </div>
        <div class="menu-title">Report Generation</div>
    </a>
    <ul>
        <li> <a href="{{ route('admin.reports.accomplished-requests') }}"><i class="bx bx-right-arrow-alt"></i>Accomplished Request</a>
        </li>
        <li> <a href="{{ route('admin.reports.pending-requests') }}"><i class="bx bx-right-arrow-alt"></i>Pending Request</a>
        </li>
        <li> <a href="{{ route('admin.reports.low-stocks') }}"><i class="bx bx-right-arrow-alt"></i>Low Stocks</a>
        </li>
    </ul>
</li>
<li>
    <a href="{{ route('admin.users.index') }}">
        <div class="parent-icon"><i class='bx bx-user-circle'></i>
        </div>
        <div class="menu-title">Users</div>
    </a>
</li>
