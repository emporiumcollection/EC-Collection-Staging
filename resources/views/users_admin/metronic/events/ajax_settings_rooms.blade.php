@foreach($cat_types as $cat)
@if(array_key_exists('rooms', $cat))
	{{--*/ $r=1; /*--}}
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-danger alert-dismissible" role="alert">
               <div class="m-alert__icon">
                    <i class="flaticon-exclamation-1"></i>
                    <span></span>
               </div>
               <div class="m-alert__text">                
                    {{ Lang::get('hotel-property.room-detail-info')}}
               </div>
            </div>
        </div>
    </div>
    
    <div class="col-sm-12 col-md-12 col-lg-12 fun-bg-gray">
        <form id="add_property_room_setup{{$cat['data']->id}}-{{$r}}" class="add_property_room_setup">
			<input type="hidden" name="property_id" value="{{$pid}}" >
			<input type="hidden" name="category_id" value="{{$cat['data']->id}}" >
			<input type="hidden" name="edit_room_id" value="" >
			<div class="row">
				<div class="col-lg-8">
					<div class="row">
						<div class="form-group col-lg-4">
							<label for="room_name">Number/Name </label>
							<input name="room_name" id="room_name" type="text" class="form-control input-sm" value="" required="required" /> 
						</div>
						<div class="form-group col-lg-2">
							<label for="room_active_full">Active Full Year </label>
							 
                            <div class="m-checkbox-inline m--align-center">
								<label class="m-checkbox m-checkbox--solid m-checkbox--brand">
									<input name="room_active_full" id="room_active_full" type="checkbox" class="form-control" value="1">
									<span></span>
								</label>
							</div>
						</div>
						<div class="form-group col-lg-3">
							<label for="room_active_from{{$cat['data']->id}}-{{$r}}">Active from </label>
							<input name="room_active_from" id="room_active_from{{$cat['data']->id}}-{{$r}}" type="text" class="form-control input-sm datepic" value="" required="required" /> 
						</div>
						<div class="form-group col-lg-3">
							<label for="room_active_to{{$cat['data']->id}}-{{$r}}">Active to</label>
							<input name="room_active_to" id="room_active_to{{$cat['data']->id}}-{{$r}}" type="text" class="form-control input-sm datepic" value="" /> 
						</div>
					</div>
				</div>
				<div class="col-lg-4 m--align-right">
					<div class="butt margin-top-10">
						<button type="submit" class="btn btn-success b-btn"><i class="fa fa-plus"></i> Add</button>
					</div>
				</div>
			</div>
		</form>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-12 gray-seprator"></div>
    
    <div class="content-block">
	@foreach($cat['rooms'] as $room)
        {{--*/ $r++ /*--}}
        <div class="alt-bg">
		<form id="add_property_room_setup{{$cat['data']->id}}-{{$r}}" class="add_property_room_setup">
			<input type="hidden" name="property_id" value="{{$pid}}" >
			<input type="hidden" name="category_id" value="{{$cat['data']->id}}" >
			<input type="hidden" name="edit_room_id" value="{{$room->id}}" >
			<div class="row">
				<div class="col-lg-8">
					<div class="row">
						<div class="form-group col-lg-4">
							<label for="room_name">Number/Name </label>
							<input name="room_name" id="room_name" type="text" class="form-control input-sm" value="{{$room->room_name}}" required="required" /> 
						</div> 
						<div class="form-group col-lg-2">
							<label for="room_active_full">Active Full Year </label>
							
                            
                            <div class="m-checkbox-inline m--align-center">
								<label class="m-checkbox m-checkbox--solid m-checkbox--brand">
									<input name="room_active_full" id="room_active_full" type="checkbox" class="form-control input-sm " value="1" {{($room->active_full_year==1) ? 'checked="checked"' : ''}}>
									<span></span>
								</label>
							</div>
                            
						</div>
						<div class="form-group col-lg-3">
							<label for="room_active_from{{$cat['data']->id}}-{{$r}}">Active from </label>
							<input name="room_active_from" id="room_active_from{{$cat['data']->id}}-{{$r}}" type="text" class="form-control input-sm datepic" value="{{$room->room_active_from}}" required="required" /> 
						</div>
						<div class="form-group col-lg-3">
							<label for="room_active_to{{$cat['data']->id}}-{{$r}}">Active to</label>
							<input name="room_active_to" id="room_active_to{{$cat['data']->id}}-{{$r}}" type="text" class="form-control input-sm datepic" value="{{$room->room_active_to}}" /> 
						</div>
					</div>
				</div>
				<div class="col-lg-4 m--align-right">
					<div class="butt margin-top-10">
						<button type="button" class="btn btn-primary b-btn" onclick="copy_rooms_data({{$room->id}});" ><i class="fa fa-trash-0"></i> Copy</button>
						<button type="button" class="btn btn-danger b-btn" onclick="delete_rooms_tabdata({{$room->id}},{{$r}},{{$cat['data']->id}},{{$pid}});"><i class="fa fa-trash-0"></i> Delete</button>
						<button type="submit" class="btn btn-success b-btn"><i class="fa fa-save"></i> Save</button>
					</div>
				</div>
			</div>
		</form>
        </div>
		
	@endforeach
	</div>
@else
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-danger alert-dismissible" role="alert">
               <div class="m-alert__icon">
                    <i class="flaticon-exclamation-1"></i>
                    <span></span>
               </div>
               <div class="m-alert__text">                
                    {{ Lang::get('hotel-property.room-detail-info')}}
               </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 fun-bg-gray">
		 <form id="add_property_room_setup{{$cat['data']->id}}-1" class="add_property_room_setup">
			<input type="hidden" name="property_id" value="{{$pid}}" >
			<input type="hidden" name="category_id" value="{{$cat['data']->id}}" >
			<input type="hidden" name="edit_room_id" value="" >
			<div class="row">
				<div class="col-lg-8">
					<div class="row">
						<div class="form-group col-lg-4">
							<label for="room_name">Number/Name </label>
							<input name="room_name" id="room_name" type="text" class="form-control input-sm" value="" required="required" /> 
						</div> 
						<div class="form-group col-lg-2">
							<label for="room_active_full">Active Full Year </label>
							
                            <div class="m-checkbox-inline m--align-center">
								<label class="m-checkbox m-checkbox--solid m-checkbox--brand">
									<input name="room_active_full" id="room_active_full" type="checkbox" value="1">
									<span></span>
								</label>
							</div>
						</div>
						<div class="form-group col-lg-3">
							<label for="room_active_from{{$cat['data']->id}}-1">Active from </label>
							<input name="room_active_from" id="room_active_from{{$cat['data']->id}}-1" type="text" class="form-control input-sm datepic" value="" required="required" /> 
						</div>
						<div class="form-group col-lg-3">
							<label for="room_active_to{{$cat['data']->id}}-1">Active to</label>
							<input name="room_active_to" id="room_active_to{{$cat['data']->id}}-1" type="text" class="form-control input-sm datepic" value="" /> 
						</div>
					</div>
				</div>
				<div class="col-lg-4 m--align-right">
					<div class="butt margin-top-10">
						<button type="submit" class="btn btn-success b-btn"><i class="fa fa-plus"></i> Add</button>
					</div>
				</div>
			</div>
		</form>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 gray-seprator"></div>
    </div>
@endif
@endforeach