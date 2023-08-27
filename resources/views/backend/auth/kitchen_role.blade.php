
@extends('backend.layout.master')
@section('main_content')

@if($errors->any())
@foreach($errors->all() as $error)
 <div class="alert alert-danger m-4">
 {{$error}}
 </div>
@endforeach
@endif



</div>

 <!-- table primary start -->
 <div class="col-lg-12 mt-5">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title text-center">User Manage</h4>
            <div class="single-table">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="text-uppercase bg-primary">
                            <tr class="text-white">

                          

                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Assigned Kitchen</th>

                                @if (auth()->user()->role_as === 'superadmin')
                                <th scope="col">Set Kitchen For This User</th>  
                                @endif
                               

                                <th scope="col">Actions</th>

                           
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($user_list as $slider_image)
                              
                            <tr>
                               
                                <td>{{$slider_image->name}}</td>

                                <td>{{$slider_image->email}}</td>

                                @if($slider_image->kitchen !== null)

                                <td>{{$slider_image->kitchen->name}}</td>

                                @else
                                <td>---</td>

                                @endif
                                
                                    @if (auth()->user()->role_as === 'superadmin')
                                    <td>


                                        <form class="d-flex" action="{{route('admin.kitchen.role_change')}}" method="POST" >
                                            @csrf
                                          @method('put')
                                      
                                            <input class="w-50" type="hidden" name="user_id" value="{{$slider_image->id}}">
                                                <select class="form-select" name="role" id="">
                                                    @foreach ($kitchen_list as $item)

                                                    <option value='{{$item->id}}'>{{$item->name}}</option>
                                             
                                                    @endforeach
                                                                                    
                                                </select>
    
                                                <button type="submit" class="btn btn-sm  btn-success mx-2">Set</button>
                                        </form>
    
                                        
                                     </td>

                                    @endif
                           






                                <td class="d-flex justify-content-center align-items-center">
                                    @if (auth()->user()->role_as !== 'creator')
                                    <form class="d-inline " onclick="return confirm('Sure to delete product ?')"  action="{{route('admin.user.delete', $slider_image->id)}}" method="POST">
                                        @csrf
                                        @method('Delete')
                                        <button type="submit" class="btn btn-danger mt-2 btn-sm"><i class="ti-trash"></i></button>
                                        </form>
                                    @endif
                               

                                </td>


                            </tr>

                            @endforeach
                   
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- table primary end -->


@endsection