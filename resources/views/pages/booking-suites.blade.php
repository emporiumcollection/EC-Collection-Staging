<div class="input-field1">
    SUITES
</div>
<div class="input-field2" style="display: none;">
    <div class="booking-form-heading">Type</div>
    <select name="booking_Room_type[]" class="booking-form-select-inputs-style booking_Room_type">
        <option value="0">Select</option>
    </select>
</div>
<div class="input-field2">
    <div class="booking-form-heading">#Adults(s)</div>
    <select name="booking_adults[]" class="booking-form-select-inputs-style booking_adults">
        <option {{ ($adults!='' && $adults==1) ? 'selected' : '' }}>1</option>
        <option {{ ($adults!='' && $adults==2) ? 'selected' : '' }}>2</option>
        <option {{ ($adults!='' && $adults==3) ? 'selected' : '' }}>3</option>

        <option {{ ($adults!='' && $adults==4) ? 'selected' : '' }}>4</option>
        <option {{ ($adults!='' && $adults==5) ? 'selected' : '' }}>5</option>
         <option {{ ($adults!='' && $adults==6) ? 'selected' : '' }}>6</option>
    </select>
</div>
<div class="right-input-align2">
    <div class="booking-form-heading">#Children</div>
    <select name="booking_children[]" class="number_of_children booking-form-select-inputs-style booking_children">
        <option {{ ($childs!='' && $childs==0) ? 'selected' : '' }}>0</option>
        <option {{ ($childs!='' && $childs==1) ? 'selected' : '' }}>1</option>
        <option {{ ($childs!='' && $childs==2) ? 'selected' : '' }}>2</option>
        <option {{ ($childs!='' && $childs==3) ? 'selected' : '' }}>3</option>
        
        <option {{ ($childs!='' && $childs==4) ? 'selected' : '' }}>4</option>
        <option {{ ($childs!='' && $childs==5) ? 'selected' : '' }}>5</option>
        <option {{ ($childs!='' && $childs==6) ? 'selected' : '' }}>6</option>
    </select>
</div>
<div class="clearfix"></div>
<a href="#" class="add-new-room-btn booking-add-room">ADD SUITE</a>