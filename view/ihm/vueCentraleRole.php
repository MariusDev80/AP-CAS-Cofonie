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
		public function ajouterRole($nbRoles,$tousLesInstitutions, $nbInstits)
		{
			$listeInstitution = explode("|", $tousLesInstitutions);
			echo '<table class="table table-striped table-bordered table-sm ">
						<thead>
						<tr>
							<th scope="col">Id Role</th>
							<th scope="col">Id Institution</th>
							<th scope="col">Intitulé du role</th>
							<th scope="col">Valider<th>
						</tr>
					</thead>
					<tbody>
						<form action=index.php?vue=role&action=saisirRole method=POST align=center autocomplete="off">
							<tr>
								<th scope="col"><input type=number name="idRole" value='.($nbRoles+1).' readonly  ></th>
								<th scope="col"><input list="Institution" name="idInstitution"></th>
								<th scope="col"><input type=text name="libelleRole"></th>
								<th scope="col"><input type="submit" class="btn btn-primary" value=Valider></input></th>
							</tr>
				 		</form>
					</tbody>
				</table>
				
				<datalist id="Institution">';
				for ($i = 0; $i < $nbInstits*2; $i=$i+2){
					echo "<option value='" . $listeInstitution[$i] . "-" . $listeInstitution[$i+1] . "'></option>";
				}
				echo '</datalist>';
		}
	}
?>