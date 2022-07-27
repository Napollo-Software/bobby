@extends("nav")
@section('title', 'Add Claim | Intrustpit')
@section("wrapper")
    <?php
    use App\Models\User;
    $role = User::where('id', '=', Session::get('loginId'))->value('role');
    ?>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h5 class="fw-bold mb-4"><span class="text-muted fw-light"><b>Dashboard</b></span> / Add Bill</h5>
        <div class="row">
            <div class="col-lg-12 mb-12">
                <div class="card">
                    <h5 class="card-header"><b>Add Bill</b></h5>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-lg-4">
                                <form action="{{ action('App\Http\Controllers\claimsController@store') }} "
                                      method="post" enctype="multipart/form-data">
                                    @csrf
                                    <label for="exampleFormControlInput1" class="form-label">Bill Title</label>
                                    <input
                                            type="text"
                                            name="claim_text"
                                            class="form-control"
                                            placeholder="Bill Request - 765"
                                            value="Bill Request - <?php echo uniqid();?>"
                                            readonly
                                    />
                            </div>
                            <div class="col-lg-4">
                                <label for="exampleFormControlInput1" class="form-label">Due Date</label>
                                <input
                                        type="date"
                                        name="expense_date"
                                        class="form-control"
                                />
                                <span class="text-danger">@error('expense_date'){{$message}} @enderror</span>
                            </div>
                            <div class="col-lg-4">
                                <label for="exampleFormControlInput1" class="form-label">Submission Date</label>
                                <input
                                        type="text"
                                        name="submission_date"
                                        class="form-control"
                                        value="<?php echo date('d-m-Y'); ?>"
                                        placeholder="06/10/2022"
                                        readonly
                                />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <label for="exampleFormControlInput1" class="form-label">Bill Description</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" name="claim_description"
                                          rows="3"></textarea>
                                <span class="text-danger">@error('claim_description'){{$message}} @enderror</span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-3 mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Category</label>
                                <select id="defaultSelect" class="form-select" name="claim_category">
                                    <option>Personal</option>
                                    <option>Foods</option>
                                    <option>Online Purchases</option>
                                    <option>Gift Card</option>
                                    <option>Other</option>
                                </select>
                                <span class="text-danger">@error('claim_category'){{$message}} @enderror</span>
                            </div>
                            <div class="col-lg-3">
                                <label for="exampleFormControlInput1" class="form-label">Bill Amount</label>
                                <input
                                        type="number"
                                        name="claim_amount"
                                        class="form-control"
                                        placeholder="$"
                                />
                                <span class="text-danger">@error('claim_amount'){{$message}} @enderror</span>
                            </div>
                            <div class="col-lg-3">
                                <label for="exampleFormControlInput1" class="form-label">Bill Attachment</label>
                                <input class="form-control" name="claim_bill_attachment" type="file"
                                       id="formFileMultiple">
                                <span class="text-danger">@error('claim_bill_attachment'){{$message}} @enderror</span>
                            </div>
                            <div class="col-lg-3">
                                <label for="exampleFormControlInput1" class="form-label">Payment Method</label>
                                <select id="defaultSelect" class="form-select" name="payment_method">
                                    <option>Cash</option>
                                    <option>Credit / Debit Card</option>
                                    <option>Online</option>
                                </select>
                                <span class="text-danger">@error('payment_method'){{$message}} @enderror</span>
                            </div>
                            @if ($role == 'Admin')
                                <div class="col-lg-6">
                                    <label for="exampleFormControlInput1" class="form-label">Bill Status</label>
                                    <select id="defaultSelect" class="form-select" name="claim_status">
                                        <option>Approved</option>
                                        <option>Processed</option>
                                        <option>Pending</option>
                                        <option>Refused</option>
                                    </select>
                                    <span class="text-danger">@error('claim_status'){{$message}} @enderror</span>
                                </div>
                                <div class="col-lg-6">
                                    <label for="exampleFormControlInput1" class="form-label">Customer</label>
                                    <select id="defaultSelect" class="form-select" name="claim_user">
                                        <option>Select User</option>
                                        @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">@error('claim_status'){{$message}} @enderror</span>
                                </div>                                
                            @endif
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <button class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection                 