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
							<th scope="col">Valider<th>
						</tr>
					</thead>
					<tbody>
						<form action=index.php?vue=institution&action=saisirInstitution method=POST align=center autocomplete="off">
							<fieldset>
								<tr>
									<th scope="col"><input type=number name="idInstitution" value='.($nbInstitutions+1).' readonly></th>
									<th scope="col"><input type=text name="libelleInstitution"></th>
									<th scope="col"><input type="submit" class="btn btn-primary" value=Valider></input></th>
								</tr>
							</fieldset>
				 </form>
					</tbody>
				</table>';
	
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
						<form action=index.php?vue=institution&action=modifier method=POST align=center autocomplete="off">
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
		public function modification($message,$id)
		{
			echo '<table class="table table-striped table-bordered table-sm ">
					<thead>
						<tr>
							<th scope="col">Nouveau libelle</th>
							<th scope="col">Valider<th>
						</tr>
					</thead>
					<tbody>
						<form action=index.php?vue=institution&action=modification method=POST align=center autocomplete="off">
							<fieldset>
								<tr>
								     
									<th scope="col"><input type=text name="libelleModification" value = '.$message.'></th>
									<input type=hidden name="idModification" value = '.$id.'>
									<th scope="col"><input type="submit" class="btn btn-primary" value=Valider></input></th>
								</tr>
							</fieldset>
				 		</form>
					</tbody>
				</table>';
		}
	}
?>