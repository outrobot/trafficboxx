<?php
/**
 * GetTrafficFeed class file.
 *
 * @author Mark Olson
 */
 
/**
 * Retrieves xml traffic feed and creates/updates Routes and Incidents
 */
class ExportIncidentsCommand extends CConsoleCommand
{
 
    public function run($args)
    {
        $criteria = new CDbCriteria;
        $criteria->condition = 'criticality = 1 AND type!=:construction';
        $criteria->params = array(':construction'=>  Incident::TYPE_CONSTRUCTION);
        $criteria->addSearchCondition('description', 'CLEARED' ,true, 'AND', 'NOT LIKE');
        
        
        $csv = CsvExport::export(
            Incident::model()->findAll($criteria),
            array('location'=>array(''),'description'=>array('')),
            false, // boolPrintRows
            "~/windows-share/data/incidents.csv"
           );
    }
}
?>