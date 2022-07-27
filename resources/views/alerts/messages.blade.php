@if(session('Claim_success_messgae'))
<div class="alert alert-success alert-dismissible" role="alert">
    {{ session('Claim_success_messgae') }}
   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if(session('Claim_updated_success_messgae'))
<div class="alert alert-success alert-dismissible" role="alert">
    {{ session('Claim_updated_success_messgae') }}
   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if(session('Claim_deleted_success_messgae'))
<div class="alert alert-success alert-dismissible" role="alert">
    {{ session('Claim_deleted_success_messgae') }}
   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif