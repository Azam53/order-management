@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row">
        
    @extends('layouts.sidenav')
     <div class="col-lg-12" style="padding-left:70px;">
          <h1>Add Product</h1>

	@if(Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
        @php
        Session::forget('success');
        @endphp
    </div>
    @endif

         {!! Form::open(array('route' => 'product.store', 'class' => 'form', 'action' => 'post')) !!}

		{{ csrf_field() }}
		<div class="form-group">
			<label>Name:</label>
                 {!! Form::text('p_name', null, array('required', 'class'=>'form-control', 'placeholder'=>'product-name')) !!}
			@if ($errors->has('title'))
                <span class="text-danger">{{ $errors->first('<title></title>') }}</span>
            @endif
		</div>

		<div class="form-group">
			<label>Type:</label>
             {!! Form::text('type', null, array('class'=>'form-control','required' ,'placeholder'=>'product-type')) !!}
			@if ($errors->has('body'))
                <span class="text-danger">{{ $errors->first('body') }}</span>
            @endif
		</div>

               <div class="form-group">
			<label>Price:</label>
             {!! Form::text('price', null, array('class'=>'form-control','required' ,'placeholder'=>'product-price')) !!}
			@if ($errors->has('body'))
                <span class="text-danger">{{ $errors->first('body') }}</span>
            @endif
		</div>

                <div class="form-group">
			<label>Description:</label>
             {!! Form::textarea('description', null, array('class'=>'form-control','required' ,'placeholder'=>'product-description')) !!}
			@if ($errors->has('body'))
                <span class="text-danger">{{ $errors->first('body') }}</span>
            @endif
		</div>

		

		<div class="form-group">
                      {!! Form::submit('Add', array('class'=>'btn btn-success btn-submit')) !!}
			
		</div>
       {!! Form::close() !!}
     
     </div>
  </div>
</div>
@endsection

