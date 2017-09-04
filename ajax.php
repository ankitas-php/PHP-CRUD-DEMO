<?php

include_once 'dbconfig.php'; // load the configuration file

/* action to change the current status of user */
if (isset($_REQUEST['action']) && !empty($_REQUEST['action']) && $_REQUEST['action'] == 'change_user_status') {
    echo $user_id = $_POST['user_id'];
    $status = $_POST['user_status'];
    if ($crud->change_status($user_id, $status)) {
	echo true;
	exit;
    }
}

/* action to delete a user permanently */
if (isset($_REQUEST['action']) && !empty($_REQUEST['action']) && $_REQUEST['action'] == 'delete_user') {

    $id = $_POST['user_id'];
    if ($crud->delete($id)) {
	echo true;
	exit;
    }
}

/* action to load list of all users using datatable ajax call */
if (isset($_REQUEST['action']) && !empty($_REQUEST['action']) && $_REQUEST['action'] == 'users_list') {

    $aColumns = explode(',', $_REQUEST['sColumns']);

    // get the query limit
    if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
	$LIMIT_QUERY = " LIMIT " . $_GET['iDisplayStart'] . ", " . $_GET['iDisplayLength'];
    }

    // get the query order
    $sOrder = "";
    if (isset($_GET['iSortCol_0']) && $_GET['bSortable_' . $_GET['iSortCol_0']] == "true") {
	$sOrder .= " ORDER BY ";
	$sOrder .= $aColumns[$_GET['iSortCol_0']];
	$sOrder = (trim($sOrder) == "ORDER BY") ? "" : $sOrder . " " . strtoupper($_GET['sSortDir_0']) . " ";
    }

    // get the query search variable
    $Query_search = "";
    $Static_Query_search = "";
    if (isset($_GET['sSearch']) && trim($_GET['sSearch']) != '') {
	$like_arr = array();
	for ($i = 0; $i < intval(count($aColumns)); $i++) {
	    if ($_GET['bSearchable_' . $i] == "true") {
		$like_arr[] = $aColumns[$i] . " LIKE '%" . ($_GET['sSearch']) . "%' ";
	    }
	}
	$Query_search = (count($like_arr) > 0) ? " WHERE ( " . implode(" OR ", $like_arr) . " ) " : "";
    }

    $query = "SELECT id,first_name,last_name,email_id,contact_no,status FROM tbl_users";
    $records_per_page = 10; // number of records to be shown per page
    $result = $crud->dataview($query, $LIMIT_QUERY, $sOrder, $Query_search); // call dataview method defined in the class to show user listing
    $output = array(
	"sEcho" => intval($_GET['sEcho']),
	"iTotalRecords" => $result['num_row'],
	"iTotalDisplayRecords" => $result['num_row'],
	"numRows" => (int) $_GET['iDisplayLength'],
	"aaData" => $result['users'],
	'start' => $_GET['iDisplayStart'],
	'error' => ''
    );

    echo json_encode($output);
}
?>