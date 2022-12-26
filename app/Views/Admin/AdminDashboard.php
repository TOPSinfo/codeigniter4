<?php echo view('/includes/Header');  ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Admin List</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <style type="text/css">
      .pagination {
        margin-bottom: 0;
      }
    .pagination a {
    padding-left: 5px;
    padding-right: 5px;
    margin-left: 5px;
    margin-right: 5px;
    }
    .pagination li.active{
    background: #3372bd;
    color: #fff;
    }
    .pagination li.active a{
    color: white;
    text-decoration: none;
    }
    </style>
    
  </head>
  <body>
    <div class='container-fluid'>
      
      <div class="row py-2 border-bottom" style="background:#eee;">
        <div class="col-auto">
          <!-- Search form -->
          <form method='get' action="<?php echo base_url(); ?>/adminDashboard" id="searchForm">
            <div class="input-group input-group-sm">
              <input type='text' class="form-control form-control-sm h-auto" aria-describedby="inputGroup-sizing-sm" name='search' id="searchbox" placeholder="Search" value="<?= $search;?>">
              <span class="input-group-text cursor-pointer" id="inputGroup-sizing-sm">
                <!-- <input type='button' class="btn btn-sm p-0" id='btnsearch' value='Search' onclick='document.getElementById("searchForm").submit();'> -->
                <i class="fa fa-search" id='btnsearch' aria-hidden="true" onclick='document.getElementById("searchForm").submit();'></i>
              </span>
              <span class="input-group-text cursor-pointer" id="inputGroup-sizing-sm">
                <!-- <input type='button' class="btn btn-sm p-0" id='btnreset' value='Reset' onclick="Reset();"> -->
                <i class="fa fa-th-large" id='btnreset' aria-hidden="true" onclick="Reset();"></i>
              </span>
                
              </div>
            </form>
          </div>
          <div class="col text-end">
            <form method='get' action="<?php echo base_url(); ?>/create_admin" id="searchForm">
              <input type='submit' id='create_admin' value='Create Admin' class="btn btn-sm btn-dark">
            </form>
          </div>
          
        </div>

          <div class="row  mt-3" id="show_total_records" style="display: none;">
            <div class="col-sm-12">
              <div class="d-flex align-items-center fs-13px">
              <label id="cnt_selected">0 Record(s) Selected</label><span class="mx-1">|</span>
              <a class="text_color_red text_size add_email_address" onclick="remove_selection();" title="Remove Selected" href="javascript:void(0);">Remove Selection</a>
              <div class="mx-1">
              <select class="form-select w-100px form-select-sm pt-1px pb-1px pe-2" name="multiple_action" id="multiple_action" >
                <option value="">Select</option>
                <!-- <option value="delete">Delete</option> -->
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
              </select>
            </div>
            </div>
            </div>
          </div>
        
        <div class="table-responsive mt-3 p-1">
          <table class="table table-hover mb-0" border='1' style='border-collapse: collapse;'>
            <thead>
              <tr>
                <th><input type="checkbox" class="selecctall" id="selecctall"></th>
                <th>Name</th>
                <th>Email</th>
                <th>Contact no.</th>
                <th class="w-100px text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if(count($users)>0){
              foreach($users as $user){
              echo "<tr>";
                echo "<td>".'<input type="checkbox" class="checkbox1 mycheckbox" id="check" name="check[]" value='.$user['id'].'>'
                ."</td>";
                echo "<td>".$user['name']."</td>";
                echo "<td>".$user['email']."</td>";
                echo "<td>".$user['contact_no']."</td>";
                echo "<td class='text-center'>";
                  if($user['is_deleted']==0){
                  echo
                  '<a uid='.$user['id'].' ustatus='.$user['is_deleted'].' href=""  data-bs-toggle="modal" data-bs-target="#statusModal" class="user_status_change mx-1"><i class="fa fa-check text-dark mx-1" aria-hidden="true"></i></a>';
                  }else{
                  echo
                  '<a uid='.$user['id'].' ustatus='.$user['is_deleted'].' href=""  data-bs-toggle="modal" data-bs-target="#statusModal" class="user_status_change mx-1"><i class="fa fa-close text-dark mx-1" aria-hidden="true"></i></a>';
                  }
                  echo
                  '<a href="'.base_url().'/edit_admin/'.$user['id'].'"><i class="fa fa-pencil text-dark mx-1" aria-hidden="true"></i></a>
                  <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal" id="delete_admin" uid='.$user['id'].' class="user_deleted mx-1" ><i class="fa fa-trash-o text-dark" aria-hidden="true"></i></a>
                  ';
                  
                "</td>";
              echo "</tr>";
              }
              }else{
              echo "<tr>";
                echo "<td rowspan='5'>"."No record found"."</td>";
              echo "</tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
        <!-- Paginate -->
        <div class="row d-flex align-items-center py-1">
           
          <!-- Pagination Details -->
          <div class="col">
            <div class="fw-500 fs-italic text-muted fs-13px">Showing <?= (($page * $perPage) - $perPage +1) ."-". (($page * $perPage) - $perPage + count($data))  ?> Result out of <?= number_format($total) ?></div>
          </div>
          <!-- End of Pagination Details -->

          <div class="col-auto text-muted"> 
            <div class="d-flex align-items-center fs-13px fw-500">
            <span>Show</span>
            <div class="mx-1">
              <select class="form-select form-select-sm pt-1px pb-1px pe-2" name="getRows" id="getRows" >
                <option value="">Select</option>
                <option <?php if ($getRows == "5") echo "selected='selected'";?> value="5">5</option>
                <option <?php if ($getRows == "10") echo "selected='selected'";?>  value="10">10</option>
                <option <?php if ($getRows == "20") echo "selected='selected'";?>  value="20">20</option>
              </select>
            </div>
              <span>Entries</span>
            </div>
          </div>

          <div class="col-auto"><?= $pager_links ?></div>

        </div>
      </div>
    </body>
  </html>
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form action="<?php echo base_url(); ?>/delete_admin" method="post">
        <div class="modal-content">
          <!-- <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div> -->
          <div class="modal-body text-center">
            <h6>Are you sure, you want to delete admin?</h6>
            <input type="hidden" name="id" id="user_id" value="">
          </div>
          <div class="modal-footer d-flex justify-content-center text-center">
            <div>
              <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">No</button>
              <button type="submit" name="submit" class="btn btn-primary btn-sm">Yes</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form action="<?php echo base_url(); ?>/change_status_admin" method="post">
        <div class="modal-content">
          <!-- <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div> -->
          <div class="modal-body text-center">
            <h6>Are you sure, you want to change admin status?</h6>
            <input type="hidden" name="id" id="user_id_change" value="">
            <input type="hidden" name="user_status" id="user_status" value="">
          </div>
          <div class="modal-footer d-flex justify-content-center text-center">
            <div>
              <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">No</button>
              <button type="submit" name="submit" class="btn btn-primary btn-sm">Yes</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="modal fade" id="multipleActionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form action="<?php echo base_url(); ?>/change_bulk_status_admin" method="post">
        <div class="modal-content">
          <!-- <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div> -->
          <div class="modal-body text-center">
            <h6>Are you sure, you want to <label id="show_action"></label> admin?</h6>
            <input type="hidden" name="user_ids" id="user_ids" value="">
            <input type="hidden" name="user_action" id="user_action" value="">
          </div>
          <div class="modal-footer d-flex justify-content-center text-center">
            <div>
              <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">No</button>
              <button type="submit" name="submit" class="btn btn-primary btn-sm">Yes</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
<?php echo view('/includes/Footer');  ?>

<script type="text/javascript">

        $(document).on('click','.user_deleted',function(){

            var id = $(this).attr('uid');
            
            $('#user_id').val(id);

            
        });
        $(document).on('click','.user_status_change',function(){

            var id = $(this).attr('uid');
            var user_status = $(this).attr('ustatus');
            
            $('#user_id_change').val(id);
            $('#user_status').val(user_status);

            
        });
        $('#multiple_action').on('change', function (e) {
            var optionSelected = $("option:selected", this);
            var valueSelected = this.value;

            var checkbox = $('.mycheckbox:checked');
            
            if(valueSelected!='' && checkbox.length > 0)
            {
               var checkbox_value = [];
               $(checkbox).each(function(){
                checkbox_value.push($(this).val());
               });
            
                $('#user_action').val(valueSelected);
                $('#user_ids').val(checkbox_value);
                $("#show_action").html(valueSelected)  
                $('#multipleActionModal').modal('show');
            }

            
         });
        function Reset() {
        $('#searchbox').val('');   
        $("#searchForm").submit();
     
      }

      $('#getRows').on('change', function (e) {

        var optionSelected = $("option:selected", this);
        var valueSelected = this.value;
        
        $("#searchForm").submit();
    
        });
      //checkbox
       var arraydatacount = 0;
   
       var popupcontactlist = Array();

      $('body').on('click','#selecctall',function(e)
    {
      
        if(this.checked) {
            $('.mycheckbox').each(function() { //loop through each checkbox

                this.checked = true;  
                var arrayindex = jQuery.inArray( parseInt(this.value), popupcontactlist );

                if(arrayindex == -1)
                {
                    popupcontactlist[arraydatacount++] = parseInt(this.value);
                }  
            });
            $("#show_total_records").show();

       } else{
            $('.mycheckbox').each(function() { //loop through each checkbox

                this.checked = false;  
                var arrayindex = jQuery.inArray( parseInt(this.value), popupcontactlist );

                if(arrayindex >= 0)
                {
                    popupcontactlist.splice( arrayindex, 1 );
                    arraydatacount--;
                }
            });
            $("#show_total_records").hide();
       }
       $("#cnt_selected").text(popupcontactlist.length + " Record(s) Selected");
    });
      $('body').on('click','.mycheckbox',function(e){
        
    
        if($('.mycheckbox:checkbox[value='+parseInt(this.value)+']:checked').length)
        {   
          var arrayindex = jQuery.inArray( parseInt(this.value), popupcontactlist );
          if(arrayindex == -1)
          {       
            popupcontactlist[arraydatacount++] = parseInt(this.value);
          }

            if ($('.mycheckbox:checked').length == $('.mycheckbox').length) {
                $('#selecctall').prop('checked', true); // Checks it   
            }
            
        }
        else
        {
          var arrayindex = jQuery.inArray( parseInt(this.value), popupcontactlist );
          if(arrayindex >= 0)
          {
            popupcontactlist.splice( arrayindex, 1 );
            $('#selecctall').prop('checked', false); // Checks it   
            arraydatacount--;
          }
          
        }
        if(popupcontactlist.length>=1){
          $("#show_total_records").show();
        }else{
          $("#show_total_records").hide();
        }
        $("#cnt_selected").text(popupcontactlist.length + " Record(s) Selected");

    });

    function remove_selection() {
      var cnt = popupcontactlist.length;

      for(i=0;i<popupcontactlist.length;i++)
      {
        $('.mycheckbox:checkbox[value='+popupcontactlist[i]+']').prop('checked',false);
      }
        $('#selecctall').prop('checked',false);
        popupcontactlist = Array();
        $("#cnt_selected").text("0 Record(s) Selected");
        arraydatacount = 0;
        $("#show_total_records").hide();

    }
    </script>

    