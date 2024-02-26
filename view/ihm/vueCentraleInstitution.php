<?php
	
	class vueCentraleInstitution
	{
		public function __construct()
		{
			
		}
		
		public function visualiserInstitution($message)
		{
			
			$listeInstitution=explode("|",$message);
			
			echo '<table class="table table-striped table-bordered table-sm ">
					<thead>
						<tr>
							<th scope="col">Id Institution</th>
							<th scope="col">Libelle institution</th>
						</tr>
					</thead>
					<tbody>';	
			$nbE=0;
			while ($nbE<sizeof($listeInstitution))
			{	
				$i=0;
				while (($i<2) && ($nbE<sizeof($listeInstitution)))
				{
					echo '<td scope>';
						echo trim($listeInstitution[$nbE]);
					$i++;
					$nbE++;
					echo '</td>';
				}
				echo '</tr>';
			}
			echo '</tbody>';
			echo '</table>';
		}
		public function ajouterInstitution($nbInstitutions)
		{

			echo '<table class="table table-striped table-bordered table-sm ">
					<thead>
						<tr>
							<th scope="col">Id Institution</th>
							<th scope="col">Libelle Institution</th>
						</tr>
					</thead>
					<tbody>
						<form action=index.php?vue=institution&action=saisirInstitution method=POST align=center autocomplete="off">
							<fieldset>
								<tr>
									<th scope="col"><input type=number name="idInstitution" value='.($nbInstitutions+1).' readonly></th>
									<th scope="col"><input type=text name="libelleInstitution"></th>
								</tr>
							</fieldset>
							<input type="submit" class="btn btn-primary" value=Valider></input>
				 </form>
					</tbody>
				</table>';
	
		}
	
}
?>