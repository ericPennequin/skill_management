
<?php
/**
 * Created by IntelliJ IDEA.
 * User: eric.pennequin
 * Date: 13/02/2018
 * Time: 17:52
 */
$rootUrl = "../";

?>
<?php require '../inc/header.php'?>
<?php require require "Controler/Person.php"?>
<!--

-->

	<script src="<?=$rootUrl?>lib/DataTables/datatables.js"></script>
	<link rel="stylesheet" href="<?=$rootUrl?>lib/DataTables/datatables.min.css">


<script>
	$(document).ready(function() {



		<?php
		//$dayToConvert= new Convert();
		//$today=$dayToConvert->dateToTimestamp(date('Y-m-d'));
		$personToDisplay=new Person();


		?>

		$('#defaultTable').append(
			''
		)//Ici on entre le header
		// ici on fait une requête ajax
		var table={command:'adminView'};

		$.ajax({
			url: '../Model/Querys.php',
			type:'GET',
			data:table,
			success: function (result) {
				var jsonResult = JSON.parse(result);

			}
			dataTableInit();

			});


//div du input--> children du div : id="editing-view-port"



	} );

function dataTableInit() {
	$('#defaultTable').DataTable();

}


</script>


<table id="defaultTable">
	<tbody id="body">

	</tbody>
</table>


<?php require '../inc/footer.php'?>