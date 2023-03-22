<!-- Button trigger modal -->
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#Addsections">
    Add Section
   </button>
   <br><br>
   <div>
   </div>

   <!-- Modal -->
   <div class="modal fade" id="Addsections" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title" id="exampleModalLabel">Sections</h5>

           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>

         <div class="modal-body">
             <form action="{{route('sections.store')}}" method="POST" autocomplete="off">
                 @csrf
                 <div class="form-group">
                   <label for="formGroupExampleInput">Section Name </label>
                   <input type="text" class="form-control" name="section_name"  >
                 </div>
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
