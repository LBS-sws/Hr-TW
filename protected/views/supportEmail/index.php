<?php
$this->pageTitle=Yii::app()->name . ' - supportEmail';
?>

<?php $form=$this->beginWidget('TbActiveForm', array(
    'id'=>'supportEmail-list',
    'enableClientValidation'=>true,
    'clientOptions'=>array('validateOnSubmit'=>true,),
    'layout'=>TbHtml::FORM_LAYOUT_INLINE,
)); ?>

<section class="content-header">
    <h1>
        <strong><?php echo Yii::t('app','Email support employee'); ?></strong>
    </h1>
</section>

<section class="content">
    <?php
    $search = array(
        'code',
        'name',
        'position',
        'department',
    );

    if (!Yii::app()->user->isSingleCity()) $search[] = 'city_name';
    $this->widget('ext.layout.ListPageWidget', array(
        'title'=>Yii::t('contract','Employee List'),
        'model'=>$model,
        'viewhdr'=>'//supportEmail/_listhdr',
        'viewdtl'=>'//supportEmail/_listdtl',
        'gridsize'=>'24',
        'height'=>'600',
        'search'=>$search,
    ));
    ?>
</section>
<?php
echo $form->hiddenField($model,'pageNum');
echo $form->hiddenField($model,'totalRow');
echo $form->hiddenField($model,'orderField');
echo $form->hiddenField($model,'orderType');
?>
<?php $this->endWidget(); ?>

<?php
$js = "
    $('.submit_select').on('change',function(){
        $('form:first').submit();
    });
";
Yii::app()->clientScript->registerScript('calcFunction',$js,CClientScript::POS_READY);
$js = Script::genTableRowClick();
Yii::app()->clientScript->registerScript('rowClick',$js,CClientScript::POS_READY);
?>

