@extends('layouts.app')

@section('template')		          	
@endsection

@section('content')
	<div class="flex-center position-ref full-height container">    
    <div class="container">
        <div class="row">
        	
        	<div class="col-md-3 col-lateral-table">
                <div class="col-md-12">
                <div class="card card-menu-table">
                    <div class="card-header">{{ __('form.WaiterIndex') }}</div>
                    <div class="card-body">
                        <div class="container services-table">
                            <div class="row">                                
								<div class="col-md-12 table"></div>
								<div class="col-md-12 bartender"></div>
								<div class="col-md-12 orders"></div>
								<div class="col-md-12 new-orders"></div>
                            </div>                                                  
                        </div>                  
                    </div>                            
                </div>
                </div>
                <div class="col-md-12">
                <div class="card card-menu-table">
                    <div class="card-header">{{ __('form.WaiterOptions') }}</div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    @include('layouts.options_page',['model'=>'Waiters'])						
                                </div>
                            </div>                                                  
                        </div>                  
                    </div>                            
                </div>
                </div>
            </div>   

        	<div class="col-md-9">            		
        		@include('layouts.alert')
        		<div class="card">
                    <div class="card-header">{{ __('form.indexWaiter') }}</div>
                    <div class="card-body">
                    	<div class="container">
	                    	<div class="row">

                                <div class="col-md-12">
                                <div class="page-header">

                                    {!! Form::model($waiter,['enctype' => 'multipart/form-data','id'=>'form-waiter','route'=>['waiter.index'],'method'=>'GET']) !!}
                                        <div class="form-group form-search">                              
                                            {{Form::text('name',null,['class'=>'form-control','placeholder'=>__('messages.Name')])}}
                                        </div>
                                        <div class="form-group form-search">                              
                                            {{Form::text('surname',null,['class'=>'form-control','placeholder'=>__('messages.Surname')])}}
                                        </div>
                                        <div class="form-group form-search">                              
                                            {{Form::text('email',null,['class'=>'form-control','placeholder'=>__('messages.E-Mail Address')])}}
                                        </div>
                                        <div class="form-group form-search">                              
                                            {{Form::text('phone',null,['class'=>'form-control','placeholder'=>__('messages.Phone')])}}
                                        </div>

                                        <div class="form-group form-search">                              
                                            {!! Form::select('active',[__('form.Inactive'),__('form.Active')],null,['class'=>'form-control','placeholder'=>__('form.Status')]) !!}
                                        </div>
                                        
                                        <div class="form-group form-search">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    {{Form::close()}}
                                    
                                </div>                                
                                </div>
                                
		                    	<div class="col-md-12 m-b-md table-container">
		                    		<div class="row table-header">
                                        <div class="col-md-3">{{ __('messages.Name') }}</div>
                                        <div class="col-md-3">{{ __('messages.Surname') }}</div>
                                        <div class="col-md-4">{{ __('messages.E-Mail Address') }}</div>
                                        <div class="col-md-2">{{ __('messages.Phone') }}</div>
                                    </div>   
			                    	@foreach($waiters as $key => $value)                                        
			                    		<div class="row object-waiter
                                         @if($key%2) @else row-impar @endif
                                         @if($value->active)  @else row-no-active @endif" >
                                            {{ Form::hidden('waiter-id', $value->id) }}
											<div class="col-md-3">{{$value->user()->get()->first()->name}}</div>
											<div class="col-md-3">{{$value->user()->get()->first()->surname}}</div>
											<div class="col-md-4">{{$value->user()->get()->first()->email}}</div>
											<div class="col-md-2">{{$value->user()->get()->first()->phone}}</div>
										</div>										
			                    	@endforeach

		                    	</div>

                                {{ $waiters->appends([
                                    'name'=>$waiter->name,
                                    'surname'=>$waiter->surname,
                                    'email'=>$waiter->email,
                                    'phone'=>$waiter->phone,
                                    'active'=>$waiter->active
                                ])
                                ->links() }}
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
    <script type="text/javascript" src="{{ asset('js/entity/waiter.js') }}"></script>
    <script type="text/javascript">
        waiter.selectObject('object-waiter','selected-object');
        function waiter_show_submit(id){
            if($("#"+id+" input[name=id]").val() !== ""){
                $('#'+id)[0].submit();
                return true;
            }
            alert("{{ __('messages.TableSelectNone') }}");
            return false;           
        }

        function waiter_edit_submit(id){
            if($("#"+id+" input[name=id]").val() !== ""){
                $('#'+id)[0].submit();
                return true;
            }
            alert("{{ __('messages.TableSelectNone') }}");
            return false;           
        }

        function waiter_destroy_submit(id){          
            if(confirm("{{ __('messages.TableConfirmDestroy') }}")){
                if($("#"+id+" input[name=id]").val() !== ""){
                $('#'+id)[0].submit();
                    return true;
                }
                alert("{{ __('messages.TableSelectNone') }}");
                return false;
            }
            return false;
        }

        function waiter_changepassword_submit(id){
            $('#'+id)[0].submit();
        }
    </script>   
@endsection

@section('style')	
	<link href="{{ asset('css/custom/col_md_custom.css') }}" rel="stylesheet"> 
	<style type="text/css">
		.row-impar{
		    background-color: {{ json_decode(Auth::user()->store()->label,true)['table']['colorRow'] }};
		}
        .object-waiter{
            border: 1px solid {{ json_decode(Auth::user()->store()->label,true)['table']['colorRow'] }};
            padding-top: 2px;
            padding-bottom: 2px;
            margin-top: 2px;
            margin-bottom: 2px;
        }
        .object-waiter:hover{
            cursor:pointer;
        }
        .selected-object{
            background-color: {{ json_decode(Auth::user()->store()->label,true)['table']['selectTable'] }} !important;
        }
        form#form-waiter{
            display: flex;            
            align-items: center;
            justify-content: center;
        }

        .form-search{
            margin: 4px;
        }

        .page-header{
            margin: 10px;   
        }

        .table-header{
            border: 1px solid gainsboro;
            padding-top: 2px;
            padding-bottom: 2px;
            margin-top: 2px;
            margin-bottom: 2px;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        .row-no-active{
            background: {{ json_decode(Auth::user()->store()->label,true)['table']['colorInactive'] }};
            color: {{ json_decode(Auth::user()->store()->label,true)['table']['colorRow'] }};
        }
        .selected-object{
            color: #212529
        }
	</style>	
@endsection
