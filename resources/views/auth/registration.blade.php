<!DOCTYPE html>
<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Registration | Intrustpit</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ url('/assets/img/favicon/favicon.png') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ url('/assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ url('/assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ url('/assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ url('/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ url('/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ url('/assets/vendor/css/pages/page-auth.css') }}" />
    <!-- Helpers -->
    <script src="{{ url('/assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ url('/assets/js/config.js') }}"></script>
  </head>

  <style type="text/css">
.authentication-wrapper.authentication-basic .authentication-inner {
    max-width: 60% !important;
    position: relative;
}    
  </style>

  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register Card -->
          <div class="card">
            <div class="card-body-auth">
              <!-- Logo -->
              <div class="app-brand justify-content-center mb-3">
                  <img src="{{ url('/assets/img/intrustpit-Logo.png') }}">
              </div>
              <!-- /Logo -->

              <form id="formAuthentication" class="mb-3" action="{{route('register-user')}}" method="post">
      				@if(Session::has('success'))
      				<div class="alert alert-success">{{Session::get('success')}}</div>
      				@endif
      				@if(Session::has('fail'))
      				<div class="alert alert-danger">{{Session::get('fail')}}</div>
      				@endif				
      				@csrf 
              <div class="row">
                <div class="col-sm-4 mb-3">
                  <label for="username" class="form-label">First Name</label>
                  <input type="text" class="form-control" id="username" name="name" placeholder="Your first name" autofocus value="{{old('name')}}" />
                  <span class="text-danger">@error('name'){{$message}} @enderror</span>
                </div>
                <div class="col-sm-4 mb-3">
                  <label for="last_name" class="form-label">Last Name</label>
                  <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Your lastname" autofocus value="{{old('last_name')}}" />
                  <span class="text-danger">@error('last_name'){{$message}} @enderror</span>
                </div> 
                <div class="col-sm-4 mb-3">
                  <label for="full_ssn" class="form-label">Full SSN</label>
                  <input type="text" class="form-control" id="full_ssn" name="full_ssn" placeholder="Your SSN" autofocus value="{{old('full_ssn')}}" />
                  <span class="text-danger">@error('full_ssn'){{$message}} @enderror</span>
                </div>                                               
              </div>
              <div class="row">
                <div class="col-sm-6 mb-3">
                  <label for="dob" class="form-label">DOB</label>
                  <input type="date" class="form-control" id="dob" name="dob" placeholder="Date of Birth" autofocus value="{{old('dob')}}" />
                  <span class="text-danger">@error('dob'){{$message}} @enderror</span>
                </div> 
                <div class="col-sm-6 mb-3">
                  <label for="address" class="form-label">Address</label>
                  <input type="text" class="form-control" id="address" name="address" placeholder="Street # 131" autofocus value="{{old('address')}}" />
                  <span class="text-danger">@error('address'){{$message}} @enderror</span>
                </div>                                
              </div>
              <div class="row">
                <div class="col-sm-4 mb-3">
                  <label for="username" class="form-label">State</label>
                        <select class="form-control form-select mb-3" id="state" name="state">
                          <option selected="selected" disabled="">-- Select a state</option>
                          @foreach(App\Models\City::select('state')->distinct()->get() as $state)
                          <option value="{{$state->state}}">{{$state->state}}</option>
                          @endforeach
                        </select>
                </div>
                <div class="col-sm-4 mb-3">
                  <label for="lastname" class="form-label">City</label>
                        <select class="form-control form-select" id="city" name="city">
                          
                        </select> 
                </div> 
                <div class="col-sm-4 mb-3">
                  <label for="zipcode" class="form-label">Zipcode</label>
                  <input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="Your zipcode" autofocus value="{{old('zipcode')}}" />
                  <span class="text-danger">@error('zipcode'){{$message}} @enderror</span>
                </div>                                               
              </div>                            
              <div class="row">
                <div class="col-sm-4 mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" value="{{old('email')}}"/>
                  <span class="text-danger">@error('email'){{$message}} @enderror</span>
                </div>
                <div class="col-sm-4 mb-3">
                  <label for="marital_status" class="form-label">Marital Status</label>
                  <input type="text" class="form-control" id="marital_status" name="marital_status" placeholder="Enter your Marital Status" value="{{old('marital_status')}}"/>
                  <span class="text-danger">@error('marital_status'){{$message}} @enderror</span>
                </div> 
                <div class="col-sm-4 mb-3">
                  <label for="gender" class="form-label">Gender</label><br>
                  <select class="form-control form-select" id="gender" name="gender"> 
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                  </select>                  
                </div>                                                
              </div>
              <div class="row">
                <div class="col-sm-6 mb-3">
                  <label for="date_of_withdrawal" class="form-label">Date of Withdrawal</label>
                  <input type="date" class="form-control" id="date_of_withdrawal" name="date_of_withdrawal" placeholder="Enter your email" value="{{old('date_of_withdrawal')}}"/>
                  <span class="text-danger">@error('date_of_withdrawal'){{$message}} @enderror</span>
                </div>
                <div class="col-sm-6 mb-3">
                  <label for="docs" class="form-label">Documents</label>
                  <input type="file" class="form-control" id="docs" name="docs" placeholder="Enter your Marital Status" value="{{old('docs')}}"/>
                  <span class="text-danger">@error('docs'){{$message}} @enderror</span>
                </div>                                                 
              </div>              
              <div class="row">
                <div class="mb-3 form-password-toggle">
                  <label class="form-label" for="password">Password</label>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      placeholder="Password"
                      aria-describedby="password"
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                  <span class="text-danger">@error('password'){{$message}} @enderror</span>
                </div>
                <div class="mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" />
                    <label class="form-check-label" for="terms-conditions">
                      I agree to privacy policy & terms
                    </label>
                  </div>
                </div>
                <button class="btn btn-primary d-grid w-100" type="submit">Sign up</button>                  
              </div>             	
              </form>

              <p class="text-center">
                <span>Already have an account?</span>
                <a href="{{ url('/') }}">
                  <span>Sign in instead</span>
                </a>
              </p>
            </div>
          </div>
          <!-- Register Card -->
        </div>
      </div>
    </div>

    <!-- / Content -->


    <!-- Core JS -->
          <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function(){
    
    $(document).on('change','#state',function(){

      var state=$(this).val();
       
           $.ajax({
            type: "GET",
            url:'{{url('state-fetch-city')}}/'+state,
          
            dataType: 'JSON',
            success: function (data) {
                $('#city').empty();
                $(data).each(function(i,v){
                  $('#city').append('<option value="'+v['id']+'">'+v['city_name']+'</option>');
                });
            },
             
        });
    });
});
</script>    
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ url('/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ url('/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ url('/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ url('/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ url('/assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="{{ url('/assets/js/main.js') }}"></script>
    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
