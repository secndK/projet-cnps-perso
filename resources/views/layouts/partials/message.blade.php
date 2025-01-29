

<!--@if ($message = Session::get('success'))-->
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <b>{{ $message }}</b>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<!--@elseif ($message = Session::get('errors'))-->
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <b>{{ $message }}</b>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<!--@endif-->