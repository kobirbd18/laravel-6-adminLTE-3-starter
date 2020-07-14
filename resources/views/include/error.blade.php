@if(count($errors)>0)

<div class="alert alert-warning alert-dismissible" style="padding-bottom: 0px;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fas fa-exclamation-triangle"></i> Error!</h5>
    @foreach($errors->all() as $error)
    <p style="margin-bottom: 5px;">{{$error}}</p>
    @endforeach
</div>

@endif
