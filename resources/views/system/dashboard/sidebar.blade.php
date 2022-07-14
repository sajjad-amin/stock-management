<div id="sidebar" class="sidebar left">
    <ul class="list-sidebar bg-defoult">
        <li> <a href="{{route('dashboard')}}" class="@if(Route::is('dashboard')) active @endif"><i class="fa fa-pie-chart"></i> <span class="nav-label">Dashboard</span> </a></li>
        @can('admin')
            <li> <a href="#" data-toggle="collapse" data-target="#product" class="@if(Route::is('product.*')) collapsed active @endif" > <i class="fa fa-th-large"></i> <span class="nav-label">Products</span> <span class="fa fa-chevron-left pull-right"></span> </a>
                <ul class="sub-menu @if(!Route::is('product.*')) collapse @endif" id="product">
                    <li><a href="{{route('product.all')}}" class="@if(Route::is('product.all')) active @endif"><i class="fa fa-database"></i> All Products</a></li>
                    <li><a href="{{route('product.new')}}" class="@if(Route::is('product.new')) active @endif"><i class="fa fa-plus"></i> Add New Product</a></li>
                    <li><a href="{{route('product.edit')}}" class="@if(Route::is('product.edit')) active @endif"><i class="fa fa-pencil"></i> Edit Product</a></li>
                </ul>
            </li>
            <li> <a href=""><i class="fa fa-credit-card-alt"></i> <span class="nav-label">Sell</span> </a></li>
{{--            <li> <a href=""><i class="fa fa-file-text"></i> <span class="nav-label">Invoices</span> </a></li>--}}
            <li> <a href="#" data-toggle="collapse" data-target="#ecommerce" class="collapsed" > <i class="fa fa-shopping-basket"></i> <span class="nav-label">E-Commerce</span> <span class="fa fa-chevron-left pull-right"></span> </a>
                <ul class="sub-menu collapse" id="ecommerce">
                    <li><a href="#"><i class="fa fa-bookmark"></i>Orders</a></li>
                </ul>
            </li>
        @endcan
    </ul>
</div>
