<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Customer</title>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>

        <div class="container">
            <div class="panel  panel-default ">
                <div class="panel-heading">
                    <button type="button" class="btn btn-info btn-lg" id="add">New Customer</button>
                </div>

                <div class="panel-body"> 

                    <table class="table table-hover">
                        <caption>Customer Info</caption>  
                        <thead>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Sex</th>
                        <th>Email</th>
                        <th>phone</th>
                        <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($customers as $key => $customer)
                            <tr id ="customer{{$customer->id}}">
                                <td>{{$customer->id}}</td>
                                <td>{{$customer->first_name}}</td>
                                <td>{{$customer->last_name}}</td>
                                <td>
                                    @if ($customer->sex==0)
                                    Male
                                    @else
                                    Female
                                    @endif
                                </td>
                                <td>{{$customer->email}}</td>
                                <td>{{$customer->phone}}</td>
                                <td>
                                    <button class="btn btn-success btn-edit"  data-id="{{$customer->id}}" >Edit</button>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button class="btn btn-danger btn-delete" data-id="{{$customer->id}}" >Delete</button>
                                </td>

                            </tr>
                            @endforeach 
                        </tbody>

                    </table>
                </div>
                @include('newCustomer')


            </div>

            <script type="text/javascript">

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
});

//         this is for adding a new customer which results a dialog(modal) in short with id as customer
$('#add').on('click', function () {
    $('#save').val('save');
    $('#frmCustomer').trigger('reset');
    $('#customer').modal('show');
})


//this id for updating the data .btn-edit is class,so we call with .,not #(is only for id's)
$('.btn-edit').on('click', function () {
//
    alert($(this).data('id'));
})

//this id for deleting  the data .btn-delete is class,so we call with .,not #(is only for id's)
$('.btn-delete').on('click',function (){
    alert($(this).data('id'));
})


$('#frmCustomer').on('submit', function (e) {
    e.preventDefault();
    var form = $('#frmCustomer');
    var formData = form.serialize();
    var url = form.attr('action');
    var type='post';
    var STATE=$("#save").val();
    if(STATE=='update'){
        type='put'; 
    }

    $.ajax({ 
        type: type,
        url: url,
        data: formData,
        success: function (data) {
         var sex="";
        if (data.sex == 0) {
         sex = 'Male';
         } else {
         sex = 'Female';
         }

        var row = '<tr id ="customer'+data.id+'">' +
            '<td>' + data.id + '</td>' +
            '<td>' + data.first_name + '</td>' +
            '<td>' + data.last_name + '</td>' +
            '<td>' + sex + '</td>' +
            '<td>' + data.email + '</td>' +
            '<td>' + data.phone + '</td>' +
            '<td><button  class="btn btn-success btn-edit"  >&nbsp;Edit</button>' +
            '<button class="btn btn-danger btn-delete" >&nbsp;Delete</button></td>' +
            '</tr>';

            if(STATE=='save'){
                $('tbody').append(row);
            }else{
                $('#customer'+data.id).replaceWith(row);
            }

            $('#frmCustomer').trigger('reset');
            $('#first_name').focus();
        }

    });
})

function  addRow(data) {
    var sex="";

    if (data.sex == 0) {
        sex = 'Male';
    } else {
        sex = 'Female'
    }
    var row = '<tr id ="customer'+data.id+'">' +
            '<td>' + data.id + '</td>' +
            '<td>' + data.first_name + '</td>' +
            '<td>' + data.last_name + '</td>' +
            '<td>' + data.sex + '</td>' +
            '<td>' + data.email + '</td>' +
            '<td>' + data.phone + '</td>' +
            '<td><button  class="btn btn-success btn-edit"  >&nbsp;Edit</button>' +
            '<button class="btn btn-danger btn-delete" >&nbsp;Delete</button></td>' +
            '</tr>';
    $('tbody').append(row);
}



//-------getupdate customer-------------//
    $('tbody').delegate('.btn-edit','click',function(){

        var customerId=$(this).data('id');
        console.log(customerId);
        var url='{{URL::to('getUpdate')}}';
        console.log(url);

        $.ajax({
            type:'get',
            url:url,
            data:{'customerId':customerId},

            success:function(data){
                console.log(data);
                $('#id').val(data.id);
                $('#first_name').val(data.first_name);
                $('#last_name').val(data.last_name);
                $('#sex').val(data.sex);
                $('#email').val(data.email);
                $('#phone').val(data.phone);
                $('#save').val('update');
                $('#customer').modal('show');
            }
            

        });



    });
    //---------------update customer.................//
$('tbody').delegate('.btn-delete','click',function(e){

    e.preventDefault();
    if (confirm('Are you sure you want to Delete  ?')) {
    var customerId=$(this).data('id');
    var url ='{{URL::to('deleteCustomer')}}';

        $.ajax({
            type:'post',
            url:url,
            data:{'customerId':customerId,"_token": "{{ csrf_token() }}"},   
            success:function(data){
                $('#customer'+value).remove();
            }
           
        });

    }

    


    
   



});

   


            </script>

        </div>


    </body>
</html>
