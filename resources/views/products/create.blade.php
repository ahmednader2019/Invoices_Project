<!-- Button trigger modal -->
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#Addproducts">
    Add Product
   </button>
   <br><br>
   <div>
   </div>

   <!-- Modal -->
   <div class="modal fade" id="Addproducts" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title" id="exampleModalLabel">Products</h5>

           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>

         <div class="modal-body">
             <form action="{{route('products.store')}}" method="POST" autocomplete="off">
                 @csrf
                 <div class="form-group">
                   <label for="formGroupExampleInput">Product Name </label>
                   <input type="text" class="form-control" name="product_name"  >
                 </div>
                 <div>
                    <select class="form-control" name = "section_id">
                        @foreach ($sections as $section)
                        <option value="{{$section->id}}">{{$section->section_name}}</option>
                        @endforeach
                      </select>
                   </div>
                   <br></br>
                 <div class="form-group">
                     <label for="formGroupExampleInput2">description </label>
                     <input type="text" class="form-control" name="description" >
                   </div>
                   <div class="modal-footer">
                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                   <button type="submit" class="btn btn-success">Save changes</button>
               </form>


         </div>

         </div>
       </div>
     </div>
   </div>
