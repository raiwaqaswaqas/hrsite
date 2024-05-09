<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Companies') }}
        </h2>
        
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#companyModal">
            Add Employee
        </button>
           
            <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Id</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Company_name</th>
      <th scope="col">Email</th>
      <th scope="col">Phone</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  @if($employeedata)
    @foreach($employeedata as $record)
    <tr>
        <th scope="row">{{$record['employee_id']}}</th>
        <td>{{$record['firstname']}}</td>
        <td>{{$record['lastname']}}</td>
        <td>{{$record['company_name']}}</td>
        <td>{{$record['email']}}</td>
        <td>{{$record['phone']}}</td>
        <td><a class="btn btn-primary update" href="{{ url('employdee/edit', $record['employee_id']) }}"
       title="Update" data-toggle="modal" data-target="#updateModal">
       <i class="fas fa-edit"></i>
    </a>
</td>

    <td><a class="btn btn-danger" href="{{url('employee/delete', $record['employee_id'])}}"
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
 </div>

<!-- Modal -->
<div class="modal fade" id="companyModal" tabindex="-1" role="dialog" aria-labelledby="companyModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="companyModalLabel">Add Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form for creating a new company -->
                <form action="" method="POST" id="employeeForm" enctype="multipart/form-data">
                    @csrf 
                    <div class="form-group">
                        <label for="employeeName">Employee Name</label>
                        <input type="text" class="form-control" id="employeeName" name="name" required>
                        <div class="text-danger" id='nameerror'></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="employeeLastName">Last Name</label>
                        <input type="text" class="form-control" id="employeeLastName" name="lastname" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="companyDropdown">Select Company</label>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="companyDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                Select Company Name
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="companyDropdown">
                                <!-- Add your dropdown items here -->
                                @foreach($companydata as $data)
                                <li>
                                    <a class="dropdown-item" href="#" data-attr='{{$data->comp_id}}' >
                                        {{ $data->name }}
                                    </a>
                                </li>
                                
                                @endforeach
                            </ul>
                        </div>
                        <input type="hidden" name="employeeid" id='employeeid'>
                    </div>
                    
                    <div class="form-group">
                        <label for="employeeEmail">Employee Email</label>
                        <input type="email" class="form-control" id="employeeEmail" name="email" required>
                        <div class="text-danger" id='emailerror'></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="employeePhone">Phone</label>
                        <input type="text" class="form-control" id="employeePhone" name="phone" required>
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
                    <form action="{{ route('employee.update') }}" method="POST" id="updateForm" enctype="multipart/form-data">
    @csrf 
    <div class="form-group">
                        <label for="employeeName">Employee Name</label>
                        <input type="text" class="form-control" id="firstname" name="name">
                        <div class="text-danger" id='nameerror'></div>
                    </div>
                    <div class="form-group">
                        <label for="employeeLastName">Last Name</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" >
                    </div>
                    <div class="form-group">
                        <label for="employeeEmail">Employee Email</label>
                        <input type="email" class="form-control" id="email" name="email" >
                        <div class="text-danger" id='emailerror'></div>
                    </div>
                    <div class="form-group">
                        <label for="employeePhone">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" >
                    </div>
                    <input type='hidden' id='employee_id' name='employeeid'>  
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-cQF8K/MWT/VqALpS8FC5Doi6P6zx8L/U/1O1nW+Gz1k+9eixMFCsffakm5Ka9kC4" crossorigin="anonymous"></script>

    


</x-app-layout>
<script>
    ///////Add Record
$(document).ready(function() {
    
    $('#employeeForm').on('submit', function(event) {
        event.preventDefault(); 
        $('#employeeid').attr('data-comp-id');
        let formData = new FormData(this);
        $.ajax({
            url: 'employee/store' ,
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

            }
        });
    });
    $('.dropdown-item').click(function(){
      var id=$(this).attr('data-attr');
      console.log(id);
       $('#employeeid').val(id);


    });
});
////Ajax for updatation of record
$(document).ready(function() {
    $('.update').on('click', function(event) {
        event.preventDefault();
        var href = $(this).attr('href');
        var companyId = href.split('/').pop();
        
  
        $.ajax({
            url: 'employee/edit/'+companyId,
            method: 'GET',
            success: function(data) {
                
                $('#employee_id').val(data.employee_id);
                $('#firstname').val(data.firstname);
                $('#lastname').val(data.lastname);
                $('#email').val(data.email);
                $('#phone').val(data.phone);
                $('#updateModal').modal('show');
            }
        });
    });
});

const dropdownButton = document.getElementById('companyDropdown');
    const dropdownMenuItems = document.querySelectorAll('#companyDropdown + ul .dropdown-item');
    dropdownMenuItems.forEach(item => {
        item.addEventListener('click', function(event) {
            event.preventDefault(); 
            const selectedCompanyName = event.target.textContent;
            dropdownButton.textContent = selectedCompanyName;
        });
    });
</script>
