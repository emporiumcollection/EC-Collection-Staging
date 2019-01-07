@extends('users_admin.metronic.layouts.app')

@section('page_name')
    
@stop

@section('breadcrumb')
    <li class="m-nav__separator"> - </li>
    <li class="m-nav__item"> 
        <a href="{{ URL::to('dashboard')}}" class="m-nav__link"> 
            <span class="m-nav__link-text"> Dashboard </span> 
        </a> 
    </li>
    <li class="m-nav__separator"> - </li>
    <li class="m-nav__item"> 
        <a href="{{URL::to('hotelinvoices')}}" class="m-nav__link"> 
            <span class="m-nav__link-text"> Billings &amp; Contracts </span> 
        </a> 
    </li>
    <li class="m-nav__separator"> - </li>
    <li class="m-nav__item"> 
        <a href="{{URL::to('hotelinvoices')}}" class="m-nav__link"> 
            <span class="m-nav__link-text"> Invoices </span> 
        </a> 
    </li>
    <li class="m-nav__separator"> - </li>
    <li class="m-nav__item"> 
        <a href="" class="m-nav__link"> 
            <span class="m-nav__link-text breadcrumb-end"> View </span> 
        </a> 
    </li>
@stop

@section('content')

<div class="row">
    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
        <h2>Invoice View</h2>
    </div> 
    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ornare diam at convallis lacinia. Duis a sapien et erat finibus molestie eu id nisi. Integer nibh elit, blandit ac volutpat eget, tempus eget enim. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas mollis dictum risus. Vivamus aliquam at elit non dictum. Integer nisi ante, interdum at purus vitae, rhoncus bibendum dui. Praesent pharetra augue at ultrices facilisis. Vestibulum erat urna, iaculis et purus in, fermentum varius nibh.
    </div>
    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
        <hr />
    </div>
    
    <div class="col-sm-12 col-md-12 col-xl-12">    
    
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <i class="fa fa-celander"></i>
                </div>
                <div class="m-portlet__head-tools"><a href="{{ URL::to('hotelinvoices') }}" class="btn btn-primary btn-md" title="{{ Lang::get('core.btn_back') }}"><i class="fa fa-arrow-circle-left"></i>&nbsp;Back</a> </div>
            </div>
            
            <div class="m-portlet__body">
                
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" style="width: 99%;" >
            			<tbody>            		
        					<tr>
        						<td width='80%' class='label-view text-right'>Order Id</td>
        						<td># {{ $row->id }} </td>        						
        					</tr>        					
        					<tr>
        						<td width='80%' class='label-view text-right'>Invoice No.</td>
        						<td># {{ $row->invoice_num }} </td>        						
        					</tr>        					
        					<tr>
        						<td width='80%' class='label-view text-right'>Created</td>
        						<td>{{ $row->created }} </td>        						
        					</tr>        				
        					<tr>
        						<td width='80%' class='label-view text-right'>Updated</td>
        						<td>{{ $row->updated }} </td>        						
        					</tr>        					
        					<tr>
        						<td width='80%' class='label-view text-right'>User Name</td>
        						<td>{!! SiteHelpers::gridDisplayView($row->user_id,'user_id','1:tb_users:id:first_name|last_name') !!} </td>					
        					</tr>        					
        					@if(!empty($userDetail))
        						<tr>
        							<td width='80%' class='label-view text-right'>User Address</td>
        							<td>{{ $userDetail->company_address.' '.$userDetail->company_address2.' '.$userDetail->company_city.' '.$userDetail->company_postal_code.' '.$userDetail->company_country  }}</td>
        							
        						</tr>
        					@endif        				
        					<tr>
        						<td width='80%' class='label-view text-right'>Status</td>
        						<td>{{ $row->status }} </td>
        						
        					</tr>        				
        					<tr>
        						<td width='80%' class='label-view text-right'>Comments</td>
        						<td>{{ $row->comments }} </td>        						
        					</tr>
            			</tbody>	
            		</table>  
                </div>
                @if(!empty($order_item_detail))
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" style="width: 99%;" >
                        <thead>
                            <th>No.</th>
                            <th>PACKAGES</th>
                            <th class="m--align-center">QTY</th>
                            <th class="m--align-center">PRICE</th>
                        </thead>
            			<tbody>
                            {{--*/ 
        						$qty = 1;
        						$qtyPr = 1;
        					   $Totprice = 0;
        					   $nos = 1;
        					/*--}}
        				    @foreach($order_item_detail as $detail) 
                            <tr>
                                <td width="3%">{{$nos}}</td>
                                <td>
                                    <b>{{$detail->pckname}}</b> @if($detail->pckcontent!='') <br> {{$detail->pckcontent}} @endif
        
                                    @if($detail->package_modules!='')
                                        @if($detail->package_modules !="" && $detail->package_modules!="NULL")
                                      
                                          <p>Module Access purchased in this package are:</p>
                                          {{--*/  $modulesOffered = DB::table('tb_module')->whereIn('module_id', explode(',',$detail->package_modules))->get();/*--}}
                                          @foreach ($modulesOffered as $moduleRow)
                                          
                                            <p>Module Name: {{ $moduleRow->module_name}}</p>
                                            Module Note: {{ $moduleRow->module_note}}
                                            
                                           @endforeach
                                           
                                        @endif
                                    @endif
                                </td>
                                <td class="m--align-center">{{$detail->qty}}</td>
                                <td class="m--align-right">{{$currency->content . $detail->pckprice}}</td>
                            </tr>    
                            {{--*/ $qtyPr = $detail->pckprice * $qty;
        						$Totprice = $Totprice + $qtyPr;
        						$nos++;
        					/*--}}
                            @endforeach
                            <tr>
                                <td colspan="3" class="m--align-right">Total</td><td class="m--align-right">{{$currency->content . ($Totprice -(($Totprice*$vatsettings->content)/100))}}</td>
                            </tr>    
                            <tr>
                                <td colspan="3" class="m--align-right">Vat. {{ $vatsettings->content}}%</td><td class="m--align-right">{{$currency->content . (($Totprice*$vatsettings->content)/100)}}</td>
                            </tr>    
                            
                            <tr>
                                <td colspan="3" class="m--align-right">Grand Total</td><td class="m--align-right">{{$currency->content . $Totprice}}</td>
                            </tr>       
                        </tbody>
                    </table>
                </div>    	
    			
    		@endif
            </div>
            
        </div>
    </div>
    
</div>
@stop