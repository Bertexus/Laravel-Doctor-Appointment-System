@extends('admin.layouts.master')

@section('content')

<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-edit bg-blue"></i>
                        <div class="d-inline">
                            <h5>Doctors</h5>
                            <span>lorem ipsum dolor sit amet, consectetur adipisicing elit</span>
                        </div>
                    </div>
                </div>
        <div class="col-lg-4">
            <nav class="breadcrumb-container" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="../index.html"><i class="ik ik-home"></i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="#">Doctor</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-10">

        @if(Session::has('message'))
            <div class="alert alert-success">
                {{Session::get('message')}}
            </div>
        @endif

        <div class="card">
            <div class="card-header"><h3>Add doctor</h3></div>
            <div class="card-body">
                <form class="forms-sample" method="POST" action="{{ route('doctor.store') }}" enctype="multipart/form-data"> 
                @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputName1">Full name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="exampleInputName1" placeholder="Name" name="name" 
                                value = "{{old('name')}}">
                                
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail3">Email address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="exampleInputEmail3" placeholder="Email"
                                value="{{old('email')}}">
                            
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail3">Password</label>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="" placeholder="doctor password">
                            
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleSelectGender">Gender</label>
                                <select name="gender" class="form-control @error('gender') is-invalid @enderror" id="exampleSelectGender">
                                    <option value="">Please select gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>

                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputPassword4">Education</label>
                                <input type="text" class="form-control @error('education') is-invalid @enderror" id="exampleInputPassword4" name="education"
                                 placeholder="doctor highest degree" value="{{old('education')}}">
                                
                                @error('education')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputPassword4">Address</label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror" id="exampleInputPassword4" name="address"
                                 placeholder="doctor address" value="{{old('address')}}">
                            </div>

                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Specialist</label>
                                <select name="department" class="form-control @error('department') is-invalid @enderror" id="exampleSelectDepartment">
                                    @foreach(App\Models\Department::all() as $d)
                                        <option value="{{ $d->department }}">{{ $d->department }}</option>
                                    @endforeach
                                </select>

                                @error('department')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Phone number</label>
                                <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{old('phone_number')}}">

                                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label>Image</label>
                            
                            <div class="col-md-6">
                                <input type="file" name="image" class="form-control file-upload-info @error('image') is-invalid @enderror"
                                 placeholder="Upload Image">
                                <span class="input-group-append">

                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <button class="file-upload-browse btn btn-primary" type="button">Browse photo</button>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label>Role</label>
                                <select name="role_id" class="form-control @error('role') is-invalid @enderror">
                                    <option value="">select role</option>
                                    @foreach (App\Models\Role::where('name','!=','patient')->get() as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select> 

                                @error('role_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleTextarea1">About</label>
                        <textarea class="form-control" id="exampleTextarea1" rows="4"name="description" value="{{old('description')}}"></textarea>
                        
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>



{{-- <div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <i class="ik ik-command bg-blue"></i>
                <div class="d-inline">
                    <h5>Doctors</h5>
                    <span>add doctor</span>
                </div>
            </div>
        </div>
    <div class="col-lg-4">
        <nav class="breadcrumb-container" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="../index.html"><i class="ik ik-home"></i></a>
                </li>
                <li class="breadcrumb-item"><a href="#">Doctor</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create</li>
            </ol>
        </nav>
    </div>
    </div>
</div>

<div class="row justify-content-center">
	<div class="col-lg-10">
        @if(Session::has('message'))
            <div class="alert bg-success alert-success text-white" role="alert">
                {{Session::get('message')}}
            </div>
        @endif
       
	<div class="card">
	<div class="card-header"><h3>Add doctor</h3></div>
	<div class="card-body">
		<form class="forms-sample" action="{{route('doctor.store')}}" method="post" enctype="multipart/form-data" >@csrf
			<div class="row">
				<div class="col-lg-6">
					<label for="">Full name</label>
					<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="doctor name" value="                   {{old('name')}}">
                    @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
				</div>
				<div class="col-lg-6">
					<label for="">Email</label>
					<input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="email"value="                   {{old('email')}}">
                     @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
				</div>
			</div>

			<div class="row">
				<div class="col-lg-6">
					<label for="">Password</label>
					<input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="doctor password">
                     @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
				</div>
				<div class="col-lg-6">
					<label for="">Gender</label>
					<select class="form-control @error('gender') is-invalid @enderror" name="gender">
                        <option value="">select</option>
						<option value="male">Male</option>
						<option value="female">Female</option>
					</select>
                     @error('gender')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
				</div>
			</div>

				<div class="row">
					<div class="col-lg-6">
						<label for="">Education</label>
						<input type="text" name="education" class="form-control @error('education') is-invalid @enderror" placeholder="doctor highest degree" value="                   {{old('education')}}">
                         @error('education')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
					<div class="col-lg-6">
						<label for="">Address</label>
						<input type="text" name="address" class="form-control @error('address') is-invalid @enderror" placeholder="doctor address"  value="{{old('address')}}">
                         @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
			</div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Specialist</label>
                        <select name="department" class="form-control">
                            <option value="">Please select</option>

                            @foreach(App\Department::all() as $d)
                                <option value="{{$d->department}}">{{$d->department}}</option>
                            @endforeach
                        </select>


                         @error('department')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Phone number</label>
                        <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror"value="                   {{old('phone_number')}}">
                                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        
                    </div>
                </div>

            </div>
            <div class="row">
            	<div class="col-md-6">
                        <div class="form-group">
                    <label>Image</label>
                        <input type="file" class="form-control file-upload-info @error('image') is-invalid @enderror"  placeholder="Upload Image" name="image">
                        <span class="input-group-append">
                       
                        </span>
                         @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>
                </div>
                    <div class="col-md-6">
                        <label>Role</label>
                        <select name="role_id" class="form-control @error('role_id') is-invalid @enderror">
                            <option value="">Please select role</option>
                            @foreach(App\Role::where('name','!=','patient')->get() as $role)
                                <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                            
                        </select>
                         @error('role_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>
                </div>
                
            
            
           
            <div class="form-group">
                <label for="exampleTextarea1">About</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="exampleTextarea1" rows="4" name="description">
                {{old('description')}}

                </textarea>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div>
              <button type="submit" class="btn btn-primary mr-2">Submit</button>
            <button class="btn btn-light">Cancel</button>


				</form>
			</div>
		</div>
	</div>
</div> --}}


@endsection