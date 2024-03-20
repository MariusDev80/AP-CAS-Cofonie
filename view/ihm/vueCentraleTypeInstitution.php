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
		public function ajouterTypeInstitution($nbTypeInstitutions)
		{
			echo '<table class="table table-striped table-bordered table-sm ">
					<thead>
						<tr>
							<th scope="col">ID TYPE INSTITUTION</th>
							<th scope="col">LIBELLE TYPE INSTITUTION</th>
						</tr>
					</thead>
					<tbody>
						<form action=index.php?vue=typeinstitution&action=saisirTypeInstitution method=POST align=center autocomplete="off">
							<fieldset>
								<tr>
									<th scope="col"><input type=number name="idTypeInstitution" value='.($nbTypeInstitutions+1).' readonly></th>
									<th scope="col"><input type=text name="libelleTypeInstitution"></th>
									<th scope="col"><input type="submit" class="btn btn-primary" value=Valider></input></th>
								</tr>
							</fieldset>
				 </form>
					</tbody>
				</table>';
		}
	}

?>