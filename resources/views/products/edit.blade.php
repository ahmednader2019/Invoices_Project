

   <!-- Modal -->
   <div class="modal fade" id="EditProducts{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Products</h5>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
            <form action="{{route('products.update','test')}}" method="POST" autocomplete="off">
               @method('PUT')
               @csrf
               <input type="hidden" name="id" value="{{$product->id}}">
                <div class="form-group">
                  <label for="formGroupExampleInput">Product name</label>
                  <input type="text" class="form-control" name="product_name"  value="{{$product->product_name}}" required >
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Description</label>
                    <input type="text" class="form-control" name="description"  value="{{$product->description}}">
                  </div>

                  <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Update changes</button>
              </form>


        </div>

        </div>
      </div>
    </div>
  </div>
