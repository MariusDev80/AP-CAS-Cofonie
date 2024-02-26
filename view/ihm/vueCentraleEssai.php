<?php
	
	class vueCentraleEssai
	{
		public function __construct()
		{
			
		}
		
		public function visualiserEssai($message)
		{
			$listeEssai=explode("|", $message);

			echo '<table class="table table-striped table-bordered table-sm ">
					<thead>
						<tr>
							<th scope="col">ID Essai</th>
							<th scope="col">Libelle Essai</th>
						</tr>
					</thead>
					<tbody>';

			$nbE=0;
			while ($nbE<sizeof($listeEssai))
			{	
				$i=0;
				while (($i<2) && ($nbE<sizeof($listeEssai)))
				{
					echo '<td scope>';
						echo trim($listeEssai[$nbE]);
					$i++;
					$nbE++;
					echo '</td>';
				}
				echo '</tr>';
			}
			echo '</tbody>';
			echo '</table>';
			
		}
		public function ajouterEssai()
		{

			echo "<BR>je suis dans l'ajout d'un essai";
	
		}
	
}
?>