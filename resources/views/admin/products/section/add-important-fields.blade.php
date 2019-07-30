
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name" placeholder="Product Name" required>
                <div class="help-block with-errors"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Price</label>
                <input type="number" step="any" min="0" class="form-control" name="price" placeholder="Price" required onkeypress="return (event.charCode >= 48 && event.charCode <= 57) ||  event.charCode == 46 || event.charCode == 0 ">
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Product Tax</label>
                <select name="tax" class="selectpicker form-control show-menu-arrow show-tick" required data-show-subtext="true">
                    <option value="">Select GST Tax</option>
                    @foreach($taxes as $tax)
                        <option value="{{$tax->id}}" data-subtext="{{$tax->rate}} %">{{$tax->name}}</option>
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
            </div>
        </div>
        
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Quantity <span class="text-secondary" >(numbers only)</span></label>
                <input type="number" step="any" min="0" class="form-control" name="quantity" placeholder="Quantity"  onkeypress="return (event.charCode >= 48 && event.charCode <= 57) ||  event.charCode == 46 || event.charCode == 0 "
                    @if(!empty($required) && in_array('quantity',$required))
                        required=""
                    @endif
                >
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Unit</label>
                <input type="text" class="form-control" pattern="[a-zA-Z]+" name="unit" placeholder="Unit of Quantity" >
                <div class="help-block with-errors"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Product Description</label>
                <textarea class="form-control" name="description" placeholder="Description"></textarea>
                <div class="help-block with-errors"></div>
            </div>
        </div>
    </div>
    
