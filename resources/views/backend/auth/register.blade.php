@extends('backend.layout.master')

@section('main_content')
    

@if($errors->any())
@foreach($errors->all() as $error)
 <div class="alert alert-danger m-4">
 {{$error}}
 </div>
@endforeach
@endif

     <!-- login area start -->
 <div class="login-area">
    <div class="container">
        <div class="login-box ptb--100">


            <form action="{{route('admin.account')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="login-form-head">
                    <h4>Create User</h4>
                    
                </div>
                <div class="login-form-body">
                    <div class="form-gp">
                        <label for="exampleInputName1">Full Name</label>
                        <input type="text"  name="name" value="{{old('name')}}" id="exampleInputName1">
                        <i class="ti-user"></i>
                        <div class="text-danger"></div>
                    </div>
                    <div class="form-gp">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" name="email" value="{{old('email')}}" id="exampleInputEmail1">
                        <i class="ti-email"></i>
                        <div class="text-danger"></div>
                    </div>

                    <div class="mb-3">
                        <label for="slider_image" class="form-label text-black h6">Profile Image</label>
                        <input type="file" name="image" class="form-control" id="slider_image" aria-describedby="PriceHelp">
                        
                      </div>

                    <div class="form-gp">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name="password" id="exampleInputPassword1">
                        <i class="ti-lock"></i>
                        <div class="text-danger"></div>
                    </div>
                    <div class="form-gp">
                        <label for="exampleInputPassword2">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="exampleInputPassword2">
                        <i class="ti-lock"></i>
                        <div class="text-danger"></div>
                    </div>
                    <div class="submit-btn-area">
                        <button id="form_submit" type="submit">Submit <i class="ti-arrow-right"></i></button>
                    
                        </div>
                    </div>
                  
                </div>
            </form>


        </div>
    </div>
</div>
<!-- login area end -->


@endsection


