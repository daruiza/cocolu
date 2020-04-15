@extends('layouts.app')

@section('template')		          	
@endsection

@section('content')
<div class="flex-center position-ref full-height container">    
    <div class="container">
        <div class="row">

        	<div class="col-md-3">
        		<div class="card card-menu-table">
                    <div class="card-header">{{ __('messages.ViewExpense') }}</div>
                    <div class="card-body">
                        <div class="container expense-show">
                            <div class="row">
                            	<div class="col-md-12">
									{{ __('messages.Name') }} <b>{{$expense->name}}</b>
								</div>                             
								<div class="col-md-12">
									{{ __('messages.Description') }} <b>{{$expense->description}}</b>
								</div>                             
								<div class="col-md-12">
									{{ __('messages.Value') }} {{\Auth::user()->store()->currency}} <b>{{number_format($expense->value)}}</b>
								</div>
								<div class="col-md-12">
									{{ __('messages.Clousure') }} <b>{{$expense->clousure()->first()->name}}</b>
								</div>
                                <div class="col-md-12">
                                    <a class="dropdown-item" href="javascript: expense_edit_submit('expense-edit-form')">
                                        <i class="fas fa-cogs"></i>
                                        {{ __('options.edit') }}
                                    </a>
                                    {!! Form::open(array('id'=>'expense-edit-form','route' =>['expense.edit',$expense->id] ,'method' =>'GET', 'onsubmit' =>'return validateForm()')) !!}
                                        {{ Form::hidden('id',$expense->id) }}                            
                                    {!! Form::close() !!}
                                </div>                              							
                            </div>                                                  
                        </div>                  
                    </div>                            
                </div>
    		</div>

    		<div class="col-md-6">
    			<div class="card card-menu-table">
                    <div class="card-header">{{ __('messages.ExpeseDescription') }}</div>
                    <div class="card-body">
                        <div class="container expense-table">
                            <div class="row">                                
								<div class="col-md-12">impacto del gasto</div>
                            </div>                                                  
                        </div>                  
                    </div>                            
                </div>
    		</div>

    		<div class="col-md-3">	        		
                <div class="card card-menu-table">
                    <div class="card-header">{{ __('messages.ProductImages') }}</div>
                    <div class="card-body">
                        <div class="container services-table">
                            <div class="row">                                
								<div class="col-md-12">
									{{ Html::image('users/'.\Auth::user()->id.'/supports/'.$expense->support,'Imagen no disponible',array('id'=>'img_suport_img','style'=>'width: 100%; border:2px solid #ddd;border-radius: 0%;'))}}
								</div>									
                            </div>                                                  
                        </div>                  
                    </div>                            
                </div>	                
        	</div>	

    	</div>
    </div>
</div>
@endsection

@section('script')
	<script type="text/javascript">
		function expense_edit_submit(id){
            if($("#"+id+" input[name=id]").val() !== ""){
                $('#'+id)[0].submit();
                return true;
            }
            alert("{{ __('messages.ExpenseSelectNone') }}");
            return false;           
        }
	</script>
@endsection

@section('style')	
	<link href="{{ asset('css/custom/col_md_custom.css') }}" rel="stylesheet"> 
	<style type="text/css">
		.expense-show{
			text-align: center;
		}
		.expense-show .row > div{
			border-top: 1px solid rgba(0,0,0,.125);
			border-left: 1px solid rgba(0,0,0,.125);
			border-right: 1px solid rgba(0,0,0,.125);
		}
	</style>	
@endsection
