@extends("nav")
@section('title', 'Add Balance | Intrustpit') 
@section("wrapper")
<style type="text/css">
#hidden_div {
    display: none;
} 
#hidden_div2 {
    display: none;
} 
</style>          
          <div class="container-xxl flex-grow-1 container-p-y">
            <h5 class="fw-bold mb-4"><span class="text-muted fw-light"><b>Dashboard</b></span> / Add Balance: {{$user['name']}}</h5>
            <div class="row">
              <div class="col-lg-12 mb-12">
                <div class="card">
                  <h5 class="card-header"><b>Add Balance: {{$user['name']}}</b></h5>
                  <form id="formAuthentication" class="mb-3" action="{{route('add_user_balance', $user['id'] )}}" method="get">
                    @method('post')                     
                    @csrf
                    <div class="card-body">
                    @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        {{Session::get('success')}}
                       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>                    
                    @endif
                    @if(Session::has('fail'))
                    <div class="alert alert-fail alert-dismissible" role="alert">
                        {{Session::get('fail')}}
                       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>                    
                    @endif                       
                      <div class="row mb-3">
                      <div class="row mb-3">
                        <div class="col-lg-6 mb-3">
                          <label for="exampleFormControlInput1" class="form-label">Amount</label>
                          <input
                            type="number"
                            class="form-control"
                            placeholder="$"
                            name="balance"
                          />                           
                        </div>
                        <div class="col-lg-6">
                          <label for="exampleFormControlInput1" class="form-label">Payment Type</label>
                          <select class="form-control form-select" onchange="showDiv2('hidden_div', this)">
                            <option>--Select payment type</option>
                            <option value="ACH">ACH</option>
                            <option value="Cheque Payment">Cheque Payment</option>
                          </select>                         
                        </div>
                          <div class="col-lg-6">
                            <label for="exampleFormControlInput1" class="form-label">Date of Transaction</label>
                            <input
                              type="date"
                              class="form-control"
                              placeholder="Date of Transaction"
                              name="date_of_trans"
                            /> 
                          </div>
                          <div class="col-lg-6" id="hidden_div">
                            <label for="exampleFormControlInput1" class="form-label">Transaction No.#</label>
                            <input
                              type="text"
                              class="form-control mb-3"
                              placeholder="Transaction No."
                              name="trans_no"
                            /> 
                          </div> 
                          <div class="col-lg-6" id="hidden_div2">
                            <label for="exampleFormControlInput1" class="form-label">Cheque No.#</label>
                            <input
                              type="text"
                              class="form-control mb-3"
                              placeholder="Cheque No."
                              name="trans_no"
                            /> 
                          </div>                                                                                                                         
                      </div>
                        <div class="row">
                         
                        </div>                                                                                       
                      <div class="row mb-3">
                        <div class="col-lg-3">
                          <button class="btn btn-primary">Add Balance</button>
                        </div>
                      </div>                                            
                    </div>
                  </form>                    
                </div>              
              </div>
            </div>
          </div>
<script type="text/javascript">
function showDiv2(divId, element)
{
    document.getElementById("hidden_div").style.display = element.value == 'ACH' ? 'block' : 'none';
    document.getElementById("hidden_div2").style.display = element.value == 'Cheque Payment' ? 'block' : 'none';
}
</script>          
@endsection 