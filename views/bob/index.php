<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <?php
    $table = $html->find('#teams-all table', 0);
    $rowData = array();
    foreach ($table->find('tr') as $key => $row) {
        if($key >= 2){
            $flight = array();
            foreach ($row->find('td') as $key => $cell) {
                $teamAttr = array();
                if ($key == 0){
                    foreach($cell->find('img') as $attr){
                        $teamAttr['image_path'] = $attr->src;
                    }
                    foreach($cell->find('a') as $attr){
                        $teamAttr['dotabuf_link'] = $attr->href;
                        $teamAttr['dotabuf_id'] = preg_replace('/[^0-9]/', '', $attr->href);
                    }
                    $flight[] = $teamAttr;
                }else {
                    $flight[] = $cell->plaintext;
                }
            }
            $rowData[] = $flight;
        }
    }
    echo '<pre>';
//    print_r($rowData);    
    
    
    $teamData = array();
    foreach ($rowData as $key => $team) {
       $teamData[$key]['img'] = $team[0]['image_path'];
       $teamData[$key]['dotabuf_link'] = $team[0]['dotabuf_link'];
       $teamData[$key]['dotabuf_id'] = $team[0]['dotabuf_id'];
       $teamData[$key]['team_name'] = substr($team[1],0,-21);
       $teamData[$key]['popularity'] = substr($team[2],0,-2);
       $teamData[$key]['total_match'] = $team[3];
       
    }
    print_r($teamData);
    ?> 

</div>





<!--echo '<table>';
foreach ($rowData as $row => $tr) {
    echo '<tr>'; 
    foreach ($tr as $td)
        echo '<td>' . $td .'</td>';
    echo '</tr>';-->
}