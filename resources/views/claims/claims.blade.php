@extends("nav")
@section('title', 'All Claims | Intrustpit')
@section("wrapper")
<?php 
use App\Models\User;
$role = User::where('id', '=', Session::get('loginId'))->value('role');
?>
          <div class="container-xxl flex-grow-1 container-p-y">
            <h5 class="fw-bold mb-4"><span class="text-muted fw-light"><b>Dashboard</b></span> / Bills</h5>
            <div class="row">
              <div class="col-lg-12 mb-12">
                <div class="card">
                  <h5 class="card-header"><b>@if ($role == 'Admin') All @endif @if ($role == 'User') My @endif Bills</b></h5>
                 <!-- <form action="" method="get">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="filter">
                        <label>Search:</label>
                          <input type="search" name="search" class="input-control" placeholder="Search your claims here" value="{{ $search }}">                        
                      </div>                      
                    </div>
                    <div class="col-lg-1">
                      <div class="filter pull-left">
                        <button class="btn btn-primary">Search</button>                       
                      </div>
                      </form>                      
                    </div>
                    <div class="col-lg-5">
                      <form action="{{ action('App\Http\Controllers\claimsController@create') }}">
                        <button class="btn btn-primary btn-ctrl">Add Claim</button>
                      </form>                  
                    </div>                                                            
                  </div>
                -->
                  <div class="row">
                    <div class="col-lg-12">
                      <form action="{{ action('App\Http\Controllers\claimsController@create') }}">
                        <button class="btn btn-primary btn-ctrl">Add Bill</button>
                      </form>                  
                    </div>                                                            
                  </div>                
                  <div class="card-body">
                  @if(Session::has('success'))
                  <div class="alert alert-success">{{Session::get('success')}}</div>
                  @endif
                  @if(Session::has('fail'))
                  <div class="alert alert-danger">{{Session::get('fail')}}</div>
                  @endif                    
                    @include('alerts.messages')
                    <div class="table-responsive text-nowrap">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>CID#</th>
                            <th>Bill tittle</th>
                            <th>Submission Date</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Amount</th>
                            <th>User</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($claims as $claim)
                          <tr>
                            <td>{{ $claim['id'] }}</td>
                            <td><a href="claims/{{ $claim['id'] }}">Bill Request - {{ $claim['id'] }}</a></td>
                            <td>{{ $claim['submission_date'] }}</td>
                            <td>{{ $claim['claim_category'] }}</td>
                            <td>
                              <span class="badge 
                              @if ($claim->claim_status == 'Approved') bg-label-success @endif 
                              @if ($claim->claim_status == 'Processed') bg-label-primary @endif 
                              @if ($claim->claim_status == 'Pending') bg-label-info @endif 
                              @if ($claim->claim_status == 'Refused') bg-label-danger @endif
                              me-1">
                              @if ($claim->claim_status == 'Approved') {{ $claim['claim_status'] }} @endif
                              @if ($claim->claim_status == 'Processed') {{ $claim['claim_status'] }} @endif
                               @if ($claim->claim_status == 'Pending') {{ $claim['claim_status'] }} @endif
                               @if ($claim->claim_status == 'Refused') {{ $claim['claim_status'] }} @endif
                               </span>
                            </td>
                            <td>${{ $claim['claim_amount'] }}</td>
                            <td>
                              @foreach($all_users as $user)
                              @if($claim->claim_user==$user->id)
                              {{$user->name }}              
                              @endif
                              @endforeach         
                            </td>
                            <td>
                              <div class="dropdown">
                                <button
                                  type="button"
                                  class="btn p-0 dropdown-toggle hide-arrow"
                                  data-bs-toggle="dropdown"
                                >
                                  <i class="bx bx-dots-vertical-rounded"></i>
                                </button>

                                <div class="dropdown-menu"> 
                                @if ($role == 'Admin')                              
                                  <a class="dropdown-item" href="claims/{{ $claim['id'] }}/edit"
                                    ><i class="bx bx-edit-alt me-1"></i> Edit</a
                                  >
                                @endif 
                                  <form action="{{ action('App\Http\Controllers\claimsController@destroy', $claim['id']) }} " method="post">  
                                  @csrf
                                  @method('delete')                                  
                                  <button class="dropdown-item">
                                    <i class="bx bx-trash me-1"></i> Delete
                                  </button>
                                  </form>  

                                </div>
                              </div>
                            </td>
                          </tr>
                          @endforeach                                             
                        </tbody>
                      </table>

                        {{ $claims->links() }}                     
                    </div>
                  </div>
                </div>              
              </div>
            </div>
          </div>
        </div>

@endsection 
