<?php
// include '../Includes/dbcon.php';
require_once "../engine/database.php";


$tid = intval($_GET['tid']);

if ($tid == 2) {
    echo '
    <div class="form-group row mb-3">
        <div class="col-xl-6">
            <label class="form-label">Select Date<span class="text-danger ml-2">*</span></label>
            <input type="date" class="form-control" name="singleDate">
        </div>
    </div>';
} else if ($tid == 3) {
    echo '
    <div class="form-group row mb-3">
        <div class="col-xl-6">
            <label class="form-label">From Date<span class="text-danger ml-2">*</span></label>
            <input type="date" class="form-control" name="fromDate">
        </div>
        <div class="col-xl-6">
            <label class="form-label">To Date<span class="text-danger ml-2">*</span></label>
            <input type="date" class="form-control" name="toDate">
        </div>
    </div>';
}
?>
