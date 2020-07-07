<!DOCTYPE html>
<html>
<head>
    <title>User Management System</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta meta name="api-token" content="{{Session::get('api_token')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.17/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.17/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
</head>
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="#">
               User Management App
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                   
                    <li class="list-group-item active bg-light"><a href="/users" class="link" style="text-decoration:none;">User Management</a></li>
                                       </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                  user
                                                                  </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('/logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('/logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                         </ul>
                </div>
            </div>
        </nav>

<body class="bg-dark">
 <div class="container">
   <div class="row">
     <div class="col-md-12">
       <div class="card mt-5">
         <div class="card-header">
            <div class="col-md-12">
                <h4 class="card-title">User Management Crud 
               
                 <a class="btn btn-success ml-5" href="javascript:void(0)" id="createNewUser"> Create New User</a>
               
                </h4>
            </div>
         </div>
         <div class="card-body">
           <table class="table table-bordered data-table">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>profile</th>
                        <th width="15%">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <div class="modal fade" id="ajaxModel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modelHeading"></h4>
                    </div>
                    <div class="modal-body">
                        <form id="UserForm" name="UserForm" class="form-horizontal">
                           <input type="hidden" name="user_id" id="User_id">
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Name</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="50" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Email</label>
                                <div class="col-sm-12">
                                <input type="email" id="email" name="email"  required="" placeholder="Enter User Email" class="form-control" >
                                </div>
                            </div>

                                              
                            <div class="form-group">
                                <label class="col-sm-3 control-label passwords">Password</label>
                                <input type="password" name="password" id="password"  required="" placeholder="Enter Password" class="form-control passwords">
                                </div>
                            </div>
                          
                            <div class="col-sm-offset-2 col-sm-10">
                             <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
                             </button>
                            </div>
                            </div>
                                
                           
                        </form>
                    </div>
                </div>
            </div>
         </div>
       </div>
     </div>
   </div>
 </div>

</body>
<script type="text/javascript">
  $(function () {
     
    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
              'api-token': $('meta[name="api-token"]').attr('content'),
          }
       
    });
    
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('users.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'}, 
            {data: 'profile', name: 'profile',
                render: function( data) {
                        return "<img src=\"http://soacrud-api-local/images/" + data + "\" height=\"50\"/>";
                    }
            },  
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
    
    });
     
    $('#createNewUser').click(function () {
        $('#saveBtn').val("create-User");
        $('#User_id').val('');
        $('#UserForm').trigger("reset");
        $('#modelHeading').html("Create New User");
        $('#ajaxModel').modal('show');
    });
    
    $('body').on('click', '.editUser', function () {
        
      var User_id = $(this).data('id');
      $.get("http://soacrud-api-local/api" +'/edit/' + User_id, function (data) {
          $('#modelHeading').html("Edit User");
          $('#saveBtn').val("edit-user");
          $('#ajaxModel').modal('show');
          $('.passwords').hide();
          $('#name').val(data.data.name);
          $('#email').val(data.data.email);

          $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Saving in process');
    if(User_id){
        $.ajax({
          data: $('#UserForm').serialize(),
          url: "http://soacrud-api-local/api/update/" + User_id,
          type: "PUT",
          dataType: 'json',
          success: function (data) {
     
              $('#UserForm').trigger("reset");
              $('#ajaxModel').modal('hide');
              $('.passwords').show();
              table.draw();
         
          },
          error: function (data) {
              console.log('Error:', data);
              $('#saveBtn').html('Save Changes');
          }
      });
    }
       
    });
      })
      
   });
    
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Saving in process');
    
        $.ajax({
          data: $('#UserForm').serialize(),
          url: "http://soacrud-api-local/api/create-user",
          type: "POST",
          dataType: 'json',
          success: function (data) {
     
              $('#UserForm').trigger("reset");
              $('#ajaxModel').modal('hide');
              table.draw();
         
          },
          error: function (data) {
              console.log('Error:', data);
              $('#saveBtn').html('Save Changes');
          }
      });
    });
    
    $('body').on('click', '.deleteUser', function () {
     
        var User_id = $(this).data("id");
        if(confirm("Deleting User!!!"))
      {
        $.ajax({
            type: "DELETE",
            url: "http://soacrud-api-local/api/delete/"+ User_id,
            success: function (data) {
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
        }
    });
     
  });
</script>
</html>