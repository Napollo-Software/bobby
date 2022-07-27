@extends("nav")
@section('title', 'Manage Categories | Intrustpit') 
@section("wrapper")          
          <div class="container-xxl flex-grow-1 container-p-y">
            <h5 class="fw-bold mb-4"><span class="text-muted fw-light"><b>Dashboard</b></span> / Manage Categories</h5>
            <div class="row">
              <div class="col-lg-12 mb-12">
                <div class="card">
                  <h5 class="card-header"><b>Manage Categories</b></h5>
                  <div class="row">
                    <div class="col-lg-3">
                      <div class="filter">
                      <form action="{{ action('App\Http\Controllers\categoryController@create') }}">
                        <button class="btn btn-primary">Add Category</button>
                      </form>                      
                      </div>                      
                    </div>                                        
                  </div>
                  <div class="card-body">
                    <div class="table-responsive text-nowrap">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>CID#</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($category as $c)
                          <tr>
                            <td>{{ $c['id'] }}</td>
                            <td>
                                <form action="{{ action('App\Http\Controllers\categoryController@show', $c->id) }} " method="get">  
                                @csrf                                                                
                                  <button class="btn-btn-custom"> 
                                     {{ $c['category_name'] }}
                                  </button>
                                </form>                              
                            </td>
                            <td>
                              <span class="badge 
                              @if ($c['category_staus']  == 'Published') bg-label-success @endif 
                              @if ($c['category_staus']  == 'Archived') bg-label-danger @endif 
                              me-1">
                              @if ($c['category_staus']  == 'Published') {{ $c['category_staus'] }} @endif
                              @if ($c['category_staus']  == 'Archived') {{ $c['category_staus'] }} @endif
                               </span>                              
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
                                <form action="{{ action('App\Http\Controllers\categoryController@edit', $c->id) }} " method="get">  
                                @csrf                                                                
                                  <button class="dropdown-item"> 
                                    <i class='bx bxs-show'></i> View
                                  </button>
                                </form>                                    
                                <form action="{{ action('App\Http\Controllers\categoryController@edit', $c->id) }} " method="get">  
                                @csrf                                                                
                                  <button class="dropdown-item"> 
                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                  </button>
                                </form>
                                </div>
                              </div>
                            </td>
                          </tr> 
                          @endforeach                                                                                                      
                        </tbody>
                      </table>
                      {{ $category->links() }} 
                    </div>
                  </div>
                </div>              
              </div>
            </div>
          </div>
@endsection 