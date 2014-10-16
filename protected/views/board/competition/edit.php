<div class="row">
  <div class="col-lg-12">
    <div class="page-title">
      <h1><?php echo $model->isNewRecord ? '新增' : '编辑'; ?>比赛</h1>
    </div>
  </div>
  <!-- /.col-lg-12 -->
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="portlet portlet-default">
      <div class="portlet-heading">
          <div class="portlet-title">
              <h4>比赛信息</h4>
          </div>
          <div class="clearfix"></div>
      </div>
      <div class="panel-collapse collapse in">
          <div class="portlet-body">
            <?php $form = $this->beginWidget('CActiveForm', array(
              'htmlOptions'=>array(
                'class'=>'clearfix row',
              ),
              'enableClientValidation'=>true,
            )); ?>
            <?php echo Html::formGroup(
              $model, 'name_zh', array(
                'class'=>'col-lg-6',
              ),
              $form->labelEx($model, 'name_zh', array(
                'label'=>'中文名',
              )),
              Html::activeTextField($model, 'name_zh'),
              $form->error($model, 'name_zh', array('class'=>'text-danger'))
            );?>
            <?php echo Html::formGroup(
              $model, 'name', array(
                'class'=>'col-lg-6',
              ),
              $form->labelEx($model, 'name', array(
                'label'=>'英文名',
              )),
              Html::activeTextField($model, 'name'),
              $form->error($model, 'name', array('class'=>'text-danger'))
            );?>
            <div class="clearfix"></div>
            <?php echo Html::formGroup(
              $model, 'type', array(
                'class'=>'col-lg-3 col-md-6',
              ),
              $form->labelEx($model, 'type', array(
                'label'=>'类型',
              )),
              $form->dropDownList($model, 'type', $types, array(
                'class'=>'form-control',
              )),
              $form->error($model, 'type', array('class'=>'text-danger'))
            );?>
            <?php echo Html::formGroup(
              $model, 'check_person', array(
                'class'=>'col-lg-3 col-md-6',
              ),
              $form->labelEx($model, 'check_person', array(
                'label'=>'报名自动审核',
              )),
              $form->dropDownList($model, 'check_person', $checkPersons, array(
                'class'=>'form-control',
              )),
              $form->error($model, 'check_person', array('class'=>'text-danger'))
            );?>
            <div class="clearfix hidden-lg"></div>
            <?php echo Html::formGroup(
              $model, 'entry_fee', array(
                'class'=>'col-lg-3 col-md-6'
              ),
              $form->labelEx($model, 'entry_fee', array(
                'label'=>'基础报名费',
              )),
              Html::activeTextField($model, 'entry_fee'),
              $form->error($model, 'entry_fee', array('class'=>'text-danger'))
            );?>
            <?php echo Html::formGroup(
              $model, 'person_num', array(
                'class'=>'col-lg-3 col-md-6',
              ),
              $form->labelEx($model, 'person_num', array(
                'label'=>'人数限制',
              )),
              Html::activeTextField($model, 'person_num'),
              $form->error($model, 'person_num', array('class'=>'text-danger'))
            );?>
            <div class="clearfix"></div>
            <?php echo Html::formGroup(
              $model, 'date', array(
                'class'=>'col-lg-3 col-md-6',
              ),
              $form->labelEx($model, 'date', array(
                'label'=>'日期',
              )),
              Html::activeTextField($model, 'date', array(
                'class'=>'date-picker',
                'data-date-format'=>'yyyy-mm-dd',
              )),
              $form->error($model, 'date', array('class'=>'text-danger'))
            );?>
            <?php echo Html::formGroup(
              $model, 'end_date', array(
                'class'=>'col-lg-3 col-md-6',
              ),
              $form->labelEx($model, 'end_date', array(
                'label'=>'结束日期',
              )),
              Html::activeTextField($model, 'end_date', array(
                'class'=>'date-picker',
                'data-date-format'=>'yyyy-mm-dd',
              )),
              $form->error($model, 'end_date', array('class'=>'text-danger'))
            );?>
            <div class="clearfix hidden-lg"></div>
            <?php echo Html::formGroup(
              $model, 'reg_end_day', array(
                'class'=>'col-lg-3 col-md-6',
              ),
              $form->labelEx($model, 'reg_end_day', array(
                'label'=>'注册截止时间',
              )),
              Html::activeTextField($model, 'reg_end_day', array(
                'class'=>'date-picker',
                'data-date-format'=>'yyyy-mm-dd',
              )),
              $form->error($model, 'reg_end_day', array('class'=>'text-danger'))
            );?>
            <?php echo Html::formGroup(
              $model, 'wca_competition_id', array(
                'class'=>'col-lg-3 col-md-6',
              ),
              $form->labelEx($model, 'wca_competition_id', array(
                'label'=>'WCA比赛ID',
              )),
              Html::activeTextField($model, 'wca_competition_id'),
              $form->error($model, 'wca_competition_id', array('class'=>'text-danger'))
            );?>
            <?php echo Html::formGroup(
              $model, 'organizers', array(
                'class'=>'col-lg-12',
              ),
              $form->labelEx($model, 'organizers', array(
                'label'=>'主办方',
              )),
              $form->checkBoxList($model, 'organizers', CHtml::listData($organizers, 'id', 'name_zh'), array(
                'uncheckValue'=>'',
                'container'=>'div',
                'separator'=>'',
                'class'=>'form-control organizer',
                'labelOptions'=>array(
                  'class'=>'checkbox-inline hidden',
                ),
                'template'=>'{beginLabel}{input}{labelTitle}{endLabel}',
              )),
              CHtml::textField('', '', array(
                'class'=>'form-control tokenfield',
                'placeholder'=>'输入名字或拼音',
              )),
              $form->error($model, 'organizers', array('class'=>'text-danger'))
            );?>
            <?php echo Html::formGroup(
              $model, 'delegates', array(
                'class'=>'col-lg-12',
              ),
              $form->labelEx($model, 'delegates', array(
                'label'=>'代表',
              )),
              $form->checkBoxList($model, 'delegates', CHtml::listData($delegates, 'id', 'name_zh'), array(
                'uncheckValue'=>'',
                'container'=>'div',
                'separator'=>'',
                'class'=>'form-control',
                'labelOptions'=>array(
                  'class'=>'checkbox-inline',
                ),
                'template'=>'{beginLabel}{input}{labelTitle}{endLabel}',
              )),
              $form->error($model, 'delegates', array('class'=>'text-danger'))
            );?>
            <?php echo Html::formGroup(
              $model, 'locations', array(
                'class'=>'col-lg-12',
              ),
              $this->widget('MultiLocations', array(
                'model'=>$model,
                'cities'=>$cities,
              ), true),
              $form->error($model, 'locations', array('class'=>'text-danger'))
            );?>
            <?php echo Html::formGroup(
              $model, 'events',array(
                'class'=>'col-lg-12',
              ),
              $form->labelEx($model, 'events', array(
                'label'=>'项目',
              )),
              '<div class="row"><div class="col-lg-12"><strong>常规项目</strong></div></div>',
              $this->widget('EventsForm', array(
                'model'=>$model,
                'name'=>'events',
                'events'=>$normalEvents,
                'type'=>'range',
                'fee'=>true,
                'numberOptions'=>array(
                  'min'=>0,
                  'max'=>4,
                ),
                'feeOptions'=>array(
                  'min'=>0,
                ),
              ), true),
              '<div class="row"><div class="col-lg-12"><strong>其它项目</strong></div></div>',
              $this->widget('EventsForm', array(
                'model'=>$model,
                'name'=>'events',
                'events'=>$otherEvents,
                'type'=>'range',
                'fee'=>true,
                'numberOptions'=>array(
                  'min'=>0,
                  'max'=>4,
                ),
                'feeOptions'=>array(
                  'min'=>0,
                ),
              ), true),
              $form->error($model, 'events', array('class'=>'text-danger'))
            );?>
            <div class="clearfix"></div>
            <?php echo Html::formGroup(
              $model, 'schedules', array(
                'class'=>'col-lg-12',
              ),
              $form->labelEx($model, 'schedules', array(
                'label'=>'赛程',
              )),
              '<div class="text-danger">时间会自动排序，留空时间即可删除某项，无分组请留空</div>',
              $this->widget('SchedulesForm', array(
                'model'=>$model,
                'name'=>'schedules',
              ), true),
              $form->error($model, 'schedules', array('class'=>'text-danger'))
            );?>
            <?php echo Html::formGroup(
              $model, 'regulations_zh', array(
                'class'=>'col-lg-6',
              ),
              $form->labelEx($model, 'regulations_zh', array(
                'label'=>'中文规则',
              )),
              $form->textArea($model, 'regulations_zh', array(
                'class'=>'editor form-control'
              )),
              $form->error($model, 'regulations_zh', array('class'=>'text-danger'))
            );?>
            <?php echo Html::formGroup(
              $model, 'regulations', array(
                'class'=>'col-lg-6',
              ),
              $form->labelEx($model, 'regulations', array(
                'label'=>'英文规则',
              )),
              $form->textArea($model, 'regulations', array(
                'class'=>'editor form-control'
              )),
              $form->error($model, 'regulations', array('class'=>'text-danger'))
            );?>
            <div class="clearfix"></div>
            <?php echo Html::formGroup(
              $model, 'information_zh', array(
                'class'=>'col-lg-6',
              ),
              $form->labelEx($model, 'information_zh', array(
                'label'=>'中文详情',
              )),
              $form->textArea($model, 'information_zh', array(
                'class'=>'editor form-control'
              )),
              $form->error($model, 'information_zh', array('class'=>'text-danger'))
            );?>
            <?php echo Html::formGroup(
              $model, 'information', array(
                'class'=>'col-lg-6',
              ),
              $form->labelEx($model, 'information', array(
                'label'=>'英文详情',
              )),
              $form->textArea($model, 'information', array(
                'class'=>'editor form-control'
              )),
              $form->error($model, 'information', array('class'=>'text-danger'))
            );?>
            <div class="clearfix"></div>
            <?php echo Html::formGroup(
              $model, 'travel_zh', array(
                'class'=>'col-lg-6',
              ),
              $form->labelEx($model, 'travel_zh', array(
                'label'=>'中文交通信息',
              )),
              $form->textArea($model, 'travel_zh', array(
                'class'=>'editor form-control'
              )),
              $form->error($model, 'travel_zh', array('class'=>'text-danger'))
            );?>
            <?php echo Html::formGroup(
              $model, 'travel', array(
                'class'=>'col-lg-6',
              ),
              $form->labelEx($model, 'travel', array(
                'label'=>'英文交通信息',
              )),
              $form->textArea($model, 'travel', array(
                'class'=>'editor form-control'
              )),
              $form->error($model, 'travel', array('class'=>'text-danger'))
            );?>
            <div class="col-lg-12">
              <button type="submit" class="btn btn-default btn-square"><?php echo Yii::t('common', 'Submit'); ?></button>
            </div>
            <?php $this->endWidget(); ?>
          </div>
        </div>
    </div>
  </div>
</div>
<?php
$this->widget('Editor');
Yii::app()->clientScript->registerCssFile('/b/css/plugins/bootstrap-datepicker/datepicker3.css');
Yii::app()->clientScript->registerCssFile('/b/css/plugins/bootstrap-timepicker/bootstrap-timepicker.min.css');
Yii::app()->clientScript->registerCssFile('/b/css/plugins/bootstrap-tokenfield/tokenfield-typeahead.min.css');
Yii::app()->clientScript->registerCssFile('/b/css/plugins/bootstrap-tokenfield/bootstrap-tokenfield.min.css');
Yii::app()->clientScript->registerScriptFile('/b/js/plugins/bootstrap-datepicker/bootstrap-datepicker.js');
Yii::app()->clientScript->registerScriptFile('/b/js/plugins/bootstrap-timepicker/bootstrap-timepicker.min.js');
Yii::app()->clientScript->registerScriptFile('/b/js/plugins/bootstrap-tokenfield/bootstrap-tokenfield.min.js');
Yii::app()->clientScript->registerScriptFile('/b/js/plugins/bootstrap-tokenfield/typeahead.bundle.min.js');
$allCities = json_encode($cities);
$tokens = json_encode(array_map(function($organizer) {
  return array(
    'value'=>$organizer->user->id . '-' . $organizer->user->name_zh,
    'label'=>$organizer->user->name_zh,
  );
}, $model->organizer));
$datum = json_encode(array_map(function($user) {
  return array(
    'full'=>$user->getCompetitionName() . ' ' . $user->id,
    'value'=>$user->id . '-' . $user->name_zh,
    'label'=>$user->name_zh,
  );
}, $organizers));
$organizerNames = json_encode(CHtml::listData($organizers, 'id', 'name_zh'));
Yii::app()->clientScript->registerScript('competition',
<<<EOT
  $('.date-picker').datepicker({
    autoclose: true
  });
  $('.time-picker').timepicker({
    showMeridian: false,
    defaultTime: null
  });
  var allCities = {$allCities};
  $(document).on('change', '.province', function() {
    var city = $(this).parents('.location').find('.city'),
      cities = allCities[$(this).val()] || [];
    city.empty();
    $('<option value="">').appendTo(city);
    $.each(cities, function(id, name) {
      $('<option>').val(id).text(name).appendTo(city);
    });
    if (city.find('option').length == 2) {
      city.find('option:last').prop('selected', true);
    }
  }).on('keydown', '.token-input', function(e) {
    if (e.which == 13) {
      e.preventDefault();
    }
  });
  var organizers = {$organizerNames};
  var engine = new Bloodhound({
    local: {$datum},
    datumTokenizer: function(d) {
      return d.full.split('');
    },
    queryTokenizer: function(d) {
      return d.split('');
    }
  });
  engine.initialize();
  $('.tokenfield').tokenfield({
    tokens: {$tokens},
    typeahead: [
      null,
      {
        source: engine.ttAdapter()
      }
    ]
  }).on('tokenfield:createtoken', function(e) {
    var id = e.attrs.value.split('-')[0];
    if (!organizers[id] || organizers[id] != e.attrs.value.split('-')[1]) {
      e.preventDefault();
    }
    //防止重复的
    $.each($(this).tokenfield('getTokens'), function(index, token) {
      if (token.value === e.attrs.value) {
        e.preventDefault();
        return false;
      }
    });
    if (e.attrs.value == e.attrs.label) {
      e.attrs.label = e.attrs.value.split('-')[1];
    }
  }).on('tokenfield:createdtoken', function(e) {
    $('input.organizer[value="' + e.attrs.value.split('-')[0] + '"]').prop('checked', true);
  }).on('tokenfield:removedtoken', function(e) {
    $('input.organizer[value="' + e.attrs.value.split('-')[0] + '"]').prop('checked', false);
  }).on('tokenfield:edittoken', function(e) {
    e.preventDefault();
  });
EOT
);