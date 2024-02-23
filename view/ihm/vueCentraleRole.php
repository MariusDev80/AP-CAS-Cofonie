<?php
include_once('autoload.php');
	class vueCentraleRole
	{
		public function __construct()
		{
			
		}
		public function visualiserRole($message)
		{
			
			$listeRole=explode("|",$message);
			
			echo '<table class="table table-striped table-bordered table-sm ">
					<thead>
						<tr>
							<th scope="col">Id Role</th>
							<th scope="col">Id institution</th>
							<th scope="col">Intitulé du role</th>
						</tr>
					</thead>
					<tbody>';	
			$nbE=0;
			while ($nbE<sizeof($listeRole))
			{	
				$i=0;
				while (($i<3) && ($nbE<sizeof($listeRole)))
				{
					echo '<td scope>';
						echo trim($listeRole[$nbE]);
					$i++;
					$nbE++;
					echo '</td>';
				}
				echo '</tr>';
			}
			echo '</tbody>';
			echo '</table>';
		}
		public function ajouterRole($nbRoles, $tousLesInstitutions)
		{
			echo '<table class="table table-striped table-bordered table-sm ">
					<thead>
						<tr>
							<th scope="col">Id Role</th>
							<th scope="col">Id institution</th>
							<th scope="col">Intitulé du role</th>
						</tr>
					</thead>
					<tbody>
						<form action=index.php?vue=role&action=saisirRole method=POST align=center>
							<fieldset>
								<tr>
									<th scope="col"><input type=number name="idRole" value='.($nbRoles+1).' readonly  ></th>
									<th scope="col"><input list="Institution" name="idInstitution"></th>
									<th scope="col"><input type=text name="libelleRole"></th>
								</tr>							
							</fieldset>
							<input type="submit" class="btn btn-primary" value=Valider></input>
				 </form>
					</tbody>
				</table>
				
				<datalist id="Institution">';
			foreach($tousLesInstitutions as $uneInstitution)
  				echo '<option value='.$uneIntitution->get("id").' - '.$uneInstitution->get("libelle").'>';
			echo '</datalist>';
			echo '<br>';
		}
	}
?>