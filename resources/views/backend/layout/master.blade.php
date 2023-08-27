<!Doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Rastaurant Management</title>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="{{asset('assets/images/icon/favicon.ico')}}" rel="stylesheet">
    <link href="{{asset('assets/css/font-awesome.min.css')}}" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('assets/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/metisMenu.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/slicknav.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/default-css.css')}}">
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>





    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />

    <!-- others css -->
    <link rel="stylesheet" href="{{asset('assets/css/typography.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('custom.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    {{-- Custom Js  --}}
   <!-- modernizr css -->
   <script src="{{asset('assets/js/vendor/modernizr-2.8.3.min.js')}}"></script>
 
    <!-- offset area end -->
    <!-- jquery latest version -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{asset('assets/js/print.js')}}"></script>
    
    <!-- bootstrap js -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>


    <!-- JavaScript -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>


            {{-- Sweet Alert  --}}

            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script src="sweetalert2.min.js"></script>
            <link rel="stylesheet" href="sweetalert2.min.css">

     
  </head>

  <body style="background: #F3F8FB;">

    <header>

        <div id="preloader">
            <div class="loader"></div>
        </div>

    </header>


{{--  Side bar   --}}


<div class="page-container">


<div class="sidebar-menu">
<div class="sidebar-header">
    <div class="logo">
        <a href="{{route('admin.index')}}"><img src="{{asset(auth()->user()->image)}}" alt="logo"></a>
    </div>
    <div class="logo text-white" style="font-weight: 600;">
        Name : {{auth()->user()->name}} 
    </div>
    <div class="logo text-white" style="font-weight: bold; font-size: 1rem;">
       Role : <br> {{Illuminate\Support\Str::ucfirst(auth()->user()->role_as)}}   
    </div>

    @isset(auth()->user()->kitchen)
          
    @if(auth()->user()->role_as === 'kitchen')
    <div class="logo text-white" style="font-weight: bold; font-size: 1rem;">
       Working in kitchen : <br> {{Illuminate\Support\Str::ucfirst(auth()->user()->kitchen->name)}}   
    </div>
    @endif
    @endisset

    @isset(auth()->user()->waiter)
          
    @if(auth()->user()->role_as === 'waiter')
    <div class="logo text-white" style="font-weight: bold; font-size: 1rem;">
       Working As : <br> {{Illuminate\Support\Str::ucfirst(auth()->user()->waiter->name)}}   
    </div>
    @endif
    @endisset
</div>


<div class="main-menu">
<div class="menu-inner">
    <nav>
        <ul class="metismenu" id="menu">


{{-- Home --}}
<li>
    <a href="{{route('admin.index')}}" aria-expanded="true"><i class="fas fa-home"></i><span>Home
    </span></a>

</li>


@if(auth()->user()->role_as !== 'kitchen' && auth()->user()->role_as !== 'waiter')



{{-- Collect order --}}
            <li>
                <a href="{{route('admin.order')}}" aria-expanded="true"><i class="fas fa-cart-arrow-down"></i><span>Collect Order
                </span></a>
      
            </li>



{{-- Panding Order --}}
            <li>
                <a href="{{route('admin.order.panding')}}" aria-expanded="true"><i class="far fa-clock"></i><span>Panding Order
                </span></a>
      
            </li>

            {{-- Advance Sales --}}
            <li>
                <a href="{{route('admin.order.advanced')}}" aria-expanded="true"><i class="fas fa-cart-arrow-down"></i><span>Advance Sales
                </span></a>
      
            </li>


            {{-- Waiting Advance Delivery --}}
            <li>
                <a href="{{route('admin.order.ad_panding')}}" aria-expanded="true"><i class="fas fa-hourglass-half"></i><span>Waiting Advance Delivery
                </span></a>
      
            </li>


@endif

            
@if(auth()->user()->role_as !== 'editor' && auth()->user()->role_as !== 'waiter' && auth()->user()->role_as !== 'cashier')
{{-- Kitchen Panel  --}}


<li>
    <a href="javascript:void(0)" aria-expanded="true"><i class="far fa-money-bill-alt"></i><span>Kitchen Panel
        </span></a>
    <ul class="collapse">

        <!-- <li><a href="">Add</a></li>
        <li><a href="">Manage</a></li> -->

     <li>  <a href="{{route('admin.kitchen_items')}}"><i class="fas fa-tag"></i> <span>Order Items To Prepare</span></a></li>


        


    </ul>
</li>

@endif

{{-- Waiter Panel  --}}
@if(auth()->user()->role_as !== 'editor' && auth()->user()->role_as !== 'kitchen' && auth()->user()->role_as !== 'cashier' )


<li>
    <a href="javascript:void(0)" aria-expanded="true"><i class="far fa-money-bill-alt"></i><span>Waiter Panel
        </span></a>
    <ul class="collapse">

        <!-- <li><a href="">Add</a></li>
        <li><a href="">Manage</a></li> -->

     <li>  <a href="{{route('admin.waiter_items')}}"><i class="fas fa-tag"></i> <span>Order Items To Serve</span></a></li>


        


    </ul>
</li>

@endif



            
@if(auth()->user()->role_as !== 'cashier' && auth()->user()->role_as !== 'kitchen' && auth()->user()->role_as !== 'waiter')


{{-- Accounts  --}}


<li>
    <a href="javascript:void(0)" aria-expanded="true"><i class="far fa-money-bill-alt"></i><span>Accounts
        </span></a>
    <ul class="collapse">

        <!-- <li><a href="">Add</a></li>
        <li><a href="">Manage</a></li> -->

     <li>  <a href="{{route('admin.expense')}}"><i class="fas fa-tag"></i> <span>Expenses</span></a></li>
     <li>  <a href="{{route('admin.other_income_save')}}"><i class="fas fa-tag"></i> <span>Other Income</span></a></li>
 	<li>  <a href="{{route('admin.sale_report')}}"><i class="fas fa-tag"></i><span>Today's Sale Report</span></a></li>
 	<li>  <a href="{{route('admin.all.sale_report')}}"><i class="fas fa-tag"></i><span>All Sale Report</span></a></li>

        


    </ul>
</li>





{{-- Purchase Order --}}
<li>
    <a href="{{ route('admin.purchase') }}" aria-expanded="true"><i class="fas fa-shopping-cart"></i><span>Purchase
    </span></a>

</li>



            {{--  Basic Settings   --}}
            <li>
                <a href="javascript:void(0)" aria-expanded="true"><i class="fas fa-bars"></i><span>Report
                    </span></a>
                <ul class="collapse">

               
				 <li>  <a href="{{route('admin.purchase_report')}}"><i class="fas fa-tag"></i><span>Purchase Report</span></a></li>
				 <li>  <a href="{{route('admin.sale_report')}}"><i class="fas fa-tag"></i><span>Today's Sale Report</span></a></li>
                 <li>  <a href="{{route('admin.all.sale_report')}}"><i class="fas fa-tag"></i><span>All Sale Report</span></a></li>
				<li>  <a href="{{route('admin.expense')}}"><i class="fas fa-tag"></i> <span>Expenses Report</span></a></li>
                <li>  <a href="{{route('admin.other_income_save')}}"><i class="fas fa-tag"></i> <span>Other Income Report</span></a></li>

                <li><a href="{{route('admin.order.ad_panding')}}" aria-expanded="true"><i class="fas fa-hourglass-half"></i><span>Waiting Advance Delivery Report
                </span></a></li>



			
					
          

                </ul>
            </li>



  {{--  Basic Settings   --}}
  <li>
    <a href="javascript:void(0)" aria-expanded="true"><i class="fas fa-cogs"></i><span>Other Settings
        </span></a>
    <ul class="collapse">



     <li>  <a href="{{route('admin.supplier')}}"><i class="fas fa-cog"></i><span>Supplier</span></a></li>
     <li>  <a href="{{route('admin.factory')}}"><i class="fas fa-cog"></i><span>Factory</span></a></li>
  
        


    </ul>
</li>







            {{--  Basic Settings   --}}
            <li>
                <a href="javascript:void(0)" aria-expanded="true"><i class="fas fa-cogs"></i><span>Basic Settings
                    </span></a>
                <ul class="collapse">

                    <!-- <li><a href="">Add</a></li>
                    <li><a href="">Manage</a></li> -->

				 <li>  <a href="{{route('admin.category')}}"><i class="fas fa-cog"></i><span>Category</span></a></li>
				 <li>  <a href="{{route('admin.product')}}"><i class="fas fa-cog"></i><span>Product</span></a></li>
				 <li>  <a href="{{route('admin.flavor')}}"><i class="fas fa-cog"></i><span>Flavor</span></a></li>
				 <li>  <a href="{{route('admin.add_ons')}}"><i class="fas fa-cog"></i><span>Add-ons</span></a></li>
				 <li>  <a href="{{route('admin.chocolate_flavor')}}"><i class="fas fa-cog"></i><span>Chocolate Flavor</span></a></li>
				 <li>  <a href="{{route('admin.raw_material')}}"><i class="fas fa-cog"></i><span>Raw Material</span></a></li>
				 <li>  <a href="{{route('admin.counter')}}"><i class="fas fa-cog"></i><span>Counter</span></a></li>
				 <li>  <a href="{{route('admin.fund')}}"><i class="fas fa-cog"></i><span>Fund</span></a></li>
				 <li>  <a href="{{route('admin.expense_type')}}"><i class="fas fa-cog"></i><span>Expenses Type</span></a></li>
				 <li>  <a href="{{route('admin.expense_head')}}"><i class="fas fa-cog"></i><span>Expenses Head</span></a></li>
				 <li>  <a href="{{route('admin.other_income')}}"><i class="fas fa-cog"></i><span>Other Income Head</span></a></li>
				 <li>  <a href="{{route('admin.vat')}}"><i class="fas fa-cog"></i><span>VAT/BIN</span></a></li>
				 <li>  <a href="{{route('admin.product_mat_setting')}}"><i class="fas fa-cog"></i><span>Product Material Settings</span></a></li>
				 <li>  <a href="{{route('admin.add_ons_mat_setting')}}"><i class="fas fa-cog"></i><span>Add-ons Material Settings</span></a></li>
				 <li>  <a href="{{route('admin.kitchen')}}"><i class="fas fa-cog"></i><span>Kitchen</span></a></li>
				 <li>  <a href="{{route('admin.waiter')}}"><i class="fas fa-cog"></i><span>Waiter</span></a></li>
				 <li>  <a href="{{route('admin.table')}}"><i class="fas fa-cog"></i><span>Table No</span></a></li>
				 <li>  <a href="#"><i class="fas fa-cog"></i><span>System Settings</span></a></li>
					
          

                </ul>
            </li>



            
  {{--  Create User  --}}
    @if (Illuminate\Support\Facades\Auth::check() &&
  auth()->user()->role_as === 'superadmin')

  <li>
    <a href="javascript:void(0)" aria-expanded="true"><i class="fas fa-cogs"></i><span>Create User
        </span></a>
    <ul class="collapse">



     <li>  <a href="{{route('admin.account')}}"><i class="fas fa-cog"></i><span>Create User</span></a></li>
     <li>  <a href="{{route('admin.user_list')}}"><i class="fas fa-cog"></i><span>User List</span></a></li>
     <li>  <a href="{{route('admin.kitchen.list')}}"><i class="fas fa-cog"></i><span>Kitchen's User List</span></a></li>
     <li>  <a href="{{route('admin.waiter.list')}}"><i class="fas fa-cog"></i><span>Waiter's List</span></a></li>
  
        


    </ul>
</li>
@endif






@endif



<li>-</li>
<li>-</li>
<li>-</li>
<li>-</li>
<li>-</li>




        </ul>
    </nav>
</div>
</div>
</div>
{{--  End Side menu  --}}

<div class="main">


    
 <!-- header area start -->
 <div class="header-area">
    <div class="row align-items-center">
        <!-- nav and search button -->
        <div class="col-md-4 col-sm-4 clearfix">
            <div class="nav-btn pull-left">
                <span></span>
                <span></span>
                <span></span>

               
               
            </div>





        </div>




        <div class="col-md-4 col-sm-4 clearfix">
     


            <div class="notification-area pull-left" style="margin-top: 11px;">


                <ul class="">
                

                    <li class="">
    
                        <a href="{{route('admin.order.panding')}}" class="text-white d-flex align-items-center pt-0 mt-0">
                            <i class="far fa-clock me-2" style="font-size:19px;"></i> <span style="font-weight: 600;">Panding Order</span> 
                        </a>
    
                    </li>
    
                    <li class="">
    
                        <a href="{{route('admin.order')}}" class="text-white d-flex align-items-center pt-0 mt-0">
                            <i class="fas fa-cart-arrow-down me-2" style="font-size:19px;"></i> <span style="font-weight: 600;">Collect Order</span> 
    
                        </a>
    
                    </li>
    
    
                
    
                </ul>



            </div>


        </div> 


      
           
   
        <div class="col-md-4 col-sm-4 clearfix">

         
        <span class="dropdown">


            <button class="btn p-0 border-0 margin-0 dropdown-toggle pull-right text-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">

                <i class="fas fa-user-cog text-white"></i>
                
            </button>

            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

              <li class="dropdown-item text-center"  style="font-weight: 600; font-size:0.8rem;"><i class="far fa-user me-2"></i> {{Illuminate\Support\Str::ucfirst(auth()->user()->name)}}</li>
              <li class="dropdown-item text-center" style="font-weight: 500;"><i class="fas fa-key me-2"></i> {{Illuminate\Support\Str::ucfirst(auth()->user()->role_as)}}</li>

              <li><a class="dropdown-item" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> Logout</a></li>

            </ul>

            
        </span>
        </div>

        

        

  {{-- <div class="col-md-6 col-sm-4 clearfix">
            <ul class="notification-area pull-right">
                           <a class="dropdown-item py-2 btn-primary " href="{{ route('logout') }}">Logout</a>

            </ul>
  </div> --}}




  




    </div>
</div>
<!-- header area end -->




          <!-- page title area start -->



<nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand ms-3" href="{{ route('admin.index') }}">Home</a>
    <form class="d-flex justify-content-center">

{{-- <li class="nav-item dropdown" style="list-style: none"> --}}
          {{-- <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a> --}}
          {{-- <ul class="dropdown-menu" aria-labelledby="navbarDropdown"> --}}
           {{-- <a class="dropdown-item btn-primary" href="{{ route('logout') }}">Logout</a> --}}
        
          {{-- </ul> --}}
 {{-- </li> --}}



    </form>
  </div>
</nav>






        <!-- page title area end -->

        <div class="main-content-inner mt-4">

            @if (session('message'))
            <div class="alert mt-3 alert-{{session('type')}}">
              {{session('message')}}
            </div>
        @endif

      


            @yield('main_content')
            

        </div>

</div>
{{--  End main content   --}}


    <!-- footer area start-->
    <footer>
        <div class="footer-area pb-4 ">
            <p>© Design & Developed By <a href="https://quicktech-ltd.com">QuickTech IT</a></p>
        </div>
    </footer>
    <!-- footer area end-->


</div> 
{{--  End page container  --}}





    <script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('assets/js/metisMenu.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.slicknav.min.js')}}"></script>

    <!-- start chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!-- start zingchart js -->
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script>
    zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script>
    <!-- all line chart activation -->
    <script src="{{asset('assets/js/line-chart.js')}}"></script>
    <!-- all bar chart activation -->
    <script src="{{asset('assets/js/bar-chart.js')}}"></script>
    <!-- all pie chart -->
    <script src="{{asset('assets/js/pie-chart.js')}}"></script>
    <!-- others plugins -->
    <script src="{{asset('assets/js/plugins.js')}}"></script>
    <script src="{{asset('assets/js/scripts.js')}}"></script>


   <!-- SELECT MULTIPLE  -->

<!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->
<style>
.user-profile .dropdown-menu a{
    padding: 5px;
    
}
.pr{
    position: absolute;
    bottom: 0;
    right:0;
    left:0;
}

.header-area{
    background-color: #3c8dbc;
}
</style>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@yield('before_body')


  </body>
</html>