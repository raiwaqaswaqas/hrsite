<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Companies') }}
        </h2>
        
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#companyModal">
            Add Company
        </button>
           
            <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">comp_id</th>
      <th scope="col">Comp_Name</th>
      <th scope="col">Comp_Email</th>
      <th scope="col">Image</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  @if($data)
    @foreach($data as $record)
    <tr>
        <th scope="row">{{$record->comp_id}}</th>
        <td>{{$record->name}}</td>
        <td>{{$record->email}}</td>
        <td><img src="{{ asset('storage/logos/' . $record->logo) }}" alt="picture" class="rounded"></td>
        <td><a class="btn btn-primary update" href="{{ url('/edit', $record->comp_id) }}"
       title="Update" data-toggle="modal" data-target="#updateModal">
       <i class="fas fa-edit"></i>
    </a>
</td>

    <td><a class="btn btn-danger" href="{{url('/delete', $record->comp_id)}}"
                   title="Delete"><i class="fas fa-trash"></i></a></td>

    </tr>
    @endforeach
@else
    <tr>
        <td colspan="4">No records found.</td>
    </tr>
@endif
  
  </tbody>
</table>
        </div>
        <div class="pagination">
    {{ $data->links() }}
</div>
    </div>

    <!-- Modal for creating a new company -->
    <div class="modal fade" id="companyModal" tabindex="-1" role="dialog" aria-labelledby="companyModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="companyModalLabel">Add Company</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('companies.store') }}" method="POST" id="companyForm" enctype="multipart/form-data">
    @csrf 
    <div class="form-group">
        <label for="companyName">Company Name</label>
        <input type="text" class="form-control" id="companyName" name="name" >
        
            <div class="text-danger" id='nameerror'></div>
      
    </div>
    <div class="form-group">
        <label for="companyDescription">Company Email</label>
        <input type="text" class="form-control" id="companyDescription" name="email" >
       <div class="text-danger" id='emailerror'></div>
  
    </div>
    <div class="form-group">
        <label for="companyLogo">Logo</label>
        <br>
        <input type="file" name="image"  id="image-input" >
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>

                </div>
            </div>
        </div>
    </div>
<!--Model for updatation of record-->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="companyModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="companyModalLabel">Edit Record</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('update') }}" method="GET" id="updateForm" enctype="multipart/form-data">
    @csrf 
    <div class="form-group">
        <label for="companyName">Company Name</label>
        <input type="text" class="form-control" id="companyname" name="name" >
       
    </div>
    <div class="form-group">
        <label for="companyDescription">Company Email</label>
        <input type="text" class="form-control" id="companyemail" name="email" >
     
    </div>
    <input type='hidden' id='comp_id' name='companyid'>
    <div class="modal-footer">
        
        <button type="" class="btn btn-primary">update</button>
    </div>
</form>

                </div>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</x-app-layout>
<script>
    ///////Add Record
$(document).ready(function() {
    
    $('#companyForm').on('submit', function(event) {
        event.preventDefault(); 
        let formData = new FormData(this);
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST', 
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response);
                alert('Form submitted successfully.');
                location.reload();
            },
            error: function(xhr) {

                console.error(xhr.responseText); 
                let response = xhr.responseJSON;
                 if (response && response.errors) {
    if (response.errors.name) {
        $('#nameerror').html(response.errors.name);
    }
    if (response.errors.email) {
        $('#emailerror').html(response.errors.email);
    }
}
            }
        });
    });
});
////Ajax for updatation of record
$(document).ready(function() {
    $('.update').on('click', function(event) {
        event.preventDefault();
        var href = $(this).attr('href');
        var companyId = href.split('/').pop();
        
  
        $.ajax({
            url: '/edit/'+companyId,
            method: 'GET',
            success: function(data) {
                $('#companyname').val(data.name);
                $('#companyemail').val(data.email);
                $('#comp_id').val(data.comp_id);
               
                $('#updateModal').modal('show');
            }
        });
    });
});
</script>
