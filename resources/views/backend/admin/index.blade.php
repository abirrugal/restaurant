@extends('backend.layout.master')

@section('main_content')
   

{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
<style>
  .title_font {
  font-size: 16px;
 
}



.category_title {
    padding-top: 13px;
    padding-bottom: 1px;
    font-size: 22px;
    color: #0f1111!important;
    font-weight: 700;
    font-family: "Amazon Ember", Arial, sans-serif;
    text-transform: capitalize;
}
</style>

<div class="row justify-content-center ">
  {{-- <div class="category_title  mb-2 ms-3 ">Order Information
  </div> --}}
  
  <div class="border-btm mb-2"></div>



{{-- Product Information --}}

  <div class="category_title  mb-2 ms-3 ">Order Information
  </div>
  {{-- <div class="border-btm mb-2"></div> --}}
  <hr>

<div class="col-xl-3 col-sm-6 col-12 my-3">
  <div class="card py-2 shadow">
      <div class="card-body">
          <div class="d-flex justify-content-between px-md-1">
              <div class="align-self-center">
                  <i class="far fa-comment-alt text-warning fa-3x"></i>
              </div>
              <div class="text-end">                  
                  <p class="mb-1 title_font">Panding Order</p>


                  <a  href="{{route('admin.order.panding')}}" style="text-decoration: none;"> <h4 class="text-dark">{{$panding_order}}</h4></a>

                  {{-- <h6>$total_products</h6> --}}
              </div>
          </div>
      </div>
  </div>
</div>

<div class="col-xl-3 col-sm-6 col-12 my-3">
  <div class="card py-2 shadow">
      <div class="card-body">
          <div class="d-flex justify-content-between ">
              <div class="align-self-center">
                  <i class="far fa-comment-alt text-warning fa-3x"></i>
              </div>
              <div class="text-end">                  
                  <p class="mb-1 title_font">Advanced Panding</p>


                  <a  href="{{route('admin.order.ad_panding')}}" style="text-decoration: none;"> <h4 class="text-dark">{{$panding_advanced}}</h4></a>

                  {{-- <h6>$total_products</h6> --}}
              </div>
          </div>
      </div>
  </div>
</div>

<div class="col-xl-3 col-sm-6 col-12 my-3">
  <div class="card py-2 shadow">
      <div class="card-body">
          <div class="d-flex justify-content-between px-md-1">
              <div class="align-self-center">
                  <i class="far fa-comment-alt text-warning fa-3x"></i>
              </div>
              <div class="text-end">                  
                  <p class="mb-1 title_font">Total Sale(Today)</p>


                  <a  href="{{route('admin.sale_report')}}" style="text-decoration: none;"> <h4 class="text-dark">{{$total_sale}}</h4></a>

                  {{-- <h6>$total_products</h6> --}}
              </div>
          </div>
      </div>
  </div>
</div>
<div class="col-xl-3 col-sm-6 col-12 my-3">
  <div class="card py-2 shadow">
      <div class="card-body">
          <div class="d-flex justify-content-between px-md-1">
              <div class="align-self-center">
                  <i class="far fa-comment-alt text-warning fa-3x"></i>
              </div>
              <div class="text-end">                  
                  <p class="mb-1 title_font">Total Product</p>


                  <a  href="{{route('admin.product')}}" style="text-decoration: none;"> <h4 class="text-dark">{{$total_product}}</h4></a>

                  {{-- <h6>$total_products</h6> --}}
              </div>
          </div>
      </div>
  </div>
</div>




{{-- Sale Information --}}



<div class="category_title  mb-2 ms-3 ">Sale Information
</div>
{{-- <div class="border-btm mb-2"></div> --}}
<hr>





<div class="col-xl-3 col-sm-6 col-12 my-3">
<div class="card py-2 shadow">
    <div class="card-body">
        <div class="d-flex justify-content-between px-md-1">
            <div class="align-self-center">
                <i class="far fa-comment-alt text-warning fa-3x"></i>
            </div>
            <div class="text-end">                  
                <p class="mb-1 title_font">Total Sale</p>


                <a  href="{{route('admin.all.sale_report')}}" style="text-decoration: none;"> <h4 class="text-dark">{{$all_sale}}</h4></a>

                {{-- <h6>$total_products</h6> --}}
            </div>
        </div>
    </div>
</div>
</div>

<div class="col-xl-3 col-sm-6 col-12 my-3">
  <div class="card py-2 shadow">
      <div class="card-body">
          <div class="d-flex justify-content-between px-md-1">
              <div class="align-self-center">
                  <i class="far fa-comment-alt text-warning fa-3x"></i>
              </div>
              <div class="text-end">                  
                  <p class="mb-1 title_font">Today's Sale</p>
  
  
                  <a  href="{{route('admin.sale_report')}}" style="text-decoration: none;"> <h4 class="text-dark">{{$total_sale}}</h4></a>
  
                  {{-- <h6>$total_products</h6> --}}
              </div>
          </div>
      </div>
  </div>
  </div>

<div class="col-xl-3 col-sm-6 col-12 my-3">
  <div class="card py-2 shadow">
      <div class="card-body">
          <div class="d-flex justify-content-between px-md-1">
              <div class="align-self-center">
                  <i class="far fa-comment-alt text-warning fa-3x"></i>
              </div>
              <div class="text-end">                  
                  <p class="mb-1 title_font">Monthly Sale</p>
  
  
                  <a  href="{{route('admin.sale_report')}}" style="text-decoration: none;"> <h4 class="text-dark">{{$monthly_sale}}</h4></a>
  
                  {{-- <h6>$total_products</h6> --}}
              </div>
          </div>
      </div>
  </div>
  </div>




{{-- User Information --}}


<div class="category_title  mb-2 ms-3 ">User Information
</div>
{{-- <div class="border-btm mb-2"></div> --}}
<hr>



<div class="col-xl-4 col-sm-6 col-12 my-3">
  <div class="card py-2 shadow">
      <div class="card-body">
          <div class="d-flex justify-content-between px-md-1">
              <div class="align-self-center">
                  <i class="far fa-comment-alt text-warning fa-3x"></i>
              </div>
              <div class="text-end">                  
                  <p class="mb-1 title_font">Super Admin</p>


                  <h4 class="text-dark">{{$superadmin}}</h4>

                  {{-- <h6>$total_products</h6> --}}
              </div>
          </div>
      </div>
  </div>
</div>

<div class="col-xl-4 col-sm-6 col-12 my-3">
  <div class="card py-2 shadow">
      <div class="card-body">
          <div class="d-flex justify-content-between px-md-1">
              <div class="align-self-center">
                  <i class="far fa-comment-alt text-warning fa-3x"></i>
              </div>
              <div class="text-end">                  
                  <p class="mb-1 title_font">Admin</p>


                  <h4 class="text-dark">{{$admin}}</h4>

                  {{-- <h6>$total_products</h6> --}}
              </div>
          </div>
      </div>
  </div>
</div>

<div class="col-xl-4 col-sm-6 col-12 my-3">
  <div class="card py-2 shadow">
      <div class="card-body">
          <div class="d-flex justify-content-between px-md-1">
              <div class="align-self-center">
                  <i class="far fa-comment-alt text-warning fa-3x"></i>
              </div>
              <div class="text-end">                  
                  <p class="mb-1 title_font">Editor</p>


                  <h4 class="text-dark">{{$editor}}</h4>

                  {{-- <h6>$total_products</h6> --}}
              </div>
          </div>
      </div>
  </div>
</div>

<div class="col-xl-4 col-sm-6 col-12 my-3">
  <div class="card py-2 shadow">
      <div class="card-body">
          <div class="d-flex justify-content-between px-md-1">
              <div class="align-self-center">
                  <i class="far fa-comment-alt text-warning fa-3x"></i>
              </div>
              <div class="text-end">                  
                  <p class="mb-1 title_font">Kitchen</p>


                  <h4 class="text-dark">{{$kitchen}}</h4>

                  {{-- <h6>$total_products</h6> --}}
              </div>
          </div>
      </div>
  </div>
</div>

<div class="col-xl-4 col-sm-6 col-12 my-3">
  <div class="card py-2 shadow">
      <div class="card-body">
          <div class="d-flex justify-content-between px-md-1">
              <div class="align-self-center">
                  <i class="far fa-comment-alt text-warning fa-3x"></i>
              </div>
              <div class="text-end">                  
                  <p class="mb-1 title_font">Waiter</p>


                  <h4 class="text-dark">{{$waiter}}</h4>

                  {{-- <h6>$total_products</h6> --}}
              </div>
          </div>
      </div>
  </div>
</div>





</div>

@endsection
