<?php
$this->pageTitle=Yii::app()->name;
?>
<div style="width:100%;text-align:center">
	<a  href="#feedback" data-toggle="modal" class="btn btn-success">Форма обратной связи</a>
</div>

<div id="feedback" class="modal fade" style="display:none">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="float:right;padding-bottom:15px">
					<img src="/img/close.png" alt="Закрыть"/>
				</button>
			</div>
			<div id="feedback_body" class="modal-body" style="text-align:center">
				<?php $form = $this->beginWidget('CActiveForm', array(
					'id'=>'message-form',
					'enableAjaxValidation'=>false,
				)); ?>
				<?php echo $form->errorSummary($model); ?>

			<div style="width:20%;float:left">
				<?php echo $form->label($model, 'name')?>
			</div>
			<div style="width:60%;float:left">
				<?php echo $form->textField($model,'name',array('size'=>50,'placeholder'=>'Введите Имя')); ?>
				<?php echo $form->error($model, 'name'); ?>
			</div>
			<div style="clear:both;height:20px"></div>

			<div style="width:20%;float:left">
				<?php echo $form->label($model, 'email')?>
			</div>
			<div style="width:60%;float:left">
				<?php echo $form->textField($model,'email',array('size'=>50,'placeholder'=>'Введите Почту')); ?>
				<?php echo $form->error($model, 'email'); ?>
			</div>
			<div style="clear:both;height:20px"></div>

			<div style="width:20%;float:left">
				<?php echo $form->labelEx($model, 'body'); ?>
			</div>
			<div style="width:60%;float:left">
				<?php echo $form->textArea($model, 'body', array('style' => 'height:60px;width:413px;')); ?>
				<?php echo $form->error($model, 'body'); ?>
			</div>
			<div style="clear:both;height:20px"></div>

			<div style="width:80%;float:left">
				<?php $this->widget('CCaptcha')?>
			</div>
			<div style="clear:both;height:20px"></div>

			<div style="width:20%;float:left">
				<?php echo $form->labelEx($model, 'verifyCode'); ?>
			</div>
			<div style="width:60%;float:left">
				<input id="Message_verifyCode" type="text" value="" style="width:413px;">
			</div>
			<div style="clear:both;height:20px"></div>

				<?php $this->endWidget(); ?>
			</div>
			<div class="modal-footer" style="text-align:center">
				<img src="/img/ajax-loader.gif" id="ajax-loader" style="display:none"/>
				<button id="send" type="button" class="btn btn-success">
					Отправить вопрос
				</button>
			</div>
		</div>
	</div>
</div>
<script>
function isValidEmail(email,strict){
	if ( !strict ) email = email.replace(/^\s+|\s+$/g, '');
	return !(/^([a-z0-9_\-]+\.)*[a-z0-9_\-]+@([a-z0-9][a-z0-9\-]*[a-z0-9]\.)+[a-z]{2,4}$/i).test(email);
}
jQuery(document).ready(function(){
	$('#send').click(function(){
		var good=true;
		if ($('#Message_name').val()==''){
			good=false;
			$('#Message_name').css({'border-color':'red'});
		}else
			$('#Message_name').css({'border-color':'green'});
		if ($('#Message_email').val()=='' || isValidEmail($('#Message_email').val(),true)){
			good=false;
			$('#Message_email').css({'border-color':'red'});
		}else
			$('#Message_email').css({'border-color':'green'});
		if ($('#Message_body').val()==''){
			good=false;
			$('#Message_body').css({'border-color':'red','border-width':'2px'});
		}else
			$('#Message_body').css({'border-color':'green'});
		if ($('#Message_verifyCode').val()==''){
			good=false;
			$('#Message_verifyCode').css({'border-color':'red','border-width':'2px'});
		}else
			$('#Message_verifyCode').css({'border-color':'green'});
		if(good){
			$('#ajax-loader').show();
			$.ajax({
				url: '/site/message',
				type: "POST",
				dataType:"json",
				data:{
					'name':$('#Message_name').val(),
					'email':$('#Message_email').val(),
					'body':$('#Message_body').val(),
					'verifyCode':$('#Message_verifyCode').val()
				},
				success: function(data) {
					if (data.answer==0){
						alert('Капча не сработала, введите снова');
						$('#Message_verifyCode').val('');
					}else{
						$('#send').hide();
						$('#feedback_body').html(data.answer);
					}
					$('#ajax-loader').hide();
				}
			});
		}
	});
});
</script>
