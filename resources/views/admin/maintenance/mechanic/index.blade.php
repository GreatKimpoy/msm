@extends('admin.layouts.app')

@section('content-header')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
      <h1 class="float-left">Technician Maintenance</h1>
      <ol class="breadcrumb float-right">
        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active">Technician</li>
      </ol>
  </div><!-- /.container-fluid -->
</section>
@endsection

@section('content-body')
<section class="content-header">
  <div class="container-fluid">
    <div class="card col-sm-12 mt-3">
      <div class="card-block pt-3">
        @include('notification.alert')
        <table id="mechanicsTable" class="table table-bordered table-hover">
          <thead>
            <tr> 
                <th>ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Specialization</th>
                <th></th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
</section>
@endsection

@section('scripts-include')
<script type="text/javascript">
	$(document).ready(function() {
		var table = $('#mechanicsTable').DataTable( {
	  		select: {
	  			style: 'single'
	  		},
		    language: {
		        searchPlaceholder: "Search..."
		    },
	    	columnDefs:[
				{ targets: 'no-sort', orderable: false },
	    	],
	    	"dom": "<'row'<'col-sm-3'l><'col-sm-6'<'toolbar'>><'col-sm-3'f>>" +
						    "<'row'<'col-sm-12'tr>>" +
						    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
			"processing": true,
      serverSide: true,
      ajax: "{{ url('mechanic') }}",
      columns: [
          { data: "id" },
          { data: "full_name" },
          { data: "full_address" },
          { data: "contact" },
          { data: "email" },
          { data: "specializations" },
          { data: function(callback){
            return `
              <a href="{{ url("mechanic") }}` + '/' + callback.id + `/edit" class="btn btn-warning"><i class="fa fa-edit"></i><strong>Edit</strong></a>
             
            `
          } },
      ],
    } );

	 	$("div.toolbar").html(`
 			<a type="button" id="new" href="{{ url('mechanic/create') }}"  class="btn btn-primary btn-sm float-right">
        <i class="fa fa-plus"></i> <strong> CREATE </strong>  
      </a>
		`);

    $('#mechanicsTable').on('click', '.btn-remove', function(){
				id = $(this).data('id');
        var $this = $(this);
        var loadingText = '<i class="fa fa-circle-o-notch fa-spin"></i> Loading...';
        if ($(this).html() !== loadingText) {
          $this.data('original-text', $(this).html());
          $this.html(loadingText);
        }

        swal({
          title: "Are you sure?",
          text: "This mechanic will be removed?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            $.ajax({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              type: 'delete',
              url: '{{ url("mechanic") }}' + "/" + id,
              data: {
                'id': id
              },
              dataType: 'json',
              success: function(response){
                swal('Operation Successful','Mechanic removed','success')
              },
              error: function(){
                swal('Operation Unsuccessful','Error occurred while deleting a record','error')
              },
              complete: function(){
                $this.html($this.data('original-text'));
                table.ajax.reload();
              }
            });
          } else {
            $this.html($this.data('original-text'));
            swal("Cancelled", "Operation Cancelled", "error");
          }
        });
	    });

  });
</script>
@endsection