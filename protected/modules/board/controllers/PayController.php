<?php

class PayController extends AdminController {

	public function accessRules() {
		return array(
			array(
				'allow',
				'roles'=>array(
					'role'=>User::ROLE_ORGANIZER,
				),
			),
			array(
				'deny',
				'users'=>array('*'),
			),
		);
	}

	public function actionIndex() {
		$model = new Pay();
		$model->unsetAttributes();
		$model->attributes = $this->aRequest('Pay');
		$model->type = Pay::TYPE_REGISTRATION;
		if ($this->user->isOrganizer() && $model->type_id == null) {
			$model->type_id = 0;
		}
		if ($this->user->isOrganizer() && $model->competition && !isset($model->competition->organizers[$this->user->id])) {
			Yii::app()->user->setFlash('danger', '权限不足！');
			$this->redirect(array('/board/pay/index'));
		}
		$this->render('index', array(
			'model'=>$model,
		));
	}

	public function actionBill() {
		$model = new Pay();
		$model->unsetAttributes();
		$model->attributes = $this->aRequest('Pay');
		$model->channel = Pay::CHANNEL_BALIPAY;
		$model->status = Pay::STATUS_PAID;
		$this->render('bill', [
			'model'=>$model,
		]);
	}
}
