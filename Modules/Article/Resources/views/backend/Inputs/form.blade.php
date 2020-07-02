<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<div class="row">
    <div class="col-4">
        <div class="form-group">
            <?php
            $field_name = 'user_id';
            $field_lable = "User";
            $field_relation = "user";
            $field_placeholder = "-- Select an option --";
            $required = "required";
            ?>
            {{ html()->label($field_lable, $field_name) }} {!! fielf_required($required) !!}
            {{ html()->select($field_name, isset($$module_name_singular)?optional($$module_name_singular->$field_relation)->pluck('name', 'id'):'')->placeholder($field_placeholder)->class('form-control select2-user')->attributes(["$required"]) }}
        </div>
       
    </div>
 
   
      <div class="table-responsive">
                   <form method="post" id="dynamic_category">
                    <span id="result"></span>
                    <table class="table table-bordered table-striped" id="user_table">
                  <thead>
                   <tr>
                       
                   
                       <th width="35%">Category</th>
                       <th width="35%">Weight</th>
                       <th width="30%">Action</th>
                   </tr>
                  </thead>
                  <tbody>
   
                  </tbody>
                  <tfoot>
                   <tr>
                                   <td colspan="2" align="right">&nbsp;</td>
                                   <td>
                     @csrf
                     <input type="submit" name="save" id="save" class="btn btn-primary" value="Save" />
                    </td>
                   </tr>
                   
                  </tfoot>
              </table>
                   </form>
     </div> 
@push('after-styles')

<!-- Select2 Bootstrap 4 Core UI -->
<link href="{{ asset('vendor/select2/select2-coreui-bootstrap4.min.css') }}" rel="stylesheet" />

<!-- Date Time Picker -->
<link rel="stylesheet" href="{{ asset('vendor/bootstrap-4-datetime-picker/css/tempusdominus-bootstrap-4.min.css') }}" />

<!-- File Manager -->
<link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
@endpush

@push ('after-scripts')
<!-- Select2 Bootstrap 4 Core UI -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $('.select-category').select2({
        theme: "bootstrap",
        placeholder: "-- Select an option --",
        minimumInputLength: 2,
        allowClear: true,
        ajax: {
            url: '{{route("backend.categories.index_list")}}',
            dataType: 'json',
            data: function (params) {
                return {
                    q: $.trim(params.term)
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });

    $('.select2-user').select2({
        theme: "bootstrap",
        placeholder: "-- Select an option --",
        minimumInputLength: 2,
        allowClear: true,
        ajax: {
            url: '{{route("backend.users.index_list")}}',
            dataType: 'json',
            data: function (params) {
                return {
                    q: $.trim(params.term)
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });
   
    
    var number = 1 ;

    input(number);

    function input(number)
    {
    html = '<tr>';
        html += '<tr><select id="#dynamic_category" class="form-control select2-category" name ="category[]" placeholder = "-- Select an option --" /></tr>';
        html += '<td><select id="dynamic_category" class="form-control select2-category" name ="category[]" placeholder = "-- Select an option --" /></td>';
        
      //  html += '<td><input type="text" name="weight[]" class="form-control select2-category" /></td>';
       // html += '<td><select id="dynamic_category" class="form-control select2-category" name ="category[]" placeholder = "-- Select an option --" /></td>';

        if(number > 1)
        {
            
            html += '<td><button type="button" name="remove" id="" class="btn btn-danger remove">Remove</button></td></tr>';
            $('tbody').append(html);
        }
        else
        {   
            html += '<td><button type="button" name="add" id="add" class="btn btn-success">Add</button></td></tr>';
            $('tbody').html(html);
        }
    }

    $(document).on('click', '#add','#dynamic_category', function(){
    number++;
    //$(this).add();
    
    input(number);
    });

    $(document).on('click', '.remove', function(){
    number--;
    $(this).closest("tr").remove();
    });

    $('#dynamic_form').on('submit', function(event){
        event.preventDefault();
        $.ajax({
            url:'{{ route("backend.inputs.store") }}',
            method:'post',
            data:$(this).serialize(),
            dataType:'json',
            beforeSend:function(){
                $('#save').attr('disabled','disabled');
            },
            success:function(data)
            {
                if(data.error)
                {
                    var error_html = '';
                    for(var count = 11; count < data.error.length; count++)
                    {
                        error_html += '<p>'+data.error[count]+'</p>';
                    }
                    $('#result').html('<div class="alert alert-danger">'+error_html+'</div>');
                }
                else
                {
                    input(11);
                    $('#result').html('<div class="alert alert-success">'+data.success+'</div>');
                }
                $('#save').attr('disabled', false);
            }
        })
});

// $(document).ready(function(){
//          $.get("#dynamic_category",function(data){ //specify your url for json call inside the quotes.
//              for(var i = 0; i < data.length; i++){
//                  data[i]={id:i,text:data[i].text}
//              }

 $("#dynamic_category").select2({
         theme: "bootstrap",
        placeholder: "-- Select an option --",
         minimumInputLength: 2,
         allowClear: false,
         ajax: {
             url: '{{route("backend.categories.index_list")}}',
             //type: 'get',
             dataType: 'json',

                



             data: function (params) {
                 return {
                     
                     q: $.trim(params.term)
                 };
             },
             processResults: function (data) {
                 return {
                     
                     results: data 
            //          pagination: {
            //    more: (params.page * 1 < data.total_number
            //         }

                 };
             },
             cache: true
         }
     });


    





//      $("#dynamic_category").select2({
//    ajax: {
//      url: '{{route("backend.categories.index_list")}}',
//      dataType: 'json',
//      delay: 250,
//      data: function (params) {
//        return {
//         q: $.trim(params.term)
//        };
//      },
//      processResults: function (data, params) {
//        // parse the results into the format expected by Select2
//        // since we are using custom formatting functions we do not need to
//        // alter the remote JSON data, except to indicate that infinite
//        // scrolling can be used
//        params.page = params.page || 10;

//        return {
//         results: params > 10
//         //    pagination: {
//         //      more: (params.page * 1 < data.total_number
//         //    }
//        };
//      },
//      cache: true
//    },
//    theme: "bootstrap",
//     placeholder: "-- Select an option --",
//     minimumInputLength: 2,
//     allowClear: false,
   
//  });

 
















    
});
</script>

<!-- Date Time Picker & Moment Js-->
<script type="text/javascript" src="{{ asset('vendor/moment/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/bootstrap-4-datetime-picker/js/tempusdominus-bootstrap-4.min.js') }}"></script>

<script type="text/javascript">
$(function() {
    $('.datetime').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss',
        icons: {
            time: 'far fa-clock',
            date: 'far fa-calendar-alt',
            up: 'fas fa-arrow-up',
            down: 'fas fa-arrow-down',
            previous: 'fas fa-chevron-left',
            next: 'fas fa-chevron-right',
            today: 'far fa-calendar-check',
            clear: 'far fa-trash-alt',
            close: 'fas fa-times'
        }
    });
});
</script>

<script type="text/javascript" src="{{ asset('/plugins/ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>

<script type="text/javascript">

CKEDITOR.replace('content', {filebrowserImageBrowseUrl: '/file-manager/ckeditor'});

document.addEventListener("DOMContentLoaded", function() {

  document.getElementById('button-image').addEventListener('click', (event) => {
    event.preventDefault();

    window.open('/file-manager/fm-button', 'fm', 'width=800,height=600');
  });
});

// set file link
function fmSetLink($url) {
  document.getElementById('featured_image').value = $url;
}
</script>
@endpush
