<div class="container">
	<div class="row">
	    <div class="col-md-12 ml-auto">
			@if ($errors->any())
		    <div class="alert alert-danger alert-dismissible fade show" role="alert">
		    	<p><strong>Error</strong> Please check the following:</p>
		        <ul class="list-unstyled">
		            @foreach ($errors->all() as $error)
		            	<li>{{ $error }}</li>
		            @endforeach
		        </ul>
		        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>  
		    </div>
			@endif        
	    </div>
	</div>
</div>