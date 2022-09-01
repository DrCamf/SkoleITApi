<?php
namespace Phppot;

$result = $userModel->getAllUser();
if (! empty($result)) {
    ?>
<h3>Imported records:</h3>
<table id='userTable'>
	<thead>
		<tr>
			<th>User Name</th>
			<th>First Name</th>
			<th>Last Name</th>
		</tr>
	</thead>
<?php
    foreach ($result as $row) {
        ?>
    <tbody>
		<tr>
			<td><?php  echo $row['userName']; ?></td>
			<td><?php  echo $row['firstName']; ?></td>
			<td><?php  echo $row['lastName']; ?></td>
		</tr>
                    <?php
    }
    ?>
    </tbody>
</table>
<?php 
} 
?>