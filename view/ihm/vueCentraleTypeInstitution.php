<?php
	
	class vueCentraleTypeInstitution
	{
		public function __construct()
		{
			
		}
		
		public function visualiserTypeInstitution($message)
		{
			$listeTypeInstitution=explode("|", $message);

			echo '<table class="table table-striped table-bordered table-sm ">
					<thead>
						<tr>
							<th scope="col">ID Type Institution</th>
							<th scope="col">Libelle Type Institution</th>
						</tr>
					</thead>
					<tbody>';

			$nbE=0;
			while ($nbE<sizeof($listeTypeInstitution))
			{	
				$i=0;
				while (($i<2) && ($nbE<sizeof($listeTypeInstitution)))
				{
					echo '<td scope>';
						echo trim($listeTypeInstitution[$nbE]);
					$i++;
					$nbE++;
					echo '</td>';
				}
				echo '</tr>';
			}
			echo '</tbody>';
			echo '</table>';
			
		}
		public function ajouterTypeInstitution()
		{

			echo "<BR>je suis dans l'ajout d'un type d'institution";
	
		}
		public function selectionModification($message)
		{
			echo '<table class="table table-striped table-bordered table-sm ">
						<thead>
						<tr>
							<th scope="col">Libelle Institution</th>
							<th scope="col">Valider<th>
						</tr>
					</thead>
					<tbody>
						<form action=index.php?vue=typeinstitution&action=modifier method=POST align=center autocomplete="off">
							<tr>
								<th>';
								echo $message;
								echo '</th>
								<th scope="col"><input type="submit" class="btn btn-primary" value=Valider></input></th>
							</tr>
				 		</form>
					</tbody>
				</table>';
		}
	
}
?>