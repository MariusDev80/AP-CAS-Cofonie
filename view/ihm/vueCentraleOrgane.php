<?php
	
	class vueCentraleOrgane
	{
		public function __construct()
		{
			
		}
			
		public function visualiserOrgane($message)
		{
			$listeOrgane=explode("|",$message);
			
			echo '<table class="table table-striped table-bordered table-sm ">
					<thead>
						<tr>
							<th scope="col">Id Organe</th>
							<th scope="col">Nom Organe</th>
							<th scope="col">Nombre de personnes</th>
						</tr>
					</thead>
					<tbody>';	
			$nbE=0;
			while ($nbE<sizeof($listeOrgane))
			{	
				$i=0;
				while (($i<3) && ($nbE<sizeof($listeOrgane)))
				{
					echo '<td scope>';
						echo trim($listeOrgane[$nbE]);
					$i++;
					$nbE++;
					echo '</td>';
				}
				echo '</tr>';
			}
			echo '</tbody>';
			echo '</table>';
		}
		public function ajouterOrgane($nbOrgane)
		{

			echo '<table class="table table-striped table-bordered table-sm ">
					<thead>
						<tr>
							<th scope="col">Id Organe</th>
							<th scope="col">Nom Organes</th>
							<th scope="col">Nombre de personne</th>
							<th scope="col">Valider<th>
						</tr>
					</thead>
					<tbody>
						<form action=index.php?vue=organe&action=saisirOrgane method=POST align=center autocomplete="off">
							<fieldset>
								<tr>
									<th scope="col"><input type=number name="idOrgane" value='.($nbOrgane+1).' readonly></th>
									<th scope="col"><input type=text name="nomOrgane"></th>
									<th scope="col"><input type=number name="nbPersonne"></th>
									<th scope="col"><input type="submit" class="btn btn-primary" value=Valider></input></th>
								</tr>
							</fieldset>
				 </form>
					</tbody>
				</table>';
	
		}
	
}
?>