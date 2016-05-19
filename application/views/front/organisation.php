<div class="content">	


			<h2><?php echo $title;?></h2>

<div class="panel panel-default">
	<div class="panel-heading"><b>PSSCA Staff List</b></div>
	<div class="panel-body">
	<table class="table table-striped table-responsive">
		<thead>
			<tr>
				<th>S No.</th>
				<th>Name</th>
				<th>Designation</th>
				<th>Region</th>
				<th>Email</th>
				<th>Mobile</th>
			</tr>
		</thead>
		<?php 
		$sno = 1;
		foreach ($employees as $memployee) { ?>
			<tr>
				<td><?php echo $memployee->EmployeeNumber;?></td>
				<td><?php echo $memployee->suffix.' '.$memployee->firstName.' '.$memployee->lastName;?></td>
				<td><?php echo $memployee->DesignationID;?></td>
				<td><?php echo $memployee->RegionID;?></td>
				<td><?php echo $memployee->email;?></td>
				<td><?php echo $memployee->contact;?></td>
			</tr>
		<?php
		$sno++;
		}
		?>	
	</table>
	
	<?php //  var_dump($employees); ?>
		
	</div>
</div>


</div>