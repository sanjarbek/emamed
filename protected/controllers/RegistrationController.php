<?php

class RegistrationController extends Controller
{
    /**
     * @var private property containing the associated Patient model instance.
     */
    private $_patient = null;

	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
        return CMap::mergeArray(parent::filters(),array(
//			'accessControl', // perform access control for CRUD operations
            'patientContext + create admin adminmanage', //check to ensure valid patient context
            'postOnly + delete', // we only allow deletion via POST request
            array(
                'application.filters.GridViewHandler' //path to GridViewHandler.php class
            )
        ));
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Registration;

        $model->reg_patient = $this->_patient->patient_id;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Registration']))
		{
			$model->attributes=$_POST['Registration'];
			if($model->save())
            {
                if( Yii::app()->request->isAjaxRequest )
                {
                    echo CJSON::encode( array(
                        'status' => 'success',
                        'div' => 'Registration successfully updated',
                    ));
                    Yii::app()->end();
                }
                else
                {
                    $this->redirect(array('view','id'=>$model->reg_id));
                }
            }
		}

        if( Yii::app()->request->isAjaxRequest )
        {
            // To prevent js files conflict on client side.
            Yii::app()->clientscript->scriptMap['jquery.js'] = false;
            Yii::app()->clientscript->scriptMap['bootstrap.js'] = false;
            Yii::app()->clientscript->scriptMap['bootstrap.bootbox.min.js'] = false;
            Yii::app()->clientscript->scriptMap['redactor.min.js'] = true;

            echo CJSON::encode( array(
                'status' => 'failure',
                'div' => $this->renderPartial( '_form', array(
                    'model' => $model), true, true ),
            ));
            Yii::app()->end();
        }
        else
        {
            $this->render('create',array(
                'model'=>$model,
            ));
        }

    }

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Registration']))
		{
			$model->attributes=$_POST['Registration'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->reg_id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Registration');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
//		$model=new Registration('search');
//
//		$model->unsetAttributes();  // clear any default values
//		if(isset($_GET['Registration']))
//			$model->attributes=$_GET['Registration'];
//
//        $model->reg_patient = $this->_patient->patient_id;



        if( Yii::app()->request->isAjaxRequest)
        {
            Yii::app()->clientscript->scriptMap['jquery.js'] = false;
            Yii::app()->clientscript->scriptMap['bootstrap.js'] = false;
            Yii::app()->clientscript->scriptMap['jquery.min.js'] = false;
            Yii::app()->clientscript->scriptMap['bootstrap.min.js'] = false;
            Yii::app()->clientscript->scriptMap['bootstrap.bootbox.min.js'] = false;
            Yii::app()->clientscript->scriptMap['bootstrap.datepicker.js'] = false;
            Yii::app()->clientscript->scriptMap['jquery.ba-bbq.js'] = false;
            Yii::app()->clientscript->scriptMap['jquery-ui.min.js'] = false;
            Yii::app()->clientscript->scriptMap['jquery.yiigridview.js'] = false;

            echo CJSON::encode( array(
                'status' => 'successfully',
                'div' => $this->renderPartial('admin',
                    array( 'patient_id'=>$this->_patient->patient_id), true, true),
            ));
            Yii::app()->end();
        }

//        echo CJSON::encode( array(
//            'status' => 'failure',
//            'div' => $this->renderPartial('admin', array( 'patient_id'=>$this->_patient->patient_id), true, true),
//        ));
//        Yii::app()->end();

//        $this->render('admin',array(
//			'model'=>$model, 'patient_id'=>$this->_patient->patient_id
//		));
	}
    /**
     * Manages all models.
     */
    public function actionAdminManage()
    {
		$model=new Registration('search');

		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Registration']))
			$model->attributes=$_GET['Registration'];

        $model->reg_patient = $this->_patient->patient_id;

        $this->render('adminmanage',array(
			'model'=>$model, 'patient'=>$this->_patient
		), false, true);
    }


    /**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Registration::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='registration-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function _getGridViewRegistrationGrid()
	{     
        $model=new Registration('search');

		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Registration']))
			$model->attributes=$_GET['Registration'];

        $model->reg_patient = $this->_patient->patient_id;

        $this->renderPartial('_gridview',array(
			'model'=>$model, 'patient_id'=>$this->_patient->patient_id
		));
    }

    /**
     * In-class defined filter method, configured for use in the above filters() method
     * It is called before the actionCreate() action method is run in order to ensure a proper project context
     */

    public function filterPatientContext($filterChain)
    {
        //set the project identifier based on either the GET or POST input
        //request variables, since we allow both types for our actions

        $patientId = null;
        if(isset($_GET['pid']))
            $patientId = $_GET['pid'];
        else if (isset($_POST['pid']))
            $patientId = $_POST['pid'];

        $this->loadPatient($patientId);

        // complete the running of other filters and execute the requested action
        $filterChain->run();
    }

    /**
    * Protected method to load the associated Project model class
    * @project_id the primary identifier of the associated Project
    * @return object the Project data model based on the primary key
    */
    protected function loadPatient($patient_id)
    {
        //if the project property is null, create it based on input id
        if($this->_patient===null)
        {
            $this->_patient=Patient::model()->findbyPk($patient_id);
            if($this->_patient===null)
            {
                throw new CHttpException(404,'The requested patient does not exist.');
            }
        }
        return $this->_patient;
    }

    public function actionRelation()
    {
// partially rendering "_relational" view
        $id = Yii::app()->getRequest()->getParam('id');
        $this->renderPartial('_relation', array(
            'id' => $id,
            'gridDataProvider' => Registration::model()->getGridDataProvider($id),
            'gridColumns' => $this->getGridColumns(),
        ), false, true);
    }

    public function getGridColumns()
    {
        $gridColumns = array(
            //this for the auto page number of cgridview
            array(
                'name'=>'No',
                'type'=>'raw',
                'value'=>'$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1',
                'filter'=>false,
                'sortable'=>false,
            ),
            array(
                'name'=>'reg_id',
                'value'=>'$data->reg_id',
                'filter'=>false,
                'sortable'=>false,
            ),
//            array(
//                'name'=>'reg_patient',
//                'value'=>'CHtml::encode($data->regPatient->patient_fullname)',
//                'filter'=>false,
//            ),
            array(
                'name'=>'reg_mrtscan',
                'value'=>'CHtml::encode($data->regMrtscan->mrtscan_name)',
                'filter'=>false,
                'sortable'=>false,
            ),
            array(
                'name'=>'reg_price',
                'value'=>'$data->reg_price',
                'filter'=>false,
                'sortable'=>false,
            ),
            array(
                'name'=>'reg_discont',
                'value'=>'$data->reg_discont',
                'filter'=>false,
                'sortable'=>false,
            ),
            array(
                'name'=>'reg_total_price',
                'value'=>'$data->reg_total_price',
                'filter'=>false,
                'sortable'=>false,
            ),

        );

        return $gridColumns;
    }

    public function actionReport()
    {
        $model=new Registration();
        $model->unsetAttributes();  // clear any default values

//        if(isset($_GET['Patient']))
//            $model->attributes=$_GET['Patient'];

        $this->widget('ext.EExcelView', array(
            'dataProvider'=> $model->report(), //new CActiveDataProvider(NetClientType),
            'grid_mode'=>'export',
            'exportType'=> 'Excel2007',
            'columns'=> array(
                array(
                    'name'=>'patient',
                    'value'=>'CHtml::encode($data->regPatient->patient_fullname . " " . $data->regPatient->patient_birthday)',
                ),
                array(
                    'name'=>'patient_phone',
                    'value'=>'CHtml::encode($data->regPatient->patient_phone)',
                ),
//
                array(
                    'name'=>'patient_doctor',
                    'value'=>'CHtml::encode($data->regPatient->patientDoctor->doctor_fullname . " "
                                . $data->regPatient->patientDoctor->doctorHospital->hospital_name)',
                ),
                array(
                    'name'=>'hospital_phone',
                    'value'=>'CHtml::encode($data->regPatient->patientDoctor->doctorHospital->hospital_phone)',
                ),
                array(
                    'name'=>'mrtscan_name',
                    'value'=>'CHtml::encode($data->regMrtscan->mrtscan_name)',
                ),
//                'created_at',
            ),
        ));
        Yii::app()->end();
    }

    public function actionDoctorReport()
    {
        $model=new Registration();
        $model->unsetAttributes();  // clear any default values

//        if(isset($_GET['Patient']))
//            $model->attributes=$_GET['Patient'];

        $data = $model->getDoctorReport();
        $this->widget('ext.EExcelView', array(
            'dataProvider'=> $data, //new CActiveDataProvider(NetClientType),
            'grid_mode'=>'export',
            'exportType'=> 'Excel2007',
            'columns'=> array(
                array(
                    'name'=>'doctor',
                    'value'=>'$data["doctor_fullname"]',
                ),
                array(
                    'name'=>'doctor_phone',
                    'value'=>'$data["doctor_phone"]',
                ),
                array(
                    'name'=>'date',
                    'value'=>'$data["created_at"]',
                ),
                array(
                    'name'=>'quantity',
                    'value'=>'$data["quantity"]',
                ),
                array(
                    'name'=>'price',
                    'value'=>'$data["price"]',
                ),
            ),
        ));
        Yii::app()->end();
    }




}
