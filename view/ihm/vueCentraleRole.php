<?php
	
	class vueCentraleRole
	{
		public function __construct()
		{
			
		}
		
		public function visualiserRole()
		{
			$listeRole=explode("|",$message);

			echo '<table class="table table-striped table-bordered table-sm ">
					<thead>
						<tr>
							<th scope="col">Id Role</th>
							<th scope="col">Id institution/th>
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
		public function ajouterRole()
		{

			echo '<form action=index.php?vue=vehicule&action=saisirVehicule method=POST align=center>
							<fieldset>
								<input type=number name="idRole" >
								<input type=text name="libelleRole">
														
							<input type="submit" class="btn btn-primary" value=Valider></input>
							</fieldset>	
				 </form>';
	
		}
	
}
?>