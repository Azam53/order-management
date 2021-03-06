
@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row">
        
   @extends('layouts.sidenav')  
     <div class="col-lg-12" style="padding-left:90px;">
          <h1>Dashboard</h1>
	   
	@if(Session::has('success'))
	    <div class="alert alert-success">
		{{ Session::get('success') }}
		@php
		Session::forget('success');
		@endphp
	    </div>
	    @endif
           

	
     </div>
     <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Add New Order</div>
                <div class="panel-body">
                    {!! Form::open(array('route' => 'order.store', 'class' => 'form', 'action' => 'post')) !!}

		{{ csrf_field() }}
		<div class="form-group">
			<label>User:</label>
                 {!! Form::select('user_id', $users, null, ['class' => 'form-control']) !!}
			@if ($errors->has('title'))
                <span class="text-danger">{{ $errors->first('<title></title>') }}</span>
            @endif
		</div>

		<div class="form-group">
			<strong>Product:</strong>
             {!! Form::select('product_id', $products, null, ['class' => 'form-control']) !!}
			@if ($errors->has('body'))
                <span class="text-danger">{{ $errors->first('body') }}</span>
            @endif
		</div>

		<div class="form-group">
			<label>Quantity:</label>
			<br/>
			{!! Form::text('quantity', null, array('required', 'class'=>'form-control', 'placeholder'=>'quantity')) !!}
			@if ($errors->has('tags'))
                <span class="text-danger">{{ $errors->first('tags') }}</span>
            @endif
		</div>		

		<div class="form-group">
                      {!! Form::submit('Add', array('class'=>'btn btn-success btn-submit')) !!}
			
		</div>
       {!! Form::close() !!}
                </div>
            </div>
         <!-- Search Bar starts -->
             <div class="panel panel-default">
                <div class="panel-heading">Search</div>

                <div class="panel-body">
               {!! Form::open(array('route' => 'search', 'class' => 'form-inline', 'method' => 'GET')) !!}
                 <div class="form-group">
               {!! Form::select('duration', ['all' => 'All time', 'last_day' => 'Last 7 day', 'today' => 'Today'], array( 'class'=>'form-control')) !!}
                 </div>
                 <div class="form-group">
               {!! Form::text('search_term', null, array('class'=>'form-control', 'placeholder'=>'Search')) !!}
                 </div>
               <div class="form-group">
               {!! Form::submit('Search', array('class'=>'btn btn-success btn-submit')) !!}
			
		</div>
                    {!! Form::close() !!}
                </div>
            </div>
         <!-- Search Bar ends -->
         <!-- Order List starts -->
            <div class="panel panel-default">
                
                <div class="panel-body">
                   
                            <table class="table">
			    <thead>
			      <tr>
				<th>User</th>
				<th>Product</th>
				<th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Date</th>
                                <th>Action</th>
                                       
			      </tr>
			    </thead>
			    <tbody>
                   
                      @foreach($orders as $order)
			      <tr>
				<td>{{ $order->name }}</td>
				<td>{{ $order->p_name }}</td>
				<td>{{ $order->price }} Euro</td>
                                <td>{{ $order->quantity }}</td>
                                <td>{{ $order->total_amount }} Euro</td>
                                <td>{{ date('Y-M-d h:i A',strtotime($order->created_at)) }}</td>
                                <td><span class="pull-left">
                                    {{ Form::open(['method' => 'GET','route' => ['order.edit', $order->id]]) }}
                                    {{ Form::submit('Edit', ['class' => 'btn btn-info','title' => 'edit']) }}
                                    {{ Form::close() }}
                                    </span>
                                    <span class="pull-right">
                                    {{ Form::open(['method' => 'DELETE', 'route' => ['order.destroy', $order->id]]) }}
                                    {{ Form::submit('Delete', ['class' => 'btn btn-danger','title' => 'delete']) }}
                                    {{ Form::close() }}
                                    <span>
                                </td>
			      </tr>
	             @endforeach		      
			    </tbody>
			  </table>
                </div>
            </div>
                            {{ $orders->links() }}
         <!-- Order List ends -->
        </div>
          
  </div>
</div>
@endsection


