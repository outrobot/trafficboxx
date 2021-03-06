<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

        public function actionXml()
        {
            $url = 'http://services.radiatemedia.com/cyrus/rest/city?metro_id=2';
            $i = 1;
            if (($response_xml_data = file_get_contents($url))===false){
                echo "Error fetching XML\n";
            } else {
               libxml_use_internal_errors(true);
               $data = simplexml_load_string($response_xml_data);
               if (!$data) {
                   echo "Error loading XML\n";
                   foreach(libxml_get_errors() as $error) {
                       echo "\t", $error->message;
                   }
               } else {

                   foreach($data->KEYROUTES->ROUTE as $route)
                   {
                       //echo $route->NAME . ': ' . $route->DESCRIPTION . '<br>';
                       //echo $route->DRIVETIME[0]->ROUTEID . '<br>';
                       
                        echo $i . ') <br>';
                        echo 'ID: ' . $route['ID']->__toString();
                        echo '<br>';
                        echo 'Permanent ID: ' . $route->PERMANENTID;
                        echo '<br>';
                        echo 'Name: ' . $route->NAME;
                        echo '<br>';
                        echo 'Description: ' . $route->DESCRIPTION;
                        echo '<br>';
                        echo 'Drivetime: ';
                        echo $route->TRAVEL_TIME->DRIVETIME;
                        echo '<br>';
                        echo 'Delay: ';
                        echo $route->TRAVEL_TIME->DELAYTIME;  
                        echo '<br>';
                        echo 'Length: ';
                        echo $route->TRAVEL_TIME->LENGTH; 
                        echo '<br>';
                        echo 'Avg Speed: ';
                        echo $route->TRAVEL_TIME->AVERAGESPEED; 
                        echo '<br>';
                        echo 'Jam Factor: ' . $route->JAMFACTOR;
                        echo '<br>';
                        echo 'Jam Factor Trend: ' . $route->JAMFACTORTREND;
                        
                        echo '<hr>';
                        $i++;
                   }
                    /*
                   foreach($data->INCIDENTS->INCIDENT as $incident)
                   {                     
                        echo $i . ') <br>';
                        echo 'ID: ' . $incident['ID']->__toString();
                        echo '<br>';
                        echo 'Description: ' . $incident->DESCRIPTION;
                        echo '<br>';
                        echo 'Location: ';
                        echo $incident->LOCATION; 
                        echo '<br>';
                        echo 'Criticality: ';
                        echo $incident->CRITICALITY; 
                        echo '<br>';
                        echo 'Type: ';
                        echo $incident->TYPE['ID']->__toString(); 
                        echo '<br>';
                        echo 'Type ID: ';
                        echo Incident::model()->getTypeId($incident->TYPE['ID']->__toString()); 
                        echo '<br>';
                        echo 'Type Description: ';
                        echo $incident->TYPE_DESC; 
                        echo '<br>';
                        echo 'Direction: ';
                        echo $incident->DIRECTION['VALUE']; 
                        echo '<br>';
                        echo 'GPS Lat: ';
                        echo $incident->GEOLOCATION['LATITUDE']->__toString(); 
                        echo '<br>';
                        echo 'GPS Lng: ';
                        echo $incident->GEOLOCATION['LONGITUDE']->__toString(); 
                        echo '<br>';
                        echo 'Start Time: ';
                        echo $incident->STARTTIME['VALUE'];
                        echo '<br>';
                        echo 'End Time: ';
                        echo $incident->ENDTIME['VALUE'];
                        
                        
                        echo '<hr>';
                        $i++;
                   }
                    * 
                    */
               }
            }
        }
        
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
        
        public function actionGenerateUrl()
        {
            $token = 'pk.eyJ1Ijoib3V0cm9ib3QiLCJhIjoiSHFjYTVEcyJ9.A1HPH5dGkeA2ultB60BMcg';
            
            
            $pathData = 'auqrF|vtiMe@vE?@MtAADMlAMlAOnAMpA]jBKx@M`ACRE^G\\g@vDi@vD{A~KCV?@AJIl@?FQrBAJKrA_@|FAPCPK`Be@bHo@rJe@vGIxAG~@?NeAbP?HOtBOtBMlBIhAG`AG|@q@dKEj@Cb@}AtUEb@I|AM|CAl@EhA?LElBA@?DIjC_C|]Cb@Cf@E\\Gj@Kl@Mb@Up@Wl@_@l@Y^YZQLWRQJULc@PYHQDOBYDO@U@W?WAc@Ci@EmBWyKaB}Ec@[EA?c@ACAM?]Fo@HSD[JIDE@EBGBKD?@i@ZkAtAQZMRaAjBU^IJOTOL_@^aA~@GDGHCDCBGLQROL_BzAi@d@yAtAyAtAQPaKdJg@b@mBjBs@p@WXMPuB`Ca@d@c@h@cAdAs@p@aA|@qChC_@ZOJOHOHUJUFMDQBWFQ?M@O?c@@OAC?WAs@EU?O?QA]AeAG_AEc@Cw@E}@Gm@Ee@Gg@Ii@Ki@Qg@QYOe@YWOQOA??A_@Yg@g@k@k@{@aAg@e@IIAACECACEGEs@u@EGA?ACGGKIuByBKMOMa@c@yDuDSSi@i@i@i@k@i@IIGEGEIGc@a@oBoBm@k@u@u@WYUWOSm@s@GIA?]c@y@}@_@a@eA_A][}AoBg@y@w@aAW_@IKo@gAy@sAq@cAMOe@eA]k@uA}Bu@sAUa@kBcDcAeBq@iAOWIGcCiE]k@y@eAk@o@iBwAi@[iB_AaAg@UMuAk@s@]gBu@]M[KUIEACACAeA[wC{@sC}@c@MA?o@SCAeA[c@Eg@KCAa@K';
            $overviewData = 'adssFb_gkMjCiBZUd@k@n@oARgBAaAScASa@[Yu@]gAAmABq@Gq@c@MOGWWo@c@sA}@{DyA_IUWy@mIeAwJqAgIkAeHg@wC?o@QuAGu@Am@Bc@Nm@`@c@VMTCd@DTLPRVl@Fx@C`@Id@sAzEYr@{BjGGDe@h@WPc@Je@CWMYWSg@G_@Ak@PoDBs@Ns@Xg@ZUVI\\?XFRLRXJRPz@nBtKjArJZrCAX~@rHz@rGbApF`BfGxBhHRlADxAOfB]tAk@`AeB`ByKhIS`@mVdQ}DdCqGxDqBpAmGnEyGzEwC~AuC`A}B`@uANyADsB@aFB{FAyABkBNgB^uHlCyDvAsA`@qBXgEPoB@}@F{CP{@FkI@sDAaGJoDDoBNmB^eCz@y@b@mAx@{AnAuA`By@pAw@zAa@bAm@hBq@vCYpBQrBKlD@nBHtBj@xF`DfWdPtqAp@lF^jEHdCAhBOxD_@dCi@|Bi@xAm@jAk@~@{@dAu@r@wBtAoAf@aBZgAHmA@uBOqBg@mAc@yBkAcNaIiDoBiCiAuA_@sASyAKoD@_ITsB?{BMyBc@{By@eCwA}JaHeDyBiAm@gBo@_Ce@_CSuA?kBJqAPoAXeBj@sEpBeCrAoEnCmE~CgEdDwHjG_DnCiIxHaKjK}I~JoIjKeDlEkD`F{BnDiClEiEtI_DnHeSbf@eGpOcChHkCrIaOze@qDzKgBxEwD~IoF~KaNtX{BtEsB|EsAtD_BjFsEfPsEtPkB`GqAhDuA`DcBfDsBhDkD`FgDzDcE~DyDxCcEhCaBz@yBbA}B|@uBp@iD|@wFpAyLpCyBn@aCx@gEhBuDrBqE|C_ClB_DxCuB`CqD|EiAdBoA`CyAbDgAtCyFxNcBlDeBtCmBhCeCnCcA`AcClB{AbAqFdDeNfI}IzFcHbEkG~D{NvIeGzDaDhBu^rRsLfGaDhByItEoOxHiFtCm@f@wAvAiApAmAhBoAfC}c@`aA_[`q@eAlC{@hCuAjFaAjF]lCa@dFeBrUqCh_@a@vFEfDHzBZ~Cf@fCp@`CnDhLt@xC^~CLbD\\hx@JfFLnB\\bD\\nB^`Bp@|BfApCr@xAvB~CzCrDhRfTvBdCvAnBt@tAp@~Ah@bB`@lB\\~BbGph@x@tHRnC@t@CrBWnCgF~[mHbd@gAxFy@`D_A~C{BpHyBpHa@bBcCfLyBtKa@bCa@zCaCjUm@lF}@vFy@hEc@zBIJCFITOb@UVYJU@_@KSQSa@Gq@Fu@Rc@TQf@MNGFGh@CdACJ?';
            $path = urlencode($overviewData);

            $url = 'http://api.tiles.mapbox.com/v4/outrobot.j5d8dfpg/path-5+f44+f44(' . $path . ')/auto/1200x1200.png?access_token=' . $token;
            echo CHtml::image($url);
        }
        
        public function actionGetPath()
        {
            $start = str_replace(' ', '', '40.087548, -75.402788');
            $end = str_replace(' ', '', '39.905912, -75.133714');
            
            $url = 'https://maps.googleapis.com/maps/api/directions/json?origin=' . $start . '&destination=' . $end;
            $raw_response = file_get_contents($url);
            $decoded_response = json_decode($raw_response);
            /*
            $pathData = '';
            $steps = $decoded_response->routes[0]->legs[0]->steps;
            foreach($steps as $step)
            {
                $pathData .= $step->polyline->points;
            }
            if(strlen($pathData) > 4096){
                $pathData = $decoded_response->routes[0]->overview_polyline->points;
            }
             * 
             */
            
            $pathData = $decoded_response->routes[0]->overview_polyline->points;
            $token = 'pk.eyJ1Ijoib3V0cm9ib3QiLCJhIjoiSHFjYTVEcyJ9.A1HPH5dGkeA2ultB60BMcg';

            $path = urlencode($pathData);

            $url = 'http://api.tiles.mapbox.com/v4/outrobot.j5d8dfpg/path-5+f44+f44(' . $path . ')/auto/1200x1200.png?access_token=' . $token;
            echo CHtml::image($url);
            echo '<hr>';
            echo $pathData;
            echo '<hr>';
            echo $url;
        }
}