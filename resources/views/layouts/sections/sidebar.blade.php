<!-- Begin Page Content -->            
<div class="default-sidebar">
    <!-- Begin Side Navbar -->
    <nav class="side-navbar box-scroll sidebar-scroll">
        <!-- Begin Main Navigation -->
        <ul class="list-unstyled">

            <!-- Dashboard Route -->
            <li><a href="{{route('home')}}"><i class="la la-columns"></i><span>Dashboard</span></a></li>
            
            <!-- Invoice Route -->
            @can('view_invoice')
            <li id="invoice"><a href="{{route('invoices')}}"><i class="la la-spinner"></i><span>Invoice</span></a></li>
            @endcan

            <!-- User Route -->
            @can('view_user')
            <li id="user"><a href="{{route('users')}}"><i class="la la-users"></i><span>Users</span></a></li>
            @endcan

            <!-- Recipient Route -->
            @can('view_recipient')
            <li id="recipient"><a href="{{route('recipients')}}"><i class="la la-users"></i><span>Recipients</span></a></li>
            @endcan

            <!-- Product Route -->
            @can('view_product')
            <li id="product"><a href="{{route('products')}}"><i class="ion ion-cube"></i><span>Products</span></a></li>
            @endcan

            <!-- Tax Route -->
            @can('view_tax')
            <li><a href="{{route('taxes')}}"><i class="la la-money"></i><span>Taxes</span></a></li>
            @endcan
            
        </ul>
        <!-- End Main Navigation -->
    </nav>
    <!-- End Side Navbar -->
</div>
<!-- End Left Sidebar -->