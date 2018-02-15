<?php
/**
 * Created by IntelliJ IDEA.
 * User: eric.pennequin
 * Date: 13/02/2018
 * Time: 17:52
 */
$rootUrl = "../";

?>
<?php require '../inc/header.php' ?>

<!--

-->

<script src="<?= $rootUrl ?>lib/DataTables/datatables.js"></script>
<!--<script src="<?/*= $rootUrl */?>Controler/LoadView.js"></script>-->
<link rel="stylesheet" href="<?= $rootUrl ?>lib/DataTables/datatables.css">


<script>
	$(document).ready(function () {


		/**TODO :
		 *  Injecter les th via Jquery
		 *  Récupérer la session admin/user
		 *  Insérer lien vers profil user
		 *  Faire plus beau
		 *  Faire une classe pour le JS ?
		 * */



		let table = {command: 'adminView'};
		let th = 1;
		let isAdmin = true;

		$.ajax({
			url: '../Model/Querys.php',
			type: 'GET',
			data: table,
			success: function (result) {
				//décodage du Json en array :
				let jsonResult = JSON.parse(result);
				//Injection des balises tr selon le nombre d'index (Lignes)
				for (let idx = 0; idx < jsonResult.length; idx++) {

					let idtd = "idtd" + idx;

					$('#body').append("<tr id=" + idtd + " ></tr>")

					//Pour chaque index, on récupère l'objet Json
					let subJsonResult = jsonResult[idx];

					// Injection des balises td avec le contenu (Colonnes)
					for (let key in subJsonResult) {

							if (key != 'id_person') {
								//Pour ajout en dynamique des balises th
								if (0 == th) {

									$('#head').append("<th id='' >" + key + "</th>");


								}


								if(key=="firstname"|| key =="lastname"){
									$('#' + idtd).append("<td id='"+key+ subJsonResult[key]+"' >" + subJsonResult[key] + "</td>");
									//implémentation du lien pour ouvrir le profil
									let table={command:'profilViewer', id_person:subJsonResult['id_person']};
									/*
									$('#' + key+ subJsonResult[key]).click(
										$.ajax({
											url:'../Model/Querys.php',
											type:'GET',
											data:table,
											success:function(result){
												let jsonResult = JSON.parse(result);
												console.log(jsonResult)

											}
										})
									)

									*/

								}else {
									$('#' + idtd).append("<td id='' >" + subJsonResult[key] + "</td>");

								}
							}

					}
					if (isAdmin == true) {

						//Pour ajout en dynamique des balises th
						if (0 == th) {

							$('#head').append("<th id='' >Supprimer</th>");

						}

						$('#' + idtd).append("<td id='' ><input type='button' value='Supprimer " + jsonResult[idx].firstname + "' id=" + jsonResult[idx].id_person + "></td>");

							//implémentation de la suppression du profil
							let table={command:'deleteUser', id_person:jsonResult[idx]['id_person']};

						/*
						$('#'+ jsonResult[idx].id_person).click(

								$.ajax({
									url:'../Model/Querys.php',
									type:'POST',
									data:table,
									success:function(result){
										let jsonResult = JSON.parse(result);
										console.log(jsonResult)
									}
								})
						)
						*/


					}

					th = 1;
				}
				dataTableInit()

			}
		});



		/**Attention, pour que Datatable fonctionne :
		 * 	Il doit y avoir un thead
		 * 	le nombre de balise th dans le thead doit absolument être le même que le nombre de colonne.
		 * --> Voir comment injecter les th avec les bons noms.
		 * */

	});



	//$('#editing-view-port').find('div').change(console.log('ok2'));


	function dataTableInit() {

		$('#defaultTable').DataTable()
/*

		//partie pour filtre personnalisé
		let dataTable = $('#defaultTable').DataTable();

		$("#search_box").on('keyup', function() {
			dataTable.search( this.value ).draw();
		});

*/

	}

</script>
<!--	partie pour filtre personnalisé

<style>
	.dataTables_filter { display: none; }
</style>

	<input type="text" class="form-control" placeholder="Recherche ..." id="search_box" >
-->


	<table id="defaultTable" class="display table table-bordered table-hover" cellspacing="0" width="100%">
	<thead>
	<tr id="head">
		<th>Prénom</th>
		<th>Nom</th>
		<th>N°tél</th>
		<th>Email</th>
		<th>Photo</th>
		<th>Etablissement</th>
		<th>Lieux</th>
		<th>Suppression</th>

	</tr>
	</thead>
	<tbody id="body">

	</tbody>
</table>


<?php require '../inc/footer.php' ?>