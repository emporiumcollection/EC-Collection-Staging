@extends('users_admin.metronic.layouts.app')

@section('breadcrumb')
    <li class="m-nav__separator"> - </li>
    <li class="m-nav__item"> 
        <a href="{{ URL::to('dashboard')}}" class="m-nav__link"> 
            <span class="m-nav__link-text"> Dashboard </span> 
        </a> 
    </li>   
    <li class="m-nav__separator"> - </li>
    <li class="m-nav__item"> 
        <a href="{{ URL::to('arrivaldeparture')}}" class="m-nav__link"> 
            <span class="m-nav__link-text"> Arrivals, Departures &amp; Cancelations </span> 
        </a> 
    </li>
    <li class="m-nav__separator"> - </li>
    <li class="m-nav__item"> 
        <a href="#" class="m-nav__link"> 
            <span class="m-nav__link-text breadcrumb-end"> View </span> 
        </a> 
    </li>
@stop

@section('content')
<div class="row">
    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
        <h2>Booking Details View</h2>
    </div>    
    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-right">
        <a href="{{URL::to('arrivaldeparture')}}" class="btn btn-primary">Back</a>    
    </div>
    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
        <table class="table table-striped table-bordered" >
            <tbody>	
                <tr>
                    <td width='30%' class='label-view text-right'>Booking number</td>
                    <td>{{ $row->booking_number }} </td>
                </tr>
                <tr>
                    <td width='30%' class='label-view text-right'>Guests</td>
                    <td>{{ $row->first_name }} {{$row->last_name}} </td>
                </tr>
                <tr>
                    <td width='30%' class='label-view text-right'>Date booking received</td>
                    <td>{{$row->created_date}} </td>
                </tr>
                <tr>
                    <td width='30%' class='label-view text-right'>Arrival Day</td>
                    <td><?php echo date('l', strtotime($row->checkin_date)); ?></td>
                </tr> 
                <tr>
                    <td width='30%' class='label-view text-right'>Departure Day</td>
                    <td><?php echo date('l', strtotime($row->checkout_date)); ?></td>
                </tr>                
                <tr>
                    <td width='30%' class='label-view text-right'>Checkin Date</td>
                    <td>{{ $row->checkin_date }} </td>
                </tr>
                <tr>
                    <td width='30%' class='label-view text-right'>Checkout Date</td>
                    <td>{{ $row->checkout_date }} </td>
                </tr>
                
                <tr>
                    <td width='30%' class='label-view text-right'>Arrival Time</td>
                    <td>{{ $row->arrival_time }} </td>
                </tr>
                <tr>
                    <td width='30%' class='label-view text-right'>Total Nights</td>
                    <td>{{ $row->number_of_nights }} </td>
                </tr>
                <tr>
                    <td width='30%' class='label-view text-right'>Cancelation Terms</td>
                    <td></td>
                </tr>
                <tr>
                    <td width='30%' class='label-view text-right'>Total booking</td>
                    <td></td>
                </tr>
                <tr>
                    <td width='30%' class='label-view text-right'>Total Com</td>
                    <td></td>
                </tr>
                <tr>
                    <td width='30%' class='label-view text-right'>Com %</td>
                    <td></td>
                </tr>
                <tr>
                    <td width='30%' class='label-view text-right'>Revenue per night</td>
                    <td>{{ $row->price }} </td>
                </tr>
                <tr>
                    <td width='30%' class='label-view text-right'>Reservations Email</td>
                    <td>{{ $row->email }} </td>
                </tr>
                
                
                
                
            </tbody>	
        </table>  
    </div> 
</div>

@stop