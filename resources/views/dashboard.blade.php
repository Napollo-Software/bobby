@extends("nav")
@section('title', 'Dashboard | Intrustpit') 
@section("wrapper")
<?php 
use App\Models\User;

$role = User::where('id', '=', Session::get('loginId'))->value('role');
$current_user_name = User::where('id', '=', Session::get('loginId'))->value('name');
$current_user_balance = User::where('id', '=', Session::get('loginId'))->value('user_balance');

?>        @if ($role == 'Admin') 
          <div class="container-xxl flex-grow-1 container-p-y">
            <h5 class="fw-bold mb-4"><span class="text-muted fw-light"><b>Dashboard</b></span></h5>
            <div class="row">
              <div class="col-lg-2 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img
                                src=<?= url('assets/img/icons/unicons/balance.png')?>
                                alt="chart success"
                                class="rounded"
                              />
                            </div>
                            <div class="dropdown">
                              <button
                                class="btn p-0"
                                type="button"
                                id="cardOpt3"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                <a class="dropdown-item" href="{{ url('/all_users') }}">View details</a>
                              </div>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Available Balance</span>
                        <h3 class="card-title mb-2">${{ $user_balance }}</h3>
                        <small class="fw-semibold">Users </small><span class="badge bg-label-success me-1">{{ $total_users }}</span>
                    </div>
                </div>                
              </div>
              <div class="col-lg-2 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img
                                src= <?= url('assets/img/icons/unicons/paid.png')?> 
                                alt="chart success"
                                class="rounded"
                              />
                            </div>
                            <div class="dropdown">
                              <button
                                class="btn p-0"
                                type="button"
                                id="cardOpt3"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                <a class="dropdown-item" href="{{ url('/claims/?search=processed') }}">View details</a>
                              </div>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Received Bills</span>
                        <h3 class="card-title mb-2">${{ $sum_processed_amount }}</h3>
                        <small class="fw-semibold">Bills </small><span class="badge bg-label-primary me-1">{{ $sum_processed }}</span>
                    </div>
                </div>                
              </div>
              <div class="col-lg-2 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img
                                src= <?= url('assets/img/icons/unicons/pending.png')?> 
                                alt="chart success"
                                class="rounded"
                              />
                            </div>
                            <div class="dropdown">
                              <button
                                class="btn p-0"
                                type="button"
                                id="cardOpt3"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                <a class="dropdown-item" href="{{ url('/claims/?search=pending') }}">View details</a>
                              </div>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Pending Review</span>
                        <h3 class="card-title mb-2">${{ $sum_pending_amount }}</h3>
                        <small class="fw-semibold">Bills </small><span class="badge bg-label-info me-1">{{ $sum_pending }}</span>
                    </div>
                </div>                
              </div>
              <div class="col-lg-2 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img
                                src= <?= url('assets/img/icons/unicons/approved.png')?>
                                alt="chart success"
                                class="rounded"
                              />
                            </div>
                            <div class="dropdown">
                              <button
                                class="btn p-0"
                                type="button"
                                id="cardOpt3"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                <a class="dropdown-item" href="{{ url('/claims/?search=approved') }}">View details</a>
                              </div>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Approved / Paid</span>
                        <h3 class="card-title mb-2">${{ $sum_approved_amount }}</h3>
                        <small class="fw-semibold">Bills </small><span class="badge bg-label-success me-1">{{ $sum_approved }}</span>
                    </div>
                </div>                
              </div>
              <div class="col-lg-2 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img
                                src=<?= url('assets/img/icons/unicons/refused.png')?>
                                alt="chart success"
                                class="rounded"
                              />
                            </div>
                            <div class="dropdown">
                              <button
                                class="btn p-0"
                                type="button"
                                id="cardOpt3"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                <a class="dropdown-item" href="{{ url('/claims/?search=refused') }}">View details</a>
                              </div>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Denied Bills</span>
                        <h3 class="card-title mb-2">${{ $sum_refused_amount }}</h3>
                        <small class="fw-semibold">Bills </small><span class="badge bg-label-danger me-1">{{ $sum_refused }}</span>
                    </div>
                </div>                
              </div>                                                                                    
              <div class="col-lg-2 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img
                                src=<?= url('assets/img/icons/unicons/transaction.png')?>
                                alt="chart success"
                                class="rounded"
                              />
                            </div>
                            <div class="dropdown">
                              <button
                                class="btn p-0"
                                type="button"
                                id="cardOpt3"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                <a class="dropdown-item" href="{{ url('/claims') }}">View details</a>
                              </div>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Total Bills</span>
                        <h3 class="card-title mb-2">${{ $sum_claims_amount }}</h3>
                        <small class="fw-semibold">Bills </small><span class="badge bg-label-success me-1">{{ $sum_claims }}</span>
                    </div>
                </div>                
              </div>    
            </div>
            <div class="row">
              <div class="col-lg-12 mb-12">
                <div class="card">
                  <h5 class="card-header"><b>Latest Bills</b></h5>
                  <div class="card-body">
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
                                  <a class="dropdown-item" href="claims/{{ $claim['id'] }}/edit"
                                    ><i class="bx bx-edit-alt me-1"></i> Edit</a
                                  >
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
          @endif
          @if ($role == 'User') 
          <div class="container-xxl flex-grow-1 container-p-y">
            <h5 class="fw-bold mb-4"><span class="text-muted fw-light"><b>Dashboard</b></span></h5>
            <div class="row">
              <div class="col-lg-2 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img
                                src=<?= url('assets/img/icons/unicons/balance.png')?>
                                alt="chart success"
                                class="rounded"
                              />
                            </div>
                            <div class="dropdown">
                              <button
                                class="btn p-0"
                                type="button"
                                id="cardOpt3"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                <a class="dropdown-item" href="#">View details</a>
                              </div>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Available Balance</span>
                        <h3 class="card-title mb-2">${{ $current_user_balance }}</h3>
                        <small class="fw-semibold">Balance </small><span class="badge bg-label-success me-1">{{ $current_user_balance }}</span>
                    </div>
                </div>                
              </div>
              <div class="col-lg-2 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img
                                src=<?= url('assets/img/icons/unicons/paid.png')?>
                                alt="chart success"
                                class="rounded"
                              />
                            </div>
                            <div class="dropdown">
                              <button
                                class="btn p-0"
                                type="button"
                                id="cardOpt3"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                <a class="dropdown-item" href="{{ url('/claims/?search=processed') }}">View details</a>
                              </div>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Received Bills</span>
                        <h3 class="card-title mb-2">${{ $sum_processed_amount }}</h3>
                        <small class="fw-semibold">Bills </small><span class="badge bg-label-primary me-1">{{ $sum_processed }}</span>
                    </div>
                </div>                
              </div>
              <div class="col-lg-2 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img
                                src=<?= url('assets/img/icons/unicons/pending.png')?>
                                alt="chart success"
                                class="rounded"
                              />
                            </div>
                            <div class="dropdown">
                              <button
                                class="btn p-0"
                                type="button"
                                id="cardOpt3"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                <a class="dropdown-item" href="{{ url('/claims/?search=pending') }}">View details</a>
                              </div>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Pending Review</span>
                        <h3 class="card-title mb-2">${{ $sum_pending_amount }}</h3>
                        <small class="fw-semibold">Bills </small><span class="badge bg-label-info me-1">{{ $sum_pending }}</span>
                    </div>
                </div>                
              </div>
              <div class="col-lg-2 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img
                                src=<?= url('assets/img/icons/unicons/approved.png')?>
                                alt="chart success"
                                class="rounded"
                              />
                            </div>
                            <div class="dropdown">
                              <button
                                class="btn p-0"
                                type="button"
                                id="cardOpt3"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                <a class="dropdown-item" href="{{ url('/claims/?search=approved') }}">View details</a>
                              </div>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Approved / Paid </span>
                        <h3 class="card-title mb-2">${{ $sum_approved_amount }}</h3>
                        <small class="fw-semibold">Bills </small><span class="badge bg-label-success me-1">{{ $sum_approved }}</span>
                    </div>
                </div>                
              </div>
              <div class="col-lg-2 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img
                                src=<?= url('assets/img/icons/unicons/refused.png')?>
                                alt="chart success"
                                class="rounded"
                              />
                            </div>
                            <div class="dropdown">
                              <button
                                class="btn p-0"
                                type="button"
                                id="cardOpt3"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                <a class="dropdown-item" href="{{ url('/claims/?search=refused') }}">View details</a>
                              </div>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Denied Bills</span>
                        <h3 class="card-title mb-2">${{ $sum_refused_amount }}</h3>
                        <small class="fw-semibold">Bills </small><span class="badge bg-label-danger me-1">{{ $sum_refused }}</span>
                    </div>
                </div>                
              </div>                                                                                    
              <div class="col-lg-2 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img
                                src=<?= url('assets/img/icons/unicons/transaction.png')?>
                                alt="chart success"
                                class="rounded"
                              />
                            </div>
                            <div class="dropdown">
                              <button
                                class="btn p-0"
                                type="button"
                                id="cardOpt3"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                <a class="dropdown-item" href="{{ url('/claims') }}">View details</a>
                              </div>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Total Bills</span>
                        <h3 class="card-title mb-2">${{ $sum_claims_amount }}</h3>
                        <small class="fw-semibold">Bills </small><span class="badge bg-label-success me-1">{{ $sum_claims }}</span>
                    </div>
                </div>                
              </div>    
            </div>
            <div class="row">
              <div class="col-lg-12 mb-12">
                <div class="card">
                  <h5 class="card-header"><b>Latest Bills</b></h5>
                  <div class="card-body">
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
                              {{ $claim->user_details->name }}                            
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
          @endif          
@endsection          