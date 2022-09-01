
<?php
if($_POST) {
    
    echo "videre";

require_once 'lib/UserModel.php';
$userModel = new UserModel();
if (isset($_POST["import"])) {
    $response = $userModel->readUserRecords();
}
} else {
    echo "hej";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link href="style.css" rel="stylesheet" type="text/css" />
<script src="jquery-3.2.1.min.js"></script>
<script type="text/javascript">
function validateFile() {
    var csvInputFile = document.forms["frmCSVImport"]["file"].value;
    if (csvInputFile == "") {
      error = "No source found to import. Please choose a CSV file. ";
      $("#response").html(error).addClass("error");;
      return false;
    }
    return true;
  }
</script>
</head>
<body>
    <h2>Upload CSV</h2>
<form action="" method="post" name="frmCSVImport" id="frmCSVImport"
	enctype="multipart/form-data" onsubmit="return validateFile()">
	<div Class="input-row">
		<label>Coose your file. <a href="./import-template.csv" download>Download
				template</a></label> <input type="file" name="file" id="file"
			class="file" accept=".csv,.xls,.xlsx">
		<div class="import">
			<button type="submit" id="submit" name="import" class="btn-submit">Import
				CSV and Save Data</button>
		</div>
	</div>
</form>
</body>
</html>