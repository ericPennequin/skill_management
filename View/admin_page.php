
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
<!--

-->

	<script src="<?=$rootUrl?>lib/DataTables/datatables.js"></script>
	<link rel="stylesheet" href="<?=$rootUrl?>lib/DataTables/datatables.min.css">


<script>
	$(document).ready(function() {


		$('#defaultTable').append(
			'<thead> <th>nom</th><th>prenom</th></thead>'
		)//Ici on entre le header
		// ici on fait une requête ajax
		var table={command:'userConnection'};

		$.ajax({
			url: '../Model/Querys.php',
			type:'GET',
			data:table,
			success: function (result) {
				var jsonResult = JSON.parse(result);

			}

			})

			;

		$('#defaultTable').DataTable();

//div du input--> children du div : id="editing-view-port"
		$('#toto').click(function(){
			//action de la fonction
			appelmafonction()
		})


	} );




</script>

<input type="button" id="toto">
<table id="defaultTable">


</table>


<?php require '../inc/footer.php'?>