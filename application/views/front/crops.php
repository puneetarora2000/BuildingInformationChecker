<div class="content">	


			<h2><?php echo $title;?></h2>
<?php //var_dump($divisible_crops);
	//var_dump($indivisible_crops);
		 ?>

<div class="panel panel-default">
	<div class="panel-heading"><b>Crops List</b></div>
	<div class="panel-body">
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>Divisible Crops</th>
					<th>Non Divisible Crops</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="text-left">
						<ol class="point-num-list1">
						<?php foreach ($divisible_crops as $crop) {
							echo '<li>'.$crop->CropName.'</li>';
						}?>
						</ol>
					</td>
					<td class="text-left">
						<ol class="point-num-list1">
						<?php foreach ($indivisible_crops as $crop) {
							echo '<li>'.$crop->CropName.'</li>';
						}?>
						</ol>
					</td>
				</tr>
			</tbody>
		</table>

	</div>
</div>


</div>