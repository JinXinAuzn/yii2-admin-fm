<?php

namespace jx\admin_fm\controllers;

use jx\admin_fm\components\Configs;
use jx\admin_fm\components\Helper;
use yii\rbac\Item;
use Yii;
use jx\admin_fm\models\AuthItem;
use jx\admin_fm\models\searchs\AuthItem as AuthItemSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
/**
 * PermissionController implements the CRUD actions for AuthItem model.
 *
 * @property integer $type
 * @author Au zn <690550322@qq.com>
 * @since Full version
 */
class PermissionController extends BaseController
{
	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['post'],
					'assign' => ['post'],
					'remove' => ['post'],
				],
			],
		];
	}

	/**
	 * @description 权限列表
	 * Lists all AuthItem models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new AuthItemSearch(['type' => $this->type]);
		$dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

		return $this->render('index', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
		]);
	}

	/**
	 * @description 权限详情
	 * Displays a single AuthItem model.
	 * @return mixed
	 * @throws NotFoundHttpException
	 */
	public function actionView()
	{
		$model = $this->findModel();

		return $this->render('view', ['model' => $model]);
	}

	/**
	 * @description 权限创建
	 * Creates a new AuthItem model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new AuthItem(null);
		$model->type = $this->type;
		if ($model->load(Yii::$app->getRequest()->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->name]);
		} else {
			return $this->render('create', ['model' => $model]);
		}
	}

	/**
	 * @description 权限更新
	 * Updates an existing AuthItem model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 * @throws NotFoundHttpException
	 */
	public function actionUpdate()
	{
		$model = $this->findModel();
		if ($model->load(Yii::$app->getRequest()->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->name]);
		}

		return $this->render('update', ['model' => $model]);
	}

	/**
	 * @description 权限删除
	 * Deletes an existing AuthItem model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @return mixed
	 * @throws NotFoundHttpException
	 */
	public function actionDelete()
	{
		$model = $this->findModel();
		Configs::authManager()->remove($model->item);
		Helper::invalidate();

		return $this->redirect(['index']);
	}

	/**
	 * @description 权限分配
	 * Assign items
	 * @return array
	 * @throws NotFoundHttpException
	 */
	public function actionAssign()
	{
		$items = Yii::$app->getRequest()->post('items', []);
		$model = $this->findModel();
		$success = $model->addChildren($items);
		Yii::$app->getResponse()->format = 'json';
		return array_merge($model->getItems(), ['success' => $success]);
	}

	/**
	 * @description 权限分配删除
	 * Assign or remove items
	 * @return array
	 * @throws NotFoundHttpException
	 */
	public function actionRemove()
	{
		$items = Yii::$app->getRequest()->post('items', []);
		$model = $this->findModel();
		$success = $model->removeChildren($items);
		Yii::$app->getResponse()->format = 'json';

		return array_merge($model->getItems(), ['success' => $success]);
	}

	/**
	 * @inheritdoc
	 */
	public function getViewPath()
	{
		return $this->module->getViewPath() . DIRECTORY_SEPARATOR . 'item';
	}

	/**
	 * Finds the AuthItem model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @return AuthItem the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel()
	{
		$id=Yii::$app->request->get('id');
		$auth = Configs::authManager();
		$item = $this->type === Item::TYPE_ROLE ? $auth->getRole($id) : $auth->getPermission($id);
		if ($item) {
			return new AuthItem($item);
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

    /**
     * @inheritdoc
     */
    public function labels()
    {
        return[
            'Item' => 'Permission',
            'Items' => 'Permissions',
        ];
    }

    /**
     * @inheritdoc
     */
    public function getType()
    {
        return Item::TYPE_PERMISSION;
    }
}
