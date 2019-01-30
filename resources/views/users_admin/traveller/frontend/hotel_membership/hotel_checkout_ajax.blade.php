@if(!empty($packages))
<div class="m-section" style="width: 100%;">
    <div class="m-section__content">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col" >Package</th>                                    
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Line Total</th>
                </tr>
            </thead>
            <tbody>
            	{{--*/ $subTotal = 0; $orderTotal = 0; /*--}}
            	@foreach($packages as $package)
    			{{--*/ $subTotal += $package->package_price; /*--}}
                <tr>                    
                    <td>
                    	<div class="product-title-and-remove-option">
                        	<span class="product-title"><b>{{$package->package_title}}</b></span>
                        </div>
                        <div>
                            <p>{!! nl2br($package->package_description) !!}</p>
                        </div>
                    </td>
               
                    <td class="overview-td m--align-center">1</td>
                    <td class="overview-td">
                        <span class="m--pull-right">{!! isset($currency->content)?$currency->content:'&euro;' !!}{{number_format($package->package_price,2)}}</span>
                    </td>                    
                    <td class="overview-td">
                        <span class="m--pull-right">{!! isset($currency->content)?$currency->content:'&euro;' !!}{{number_format($package->package_price,2)}}</span>
                     </td>
                </tr>
                @endforeach
                {{--*/ $orderTotal = $subTotal; /*--}}
            </tbody>
        </table>
    </div>       
</div>
<div class="m--clearfix"></div>
<div class="m-section" style="width: 100%;">
    <div class="m-section__content">
        <div class="col-md-6 col-sm-12 m--pull-right">
            <table class="table">
                <tr>
                    <td>
                        <label>Total (excl. VAT) </label> 
                    </td>
                    <td>
                        <label class="m--pull-right">{!! isset($currency->content)?$currency->content:'&euro;' !!}{{ number_format(number_format($orderTotal,2,'.','')-(($orderTotal*$data["vatsettings"]->content)/100), 2)}}</label>                            
                    </td>
                </tr>
                                       
                <tr>
                    <td>
                        Vat {{($european) ? 'Inclusive' : 'Exclusive'}} {{ $data["vatsettings"]->content}}% 
                    </td>
                    <td>
                        <label class="m--pull-right">
                        {!! isset($currency->content)?$currency->content:'&euro;' !!} 
                        {{  number_format(($orderTotal*$data["vatsettings"]->content)/100,2,'.','') }}
                        </label>                              
                    </td> 
                </tr>
                <?php 
                    if(!($european)){    
                        $orderTotal = $orderTotal - (($orderTotal*$data["vatsettings"]->content)/100); 
                    } 
                ?> 
                <tr>
                    <td>
                        <label>Order Total</label> 
                    </td>
                    <td>
                        <label class="m--pull-right">{!! isset($currency->content)?$currency->content:'&euro;' !!}{{number_format($orderTotal,2,'.','')}}</label>
                    </td> 
                </tr>
                
                
                
            </table>
        </div>
    </div>
</div> 
<div class="m--clearfix"></div>
<div class="m-section" style="width: 100%;">
    <div class="m-section__content">
        
        <div class="col-md-4 col-sm-12 m--pull-right" style="padding-bottom: 50px;">
        <form action="{{URL::to('traveller-order-post')}}" method="POST" class="m-form m-form--fit m-form--label-align-right">

            <input type="hidden" name="finalAmount" value="{{$orderTotal}}">
            
            <div class="form-group m-form__group">                                
                <label>Order Comments</label>                                
                <textarea name="order_comments" id="order_comments" class="form-control m-input"></textarea>
            </div>
            @if($orderTotal > 0)
            <div class="form-group m-form__group">
                <script
                    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                    data-key="pk_test_4KFTrHSWQ3FVkkfBwoQutZSC"
                    data-amount="{{$orderTotal*100}}"
                    data-name="emporium-voyage.com"
                    data-currency="EUR"
                    data-description="Luxury Travel Redefined"
                    data-image="{{ \URL::to('sximo/assets/images/Emporium-Voyage.png') }}" 
                    data-locale="auto">
                </script>
            </div>
            @else
            <div class="form-group m-form__group m--pull-right">
                <a class="btn btn-primary" href="#" id="finish_btn">Submit</a>
            </div>
            @endif
        </form>
        </div>        
        
    </div>
</div>
@else
<div class="m-section" style="width: 100%;">
    <div class="m-section__content">
        <h2>Your cart is empty</h2>
 
        <div class="col-sm-12 text-right p-t-50">
            <a class="btn btn-primary pull-right" href="#" id="choose_pkg_btn">Continue To Choose Packages </a>
        </div>

        <div class="cart-big-border"></div>
     </div>
 </div> 
@endif 