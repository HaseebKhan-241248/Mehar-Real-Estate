<div class="be-wrapper be-fixed-sidebar"  style="min-height: auto !important">
    <div class="be-left-sidebar">
        <div class="left-sidebar-wrapper customSidebarbackground" ><a href="#" class="left-sidebar-toggle">Dashboard</a>
            <div class="left-sidebar-spacer">
                <div class="left-sidebar-scroll">
                    <div class="left-sidebar-content">
                        <ul class="sidebar-elements">
                            <li class="divider customDivider" >Menu</li>
                            @if((Auth::user()->role) == 'Super Admin')
                            <li class="{{ (request()->is('/')) ? 'active' : '' }}">
                                <a href="{{ route('dashboard.index') }}">
                                    <i class="icon mdi mdi-home"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            @else
                            @can('Dashboard','Read')
                            <li class="{{ (request()->is('/')) ? 'active' : '' }}">
                                <a href="{{ route('dashboard.index') }}">
                                    <i class="icon mdi mdi-home"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            @endcan
                            @endif

                            @if((Auth::user()->role) == 'Super Admin')
                            <li class="{{(request()->is('accounts-list')) || (request()->is('create-account')) ? 'active' : '' }} parent "><a href="#">&nbsp<i class="mdi mdi-account-box-phone"></i > <span> &nbsp&nbsp Charts of Accounts</span></a>
                                <ul class="sub-menu">
                                    <li class="{{ (request()->is('create-account')) ? 'active' : '' }}">
                                        <a href="{{ route('add.accounts') }}">Add New</a>
                                    </li>
                                    <li class="{{ (request()->is('accounts-list')) ? 'active' : '' }}">
                                        <a href="{{ route('list.accounts') }}">Manage Accounts</a>
                                    </li>
                                </ul>
                            </li>
                            @else
                             @can('Charts of Accounts','Read')
                             <li class="{{(request()->is('accounts-list')) || (request()->is('create-account')) ? 'active' : '' }} parent "><a href="#">&nbsp<i class="mdi mdi-account-box-phone"></i > <span> &nbsp&nbsp Charts of Accounts</span></a>
                                <ul class="sub-menu">
                                    @can('Add New','Read')
                                    <li class="{{ (request()->is('create-account')) ? 'active' : '' }}">
                                        <a href="{{ route('add.accounts') }}">Add New</a>
                                    </li>
                                    @endcan
                                    @can('Manage Accounts','Read')
                                    <li class="{{ (request()->is('accounts-list')) ? 'active' : '' }}">
                                        <a href="{{ route('list.accounts') }}">Manage Accounts</a>
                                    </li>
                                    @endcan                                
                                </ul>
                            </li>
                             @endcan
                            @endif
                            
                            <li class="divider customDivider">New Persons</li>
                            @if((Auth::user()->role) == 'Super Admin')
                            
                            <li class="{{ (request()->is('partners-list')) ? 'active' : '' }} parent">
                                <a href="#"
                                ><i class="mdi mdi-accounts-add" style="font-size: 18px;"></i >
                                    <span> &nbsp&nbsp Partners</span>
                                </a>
                                <ul class="sub-menu">
                                    <li class="{{ (request()->is('partners-list')) ? 'active' : '' }}">
                                        <a href="{{ route('partners.list') }}">Manage Partners</a>
                                    </li>
                                    <li class="{{ (request()->is('partners-share')) ? 'active' : '' }}">
                                        <a href="{{ route('partners.share') }}">Partners Share</a>
                                    </li>
                                </ul>
                            </li>
                            @else
                            @can('Partners','Read')
                            <li class="{{ (request()->is('partners-list')) ? 'active' : '' }} parent">
                                <a href="#"
                                ><i class="mdi mdi-accounts-add" style="font-size: 18px;"></i >
                                    <span> &nbsp&nbsp Partners</span>
                                </a>
                                <ul class="sub-menu">
                                    @can('Manage Partners','Read')
                                    <li class="{{ (request()->is('partners-list')) ? 'active' : '' }}">
                                        <a href="{{ route('partners.list') }}">Manage Partners</a>
                                    </li>
                                    @endcan
                                    @can('Partners Share','Read')
                                    <li class="{{ (request()->is('partners-share')) ? 'active' : '' }}">
                                        <a href="{{ route('partners.share') }}">Partners Share</a>
                                    </li>
                                    @endcan
                                </ul>
                            </li>
                            @endcan
                            @endif

                            @if((Auth::user()->role) == 'Super Admin')
                            
                            <li class="{{ (request()->is('customers-list')) ? 'active' : '' }} parent">
                                <a href="#">&nbsp
                                    <i class="mdi mdi-accounts-outline" style="font-size: 18px;"></i >
                                    <span> &nbsp&nbsp Customers</span>
                                </a>
                                <ul class="sub-menu">
                                    <li class="{{ (request()->is('customers-list')) ? 'active' : '' }}">
                                        <a href="{{ route('customers.list') }}">Manage Customers</a>
                                    </li>
                                </ul>
                            </li>
                            @else
                            @can('Customers','Read')
                            <li class="{{ (request()->is('customers-list')) ? 'active' : '' }} parent">
                                <a href="#">&nbsp
                                    <i class="mdi mdi-accounts-outline" style="font-size: 18px;"></i >
                                    <span> &nbsp&nbsp Customers</span>
                                </a>
                                <ul class="sub-menu">
                                    @can('Manage Customers','Read')
                                    <li class="{{ (request()->is('customers-list')) ? 'active' : '' }}">
                                        <a href="{{ route('customers.list') }}">Manage Customers</a>
                                    </li>
                                    @endcan
                                </ul>
                            </li>
                            @endcan
                            @endif
                            
                            @if((Auth::user()->role ) == 'Super Admin')
                            
                            <li class="{{ (request()->is('dealers-list')) ? 'active' : '' }} parent">
                                <a href="#">&nbsp
                                    <i class="mdi mdi-slideshare" style="font-size: 18px;"></i >
                                    <span> &nbsp&nbsp Dealers</span>
                                </a>
                                <ul class="sub-menu">
                                    <li class="{{ (request()->is('dealers-list')) ? 'active' : '' }}">
                                        <a href="{{ route('dealers.list') }}">Manage Dealers</a>
                                    </li>
                                </ul>
                            </li>
                            @else
                            @can('Dealers','Read')
                            <li class="{{ (request()->is('dealers-list')) ? 'active' : '' }} parent">
                                <a href="#">&nbsp
                                    <i class="mdi mdi-slideshare" style="font-size: 18px;"></i >
                                    <span> &nbsp&nbsp Dealers</span>
                                </a>
                                
                                <ul class="sub-menu">
                                    @can('Manage Dealers','Read')
                                    <li class="{{ (request()->is('dealers-list')) ? 'active' : '' }}">
                                        <a href="{{ route('dealers.list') }}">Manage Dealers</a>
                                    </li>
                                    @endcan
                                </ul>
                            </li>
                            @endcan
                            @endif
                            
                            @if((Auth::user()->role) == 'Super Admin')
                            
                            <li class="{{ (request()->is('marketers-list')) ? 'active' : '' }} parent">
                                <a href="#">&nbsp
                                    <i class="mdi mdi-account-add" style="font-size: 18px;"></i >
                                    <span> &nbsp&nbsp Marketers</span>
                                </a>
                                <ul class="sub-menu">
                                    <li class="{{ (request()->is('marketers-list')) ? 'active' : '' }}">
                                        <a href="{{ route('marketers.list') }}">Manage Marketers</a>
                                    </li>
                                </ul>
                            </li>
                            @else
                            @can('Marketers','Read')
                            <li class="{{ (request()->is('marketers-list')) ? 'active' : '' }} parent">
                                <a href="#">&nbsp
                                    <i class="mdi mdi-account-add" style="font-size: 18px;"></i >
                                    <span> &nbsp&nbsp Marketers</span>
                                </a>
                                <ul class="sub-menu">
                                    @can('Manage Marketers','Read')
                                    <li class="{{ (request()->is('marketers-list')) ? 'active' : '' }}">
                                        <a href="{{ route('marketers.list') }}">Manage Marketers</a>
                                    </li>
                                    @endcan
                                </ul>
                            </li>
                            @endcan
                            @endif

                            <li class="divider customDivider">Inventory Management</li>
                            @if((Auth::user()->role) == 'Super Admin')
                            
                            <li class="{{ (request()->is('sectors-list')) || (request()->is('blocks-list')) || (request()->is('projects-list')) ||  (request()->is('plots-list')) ? 'active' : '' }} parent">
                                <a href="#">&nbsp
                                    <i class="mdi mdi-file-plus"></i >
                                    <span> &nbsp&nbsp Inventory Management</span>
                                </a>
                                <ul class="sub-menu">
                                    <li class="{{ (request()->is('projects-list')) ? 'active' : '' }}">
                                        <a href="{{ route('project.list') }}">Manage Projects</a>
                                    </li>
                                    <li class="{{ (request()->is('sectors-list')) ? 'active' : '' }}">
                                        <a href="{{ route('sector.list') }}">Manage Sectors</a>
                                    </li>
                                    <li class="{{ (request()->is('blocks-list')) ? 'active' : '' }}">
                                        <a href="{{ route('block.list') }}">Manage Blcoks</a>
                                    </li>
                                    <li class="{{ (request()->is('plots-list')) ? 'active' : '' }}">
                                        <a href="{{ route('plot.list') }}">Manage Plots</a>
                                    </li>
                                </ul>
                            </li>
                            @else 
                            @can('Inventory Management','Read')
                            
                            <li class="{{ (request()->is('sectors-list')) || (request()->is('blocks-list')) || (request()->is('projects-list')) ||  (request()->is('plots-list')) ? 'active' : '' }} parent">
                                <a href="#">&nbsp
                                    <i class="mdi mdi-file-plus"></i >
                                    <span> &nbsp&nbsp Inventory Management</span>
                                </a>
                                <ul class="sub-menu">
                                    @can('Manage Projects','Read')
                                    <li class="{{ (request()->is('projects-list')) ? 'active' : '' }}">
                                        <a href="{{ route('project.list') }}">Manage Projects</a>
                                    </li>
                                    @endcan
                                    @can('Manage Sectors','Read')
                                    <li class="{{ (request()->is('sectors-list')) ? 'active' : '' }}">
                                        <a href="{{ route('sector.list') }}">Manage Sectors</a>
                                    </li>
                                    @endcan
                                    @can('Manage Blocks','Read')
                                    <li class="{{ (request()->is('blocks-list')) ? 'active' : '' }}">
                                        <a href="{{ route('block.list') }}">Manage Blcoks</a>
                                    </li>
                                    @endcan
                                    @can('Manage Plots','Read')
                                    <li class="{{ (request()->is('plots-list')) ? 'active' : '' }}">
                                        <a href="{{ route('plot.list') }}">Manage Plots</a>
                                    </li>
                                    @endcan
                                </ul>
                            </li>
                            @endcan
                            @endif
                           
                            @if((Auth::user()->role) == 'Super Admin')
                            
                            <li class="{{ (request()->is('booking-list')) ||(request()->is('create-new-booking')) ? 'active' : '' }} parent">
                                <a href="#">&nbsp
                                    <i class="mdi mdi-assignment" style="font-size: 18px;"></i >
                                    <span> &nbsp&nbsp Bookings</span>
                                </a>
                            <ul class="sub-menu">
                                <li class="{{ (request()->is('create-new-booking')) ? 'active' : '' }}">
                                    <a href="{{ route('create.booking') }}">Add New Booking</a>
                                </li>
                                <li class="{{ (request()->is('booking-list')) ? 'active' : '' }}">
                                    <a href="{{ route('booking.list') }}">Manage Bookings</a>
                                </li>
{{--                                <li><a href="{{ route('plans.list') }}">Add Plans</a></li>--}}
                            </ul>
                            </li>
                            @elseif((Auth::user()->role) == 'GM')
                            <li class="{{ (request()->is('booking-list')) ||(request()->is('create-new-booking')) ? 'active' : '' }} parent">
                                <a href="#">&nbsp
                                    <i class="mdi mdi-assignment" style="font-size: 18px;"></i >
                                    <span> &nbsp&nbsp Bookings</span>
                                </a>
                            <ul class="sub-menu">
                                
                                <li class="{{ (request()->is('booking-list')) ? 'active' : '' }}">
                                    <a href="{{ route('booking.list') }}">Manage Bookings</a>
                                </li>
{{--                                <li><a href="{{ route('plans.list') }}">Add Plans</a></li>--}}
                            </ul>
                            </li>
                            @else
                            @can('Bookings','Read')
                            <li class="{{ (request()->is('booking-list')) ||(request()->is('create-new-booking')) ? 'active' : '' }} parent">
                                <a href="#">&nbsp
                                    <i class="mdi mdi-assignment" style="font-size: 18px;"></i >
                                    <span> &nbsp&nbsp Bookings</span>
                                </a>
                            <ul class="sub-menu">
                                @can('Add New Booking','Read')
                                <li class="{{ (request()->is('create-new-booking')) ? 'active' : '' }}">
                                    <a href="{{ route('create.booking') }}">Add New Booking</a>
                                </li>
                                @endcan
                                @can('Manage Booking','Read')
                                <li class="{{ (request()->is('booking-list')) ? 'active' : '' }}">
                                    <a href="{{ route('booking.list') }}">Manage Bookings</a>
                                </li>
                                @endcan
{{--                                <li><a href="{{ route('plans.list') }}">Add Plans</a></li>--}}
                            </ul>
                            </li>
                            @endcan
                            @endif

                            @if((Auth::user()->role) == 'Super Admin')
                            <li class="divider customDivider">Roles and Permissions</li>
                            <li class="{{ (request()->is('users-list')) || (request()->is('create-user')) ? 'active' : '' }} parent">
                                <a href="#">&nbsp
                                    <i class="mdi mdi-assignment" style="font-size: 18px;"></i >
                                    <span> &nbsp&nbsp User Roles & Permissions</span>
                                </a>
                                <ul class="sub-menu">
                                    {{-- <li class="#">
                                        <a href="#">Manage Roles & Permission</a>
                                    </li>
                                    <li class="#">
                                        <a href="#">Assign Roles & Permissions to User</a>
                                    </li> --}}
                                    <li class="{{ (request()->is('users-list')) || (request()->is('create-user')) ? 'active' : '' }}">
                                        <a href="{{ route('users.list') }}">Manage Users</a>
                                    </li>
                                    <li class="{{ (request()->is('assign-project'))  ? 'active' : '' }}">
                                        <a href="{{ route('assign.project') }}">Assign Projects</a>
                                    </li>
                                </ul>
                            </li>
                            @else
                            @can('User Roles & Permission','Read')
                            <li class="divider customDivider">Roles and Permissions</li>
                            <li class="{{ (request()->is('users-list')) || (request()->is('create-user')) ? 'active' : '' }} parent">
                                <a href="#">&nbsp
                                    <i class="mdi mdi-assignment" style="font-size: 18px;"></i >
                                    <span> &nbsp&nbsp User Roles & Permissions</span>
                                </a>
                                <ul class="sub-menu">
                                    {{-- <li class="#">
                                        <a href="#">Manage Roles & Permission</a>
                                    </li>
                                    <li class="#">
                                        <a href="#">Assign Roles & Permissions to User</a>
                                    </li> --}}
                                    @can('Manage Users','Read')                                    
                                    <li class="{{ (request()->is('users-list')) || (request()->is('create-user')) ? 'active' : '' }}">
                                        <a href="{{ route('users.list') }}">Manage Users</a>
                                    </li>
                                    @endcan
                                </ul>
                            </li>
                            @endcan
                            @endif
                           
                           

                            {{-- {{dd(Auth::user()->id)}} --}}
                            @if((Auth::user()->role) == 'Super Admin')
                            <li class="divider customDivider">Master</li>
                            <li class="{{ (request()->is('installments-head-list')) || (request()->is('marla-list')) ? 'active' : '' }} parent">
                                <a href="#">&nbsp
                                    <i class="mdi mdi-refresh-alt"></i >
                                    <span> &nbsp&nbsp Master</span>
                                </a>
                                <ul class="sub-menu">
                                    <li class="{{ (request()->is('marla-list')) ? 'active' : '' }}">
                                        <a href="{{ route('marla.list') }}">Add Plot Marla</a>
                                    </li>
                                    <li class="{{ (request()->is('installments-head-list')) ? 'active' : '' }}">
                                        <a href="{{ route('installmenthead.list') }}">Add Installment Head</a>
                                    </li>
                                </ul>
                            </li> 
                            @else
                            @can('Master','Read')
                            <li class="divider customDivider">Master</li>
                            <li class="{{ (request()->is('installments-head-list')) || (request()->is('marla-list')) ? 'active' : '' }} parent">
                                <a href="#">&nbsp
                                    <i class="mdi mdi-refresh-alt"></i >
                                    <span> &nbsp&nbsp Master</span>
                                </a>
                                <ul class="sub-menu">
                                    @can('Add Plot Marla','Read')
                                    <li class="{{ (request()->is('marla-list')) ? 'active' : '' }}">
                                        <a href="{{ route('marla.list') }}">Add Plot Marla</a>
                                    </li>
                                    @endcan
                                    @can('Add Installment Head','Read')
                                    <li class="{{ (request()->is('installments-head-list')) ? 'active' : '' }}">
                                        <a href="{{ route('installmenthead.list') }}">Add Installment Head</a>
                                    </li>
                                    @endcan
                                </ul>
                            </li> 
                            @endcan
                         @endif             
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
