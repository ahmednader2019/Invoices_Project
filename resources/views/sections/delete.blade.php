

   <!-- Modal -->
   <div class="modal fade" id="DeleteSections{{$section->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Sections</h5>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
            <form action="{{route('sections.destroy',$section->id)}}" method="POST" autocomplete="off">
               @method('DELETE')
               @csrf
               <input type="hidden" name="id" value="{{$section->id}}">
                <div class="form-group">
                  <label for="formGroupExampleInput">Section Name </label>
                  <input type="text" class="form-control" name="name"  value="{{$section->section_name}}" required >
                </div>
                  <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-danger">Delete</button>
              </form>


        </div>

        </div>
      </div>
    </div>
  </div>
