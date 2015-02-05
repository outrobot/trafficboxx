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
                           Route::model()->updateByPk($routeId, array(
                                'drivetime' => (int) $route->TRAVEL_TIME->DRIVETIME,
                                'delaytime' => (int) $route->TRAVEL_TIME->DELAYTIME,
                                'average_speed' => (int) $route->TRAVEL_TIME->AVERAGESPEED,
                                'jamfactor' => (float) $route->JAMFACTOR,
                                'jamfactor_trend' => (float) $route->JAMFACTORTREND,
                                'update_time' => new CDbExpression('NOW()')
                           ));
                       } else {
                            $model = new Route;
                            $model->id = $route['ID']->__toString();
                            $model->permanent_id = $route->PERMANENTID;
                            $model->name = $route->NAME;
                            $model->description = $route->DESCRIPTION;
                            $model->drivetime = $route->TRAVEL_TIME->DRIVETIME;
                            $model->delaytime = $route->TRAVEL_TIME->DELAYTIME;
                            $model->length = $route->TRAVEL_TIME->LENGTH;
                            $model->average_speed = $route->TRAVEL_TIME->AVERAGESPEED;
                            $model->jamfactor = $route->JAMFACTOR;
                            $model->jamfactor_trend = $route->JAMFACTORTREND;
                            $model->update_time = new CDbExpression('NOW()');
                       }
                   }

                   foreach($data->INCIDENTS->INCIDENT as $incident)
                   {       
                       $incidentId = (int) $incident['ID']->__toString();
                       if($this->incidentExists($incidentId))
                       {
                            // Update existing incident record
                           Incident::model()->updateByPk($incidentId, array(
                                'description' => $incident->DESCRIPTION,
                                'location' => $incident->LOCATION,
                                'criticality' => $incident->CRITICALITY,
                                'type' => Incident::model()->getTypeId($incident->TYPE['ID']->__toString()),
                                'type_description' => $incident->TYPE_DESC,
                                'direction' => $incident->DIRECTION['VALUE'],
                                'gps_lat' => (float) $incident->GEOLOCATION['LATITUDE'],
                                'gps_lng' => (float) $incident->GEOLOCATION['LONGITUDE'],
                                'start_time' => $this->convertToSqlDate($incident->STARTTIME['VALUE']),
                                'end_time' => $this->convertToSqlDate($incident->ENDTIME['VALUE']),
                                'update_time' => new CDbExpression('NOW()')
                           ));
                       } else {
                            // Create new incident record
                            $model = new Incident;
                            $model->id = $incidentId;
                            $model->description = $incident->DESCRIPTION;
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