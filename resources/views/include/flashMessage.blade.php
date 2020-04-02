@if(Session::has('success'))

<div class="alert alert-success alert-dismissible" style="padding-bottom: 0px;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fas fa-check"></i> Success!</h5>
    <p>{{session('success')}}</p>
</div>

@endif

@if(Session::has('error'))

<div class="alert alert-warning alert-dismissible" style="padding-bottom: 0px;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fas fa-exclamation-triangle"></i> Error!</h5>
    <p>{{session('error')}}</p>
</div>

@endif

@if(Session::has('warning'))

<div class="alert alert-warning alert-dismissible" style="padding-bottom: 0px;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fas fa-exclamation-triangle"></i> Error!</h5>
    <p>{{session('warning')}}</p>
</div>

@endif

@if(Session::has('forceLogoutError'))

<div class="alert alert-warning alert-dismissible" style="padding-bottom: 0px;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fas fa-exclamation-triangle"></i> Error!</h5>
    <p>{{session('forceLogoutError')}}</p>
</div>

@endif
