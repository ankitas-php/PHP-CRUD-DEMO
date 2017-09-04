<script src="<?php echo SITE_URL; ?>bootstrap/js/bootstrap.min.js"></script>
<script>

    var dataTable;

    function delete_user(user_id) {
	var x = confirm("Are you sure you want to delete?");
	if (x) {
	    $.ajax({
		data: {user_id: user_id, action: 'delete_user'},
		url: "ajax.php",
		type: 'POST',
		success: function(response) {
		    dataTable.ajax.reload();

		},
	    });
	}

    }

    function dataTableAction() {

	$('.user_status').unbind('change');

	$('.user_status').change(function() {
	    var user_status = ($(this).is(':checked')) ? "1" : "0";
	    var user_id = $(this).attr('data-id');
	    $.ajax({
		data: {user_id: user_id, action: 'change_user_status', user_status: user_status},
		url: "ajax.php",
		type: 'POST',
		success: function(response) {
		    dataTable.ajax.reload();

		},
	    });
	});

    }

    function AssignDataTable(TABLE_ID) {
	var columns = $('#' + TABLE_ID).find('thead').find('tr').find('th');
	var columnDefs = [];
	var columnFilter = new Array;
	var aoColumns = new Array;
	var ORDER_ROW = $('#' + TABLE_ID).attr('data-order-by');
	var ORDER_TYPE = $('#' + TABLE_ID).attr('data-order-type');
	var ACTION = $('#' + TABLE_ID).attr('data-action');
	columns.each(function(i) {
	    var bSortable = false;
	    var bSearchable = false;
	    if ($(this).attr('data-searchable') == "true") {
		bSearchable = true;
	    }
	    if ($(this).attr('data-sortable') == "true") {
		bSortable = true;
	    }
	    if ($(this).attr('data-class') != undefined) {
		columnDefs.push({"className": $(this).attr('data-class'), "target": i});
	    }
	    columnFilter.push({"bSortable": bSortable, "bSearchable": bSearchable, "sWidth": $(this).attr('data-width') + "%"});
	    aoColumns.push({"data": $(this).attr('data-name'), "sWidth": $(this).attr('data-width') + "%"});
	});
	dataTable = $('#' + TABLE_ID).DataTable({
	    "iDisplayLength": 10,
	    "columnDefs": columnDefs,
	    "aoColumns": aoColumns,
	    "columnFilter": columnFilter,
	    "bFilter": true,
	    "order": [[ORDER_ROW, ORDER_TYPE]],
	    "retrieve": true,
	    "preDrawCallback": function(settings) {
		$("#loading").show();
	    },
	    "oLanguage": {
		"sProcessing": '<div id="loading"><img id="loading-image" src="assets/images/ajax-loader.gif" alt="Loading..."> </div>'
	    },
	    "bProcessing": true,
	    "bServerSide": true,
	    "sAjaxSource": "ajax.php?action=" + ACTION,
	    "fnServerData": function(sSource, aoData, fnCallback, oSettings) {
		$.getJSON(sSource, aoData, function(json) {
		    if (json.error != '') {
			alert(json.error);
		    } else {
			fnCallback(json);
			$('.user_status').bootstrapToggle();
			dataTableAction();
		    }
		    $('#loading').hide();
		});
	    },
	});
    }

</script>
</body>
</html>
