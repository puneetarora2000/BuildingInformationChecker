<?php defined('BASEPATH') OR exit('No direct script access allowed');
//var_dump($list); ?>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/sbadmin/bower_components/bootstrap/dist/css/bootstrap.min.css');?>">
<style type="text/css">
.dotted-field {
   	border-bottom: 1px dashed #000 !important;
   	padding: 0 20px 1px 20px;
   	width: 100px;
   	
}
</style>
<div class="container">
	<div class="row text-center">
		<h2>Punjab Seed Certification Authority</h2>
		<h4>Regional Office: <?php echo $list[0]->SeedCertificationAuthority;?> </h4>
	</div>
	<div class="row">
		<div class="col-xs-6 col-md-4">
			To <span class="dotted-field"><?php echo $list[0]->SeedProducerID;?> </span><br/>
			&nbsp;&nbsp;&nbsp;	<span class="dotted-field">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><br/>
			&nbsp;&nbsp;&nbsp;	<span class="dotted-field">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
		</div>
		<br/>
		<div class="col-xs-6 col-md-4">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</div>
		<div class="col-xs-6 col-md-4">
			Date: <?php echo $list[0]->created_at;?> 
		</div>
	</div>
	<br/>
	<div class="row">
		<div class="col-xs-6 col-md-4">
			Subject: Seed Sample Test Report
		</div>
		<br/>
		<div class="col-xs-12 col-md-8">
			According to the Letter No. <?php echo $list[0]->ResultLetterNo;?> By the Testing Labortary <?php echo $list[0]->SeedCertificationAuthority;?> and Date <?php echo $list[0]->SampleResultDate;?>, following is the testing report of your seed samples.
		</div>
	</div>
	<br/>
<div class="row">
<table class="table table-bordered">
 <thead>
 		<tr>
 		<td>S No.</td>
<?php  foreach ($list[0] as $columnname => $columnval) { 
		if(($columnname == 'id') || ($columnname == 'SentSampleID') || ($columnname == 'SeedProducerID') || ($columnname == 'SeedSampleDate') || ($columnname == 'ForwardingNo') || ($columnname == 'GrowingPower') || ($columnname == 'SeedPurity') || ($columnname == 'ODV') || ($columnname == 'Laboratory') || ($columnname == 'SeedCertificationAuthority') || ($columnname == 'RegionalCertificationOfficerSignature') || ($columnname == 'branch') || ($columnname == 'created_at'))
		{
			continue;
		} else {
		?>
 			<th style="padding: 4px"><?php echo preg_replace('/(?<!\ )[A-Z]/', ' $0', $columnname); 	?></th>
<?php	}
	   }
 ?>
 		</tr>
 </thead>
 <tbody>
 	<?php 	$sno = 1;
 			foreach ($list as $row) {
 			echo '<tr>';
 			echo '<td>'.$sno.'</td>';
 			foreach ($row as $columnname => $columnval) { 
 				if(($columnname == 'id') || ($columnname == 'SentSampleID') || ($columnname == 'SeedProducerID') || ($columnname == 'SeedSampleDate') || ($columnname == 'ForwardingNo') || ($columnname == 'GrowingPower') || ($columnname == 'SeedPurity') || ($columnname == 'ODV') || ($columnname == 'Laboratory') || ($columnname == 'SeedCertificationAuthority') || ($columnname == 'RegionalCertificationOfficerSignature') || ($columnname == 'branch') || ($columnname == 'created_at'))
				{
					continue;
				} else {
 					echo '<td style="padding: 4px">'.$columnval.'</td>';
 				}
 				
 			}
 			echo '</tr>';
 			$sno++;
 	} ?>
 </tbody>
 </table>
 	<div class="text-right"><?php echo 'Signature <br/>'.$list[0]->RegionalCertificationOfficerSignature;?>
 	</div>
 </div>
</div>