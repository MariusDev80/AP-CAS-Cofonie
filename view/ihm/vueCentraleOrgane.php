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
		public function ajouterOrgane()
		{

			echo "<BR>je suis dans l'ajout d'un organe";
	
		}
	
}
?>