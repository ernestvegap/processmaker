<?php

  // getting the extJs parameters
  $callback = isset($_POST['callback']) ? $_POST['callback'] : 'stcCallback1001';
  $dir      = isset($_POST['dir'])    ? $_POST['dir']    : 'DESC';
  $sort     = isset($_POST['sort'])   ? $_POST['sort']   : '';
  $start    = isset($_POST['start'])  ? $_POST['start']  : '0';
  $limit    = isset($_POST['limit'])  ? $_POST['limit']  : '25';
  $filter   = isset($_POST['filter']) ? $_POST['filter'] : '';
  $search   = isset($_POST['search']) ? $_POST['search'] : '';
  $process  = isset($_POST['process']) ? $_POST['process'] : '';
  $action   = isset($_GET['action']) ? $_GET['action'] : (isset($_POST['action']) ? $_POST['action'] : 'todo');
  $type   = isset($_GET['type']) ? $_GET['type'] : (isset($_POST['type']) ? $_POST['type'] : 'extjs');

  try {  	

  G::LoadClass("BasePeer" );
  require_once ( "classes/model/AppCacheView.php" );
  require_once ( "classes/model/AppDelegation.php" );
  require_once ( "classes/model/AdditionalTables.php" );
  require_once ( "classes/model/AppDelay.php" );
  G::LoadClass ( "BasePeer" );
  G::LoadClass ( 'configuration' );
  require_once ( "classes/model/Fields.php" );

  $sUIDUserLogged = $_SESSION['USER_LOGGED'];
// get the action based list
  switch ( $action ) {
  	case 'draft' :
         $Criteria = getDraft();
         break;
  	case 'sent' :
         $Criteria = getParticipated();
         break;
  	case 'selfservice' :
         $Criteria = getUnassigned();
         break;
  	case 'paused' :
         $Criteria = getPaused();
         break;
  	case 'completed' :
         $Criteria = getCompleted();
         break;
  	case 'cancelled' :
         $Criteria = getCancelled();
         break;
    case 'todo' :
    default:
         $Criteria = getToDo();
    break;
  }
  // VERY IMPORTANT
  // Above Development debugging code needed to be removed previously to be deployed or commited
  // TODO: remove this code if the list for both the new and original functions
  //       get the exactly same results
  G::LoadClass("case" );
  $oCases = new Cases();

//  $type='old'; // can uncomment this line to populate the list with the old cases methods
  if ($type=='old'){
    $action = $action=='todo' ? 'to_do' : $action;
    $aCasesData = $oCases->getConditionCasesList($action,$sUIDUserLogged);
    $Criteria = $aCasesData[0];
    //g::pr($Criteria);
  }
  //
  //  end test code
  // VERY IMPORTANT

  //add the process filter
  if ( $process != '' ) {
    $Criteria->add (AppCacheViewPeer::APP_PRO_TITLE, $process, Criteria::EQUAL );
  }

  //add the filter 
  if ( $filter != '' ) {
  	switch ( $filter ) {
  		case 'read' : 
        $Criteria->add (AppCacheViewPeer::DEL_INIT_DATE, null, Criteria::ISNOTNULL);
        break;
  		case 'unread' : 
        $Criteria->add (AppCacheViewPeer::DEL_INIT_DATE, null, Criteria::ISNULL);
        break;
  	}
  }  

  //add the search filter
  if ( $search != '' ) {
    $Criteria->add (AppCacheViewPeer::APP_TITLE, $search . '%', Criteria::LIKE );
  }  

  //here we count how many records exists for this criteria.
  $totalCount = GulliverBasePeer::doCount( $Criteria );
      
  //add sortable options    
  if ( $sort != '' ) {
    if ( $dir == 'DESC' )
      $Criteria->addDescendingOrderByColumn( $sort );
    else
      $Criteria->addAscendingOrderByColumn( $sort );
    }

  //limit the results according the interface    
  $Criteria->setLimit( $limit );
  $Criteria->setOffset( $start );

  //execute the query      
  $oDataset = AppCacheViewPeer::doSelectRS($Criteria);
  $oDataset->setFetchmode(ResultSet::FETCHMODE_ASSOC);
  $oDataset->next();
      
  $result = array();
  $result['totalCount'] = $totalCount;
  $rows = array();
  $index = $start;
  while($aRow = $oDataset->getRow()){
    //$aRow['index'] = ++$index;
//    g::pr($aRow);
    $aRow['DEL_TASK_DUE_DATE'] = strip_tags($aRow['DEL_TASK_DUE_DATE']);
    $rows[] = $aRow;
      
    $oDataset->next();
  }
  $result['data'] = $rows;
 // print the result in json format
  print json_encode( $result ) ;
  
  }
  catch ( Exception $e ) {
    $G_PUBLISH = new Publisher;
    $aMessage['MESSAGE'] = $e->getMessage();
    $G_PUBLISH->AddContent('xmlform', 'xmlform', 'login/showMessage', '', $aMessage );
    G::RenderPage( 'publish', 'blank' );
  }      

  /**
   * gets the todo cases list criteria
   * @return Criteria object $Criteria
   */
  function getToDo () {
  	global $sUIDUserLogged ;
    $Criteria = new Criteria('workflow');
  
    $Criteria->clearSelectColumns ( );
   // $Criteria = addPMFieldsToCriteria('todo');
//
//    $Criteria->addSelectColumn (  AppCacheViewPeer::APP_UID );
//    $Criteria->addSelectColumn (  AppCacheViewPeer::APP_NUMBER );
//    $Criteria->addSelectColumn (  AppCacheViewPeer::APP_STATUS );
//    $Criteria->addSelectColumn (  AppCacheViewPeer::DEL_INDEX );
//    $Criteria->addSelectColumn (  AppCacheViewPeer::APP_TITLE );
//    $Criteria->addSelectColumn (  AppCacheViewPeer::APP_PRO_TITLE );
//    $Criteria->addSelectColumn (  AppCacheViewPeer::APP_TAS_TITLE );
//    $Criteria->addSelectColumn (  AppCacheViewPeer::APP_DEL_PREVIOUS_USER );
//    $Criteria->addSelectColumn (  AppCacheViewPeer::APP_CURRENT_USER );
//    $Criteria->addSelectColumn (  AppCacheViewPeer::DEL_TASK_DUE_DATE );
//    $Criteria->addSelectColumn (  AppCacheViewPeer::APP_UPDATE_DATE );
//    $Criteria->addSelectColumn (  AppCacheViewPeer::DEL_PRIORITY );
//    $Criteria->addSelectColumn (  AppCacheViewPeer::APP_STATUS );
//    $Criteria->addSelectColumn (  AppCacheViewPeer::APP_FINISH_DATE );

    // adding configuration fields from the configuration options
    // and forming the criteria object
    $Criteria = addPMFieldsToCriteria('todo',$Criteria);

    $Criteria->add (AppCacheViewPeer::APP_STATUS, "TO_DO" , CRITERIA::EQUAL );
    $Criteria->add (AppCacheViewPeer::USR_UID, $sUIDUserLogged);

    $Criteria->add (AppCacheViewPeer::DEL_FINISH_DATE, null, Criteria::ISNULL);
    $Criteria->add (AppCacheViewPeer::APP_THREAD_STATUS, 'OPEN');
    $Criteria->add (AppCacheViewPeer::DEL_THREAD_STATUS, 'OPEN');
//    g::pr($Criteria);
    return $Criteria;
  }

  /**
   * gets the draft cases list criteria
   * @return Criteria object $Criteria
   */
  function getDraft() {
  	global $sUIDUserLogged ;
    $Criteria = new Criteria('workflow');
    $Criteria->clearSelectColumns ( );

    // adding configuration fields from the configuration options
    // and forming the criteria object

    $Criteria = addPMFieldsToCriteria('draft');
        
    $Criteria->add (AppCacheViewPeer::APP_STATUS, "DRAFT" , CRITERIA::EQUAL );
    $Criteria->add (AppCacheViewPeer::DEL_FINISH_DATE, null, CRITERIA::ISNULL);
    $Criteria->add (AppCacheViewPeer::DEL_THREAD_STATUS, 'OPEN');
    $Criteria->add (AppCacheViewPeer::USR_UID, $sUIDUserLogged);
    $Criteria->addDescendingOrderByColumn(AppCacheViewPeer::APP_NUMBER);
    
    return $Criteria;
  }
  /**
   * gets the participated cases list criteria
   * @return Criteria object $Criteria
   */
  function getParticipated() {
    global $sUIDUserLogged;
    $Criteria = new Criteria('workflow');
    $Criteria->clearSelectColumns ( );
    // adding configuration fields from the configuration options
    // and forming the criteria object
    $Criteria = addPMFieldsToCriteria('sent');

    return $Criteria;
  }
  /**
   * gets the unassigned cases list criteria
   * @return Criteria object $Criteria
   */
  function getUnassigned() {

    global $sUIDUserLogged;
    $Criteria = new Criteria('workflow');

    $Criteria->clearSelectColumns ( );
    // adding configuration fields from the configuration options
    // and forming the criteria object

    $Criteria = addPMFieldsToCriteria('selfservice');

    return $Criteria;
  }

  /**
   * gets the paused cases list criteria
   * @return Criteria object $Criteria
   */
  function getPaused(){
    global $sUIDUserLogged ;
    $Criteria = new Criteria('workflow');

    $Criteria->clearSelectColumns ( );

    // adding configuration fields from the configuration options
    // and forming the criteria object
    $Criteria = addPMFieldsToCriteria('paused');

    $appDelayConds[] = array(AppCacheViewPeer::APP_UID, AppDelayPeer::APP_UID);
    $appDelayConds[] = array(AppDelegationPeer::DEL_INDEX, AppDelayPeer::APP_DEL_INDEX);
//    $appDelayConds[] = array(AppDelegationPeer::DEL_INDEX, AppDelayPeer::APP_DEL_INDEX);
//    $Criteria->addJoin(AppCacheViewPeer::APP_UID, AppDelayPeer::APP_UID, Criteria::LEFT_JOIN);
    $Criteria->addJoinMC($appDelayConds, Criteria::LEFT_JOIN);

    $Criteria->add(AppDelayPeer::APP_DELAY_UID, null, Criteria::ISNOTNULL);
    $Criteria->add(AppDelayPeer::APP_TYPE, array("REASSIGN","ADHOC","CANCEL"), Criteria::NOT_IN);
    $Criteria->add($Criteria->getNewCriterion(AppDelayPeer::APP_DISABLE_ACTION_USER, null, Criteria::ISNULL)->addOr($Criteria->getNewCriterion(AppDelayPeer::APP_DISABLE_ACTION_USER, 0)));
    $Criteria->addDescendingOrderByColumn(AppCacheViewPeer::APP_NUMBER);
    $Criteria->add (AppCacheViewPeer::USR_UID, $sUIDUserLogged);
    return $Criteria;
  }

  /**
   * gets the completed cases list criteria
   * @return Criteria object $Criteria
   */
  function getCompleted(){
    global $sUIDUserLogged ;
    $Criteria = new Criteria('workflow');

    $Criteria->clearSelectColumns ( );

    // adding configuration fields from the configuration options
    // and forming the criteria object
    $Criteria = addPMFieldsToCriteria('completed');

    $Criteria->addJoin(AppCacheViewPeer::APP_UID, AppDelegationPeer::APP_UID, Criteria::LEFT_JOIN);
    $Criteria->add(AppCacheViewPeer::APP_STATUS, 'COMPLETED');
    $Criteria->add(AppDelegationPeer::DEL_PREVIOUS, '0', Criteria::NOT_EQUAL);

    //$c->addAsColumn('DEL_FINISH_DATE', 'max('.AppDelegationPeer::DEL_FINISH_DATE.')');
    $Criteria->addGroupByColumn(AppCacheViewPeer::APP_UID);
    $Criteria->addDescendingOrderByColumn(AppCacheViewPeer::APP_NUMBER);
    return $Criteria;
  }

  /**
   * gets the cancelled cases list criteria
   * @return Criteria object $Criteria
   */
  function getCancelled(){
    global $sUIDUserLogged ;
    $Criteria = new Criteria('workflow');

    $Criteria->clearSelectColumns ( );

    // adding configuration fields from the configuration options
    // and forming the criteria object
    $Criteria = addPMFieldsToCriteria('cancelled');

    $Criteria->add($Criteria->getNewCriterion(AppCacheViewPeer::APP_THREAD_STATUS, 'CLOSED')->addAnd($Criteria->getNewCriterion(AppCacheViewPeer::APP_STATUS, 'CANCELLED')));
    $Criteria->addDescendingOrderByColumn(AppCacheViewPeer::APP_NUMBER);
    $Criteria->add (AppCacheViewPeer::USR_UID, $sUIDUserLogged);
    return $Criteria;
  }

  /**
   * loads the configuration fields from the database based in an action parameter
   * then assemble the Criteria object with these data.
   * @param  String $action
   * @return Criteria object $Criteria
   */
function addPMFieldsToCriteria($action){
  $caseColumns = array();
  $caseReaderFields = array();
  $oCriteria  = new Criteria('workflow');
  $oCriteria->clearSelectColumns ( );
  // default configuration fields array
  $defaultFields = array (
                  'APP_UID',
                  'DEL_INDEX',
                  'APP_NUMBER',
                  'APP_STATUS',
                  'USR_UID',
                  'PREVIOUS_USR_UID',
                  'TAS_UID',
                  'PRO_UID',
                  'DEL_DELEGATE_DATE',
                  'DEL_INIT_DATE',
                  'DEL_TASK_DUE_DATE',
                  'DEL_FINISH_DATE',
                  'DEL_THREAD_STATUS',
                  'APP_THREAD_STATUS',
                  'APP_TITLE',
                  'APP_PRO_TITLE',
                  'APP_TAS_TITLE',
                  'APP_CURRENT_USER',
                  'APP_DEL_PREVIOUS_USER',
                  'DEL_PRIORITY',
                  'DEL_DURATION',
                  'DEL_QUEUE_DURATION',
                  'DEL_DELAY_DURATION',
                  'DEL_STARTED',
                  'DEL_FINISHED',
                  'DEL_DELAYED',
                  'APP_CREATE_DATE',
                  'APP_FINISH_DATE',
                  'APP_UPDATE_DATE',
                  'APP_OVERDUE_PERCENTAGE'
                );
  
  $conf = new Configurations();
  $confCasesList = $conf->loadObject('casesList',$action,'','','');
  if (count($confCasesList)>1&&isset($confCasesList['PMTable'])&&trim($confCasesList['PMTable'])!=''){
  // getting the table name
    $oAdditionalTables = AdditionalTablesPeer::retrieveByPK($confCasesList['PMTable']);
    $tableName = $oAdditionalTables->getAddTabName();

    foreach($confCasesList['second']['data'] as $fieldData){
      if (!in_array($fieldData['name'],$defaultFields)){
        $fieldName = $tableName.'.'.$fieldData['name'];
        $oCriteria->addSelectColumn (  $fieldName );
      } else {
        $fieldName = 'APP_CACHE_VIEW.'.$fieldData['name'];
        $oCriteria->addSelectColumn (  $fieldName );
      }
    }
    $oCriteria->addJoin(AppCacheViewPeer::APP_UID, $tableName.'.APP_UID', Criteria::LEFT_JOIN);
    return $oCriteria;
  } else {
    return $oCriteria;
  }
}

