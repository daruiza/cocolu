<div id="modal-alert" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
    	<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title" id="myModalLabel">{{ __('messages.Alert') }}</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body"> 
        		<div class="container">        			
        			<div class="row">
        				<div class="col-md-12 content-text">
        					
        				</div>        				
        			</div>
        		</div>
    		</div>
    		<div class="modal-footer">        		
        		<button type="button" class="btn btn-primary" data-dismiss="modal">{{ __('options.Accept') }}</button>
      		</div>
		</div>
    </div>
</div>

<div id="modal-confirm" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
    	<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title" id="myModalLabel">{{ __('messages.ModalConfirm') }}</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body"> 
        		<div class="container">        			
        			<div class="row">
        				<div class="col-md-12 content-text">
        					
        				</div>        				
        			</div>
        		</div>
    		</div>
    		<div class="modal-footer">
        		<button type="submit" class="btn btn-default submit" form="" >
        			{{ __('messages.Yes') }}
        		</button>
        		<button type="button" class="btn btn-primary" data-dismiss="modal">
        			{{ __('messages.Not') }}
        		</button>
      		</div>
		</div>
    </div>
</div>