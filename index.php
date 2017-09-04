<?php
/* include the configuration and header files */
include_once 'dbconfig.php';
include_once 'header.php';
?>

<div class="clearfix"></div>

<div class="container">
    <a href="add-data.php" class="btn btn-large btn-info"><i class="glyphicon glyphicon-plus"></i> &nbsp; Add Records</a>
</div>

<div class="clearfix"></div><br />

<div class="container">

    <table  id="user-lists" cellpadding="1" class="table table-striped table-hover table-full-width" data-order-by="1" data-order-type="asc" data-action="users_list">
        <thead>
            <tr>
		<th data-name="id" data-width="5" data-sortable="true" data-searchable="false">#</th>
		<th data-name="first_name" data-width="5" data-sortable="true" data-searchable="true">First Name</th>
		<th data-name="last_name" data-width="5" data-sortable="true" data-searchable="true">Last Name</th>
		<th data-name="email_id" data-width="5" data-sortable="true" data-searchable="true">E - mail ID</th>
		<th data-name="contact_no" data-width="5" data-sortable="false" data-searchable="false">Contact No</th>
		<th data-name="status" data-width="5" data-sortable="false" data-searchable="false">Status</th>
		<th data-name="action" data-width="5" data-sortable="false" data-searchable="false" align="center">Actions</th>
	    </tr>
        </thead>

        <tbody></tbody>
    </table>


</div>
<?php include_once 'footer.php'; ?>
<script type="text/javascript">

    $(document).ready(function() {
	// assign datatable to the user listing table 
	AssignDataTable('user-lists');
    });


</script>

