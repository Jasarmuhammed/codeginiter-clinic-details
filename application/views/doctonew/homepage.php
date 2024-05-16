<body>
  <div class="container">

    <div class="form-container">
      <a href="<?php echo base_url('Doctologin/logout'); ?>" class="fa fa-power-off text-red logout-btn">Logout</a>
      <div class="modal-body">
        <div class="form-group">
          <label for="username">User Name</label>
          <input type="text" id="username" class="form-control">
        </div>
        <div class="form-group">
          <label for="clinicid">Clinic Id</label>
          <input type="text" id="clinicid" class="form-control">
        </div>
        <div class="form-group">
          <label for="server">Server</label>
          <input type="text" id="server" class="form-control">
          </select>
        </div>
        <button type="button" class="btn btn-primary" id="save">Save</button>
      </div>
    </div>


    <div class="list-container">
      <div class="modal-footer">
        <div class="form-group" style="display: flex; align-items: center;">
          <select style="float:right;width:100%" class="form-control search_category" id="search_category">
            <option value="4">--<?php echo "select"?>--</option>
            <option value="1"><?php echo "new_search_with_user name";?></option>
            <option value="2"><?php echo "new_search_with_clinic id";?></option>
            <option value="3"><?php echo "new_search_with_server";?></option>
          </select>
          <input id="myInputFilter" type="text" class="form-control myInputFilter" style="float:right;width:100%" autocomplete="off" placeholder="<?php echo "Search"?>">

        </div>
      </div>

      <div class="box-body">
        <div class="box-datatable table-responsive">
          <table class="datatables-demo table table-bordered" id="xin_table">
            <thead>
              <tr>
                <th>Action</th>
                <th>Username</th>
                <th>Clinic id</th>
                <th>Server</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</body>

</html>


  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4"></script>

  <script>
    $(document).ready(function() {

      $(document).on("click", "#save", function(e) {
        e.preventDefault();
        var username = $("#username").val();
        var clinicid = $("#clinicid").val();
        var server = $("#server").val();
        $.ajax({
          url: "<?php echo base_url(); ?>Doctologin/saveform",
          type: "post",
          dataType: "json",
          data: {
            username: username,
            clinicid: clinicid,
            server: server
          },
          success: function(data) {
            if (data.responce == "success") {
              toastr.success(data.message);
              setTimeout(function() {
                window.location.reload();
              }, 2000);
            } else {
              toastr.error(data.message);
            }
          }
        });
        $("#form")[0].reset();
      });

      var table = $('#xin_table').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": false,
        "autoWidth": false,
        "pageLength": 10,
        "lengthMenu": [10, 25, 50, 75, 100],
        "columnDefs": [{
          "targets": 0,
          "orderable": false,
          "searchable": false
        }]
      });
      function applyFilter() {
        var filterCategory = $("#search_category").val();
        var filterValue = $("#myInputFilter").val();
        fetch(filterCategory, filterValue);
      }
      $("#search_category, #myInputFilter").on("change keyup", function() {
        applyFilter();
      });
      $(document).on("click",".del", function(e){
        e.preventDefault();
        var del_id =$(this).data("id");
        if(del_id==""){
          alert("delete id required");
        }else{
          const swalWithBootstrapButtons = Swal.mixin({
                  customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                  },
                  buttonsStyling: false
                });

                swalWithBootstrapButtons.fire({
                  title: 'Are you sure?',
                  text: "You won't be able to revert this!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonText: 'Yes, delete it!',
                  cancelButtonText: 'No, cancel!',
                  reverseButtons: true
                }).then((result) => {
                  if (result.isConfirmed) {
                     $.ajax({
                      url:"<?php echo base_url(); ?>Doctologin/delete",
                      type:"post",
                      dataType:"json",
                      data:{
                        del_id: del_id
                      },
                      success: function(data){
                        fetch();
                        if (data.responce =="success"){

                          swalWithBootstrapButtons.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                          );
                              }
                        }
                     });
                  } else if (
                    result.dismiss === Swal.DismissReason.cancel
                  ) {
                    swalWithBootstrapButtons.fire(
                      'Cancelled',
                      'Your imaginary file is safe :)',
                      'error'
                    );
                  }
                });
        }
      });
      function fetch(filterCategory = '', filterValue = '') {
        $.ajax({
          url: "<?php echo base_url(); ?>Doctologin/fetch",
          type: "post",
          dataType: "json",
          data: {
            filter_category: filterCategory,
            filter_value: filterValue
          },
          success: function(data) {
            var tableBody = "";
            for (var key in data) {
              tableBody += "<tr>";
              tableBody += "<td>" +
                `<a href="#" class="del" data-id="${data[key]['id']}">
   Delete
</a>
` +
                "</td>";
              tableBody += "<td>" + data[key]['username'] + "</td>";
              tableBody += "<td>" + data[key]['clinicid'] + "</td>";
              tableBody += "<td>" + data[key]['server'] + "</td>";
              tableBody += "</tr>";
            }

            table.clear().draw();

            table.rows.add($(tableBody)).draw();
          }
        });
      }
      fetch();
    });
  </script>

</body>

</html>
