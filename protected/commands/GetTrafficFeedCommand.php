<?php
/**
 * GetTrafficFeed class file.
 *
 * @author Mark Olson
 */
 
/**
 * Retrieves xml traffic feed and creates/updates Routes and Incidents
 */
class GetTrafficFeedCommand extends CConsoleCommand
{
 
    public function run($args)
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
                       $routeId = (int) $route['ID']->__toString();
                       if($this->routeExists($routeId))
                       {
                            // Update existing incident record
                           Route::model()->updateByPk((int) $route['ID']->__toString(), array(
                                'drivetime' => (int) $route->TRAVEL_TIME->DRIVETIME,
                                'delaytime' => (int) $route->TRAVEL_TIME->DELAYTIME,
                                'average_speed' => (int) $route->TRAVEL_TIME->AVERAGESPEED,
                                'jamfactor' => (float) $route->JAMFACTOR,
                                'jamfactor_trend' => (float) $route->JAMFACTORTREND,
                                'update_time' => new CDbExpression('NOW()')
                           ));
                       } else {
                            $model = new Route;
                            $model->id = (int) $route['ID']->__toString();
                            $model->permanent_id = $route->PERMANENTID;
                            $model->name = $route->NAME;
                            $model->description = $route->DESCRIPTION;
                            $model->drivetime = (int) $route->TRAVEL_TIME->DRIVETIME;
                            $model->delaytime = (int) $route->TRAVEL_TIME->DELAYTIME;
                            $model->length = (int) $route->TRAVEL_TIME->LENGTH;
                            $model->average_speed = (int) $route->TRAVEL_TIME->AVERAGESPEED;
                            $model->jamfactor = (float) $route->JAMFACTOR;
                            $model->jamfactor_trend = (float) $route->JAMFACTORTREND;
                            $model->update_time = new CDbExpression('NOW()');
                            if(!$model->save())
                            {
                                echo var_dump($model->getErrors());
                            }
                       }
                   }
                   Incident::model()->deleteAll();
                   foreach($data->INCIDENTS->INCIDENT as $incident)
                   {       
                        $incidentId = (int) $incident['ID']->__toString();
                        
                        // Create new incident record
                        $model = new Incident;
                        $model->id = $incidentId;
                        $description = preg_replace('/\s+/', ' ', $incident->DESCRIPTION);
                        $model->description = substr($description, 0, 255);
                        $model->location = $incident->LOCATION; 
                        $model->criticality = (int) $incident->CRITICALITY; 
                        $model->type = $model->getTypeId($incident->TYPE['ID']->__toString());
                        $model->type_description = $incident->TYPE_DESC; 
                        $model->direction = $incident->DIRECTION['VALUE'];
                        $model->gps_lat = (float) $incident->GEOLOCATION['LATITUDE'];
                        $model->gps_lng = (float) $incident->GEOLOCATION['LONGITUDE'];
                        $model->start_time = $this->convertToSqlDate($incident->STARTTIME['VALUE']);
                        $model->end_time = $this->convertToSqlDate($incident->ENDTIME['VALUE']);
                        $model->create_time = new CDbExpression('NOW()');
                        $model->update_time = new CDbExpression('NOW()');
                        if(!$model->save())
                        {
                            echo var_dump($model->getErrors());
                        }
                   }
               }
            }
    }

    private function incidentExists($id)
    {
       return Yii::app()->db->createCommand()
               ->select('*')
               ->from('tbl_incident')
               ->where('id=:Id', array(':Id'=>$id))
               ->queryScalar();
    }
    
    private function routeExists($id)
    {
       return Yii::app()->db->createCommand()
               ->select('*')
               ->from('tbl_route')
               ->where('id=:Id', array(':Id'=>$id))
               ->queryScalar();
    }

    private function convertToSqlDate($date)
    {
        return date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $date)));
    }
}
?>