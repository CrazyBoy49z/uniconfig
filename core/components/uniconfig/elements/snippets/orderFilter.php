<?php
if ($_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest'){return;}
//Filter Fields Settings
$filter = array();

//Radio, Select & Text Fields Type
if($_GET['status']) {
  $filter['status'] = $_GET['status'];
}

if($_GET['specialization']) {
  $filter['specialization'] = $_GET['specialization'];
}

if($_GET['location']) {
  $filter['location'] = $_GET['location'];
}
//End Settings

//Sort
if($_GET['sortby']) {
  $sortby = $_GET['sortby'];
} else {
  $sortby = 'id';
}
if($_GET['sortdir']) {
  $sortdir = $_GET['sortdir'];
} else {
  $sortdir = 'desc';
}
//End Sort

//Offset
$offset = 0;
if($_GET['offset']){
  $offset = $_GET['offset'];
}
$wheres = array_merge($where, $filter);
$params_count = array(
  'class' => 'uniOrder',
  'limit' => 0,
  'tpl' => '@INLINE ,',
  'select' => 'id',
  'where' => $wheres,
  'sortby' => 'id',
  'sortdir' => 'asc',
);

$count = $modx->runSnippet('pdoResources',$params_count);
$count = count(explode(',',$count))-1;
$modx->setPlaceholder('count',$count);
$params = array(
  'class' => 'uniOrder',
  'leftJoin' => '{
      "Status":{
        "class": "uniOrderStatus",
        "on": "uniOrder.status = Status.id"
      },
      "Specialization": {
        "class": "uniSpecialization",
        "on" : "uniOrder.specialization = Specialization.id"
      }
    }',
  'select' => '{
      "uniOrder": "*",
      "Status" : "Status.name as status_name",
      "Specialization" : "Specialization.name as specialization_name"
    }',
  'limit' => $limit,
  'offset' => $offset,
  'tpl' => $tpl,
  'where' => $wheres,
  'sortby' => $sortby,
  'sortdir' => $sortdir,
);

$more = $count - $offset - $limit;
$lim = $more > $limit ? $limit : $more;

$button = '';
if($more > 0){
  $button = '<tr><td colspan="4" class="ajax-filter-count text-center" data-count="'.$count.'"><a href="#" class="ajax-more">Загрузить еще '.$lim.' из '.$more.'</a></tr>';
}

return $modx->runSnippet('pdoResources',$params).$button;