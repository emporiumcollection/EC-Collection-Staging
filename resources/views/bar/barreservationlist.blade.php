

  <div class="page-content row">
    <!-- Page header -->
    
	
	<div class="page-content-wrapper m-t">	 	

<div class="sbox animated fadeInRight">
	<div class="sbox-title"> <h5> <i class="fa fa-table"></i> </h5>
<div class="sbox-tools" >
		</div>
	</div>
	<div class="sbox-content"> 	
	    <div class="toolbar-line ">
			
		</div> 		

	
	
	 
	 <div class="table-responsive" style="min-height:300px;">
    <table class="table table-striped ">
        <thead>
			<tr>
				<th class="number"> No </th>
				<th>Name</th>
				<th>Email</th>
				<th>Telephone</th>
				<th>Telephone Secondary</th>
				<th>Reserve Date</th>
				<th>Guest</th>
				<th>Query</th>
				<th>Date</th>
			  </tr>
        </thead>

        <tbody>     
			@if(!empty($reservedata))
				@foreach ($reservedata as $row)
					<tr>
						<td width="30"> {{ ++$i }} </td>
						<td> {{ $row->firstname . ' ' . $row->lastname }}</td>
						<td> {{ $row->emailaddress }}</td>	
						<td> {{ $row->telephone_code . $row->telephone_number }}</td>
						<td> {{ $row->telephone_code2 . $row->telephone_number2 }}</td>
						<td> {{ $row->reserve_day . ' ' . $row->reserve_month . ', ' . $row->reserve_year }}</td>
						<td> {{ $row->reserve_hour . ' : '. $row->reserve_minute }}</td>
						<td> {{ $row->totalguest }}</td>
						<td> {{ $row->query }}</td>
						<td> {{ $row->created }}</td>
					</tr>	
				@endforeach
             @endif
			 
        </tbody>
      
    </table>
	<input type="hidden" name="md" value="" />
	</div>
	
	
	</div>
</div>	
	</div>	  
</div>			
