<?php $this->Html->script(array('ckeditor/ckeditor'), array('inline'=>false));?>

<style>
	.score_values label.error{ margin-left: -154px; margin-top: 38px; position: absolute;}
	.mboxes { padding-bottom: 17px;}
	#TextBoxesGroup{ width:546px;}
</style>

	<div class="faqs row">
    <div class="floatleft mtop10"><h1><?php echo __('Add WOD Dictionary'); ?></h1></div>
    <div class="floatright">
        <?php
		echo $this->Html->link('<span>'.__('Back To Manage WOD').'</span>', array('controller' => 'wods','action' => 'index','admin' => true),array('class'=>'black_btn','escape'=>false));?>
	</div>
	<div class="errorMsg"><?php echo $this->element('/admin/validations'); ?></div>
</div>

<div align="center" class="whitebox mtop15">
    <?php
     echo $this->Session->flash('error');
     echo $this->Form->create('Wod');?>
    <table cellspacing="0" cellpadding="7" border="0" align="center" width="450">
		<tr>
			<td align="left"><strong class="upper">Title</strong></td>
			<td align="left"><?php	echo $this->Form->input('title',array('class' => 'input required', 'label' => false, 'error' => false, 'div' => false, 'style'=>'width: 450px;'));?>
			</td>
		</tr>
		<tr>
			<td align="left"><strong class="upper">Notes</strong></td>
			<td align="left"><?php	echo $this->Form->input('description',array('class' => 'input required','type'=>'textarea', 'label' => false, 'error' => false, 'div' => false, 'style'=>'width: 450px;'));?>
			</td>
		</tr>
		<tr>
			<td align="left"><strong class="upper">Details</strong></td>
			<td align="left"><?php	echo $this->Form->input('details',array('class' => 'input required','type'=>'textarea', 'label' => false, 'error' => false, 'div' => false, 'style'=>'width: 450px;'));?>
			</td>
		</tr>
		<?php 
			$wod_types = array(
								'AMRAP' => 'AMRAP (As Many Rounds As Possible)',
								'AMREP' => 'AMREP (As Many Reps As Possible)',
								'Time' => 'Time',
								'Distance' => 'Distance',
								'Load' => 'Load',
								'Reps' => 'Reps',
								'Rounds For Time' => 'Rounds For Time',
								'EMOM' => 'Every Minute On the Minute'
							);
		?>
		<tr>
			<td align="left"><strong class="upper">WOD Type</strong></td>
			<td align="left"><?php	echo $this->Form->input('wod_type',array('class' => 'input required','type'=>'select','empty' => 'Please select','options' => $wod_types, 'label' => false, 'error' => false, 'div' => false, 'style'=>'width: 450px;'));?>
			</td>
		</tr>
		
		<?php if(isset($data)){ ?>
			<tr>
				
							<td align="left"><strong class="upper">Adjusted Criteria</strong></td>
							<td align="left" class="score_values"><?php	echo $this->Form->input('adjusted_criteria',array('type'=>'select', 
																										'class' => 'input', 
																										'options' => array('time'=>'Time', 'distance' => 'Distance', 'reps' =>'Reps', 'load' => 'Load', 'rounds' => 'Rounds'), 
																										'label' => false, 
																										'error' => false, 
																										'div' => false, 
																										'style' => 'width: 200px; '
																							)); 
								
								echo $this->Form->input('adjusted_criteria_value', array('class' => 'input required number','label' => false,'div' => false,'placeholder' => 'value') );															
								?>
							</td>
			</tr>
						
						
				
		<?php } ?>	
		<!--<tr>
			<td align="left"><strong class="upper">WOD categories</strong></td>
			<td align="left"><?php	echo $this->Form->input('category_id',array('class' => 'input required','type'=>'select','options' => $categories, 'label' => false, 'error' => false, 'div' => false, 'style'=>'width: 450px;'));?>
			</td>
		</tr>
		<tr>
			<td align="left"><strong class="upper">WOD Type</strong></td>
			<td align="left"><?php	echo $this->Form->input('type_id',array('class' => 'input required','type'=>'select','empty' => 'Please select','options' => $types, 'label' => false, 'error' => false, 'div' => false, 'style'=>'width: 450px;'));?>
			</td>
		</tr>
		<tr>
			<td align="left"><strong class="upper">WOD Subtype</strong></td>
			<td align="left"><?php	echo $this->Form->input('sub_type',array('class' => 'input','type'=>'select', 'label' => false, 'error' => false, 'div' => false, 'style'=>'width: 450px;'));?>
			</td>
		</tr>
		<tr>
			<td align="left"><strong class="upper">Number of rounds</strong></td>
			<td align="left"><?php	echo $this->Form->input('rounds',array('class' => 'input', 'label' => false, 'error' => false, 'div' => false, 'style'=>'width: 450px;'));?>
			</td>
		</tr>
		<tr>
			<td align="left"><strong class="upper">Result based on</strong></td>
			<td align="left">
				<?php	
				echo $this->Form->input('result_type', array(
						    'between' => '  ',
						    'separator' => ' ',
						    'type' => 'radio',
						    'options' => array('time' => 'Time', 'reps' => 'Reps','load' => 'Load','rounds' => 'Rounds','distance' => 'Distance'),
						    'value' => 'time',
						    'legend' => false
						));
				?>
			</td>
		</tr>-->
		
		
		<tr>
		<td colspan="2">
			<h2>Add Movements</h2>
			<div id="TextBoxesGroup">
				
				<?php if ( !isset($data) ){  ?>
				<div id="movementsDataBoxHtml1" class="mboxes">
					<table>
						<tr>
							<td align="left"><strong class="upper">movements</strong></td>
							<td align="left"><?php	echo $this->Form->input('movement_category][',array('type'=>'select', 'class' => 'input', 'options' => $movements, 'label' => false, 'error' => false, 'div' => false, 'style'=>'width: 450px;')); ?>
							</td>
						</tr>
						<tr>
							<td align="left"><strong class="upper">Scoring</strong></td>
							<td align="left" class="score_values">
								<?php				
								echo $this->Form->input('movement_option][',array('type'=>'select', 'class' => 'input optionSelected', 'options' => array('time' => 'Time', 'distance' => 'Distance','load' => 'Load', 'reps' => 'Reps', 'rounds' => 'Rounds') , 'label' => false, 'error' => false, 'div' => false, 'style'=>'width: 200px;'));
								echo $this->Form->input('option_data][', array('class' => 'input required number','label' => false,'div' => false,'placeholder' => 'value') );
								echo $this->Form->input('movement_distance][',array('type'=>'select', 'class' => 'input distanceOption', 'options' => array('mile' => 'Mile','meter' => 'Meter'), 'label' => false, 'error' => false, 'div' => false, 'style'=>'width: 70px; display:none;'));
								echo $this->Form->input('movement_load][',array('type'=>'select', 'class' => 'input loadOption', 'options' => array('lbs' => 'lbs','kg' => 'Kg'), 'label' => false, 'error' => false, 'div' => false, 'style'=>'width: 70px;display:none;')); 
								?>
								
							</td>
						</tr>
					</table>
				</div>
				<?php }else{ 
					
					if(!empty($data['movement_category'])) {
						
						for($j=0; $j<count($data['movement_category']); $j++){
				?>
							
				<div id="movementsDataBoxHtml1" class="mboxes">
					<table>
						<tr>
							<td align="left"><strong class="upper">movements</strong></td>
							<td align="left"><?php	echo $this->Form->input('movement_category][',array('type'=>'select', 'class' => 'input', 'options' => $movements, 'selected' => $data['movement_category'][$j], 'label' => false, 'error' => false, 'div' => false, 'style'=>'width: 450px;')); ?>
							</td>
						</tr>
						<tr>
							<td align="left"><strong class="upper">Scoring</strong></td>
							<td align="left" class="score_values">
								<?php				
								echo $this->Form->input('movement_option][',array('type'=>'select', 'class' => 'input optionSelected', 'selected' => $data['movement_option'][$j] ,'options' => array('time' => 'Time', 'distance' => 'Distance','load' => 'Load', 'reps' => 'Reps', 'rounds' => 'Rounds') , 'label' => false, 'error' => false, 'div' => false, 'style'=>'width: 200px;'));
								echo $this->Form->input('option_data][', array('class' => 'input required number','label' => false,'div' => false,'placeholder' => 'value', 'value'=>$data['option_data'][$j]) );
								
								
								$dstyle = $lstyle = '';
								if($data['movement_option'][$j] == 'load')
									$dstyle = 'display: none';
								if($data['movement_option'][$j] == 'distance')
									$lstyle = 'display: none';
								
								
								echo $this->Form->input('movement_distance][',array('type'=>'select', 'class' => 'input distanceOption', 'selected' => $data['movement_distance'][$j], 'options' => array('mile' => 'Mile','meter' => 'Meter'), 'label' => false, 'error' => false, 'div' => false, 'style'=>'width: 70px;'.$dstyle));
								echo $this->Form->input('movement_load][',array('type'=>'select', 'class' => 'input loadOption','selected' => $data['movement_load'][$j], 'options' => array('lbs' => 'lbs','kg' => 'Kg'), 'label' => false, 'error' => false, 'div' => false, 'style'=>'width: 70px;display:none;'.$lstyle)); 
								?>
								
							</td>
						</tr>
					</table>
				</div>
				
			
					
					
				<?php 		}
						}
					} 
				?>	
			</div>	
			<input type='button' value='Add Movements' id='addButton'>&nbsp;
			<input type='button' value='Remove Movements' id='removeButton' style="display:none;">	
		</td>
        <tr>
            <td align="left"></td>
            <td align="left"><div class="black_btn2"><span class="upper"><?php echo $this->Form->end(__('Submit'));?></span></div></td>
        </tr>  
    </table>
</div>

<div id="movementsDataBoxHtml" style="display: none">
	<table>
		<tr>
			<td align="left"><strong class="upper">movements</strong></td>
			<td align="left"><?php	echo $this->Form->input('Wod.movement_category][',array('type'=>'select', 'class' => 'input', 'options' => $movements, 'label' => false, 'error' => false, 'div' => false, 'style'=>'width: 450px;')); ?>
			</td>
		</tr>
		<tr>
			<td align="left"><strong class="upper">Scoring</strong></td>
			<td align="left" class="score_values">
				<?php				
				echo $this->Form->input('Wod.movement_option][',array('type'=>'select','class' => 'input optionSelected', 'options' => array('time' => 'Time', 'distance' => 'Distance','load' => 'Load', 'reps' => 'Reps', 'rounds' => 'Rounds') , 'label' => false, 'error' => false, 'div' => false, 'style'=>'width: 200px;'));
				echo $this->Form->input('Wod.option_data][', array('class' => 'input required number','label' => false,'div' => false,'placeholder' => 'value') );
				echo $this->Form->input('Wod.movement_distance][',array('type'=>'select', 'class' => 'input distanceOption', 'options' => array('mile' => 'Mile','meter' => 'Meter'), 'label' => false, 'error' => false, 'div' => false, 'style'=>'width: 70px; display:none;'));
				echo $this->Form->input('Wod.movement_load][',array('type'=>'select', 'class' => 'input loadOption', 'options' => array('lbs' => 'lbs','kg' => 'Kg'), 'label' => false, 'error' => false, 'div' => false, 'style'=>'width: 70px;display:none;')); 
				?>
				
			</td>
		</tr>
	</table>
</div>
<?php
$this->Js->get('#WodTypeId')->event('change', 
	$this->Js->request(array(
		'controller'=>'movements',
		'action'=>'get_by_type'
		), array(
		'update'=>'#WodSubType',
		'async' => true,
		'method' => 'post',
		'dataExpression'=>true,
		'data'=> $this->Js->serializeForm(array(
			'isForm' => true,
			'inline' => true
			))
		))
	);
?>
<script type="text/javascript">


$(document).ready(function(){ 
    var counter = 2;
    $("#addButton").click(function () { 
	    var html = $("#movementsDataBoxHtml").html();
		$("#TextBoxesGroup").append('<div id="TextBoxDiv'+ counter +'" class="mboxes">'+ html + '</div>');
		counter++;
		
		if(counter > 1)
		{
			$('#removeButton').show();	
		}
     });
 
     $("#removeButton").click(function () {
		if(counter==1){
	          alert("No more textbox to remove");
	          return false;
	       } 	 
		counter--;	
		if(counter == 2)
		{
			$('#removeButton').hide();	
		} 
        $("#TextBoxDiv" + counter).remove();
 
     });
     
    $(".optionSelected").live('change',function(){
		var selectedOption = $(this).val();
		
		var parentId = $(this).parents('div').attr("id");
		
		if ( selectedOption == 'distance'){
			$('#' + parentId + ' .distanceOption').show();
			$('#' + parentId + ' .loadOption').hide();
		}else if ( selectedOption == 'load'){
			$('#' + parentId + ' .distanceOption').hide();
			$('#' + parentId + ' .loadOption').show();
		}else{
			$('#' + parentId + ' .distanceOption').hide();
			$('#' + parentId + ' .loadOption').hide();
		}
	});
     
  });

  
$(function(){ 
  $('#WodAdminAddForm').validate({
  	
    submitHandler: function(form) {   
   			var textarea = document.getElementById('WodDetails'); 
   			CKEDITOR.instances[textarea.id].updateElement(); // update textarea
   			 var editorcontent = textarea.value.replace(/<[^>]*>/gi, ''); // strip tags
   			if(editorcontent.length == 0)
   			{
   				alert('Please enter Wod Details');
   			}else{             
                form.submit();
            }
        
         return false;
    } 
  	
  });
});

	CKEDITOR.replace( 'WodDescription' ,
	{
		toolbar: [
			{ name: 'document', items: [ 'Source', '-', 'NewPage', 'Preview', '-', 'Templates' ] },	// Defines toolbar group with name (used to create voice label) and items in 3 subgroups.
			[ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],			// Defines toolbar group without name.
			'/',																					// Line break - next group will be placed in new line.
			{ name: 'basicstyles', items: [ 'Bold', 'Italic' ] }
		]
	});
	CKEDITOR.replace( 'WodDetails' ,
	{
		toolbar: [
			{ name: 'document', items: [ 'Source', '-', 'NewPage', 'Preview', '-', 'Templates' ] },	// Defines toolbar group with name (used to create voice label) and items in 3 subgroups.
			[ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],			// Defines toolbar group without name.
			'/',																					// Line break - next group will be placed in new line.
			{ name: 'basicstyles', items: [ 'Bold', 'Italic' ] }
		]
	});
	
</script>
<?php
if (class_exists('JsHelper') && method_exists($this->Js, 'writeBuffer')) echo $this->Js->writeBuffer();
// Writes cached scripts
?>