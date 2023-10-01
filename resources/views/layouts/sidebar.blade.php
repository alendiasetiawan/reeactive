<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
<div class="app-brand demo">
    <a href="index.html" class="app-brand-link">
    <span class="app-brand-logo demo">
        <svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
            fill="#7367F0"
        />
        <path
            opacity="0.06"
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z"
            fill="#161616"
        />
        <path
            opacity="0.06"
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z"
            fill="#161616"
        />
        <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
            fill="#7367F0"
        />
        </svg>
    </span>
    <span class="app-brand-text demo menu-text fw-bold">Sales App</span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
    <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
    <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
    </a>
</div>

<div class="menu-inner-shadow"></div>

@if (Auth::user()->role_id==1)
<!--MENU LOGIN : Sales-->
<ul class="menu-inner py-1">
    <!-- Dashboards -->
    <li class="menu-item {{ ($title === "Dashboard Sales") ? 'active' : '' }}">
        <a href="/" class="menu-link">
            <i class="menu-icon tf-icons ti ti-dashboard"></i>
            Dashboard
        </a>
    </li>

    <!-- Customer -->
    <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Sales & Customer</span>
    </li>
    <li class="menu-item">
        <a href="#" class="menu-link">
            <i class="menu-icon tf-icons ti ti-users"></i>
            Database Customer
        </a>
    </li>
    <li class="menu-item {{ ($title === "Cold Call Sales") || ($title === "Form Tambah Customer Cold Call") || ($title === "Warm Call Sales")
    || ($title === "Form Tambah Customer Warm Call") || ($title === "Lead Generated Sales")
    || ($title === "Form Tambah Customer Lead Generated") || ($title === "Sales Closing")
    || ($title === "Form Tambah Customer Sales Closing") ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ti ti-phone-call"></i>
            Customer Call
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ ($title === "Cold Call Sales") || ($title === "Form Tambah Customer Cold Call") ? 'active' : '' }}">
                <a href="/sales/cold-call" class="menu-link">
                    Cold Call
                </a>
            </li>
            <li class="menu-item {{ ($title === "Warm Call Sales") || ($title === "Form Tambah Customer Warm Call") ? 'active' : '' }}">
                <a href="/sales/warm-call" class="menu-link">
                    Warm Call
                </a>
            </li>
            <li class="menu-item {{ ($title === "Lead Generated Sales") || ($title === "Form Tambah Customer Lead Generated") ? 'active' : '' }}">
                <a href="/sales/lead-generated" class="menu-link">
                    Lead Generated
                </a>
            </li>
            <li class="menu-item {{ ($title === "Sales Closing") || ($title === "Form Tambah Customer Sales Closing") ? 'active' : '' }}">
                <a href="/sales/sales-closing" class="menu-link">
                    Sales Closing
                </a>
            </li>
        </ul>
    </li>

    <!-- Report -->
    <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Report</span>
    </li>
    <li class="menu-item {{ ($title === "Laporan Sales Pekanan") || ($title === "Laporan Sales Bulanan") || ($title === "Laporan Sales Tahunan") ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ti ti-file-report"></i>
            Laporan Sales
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ ($title === "Laporan Sales Pekanan") ? 'active' : '' }}">
                <a href="/sales/laporan-sales-pekanan" class="menu-link">
                    Pekanan
                </a>
            </li>
            <li class="menu-item {{ ($title === "Laporan Sales Bulanan") ? 'active' : '' }}">
                <a href="/sales/laporan-sales-bulanan" class="menu-link">
                    Bulanan
                </a>
            </li>
            <li class="menu-item {{ ($title === "Laporan Sales Tahunan") ? 'active' : '' }}">
                <a href="/sales/laporan-sales-tahunan" class="menu-link">
                    Tahunan
                </a>
            </li>
        </ul>
    </li>
</ul>
@endif
</aside>
