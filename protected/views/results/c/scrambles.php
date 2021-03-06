<?php
$this->renderPartial('c/dropdownEvents', $_data_);
$this->widget('GroupGridView', array(
  'dataProvider'=>new CArrayDataProvider($scrambles, array(
    'pagination'=>false,
    'sort'=>false,
  )),
  'itemsCssClass'=>'table table-condensed table-hover table-boxed',
  'groupKey'=>'eventId',
  'groupHeader'=>'implode("&nbsp;&nbsp;&nbsp;&nbsp;", array(
    Events::getFullEventNameWithIcon($data->eventId),
    Yii::t("RoundTypes", $data->round->cellName),
    CHtml::tag("a", ["id"=>$data->eventId], ""),
  ))',
  'repeatHeader'=>true,
  'rowHtmlOptionsExpression'=>'array(
    "data-event"=>$data->eventId,
    "data-round"=>$data->roundTypeId,
  )',
  'columns'=>array(
    array(
      'name'=>Yii::t('Scrambles', 'Group'),
      'value'=>'$data->groupId',
    ),
    array(
      'name'=>Yii::t('Scrambles', 'No.'),
      'type'=>'raw',
      'value'=>'$data->num',
    ),
    array(
      'name'=>Yii::t('Scrambles', 'Scramble'),
      'type'=>'raw',
      'value'=>'$data->formattedScramble',
      'htmlOptions'=>array(
        'class'=>'scramble',
      ),
    ),
  ),
)); ?>
