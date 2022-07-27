@extends("nav")
@section('title', 'Edit Claim | Intrustpit')
@section("wrapper")
    <div class="container-xxl flex-grow-1 container-p-y">
        <h5 class="fw-bold mb-4"><span class="text-muted fw-light"><b>Dashboard</b></span> / Edit Bill #{{ $claim->id}}
        </h5>
        <div class="row">
            <div class="col-lg-12 mb-12">
                <div class="card">
                    <h5 class="card-header"><b>Edit Bill #{{ $claim->id}}</b></h5>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-lg-4">
                                <form action="{{ action('App\Http\Controllers\claimsController@update', $claim->id) }} "
                                      method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <label for="exampleFormControlInput1" class="form-label">Bill Title</label>
                                    <input
                                            type="text"
                                            name="claim_text"
                                            class="form-control"
                                            placeholder=""
                                            value="Bill Request - {{ $claim->id }}"
                                            readonly
                                    />
                            </div>
                            <div class="col-lg-4">
                                <label for="exampleFormControlInput1" class="form-label">Due Date</label>
                                <input
                                        type="date"
                                        name="expense_date"
                                        value="{{ $claim->expense_date }}"
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
                                        value="{{ $claim->submission_date }}"
                                        placeholder="06/10/2022"
                                        readonly
                                />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <label for="exampleFormControlInput1" class="form-label">Bill Description</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" name="claim_description"
                                          rows="3">{{ $claim->claim_description }}</textarea>
                                <span class="text-danger">@error('claim_description'){{$message}} @enderror</span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-3 mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Category</label>
                                <select id="defaultSelect" class="form-select" name="claim_category">
                                    <option value=""></option>
                                    <option value="Personal" @if ($claim->claim_category == 'Personal') selected @endif>
                                        Personal
                                    </option>
                                    <option value="Foods" @if ($claim->claim_category == 'Foods') selected @endif>
                                        Foods
                                    </option>
                                    <option value="Online Purchases"
                                            @if ($claim->claim_category == 'Online Purchases') selected @endif>Online
                                        Purchases
                                    </option>
                                    <option value="Gift Card"
                                            @if ($claim->claim_category == 'Gift Card') selected @endif>Gift Card
                                    </option>
                                    <option value="Other" @if ($claim->claim_category == 'Other') selected @endif>
                                        Other
                                    </option>
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
                                        value="{{ $claim->claim_amount }}"
                                />
                                <span class="text-danger">@error('claim_amount'){{$message}} @enderror</span>
                            </div>
                            <div class="col-lg-3">
                                <label for="exampleFormControlInput1" class="form-label">Bill Attachment</label>
                                <input class="form-control" name="claim_bill_attachment" type="file"
                                       id="formFileMultiple" value="{{ $claim->claim_bill_attachment }}">
                                <a href="{{ url('img/'.$claim->claim_bill_attachment) }}" target="_blank">{{ $claim->claim_bill_attachment }}</a>
                                <span class="text-danger">@error('claim_bill_attachment'){{$message}} @enderror</span>
                            </div>

                            <div class="col-lg-3">
                                <label for="exampleFormControlInput1" class="form-label">Payment Method</label>
                                <select id="defaultSelect" class="form-select" name="payment_method">
                                    <option value=""></option>
                                    <option value="Cash" @if ($claim->payment_method == 'Cash') selected @endif>Cash
                                    </option>
                                    <option value="Credit / Debit Card"
                                            @if ($claim->payment_method == 'Credit / Debit Card') selected @endif>Credit
                                        / Debit Card
                                    </option>
                                    <option value="Online" @if ($claim->payment_method == 'Online') selected @endif >
                                        Online
                                    </option>
                                </select>
                                <span class="text-danger">@error('payment_method'){{$message}} @enderror</span>
                            </div>
                            <div class="col-lg-12">
                                <label for="exampleFormControlInput1" class="form-label">Bill Status</label>
                                <select id="defaultSelect" class="form-select" name="claim_status">
                                    <option value=""></option>
                                    <option value="Approved" @if ($claim->claim_status == 'Approved') selected @endif>
                                        Approved
                                    </option>
                                    <option value="Processed" @if ($claim->claim_status == 'Processed') selected @endif>
                                        Processed
                                    </option>
                                    <option value="Pending" @if ($claim->claim_status == 'Pending') selected @endif>
                                        Pending
                                    </option>
                                    <option value="Refused" @if ($claim->claim_status == 'Refused') selected @endif>
                                        Refused
                                    </option>
                                </select>
                                <span class="text-danger">@error('claim_status'){{$message}} @enderror</span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <button class="btn btn-primary">Update</button>
                                <a href="{{ url('/claims') }}" class="btn btn-danger">Discard</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection                 