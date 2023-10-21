<div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
    <!--begin::Menu Nav-->
    <ul class="menu-nav">
        <li class="menu-item" aria-haspopup="true">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <i class="menu-icon flaticon-home"></i>
                <span class="menu-text">Dashboard</span>
            </a>
        </li>
        <li class="menu-section">
            <h4 class="menu-text">Custom</h4>
            <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
        </li>
        <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
            <a href="{{ route('customers.index') }}" class="menu-link menu-toggle">
                <i class="menu-icon flaticon-web"></i>
                <span class="menu-text">Customers</span>
            </a>
        </li>


    </ul>
    <!--end::Menu Nav-->
</div>