
@section('title', 'Add User | Intrustpit') 
@section("wrapper")          
          <div class="container-xxl flex-grow-1 container-p-y">
            <h5 class="fw-bold mb-4"><span class="text-muted fw-light"><b>Dashboard</b></span> / Add User</h5>
            <div class="row">
              <div class="col-lg-12 mb-12">
                <div class="card">
                  <h5 class="card-header"><b>Add User</b></h5>
                  <form id="formAuthentication" class="mb-3" action="{{route('add_user')}}" method="post">
                    @method('post')
                    @csrf
                    <div class="card-body">
                      <div class="row mb-3">
                        <div class="col-lg-6">
                          <label for="exampleFormControlInput1" class="form-label">Name</label>
                          <input
                            type="text"
                            class="form-control"
                            placeholder="User Name"
                            name="name"
                          />
                          <span class="text-danger">@error('name'){{$message}} @enderror</span>
                        </div>
                        <div class="col-lg-6">
                          <label for="exampleFormControlInput1" class="form-label">Email</label>
                          <input
                            type="Email"
                            class="form-control"
                            placeholder="User Email"
                            name="email"
                          />
                          <span class="text-danger">@error('email'){{$message}} @enderror</span>                           
                        </div>                                                      
                      </div>
                      <div class="row mb-3">
                        <div class="col-lg-6">
                          <label for="exampleFormControlInput1" class="form-label">Password</label>
                          <input
                            type="password"
                            class="form-control"
                            placeholder="Password"
                            name="password"
                          /> 
                            <span class="text-danger">@error('password'){{$message}} @enderror</span>                        
                        </div>
                        <div class="col-lg-6">
                          <label for="exampleFormControlInput1" class="form-label">User Role</label>
                          <select id="defaultSelect" class="form-select">
                            <option>--</option>
                            <option>Admin</option>
                            <option>User</option>
                          </select>                          
                        </div>                                                      
                      </div>
                      <div class="row mb-3">
                        <div class="col-lg-6">
                          <label for="exampleFormControlInput1" class="form-label">Account Status</label>
                          <select id="defaultSelect" class="form-select">
                            <option>--</option>
                            <option>Active</option>
                            <option>Archived</option>
                          </select>                          
                        </div>
                        <div class="col-lg-6">
                          <label for="exampleFormControlInput1" class="form-label">Balance</label>
                          <input
                            type="number"
                            class="form-control"
                            placeholder="$"
                          />                           
                        </div>                                                                                                       
                      </div>                                                                
                      <div class="row mb-3">
                        <div class="col-lg-3">
                          <button class="btn btn-primary">Add User</button>
                        </div>
                      </div>                                            
                    </div>
                  </form>                    
                </div>              
              </div>
            </div>
          </div>
@endsection 