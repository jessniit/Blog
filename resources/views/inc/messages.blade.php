@if (count($errors)>0)
@foreach ($errors->all() as $item)
<div class="alert alert-danger">
    {{$item}}
</div>
    
@endforeach    
@endif

@if (session('success'))

<div class="alert alert-danger">

   {!!session('success')!!}
    
</div>
@endif

@if (session('error'))
<div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
    {{session('error')}}
</div>
</div> 
@endif
