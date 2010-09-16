<?php
/**
 * class.pmFunctions.php
 *
 * ProcessMaker Open Source Edition
 * Copyright (C) 2004 - 2008 Colosa Inc.23
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * For more information, contact Colosa Inc, 2566 Le Jeune Rd.,
 * Coral Gables, FL, 33134, USA, or email info@colosa.com.
 *
 *
 *
 *
 */
////////////////////////////////////////////////////
// PM Functions
//
// Copyright (C) 2007 COLOSA
//
// License: LGPL, see LICENSE
////////////////////////////////////////////////////

/**
 * ProcessMaker has made a number of its PHP functions available be used in triggers and conditions.
 * Most of these functions are wrappers for internal functions used in Gulliver, which is the development framework
 * used by ProcessMaker.
 * @class pmFunctions
 * @name ProcessMaker Functions
 * @icon /images/pm.gif
 * @className class.pmFunctions.php
 */


/**
 * @method
 *
 * Returns the current date formated in the format "yyyy-mm-dd", with leading zeros in the
 * month and day if less than 10. This function is equivalent to PHP's date("Y-m-d").
 *
 * @name getCurrentDate
 * @label Get Current Date
 * @link http://wiki.processmaker.com/index.php/ProcessMaker_Functions#getCurrentDate.28.29
 *
 * @return date | $date | Current Date (Y-m-d) | It returns the current date as a string value.
 *
 */
function getCurrentDate() {
  return G::CurDate('Y-m-d');
}
/**
 * @method
 *
 * Returns the current time in the format "hh:mm:ss" with leading zeros when the hours,
 * minutes or seconds are less than 10.
 *
 * @name getCurrentTime
 * @label Get Current Time
 * @link http://wiki.processmaker.com/index.php/ProcessMaker_Functions#getCurrentTime.28.29
 *
 * @return time | $time | Current Time (H:i:s)| The function returns the current time as a string.
 *
 */
function getCurrentTime() {
  return G::CurDate('H:i:s');
}
/**
 * @method
 *
 * Retrieves information about a user with a given ID.
 *
 * @name userInfo
 * @label User Info
 * @link http://wiki.processmaker.com/index.php/ProcessMaker_Functions#userInfo.28.29
 *
 * @param string(32) | $user_id | User ID | The user unique ID
 * @return array | $userInfo | User Info | An associative array with Information
 *
 */
function userInfo($user_uid) {
  try {
    require_once 'classes/model/Users.php';
    $oUser = new Users();
    return $oUser->getAllInformation($user_uid);
  }
  catch (Exception $oException) {
    throw $oException;
  }
}
/**
 * @method
 *
 * Returns a string converted into all UPPERCASE letters.
 *
 * @name upperCase
 * @label Upper Case
 * @link http://wiki.processmaker.com/index.php/ProcessMaker_Functions#upperCase.28.29
 *
 * @param string(32) | $sText | Text To Convert | A string to convert to UPPERCASE letters.
 * @return string | $TextC | Text Converted | Returns a string with the text converted into upper case letters.
 *
 */
function upperCase($sText) {
  return G::toUpper($sText);
}
/**
 * @method
 *
 * Returns a string with all the letters converted into lower case letters.
 *
 * @name lowerCase
 * @label Lower Case
 * @link http://wiki.processmaker.com/index.php/ProcessMaker_Functions#lowerCase.28.29
 *
 * @param string(32) | $sText | Text To Convert | A string to convert to lower case letters.
 * @return string | $TextC | Text Converted | Returns a string with the text converted into lower case letters.
 *
 */
function lowerCase($sText) {
  return G::toLower($sText);
}
/**
 * @method
 *
 * Converts the first letter in each word into an uppercase letter.
 * Subsequent letters in each word are changed into lowercase letters.
 *
 * @name capitalize
 * @label Capitalize
 * @link http://wiki.processmaker.com/index.php/ProcessMaker_Functions#capitalize.28.29
 *
 * @param string(32) | $sText | Text To Convert | The string to capitalize.
 * @return string | $TextC | Text Converted | It returns the introduced text with the first letter capitalized in each word and the subsequent letters into lowercase letters
 *
 */
function capitalize($sText) {
  return G::capitalizeWords($sText);
}
/**
 * @method
 *
 * Returns a string formatted according to the given date format and given language
 *
 * @name formatDate
 * @label Format Date
 * @link http://wiki.processmaker.com/index.php/ProcessMaker_Functions#formatDate.28.29
 *
 * @param string(32) | $date | Date | The input date to be reformatted. The input date must be a string in the format 'yyyy-mm-dd'.
 * @param string(32) | $format="" | format | The format of the date which will be returned. It can have the following definitions:
 * @param string(32) | $lang="en"| Language | The language in which to reformat the date. It can be 'en' (English), 'es' (Spanish) or 'fa' (Persian).
 * @return string | $formatDate | Date whit format | It returns the passed date according to the given date format.
 *
 */
function formatDate($date, $format='', $lang='en') {
  if( !isset($date) or $date == '') {
    throw new Exception('function:formatDate::Bad param');
  }
  try {
    return G::getformatedDate($date, $format, $lang);
  } catch (Exception $oException) {
    throw $oException;
  }
}
/**
 * @method
 *
 * Returns a specified date written out in a given language, with full month names.
 *
 * @name literalDate
 * @label Literal Date
 * @link http://wiki.processmaker.com/index.php/ProcessMaker_Functions#literalDate.28.29
 *
 * @param string(32) | $date | date | The input date in standard format (yyyy-mm-dd) that is a string.
 * @param string(32) | $lang="en" | Language | The language to display, which can be 'en' (English) or 'es' (Spanish). If not included, then it will be English by default.
 * @return string | $literaDate | Literal date | It returns the literal date as a string value.
 *
 */
function literalDate($date, $lang = 'en') {
  if( !isset($date) or $date == '' ) {
    throw new Exception('function:formatDate::Bad param');
  }
  try {
    switch($lang) {
      case 'en': $ret = G::getformatedDate($date, 'M d,yyyy', $lang);
        break;
      case 'es': $ret = G::getformatedDate($date, 'd de M de yyyy', $lang);
        break;
    }
    return $ret;
  } catch (Exception $oException) {
    throw $oException;
  }
}
/**
 * @method
 *
 * Pauses a specified case.
 *
 * @name pauseCase
 * @label Pause Case
 * @link  http://wiki.processmaker.com/index.php/ProcessMaker_Functions#pauseCase.28.29
 *
 * @param string(32) | $sApplicationUID= "" | ID of the case | The unique ID of the case. The UID of the current case can be found in the system variable @@APPLICATION.
 * @param string(32) | $iDelegation = 0| Delegation index of the case | The delegation index of the current task in the case.
 * @param string(32) | $sUserUID = ""| ID user | The unique ID of the user who will pause the case.
 * @param string(32) | $sUnpauseDate = null  | Date | Optional parameter. The date in the format 'yyyy-mm-dd' indicating when to unpause the case.
 * @return None  | $none | None | None
 *
 */
function pauseCase($sApplicationUID = '', $iDelegation = 0, $sUserUID = '', $sUnpauseDate = null) {//var_dump($sApplicationUID, $iDelegation, $sUserUID, $sUnpauseDate);die(':|');
  try {
    if ($sApplicationUID == '') {
      throw new Exception('The application UID cannot be empty!');
    }
    if ($iDelegation == 0) {
      throw new Exception('The delegation index cannot be 0!');
    }
    if ($sUserUID == '') {
      throw new Exception('The user UID cannot be empty!');
    }
    G::LoadClass('case');
    $oCase = new Cases();
    $oCase->pauseCase($sApplicationUID, $iDelegation, $sUserUID, $sUnpauseDate);
  }
  catch (Exception $oException) {
    throw $oException;
  }
}
/**
 * @method
 *
 * Executes a SQL statement in a database connection or in one of ProcessMaker's
 * internal databases.
 *
 * @name executeQuery
 * @label execute Query
 * @link http://wiki.processmaker.com/index.php/ProcessMaker_Functions#executeQuery.28.29
 *
 * @param string(32) | $SqlStatement | Sql query | The SQL statement to be executed. Do NOT include the database name in the SQL statement.
 * @param string(32) | $DBConnectionUID="workflow"| UID database | The UID of the database connection where the SQL statement will be executed.
 * @return array or string | $Resultquery | Result | Result of the query | If executing a SELECT statement, it returns an array of associative arrays
 *
 */
function executeQuery($SqlStatement, $DBConnectionUID = 'workflow') {
  try {

    $con = Propel::getConnection($DBConnectionUID);
    $con->begin();
    switch(true) {
      case preg_match("/^SELECT\s/i", $SqlStatement):
      case preg_match("/^EXECUTE\s/i", $SqlStatement):
        $rs = $con->executeQuery($SqlStatement);
        $con->commit();

        $result = Array();
        $i=1;
        while ($rs->next()) {
          $result[$i++] = $rs->getRow();
        }
        break;
      case preg_match("/^INSERT\s/i", $SqlStatement):
        $rs = $con->executeUpdate($SqlStatement);
        $con->commit();
        //$result = $lastId->getId();
        $result = 1;
        break;
      case preg_match("/^UPDATE\s/i", $SqlStatement):
        $rs = $con->executeUpdate($SqlStatement);
        $con->commit();
        $result =  $con->getUpdateCount();
        break;
      case preg_match("/^DELETE\s/i", $SqlStatement):
        $rs = $con->executeUpdate($SqlStatement);
        $con->commit();
        $result =  $con->getUpdateCount();
        break;
    }

    return $result;
  } catch (SQLException $sqle) {
    $con->rollback();
    throw $sqle;
  }
}
/**
 * @method
 *
 * Sorts a grid according to a specified field in ascending or descending order.
 *
 * @name orderGrid
 * @label order Grid
 * @link http://wiki.processmaker.com/index.php/ProcessMaker_Functions#orderGrid.28.29
 *
 * @param array | $dataM | User ID |  A grid, which is a numbered array containing associative arrays with field names and their values, it has to be set like this "@=".
 * @param string(32) | $field | Name of field | The name of the field by which the grid will be sorted.
 * @param string(32) | $ord = "ASC"| Optional parameter | Optional parameter. The order which can either be 'ASC' (ascending) or 'DESC' (descending). If not included, 'ASC' will be used by default.
 * @return array | $dataM | Grid Sorted | Grid sorted
 *
 */
function orderGrid($dataM, $field, $ord = 'ASC') {
  if(!is_array($dataM) or !isset($field) or $field=='') {
    throw new Exception('function:orderGrid Error!, bad parameters found!');
  }
  for($i=1; $i <= count($dataM)-1; $i++) {
    for($j=$i+1; $j <= count($dataM); $j++) {
      if(strtoupper($ord) == 'ASC') {
        if(strtolower($dataM[$j][$field]) < strtolower($dataM[$i][$field])) {
          $swap  = $dataM[$i];
          $dataM[$i] = $dataM[$j];
          $dataM[$j] = $swap;
        }
      } else {
        if($dataM[$j][$field] > $dataM[$i][$field]) {
          $swap  = $dataM[$i];
          $dataM[$i] = $dataM[$j];
          $dataM[$j] = $swap;
        }
      }
    }
  }
  return $dataM;
}
/**
 * @method
 *
 * Executes operations among the grid fields, such as addition, substraction, etc
 *
 * @name evaluateFunction
 * @label evaluate Function
 * @link http://wiki.processmaker.com/index.php/ProcessMaker_Functions#evaluateFunction.28.29
 *
 * @param array | $aGrid | Grid | The input grid.
 * @param string(32) | $sExpresion | Expression for the operation | The input expression for the operation among grid fields. The expression must always be within double quotes, otherwise a fatal error will occur. 
 * @return array | $aGrid | Grid | Grid with executed operation
 *
 */
function evaluateFunction($aGrid, $sExpresion) {
  $sExpresion = str_replace('Array','$this->aFields', $sExpresion);
  $sExpresion .= ';';
  G::LoadClass('pmScript');
  $pmScript = new PMScript();
  $pmScript->setScript($sExpresion);

  for($i=1; $i<=count($aGrid); $i++) {
    $aFields = $aGrid[$i];

    $pmScript->setFields($aFields);

    $pmScript->execute();

    $aGrid[$i] = $pmScript->aFields;
  }
  return $aGrid;
}

/** Web Services Functions **/
/**
 * @method
 *
 * Logs in a user to initiate a web services session in a ProcessMaker server.
 *
 * @name WSLogin
 * @label WS Login
 * @link http://wiki.processmaker.com/index.php/ProcessMaker_Functions#WSLogin.28.29
 *
 * @param string(32) | $user | Username of the user | The username of the user who will login to ProcessMaker. All subsequent actions will be limited to the permissions of that user.
 * @param string(32) | $pass | Password encrypted | The user's password encrypted as an MD5 hash with 'md5:' prepended.
 * @param string(32) | $endpoint="" | URI of the WSDL | The URI (address) of the WSDL definition of the ProcessMaker web services.
 * @return string | $unique ID | Unique Id |The unique ID for the initiated session.
 *
 */
function WSLogin($user, $pass, $endpoint='') {
  $client = wSOpen(true);
  $params = array('userid'=>$user, 'password'=>$pass);
  $result = $client->__SoapCall('login', array($params));

  if($result->status_code == 0) {
    if($endpoint != '') {
      $_SESSION['WS_END_POINT'] = $endpoint;
    }
    return $_SESSION['WS_SESSION_ID'] = $result->message;
  } else {
    unset($_SESSION['WS_SESSION_ID']);
    $wp = (trim($pass) != "")?'YES':'NO';
    throw new Exception("WSAccess denied! for user $user with password $wp");
  }
}
/**
 * @method
 *
 * Opens a connection for web services and returns a SOAP client object which is
 * used by all subsequent other WS function calls
 *
 * @name WSOpen
 * @label WS Open
 * @link http://wiki.processmaker.com/index.php/ProcessMaker_Functions#WSOpen.28.29
 *
 * @param boolean | $force=false | Optional Parameter | Optional parameter. Set to true to force a new connection to be created even if a valid connection already exists.
 * @return Object Client | $client | SoapClient object | A SoapClient object. If unable to establish a connection, returns NULL.
 *
 */
function WSOpen($force=false) {
  if(isset($_SESSION['WS_SESSION_ID']) || $force) {
    if( !isset ($_SESSION['WS_END_POINT']) ) {
      $defaultEndpoint = 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/sys'.SYS_SYS.'/en/green/services/wsdl';
    }
    $endpoint = isset( $_SESSION['WS_END_POINT'] ) ? $_SESSION['WS_END_POINT'] : $defaultEndpoint;
    $client = new SoapClient( $endpoint );
    return $client;
  } else {
    throw new Exception('WS session is not open');
  }
}
/**
 * @method
 *
 * Returns all the tasks which has open delegations for the indicated case.
 *
 * @name WSTaskCase
 * @label WS Task Case
 * @link http://wiki.processmaker.com/index.php/ProcessMaker_Functions#WSTaskCase.28.29
 *
 * @param string(32) | $caseId | Case ID | The unique ID for the case. Case UIDs can be found with WSCaseList() and are stored in the field wf_<WORKSPACE>.APPLICATION.APP_UID.
 * @return array | $rows | Array of tasks open | An array of tasks in the indicated case which have open delegations.
 *
 */
function WSTaskCase($caseId) {
  $client = WSOpen();

  $sessionId = $_SESSION['WS_SESSION_ID'];

  $params = array('sessionId'=>$sessionId, 'caseId'=>$caseId);
  $result = $client->__soapCall('taskCase', array($params));

  $i = 1;
  if(isset ($result->taskCases)) {
    foreach ( $result->taskCases as $key=> $item) {
      if ( isset ($item->item) ) {
        foreach ( $item->item as $index=> $val ) {
          if ( $val->key == 'guid' ) $guid = $val->value;
          if ( $val->key == 'name' ) $name = $val->value;
        }
      } else {
        foreach ( $item as $index=> $val ) {
          if ( $val->key == 'guid' ) $guid = $val->value;
          if ( $val->key == 'name' ) $name = $val->value;
        }
      }

      $rows[$i++] = array ( 'guid' => $guid, 'name' => $name );
    }
  }
  return $rows;
}
/**
 * @method
 *
 * Returns a list of tasks in which the logged-in user can initiate cases or is
 * assigned to these cases.
 *
 * @name WSTaskList
 * @label WS Task List
 * @link http://wiki.processmaker.com/index.php/ProcessMaker_Functions#WSTaskList.28.29
 *
 * @return array | $rows |List of tasks | This function returns a list of tasks
 *
 */
function WSTaskList() {
  $client = WSOpen();

  $sessionId = $_SESSION['WS_SESSION_ID'];
  $params = array('sessionId'=>$sessionId );
  $result = $client->__SoapCall('TaskList', array($params));

  $i = 1;
  if(isset ($result->tasks)) {
    foreach ( $result->tasks as $key=> $item) {
      if ( isset ($item->item) ) {
        foreach ( $item->item as $index=> $val ) {
          if ( $val->key == 'guid' ) $guid = $val->value;
          if ( $val->key == 'name' ) $name = $val->value;
        }
      } else {
        foreach ( $item as $index=> $val ) {
          if ( $val->key == 'guid' ) $guid = $val->value;
          if ( $val->key == 'name' ) $name = $val->value;
        }
      }

      $rows[$i++] = array ( 'guid' => $guid, 'name' => $name );
    }
  }
  return $rows;
}
/**
 * @method
 *
 * Returns a list of users whose status is "ACTIVE" in the current workspace.
 *
 * @name WSUserList
 * @label WS User List
 * @link http://wiki.processmaker.com/index.php/ProcessMaker_Functions#WSUserList.28.29
 *
 * @return array | $rows | List | List of Active users in the workspace
 *
 */
function WSUserList() {
  $client = WSOpen();

  $sessionId = $_SESSION['WS_SESSION_ID'];
  $params = array('sessionId'=>$sessionId );
  $result = $client->__SoapCall('UserList', array($params));

  $i = 1;
  if(isset ($result->users)) {
    foreach ( $result->users as $key=> $item) {
      if ( isset ($item->item) ) {
        foreach ( $item->item as $index=> $val ) {
          if ( $val->key == 'guid' ) $guid = $val->value;
          if ( $val->key == 'name' ) $name = $val->value;
        }
      } else {
        foreach ( $item as $index=> $val ) {
          if ( $val->key == 'guid' ) $guid = $val->value;
          if ( $val->key == 'name' ) $name = $val->value;
        }
      }

      $rows[$i++] = array ( 'guid' => $guid, 'name' => $name );
    }
  }
  return $rows;
}
/**
 * @method
 *
 * Returns a list of active groups in a workspace.
 *
 * @name WSGroupList
 * @label WS Group List
 * @link http://wiki.processmaker.com/index.php/ProcessMaker_Functions#WSGroupList.28.29
 *
 * @return array | $rows | List | List of active groups in the workspace
 *
 */
function WSGroupList() {
  $client = WSOpen();

  $sessionId = $_SESSION['WS_SESSION_ID'];
  $params = array('sessionId'=>$sessionId );
  $result = $client->__SoapCall('GroupList', array($params));

  $i = 1;
  if(isset ($result->groups)) {
    foreach ( $result->groups as $key=> $item) {
      if ( isset ($item->item) ) {
        foreach ( $item->item as $index=> $val ) {
          if ( $val->key == 'guid' ) $guid = $val->value;
          if ( $val->key == 'name' ) $name = $val->value;
        }
      } else {
        foreach ( $item as $index=> $val ) {
          if ( $val->key == 'guid' ) $guid = $val->value;
          if ( $val->key == 'name' ) $name = $val->value;
        }
      }

      $rows[$i++] = array ( 'guid' => $guid, 'name' => $name );
    }
  }
  return $rows;
}

/**
 * @method
 *
 * Returns a list of roles in the current workspace.
 *
 * @name WSRoleList
 * @label WS Role List
 * @link http://wiki.processmaker.com/index.php/ProcessMaker_Functions#WSRoleList.28.29
 *
 * @return array | $rows | List | List of roles in the workspace
 *
 */
function WSRoleList() {
  $client = WSOpen();

  $sessionId = $_SESSION['WS_SESSION_ID'];
  $params = array('sessionId'=>$sessionId );
  $result = $client->__SoapCall('RoleList', array($params));
  $i = 1;
  if(isset ($result->roles)) {
    foreach ( $result->roles as $key=> $item) {
      if ( isset ($item->item) ) {
        foreach ( $item->item as $index=> $val ) {
          if ( $val->key == 'guid' ) $guid = $val->value;
          if ( $val->key == 'name' ) $name = $val->value;
        }
      } else {
        foreach ( $item as $index=> $val ) {
          if ( $val->key == 'guid' ) $guid = $val->value;
          if ( $val->key == 'name' ) $name = $val->value;
        }
      }

      $rows[$i++] = array ( 'guid' => $guid, 'name' => $name );
    }
  }
  return $rows;
}
/**
 * @method
 *
 * Returns a list of the cases which the current logged-in user has privileges to
 * open.
 *
 * @name WSCaseList
 * @label WS Case List
 * @Link http://wiki.processmaker.com/index.php/ProcessMaker_Functions#WSCaseList.28.29
 *
 * @return array | $rows | List of the cases |It returns a list of cases
 *
 */
function WSCaseList() {
  $client = WSOpen();

  $sessionId = $_SESSION['WS_SESSION_ID'];
  $params = array('sessionId'=>$sessionId );
  $result = $client->__SoapCall('CaseList', array($params));

  $i = 1;
  if(isset ($result->cases)) {
    foreach ( $result->cases as $key=> $item) {
      if ( isset ($item->item) ) {
        foreach ( $item->item as $index=> $val ) {
          if ( $val->key == 'guid' ) $guid = $val->value;
          if ( $val->key == 'name' ) $name = $val->value;
        }
      } else {
        foreach ( $item as $index=> $val ) {
          if ( $val->key == 'guid' ) $guid = $val->value;
          if ( $val->key == 'name' ) $name = $val->value;
        }
      }

      $rows[$i++] = array ( 'guid' => $guid, 'name' => $name );
    }
  }

  return $rows;
}
/**
 * @method
 *
 * Returns a list of processes in the current workspace.
 *
 * @name WSProcessList
 * @label WS Process List
 * @Link http://wiki.processmaker.com/index.php/ProcessMaker_Functions#WSProcessList.28.29
 *
 * @return array | $rows | List of processes | A list of processes
 *
 */
function WSProcessList() {
  $client = WSOpen();

  $sessionId = $_SESSION['WS_SESSION_ID'];
  $params = array('sessionId'=>$sessionId );
  $result = $client->__SoapCall('ProcessList', array($params));

  $i = 1;
  if(isset ($result->processes)) {
    foreach ( $result->processes as $key=> $item) {
      if ( isset ($item->item) ) {
        foreach ( $item->item as $index=> $val ) {
          if ( $val->key == 'guid' ) $guid = $val->value;
          if ( $val->key == 'name' ) $name = $val->value;
        }
      } else {
        foreach ( $item as $index=> $val ) {
          if ( $val->key == 'guid' ) $guid = $val->value;
          if ( $val->key == 'name' ) $name = $val->value;
        }
      }

      $rows[$i++] = array ( 'guid' => $guid, 'name' => $name );
    }
  }
  return $rows;
}
/**
 * @method
 *
 * Returns a list of processes in the current workspace.
 *
 * @name getEmailConfiguration
 * @label WS Get Email Configuration
 *
 *
 * @return array | $aFields | Array |Get current email configuration
 *
 */
//private function to get current email configuration
function getEmailConfiguration () {
  require_once 'classes/model/Configuration.php';
  $oConfiguration = new Configuration();
  $sDelimiter     = DBAdapter::getStringDelimiter();
  $oCriteria      = new Criteria('workflow');
  $oCriteria->add(ConfigurationPeer::CFG_UID, 'Emails');
  $oCriteria->add(ConfigurationPeer::OBJ_UID, '');
  $oCriteria->add(ConfigurationPeer::PRO_UID, '');
  $oCriteria->add(ConfigurationPeer::USR_UID, '');
  $oCriteria->add(ConfigurationPeer::APP_UID, '');

  if (ConfigurationPeer::doCount($oCriteria) == 0) {
    $oConfiguration->create(array('CFG_UID' => 'Emails', 'OBJ_UID' => '', 'CFG_VALUE' => '', 'PRO_UID' => '', 'USR_UID' => '', 'APP_UID' => ''));
    $aFields = array();
  }
  else {
    $aFields = $oConfiguration->load('Emails', '', '', '', '');
    if ($aFields['CFG_VALUE'] != '') {
      $aFields = unserialize($aFields['CFG_VALUE']);
    }
    else {
      $aFields = array();
    }
  }

  return $aFields;
}

/**
 * @method
 *
 * Sends an email using a template file.
 *
 * @name PMFSendMessage
 * @label PMF Send Message
 * @link http://wiki.processmaker.com/index.php/ProcessMaker_Functions#PMFSendMessage.28.29
 *
 * @param string(32) | $caseId | UID for case | The UID (unique identification) for a case, which is a string of 32 hexadecimal characters to identify the case.
 * @param string(32) | $sFrom | Email addres | The email address of the person who sends out the email.
 * @param string(32) | $sTo | Email receptor | The email address(es) to whom the email is sent. If multiple recipients, separate each email address with a semicolon.
 * @param string(32) | $sCc | Email addres for copies | The email address(es) of people who will receive carbon copies of the email.
 * @param string(32) | $sBcc | Email addres for copies hidden | The email address(es) of people who will receive blind carbon copies of the email.
 * @param string(32) | $sSubject | Subject of the email | The subject (title) of the email.
 * @param string(32) | $sTemplate | Name of the template | The name of the template file in plain text or HTML format which will produce the body of the email.
 * @param array | $aFields=array() | An associative array optional | Optional parameter. An associative array where the keys are the variable name and the values are the variable's value.
 * @return int | $result | result | Result of sending email
 *
 */
function PMFSendMessage($caseId, $sFrom, $sTo, $sCc, $sBcc, $sSubject, $sTemplate, $aFields = array()) {
  G::LoadClass('wsBase');
  $ws = new wsBase ();
  $result = $ws->sendMessage($caseId, $sFrom, $sTo, $sCc, $sBcc, $sSubject, $sTemplate, $aFields);

  if ( $result->status_code == 0) {
    return 1;
  } else {
    return 0;
  }
}

/**
 * @method
 *
 * Sends two variables to the specified case.
 * It will create new case variables if they don't already exist
 *
 * @name WSSendVariables
 * @label WS Send Variables
 * @link http://wiki.processmaker.com/index.php/ProcessMaker_Functions#WSSendVariables.28.29
 *
 * @param string(32) | $caseId | UID for case | The unique ID of the case which will receive the variables.
 * @param string(32) | $name1 | Name of the first variable | The name of the first variable to be sent to the created case.
 * @param string(32) | $value1 | Value of the first variable | The value of the first variable to be sent to the created case.
 * @param string(32) | $name2 | Name of the second variable | The name of the second variable to be sent to the created case.
 * @param string(32) | $value2 | Value of the second variable | The value of the second variable to be sent to the created case.
 * @return array | $fields | WS Response Associative Array: | The function returns a WS Response associative array.
 *
 */
function WSSendVariables($caseId, $name1, $value1, $name2, $value2) {
  $client = WSOpen();
  $sessionId = $_SESSION['WS_SESSION_ID'];

  $variables[1]->name  = $name1;
  $variables[1]->value = $value1;
  $variables[2]->name  = $name2;
  $variables[2]->value = $value2;
  $params = array('sessionId'=>$sessionId, 'caseId'=>$caseId, 'variables'=>$variables);
  $result = $client->__SoapCall('SendVariables', array($params));

  $fields['status_code'] = $result->status_code;
  $fields['message']     = $result->message;
  $fields['time_stamp']  = $result->timestamp;
  return $fields;
}
/**
 * @method
 *
 * Routes (derivates) a case, moving the case to the next task in the process
 * according its routing rules.
 *
 * @name WSDerivateCase
 * @label WS Derivate Case
 * @link http://wiki.processmaker.com/index.php/ProcessMaker_Functions#WSDerivateCase.28.29
 *
 * @param string(32) | $CaseId | Case ID |The unique ID for a case, which can be found with WSCaseList() or by examining the field wf_<WORKSPACE>.APPLICATION.APP_UID.
 * @param string(32) | $delIndex | Delegation index for the task | The delegation index for the task, which can be found by examining the field wf_<WORKSPACE>.APP_DELEGATION.DEL_INDEX.
 * @return array | $fields | WS Response Associative Array | A WS Response associative array.
 *
 */
function WSDerivateCase($caseId, $delIndex) {
  $client = WSOpen();
  $sessionId = $_SESSION['WS_SESSION_ID'];

  $params = array('sessionId'=>$sessionId, 'caseId'=>$caseId, 'delIndex'=>$delIndex );
  $result = $client->__SoapCall('DerivateCase', array($params));

  $fields['status_code'] = $result->status_code;
  $fields['message']     = $result->message;
  $fields['time_stamp']  = $result->timestamp;
  return $fields;
}
/**
 * @method
 *
 * Creates a case with any user with two initial case variables.
 *
 * @name WSNewCaseImpersonate
 * @label WS New Case Impersonate
 * @link  http://wiki.processmaker.com/index.php/ProcessMaker_Functions#WSNewCaseImpersonate.28.29
 *
 * @param string(32) | $processId | Process ID | The unique ID for the process.
 * @param string(32) | $userId | User ID | The unique ID for the user.
 * @param string(32) | $name1 | Name of the first variable  | The name of the first variable to be sent to the created case.
 * @param string(32) | $value1 | Value of the first variable | The value of the first variable to be sent to the created case.
 * @param string(32) | $name2 | Name of the second variable | The name of the second variable to be sent to the created case.
 * @param string(32) | $value2 | Value of the second variable | The value of the second variable to be sent to the created case.
 * @return array | $fields | WS Response Associative Array | A WS Response associative array.
 *
 */
function WSNewCaseImpersonate($processId, $userId, $name1, $value1, $name2, $value2) {
  $client = WSOpen();
  $sessionId = $_SESSION['WS_SESSION_ID'];

  $variables[1]->name  = $name1;
  $variables[1]->value = $value1;
  $variables[2]->name  = $name2;
  $variables[2]->value = $value2;

  $params = array('sessionId'=>$sessionId, 'processId'=>$processId, 'userId'=>$userId, 'variables'=>$variables );
  $result = $client->__SoapCall('NewCaseImpersonate', array($params));

  $fields['status_code'] = $result->status_code;
  $fields['message']     = $result->message;
  $fields['time_stamp']  = $result->timestamp;
  return $fields;
}
/**
 * @method
 *
 * Creates a new case starting with a specified task and using two initial case
 * variables.
 *
 * @name WSNewCase
 * @label WS New Case
 * @link http://wiki.processmaker.com/index.php/ProcessMaker_Functions#WSNewCase.28.29
 *
 * @param string(32) | $processId | Process ID | The unique ID for the process. To use the current process, use the system variable @@PROCESS.
 * @param string(32) | $userId | User ID | The unique ID for the user. To use the currently logged-in user, use the system variable @@USER_LOGGED.
 * @param string(32) | $name1 | Name of the first variable  | The name of the first variable to be sent to the created case.
 * @param string(32) | $value1 | Value of the first variable | The value of the first variable to be sent to the created case.
 * @param string(32) | $name2 | Name of the second variable | The name of the second variable to be sent to the created case.
 * @param string(32) | $value2 | Value of the second variable | The value of the second variable to be sent to the created case.
 * @return array | $fields | WS array | A WS Response associative array.
 *
 */
function WSNewCase($processId, $taskId, $name1, $value1, $name2, $value2) {
  $client = WSOpen();
  $sessionId = $_SESSION['WS_SESSION_ID'];

  $variables[1]->name  = $name1;
  $variables[1]->value = $value1;
  $variables[2]->name  = $name2;
  $variables[2]->value = $value2;

  $params = array('sessionId'=>$sessionId, 'processId'=>$processId, 'taskId'=>$taskId, 'variables'=>$variables );
  $result = $client->__SoapCall('NewCase', array($params));

  $fields['status_code'] = $result->status_code;
  $fields['message']     = $result->message;
  $fields['time_stamp']  = $result->timestamp;
  return $fields;
}
/**
 * @method
 *
 * Assigns a user to a group (as long as the logged in user has the PM_USERS
 * permission in their role).
 *
 * @name WSAssignUserToGroup
 * @label WS Assign User To Group
 * @link http://wiki.processmaker.com/index.php/ProcessMaker_Functions#WSAssignUserToGroup.28.29
 *
 * @param string(32) | $userId | User ID | The unique ID for a user.
 * @param string(32) | $groupId | Group ID | The unique ID for a group.
 * @return array | $fields | WS array |A WS Response associative array.
 *
 */
function WSAssignUserToGroup($userId, $groupId) {
  $client = WSOpen();
  $sessionId = $_SESSION['WS_SESSION_ID'];

  $params = array('sessionId'=>$sessionId, 'userId'=>$userId, 'groupId'=>$groupId);
  $result = $client->__SoapCall('AssignUserToGroup', array($params));

  $fields['status_code'] = $result->status_code;
  $fields['message']     = $result->message;
  $fields['time_stamp']  = $result->timestamp;
  return $fields;
}
/**
 * @method
 *
 * Creates a new user in ProcessMaker.
 *
 * @name WSCreateUser
 * @label WS Create User
 * @link http://wiki.processmaker.com/index.php/ProcessMaker_Functions#WSCreateUser.28.29
 *
 * @param string(32) | $userId | User ID | The username of the new user, which can be up to 32 characters long.
 * @param string(32) | $password | Password of the new user | El password of the new user, which can be up to 32 characters long.
 * @param string(32) | $firstname | Firstname of the new user | The first name(s) of the new user, which can be up to 50 characters long.
 * @param string(32) | $lastname | Lastname of the new user | The last name(s) of the new user, which can be up to 50 characters long.
 * @param string(32) | $email | Email the new user | The e-mail of the new user, which can be up to 100 characters long.
 * @param string(32) | $role | Rol of the new user | The role of the new user, such as 'PROCESSMAKER_ADMIN' and 'PROCESSMAKER_OPERATOR'.
 * @return array | $fields | WS array | A WS Response associative array.
 *
 */
function WSCreateUser($userId, $password, $firstname, $lastname, $email, $role) {
  $client = WSOpen();
  $sessionId = $_SESSION['WS_SESSION_ID'];
  $params = array('sessionId'=>$sessionId, 'userId'=>$userId, 'firstname'=>$firstname, 'lastname'=>$lastname, 'email'=>$email, 'role'=>$role, 'password'=>$password);
  $result = $client->__SoapCall('CreateUser', array($params));

  $fields['status_code'] = $result->status_code;
  $fields['message']     = $result->message;
  $fields['time_stamp']  = $result->timestamp;
  return $fields;
}
/**
 * @method
 *
 * Returns the unique ID for the current active session.
 *
 * @name WSGetSession
 * @label WS Get Session
 * @link http://wiki.processmaker.com/index.php/ProcessMaker_Functions#WSGetSession.28.29
 *
 * @return string | $userId | Sesion ID | The unique ID for the current active session.
 *
 */
function WSGetSession() {
  if(isset($_SESSION['WS_SESSION_ID'])) {
    return $_SESSION['WS_SESSION_ID'];
  } else {
    throw new Exception("SW session is not opem!");
  }
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/** Local Services Functions **/

/**
 * @method
 *
 * Returns all the tasks for the specified case which have open delegations.
 *
 * @name PMFTaskCase
 * @label PMF Task Case
 * @link http://wiki.processmaker.com/index.php/ProcessMaker_Functions#PMFTaskCase.28.29
 *
 * @param string(32) | $caseId | Case ID | The unique ID for a case.
 * @return array | $rows | List of tasks | A list of tasks
 *
 */
function PMFTaskCase($caseId) #its test was successfull
{
  G::LoadClass('wsBase');
  $ws = new wsBase ();
  $result = $ws->taskCase($caseId);
  $rows = Array();
  $i = 1;
  if(isset ($result)) {
    foreach ( $result as $item) {
      $rows[$i++] = $item;
    }
  }
  return $rows;
}
/**
 * @method
 *
 * Returns a list of tasks which the specified user has initiated.
 *
 * @name PMFTaskList
 * @label PMF Task List
 * @link http://wiki.processmaker.com/index.php/ProcessMaker_Functions#PMFTaskList.28.29
 *
 * @param string(32) | $userid | User ID | The unique ID of a user.
 * @return array | $rows | List of tasks | An array of tasks
 *
 */
function PMFTaskList($userId) #its test was successfull
{
  G::LoadClass('wsBase');
  $ws = new wsBase ();
  $result = $ws->taskList($userId);
  $rows = Array();
  $i = 1;
  if(isset ($result)) {
    foreach ( $result as $item) {
      $rows[$i++] = $item;
    }
  }
  return $rows;
}
/**
 * @method
 *
 * Returns a list of users whose status is set to "ACTIVE" for the current workspace.
 *
 * @name PMFUserList
 * @label PMF User List
 * @link http://wiki.processmaker.com/index.php/ProcessMaker_Functions#PMFUserList.28.29
 *
 * @return array | $rows | List of users | An array of users
 *
 */
function PMFUserList() #its test was successfull
{
  G::LoadClass('wsBase');
  $ws = new wsBase ();
  $result = $ws->userList();
  $rows = Array();
  $i = 1;
  if(isset ($result)) {
    foreach ( $result as $item) {
      $rows[$i++] = $item;
    }
  }
  return $rows;
}
/**
 * @method
 *
 * Generates an Output Document
 *
 * @name PMFGenerateOutputDocument
 * @label PMF Generate Output Document
 *
 * @param string(32) | $outputID | Output ID | Output Document ID
 * @return none | $none | None | None
 *
 */
function PMFGenerateOutputDocument($outputID) {

  $oCase = new Cases();
  $oCase->thisIsTheCurrentUser($_SESSION['APPLICATION'], $_SESSION['INDEX'], $_SESSION['USER_LOGGED'], 'REDIRECT', 'cases_List');

  $oOutputDocument = new OutputDocument();
  $aOD = $oOutputDocument->load($outputID);

  $Fields = $oCase->loadCase( $_SESSION['APPLICATION'] );

  $sFilename = ereg_replace('[^A-Za-z0-9_]', '_', G::replaceDataField($aOD['OUT_DOC_FILENAME'], $Fields['APP_DATA']));

  if ( $sFilename == '' ) $sFilename='_';

  $sFilename = ereg_replace('[^A-Za-z0-9_]', '_', G::replaceDataField($aOD['OUT_DOC_FILENAME'], $Fields['APP_DATA']));
  if ( $sFilename == '' ) $sFilename='_';
  $pathOutput = PATH_DOCUMENT . $_SESSION['APPLICATION'] . PATH_SEP . 'outdocs'. PATH_SEP ;
  G::mk_dir ( $pathOutput );

  $oOutputDocument->generate( $outputID, $Fields['APP_DATA'], $pathOutput, $sFilename, $aOD['OUT_DOC_TEMPLATE'], (boolean)$aOD['OUT_DOC_LANDSCAPE'] );

} 
/**
 * @method
 *
 * Returns a list of groups from the current workspace
 *
 * @name PMFGroupList
 * @label PMF Group List
 * @link http://wiki.processmaker.com/index.php/ProcessMaker_Functions#PMFGroupList.28.29
 *
 * @return array | $rows | List of groups | An array of groups
 *
 */
function PMFGroupList() #its test was successfull
{
  G::LoadClass('wsBase');
  $ws = new wsBase ();
  $result = $ws->groupList();
  $rows = Array();
  $i = 1;
  if(isset ($result)) {
    foreach ( $result as $item) {
      $rows[$i++] = $item;
    }
  }
  return $rows;
}

/**
 * @method
 *
 * Returns a list of roles whose status is "ACTIVE" for the current workspace.
 *
 * @name PMFRoleList
 * @label PMF Role List
 * @link http://wiki.processmaker.com/index.php/ProcessMaker_Functions#PMFRoleList.28.29
 *
 * @return array | $rows | List of roles | This function returns an array of roles
 *
 */
function PMFRoleList() #its test was successfull
{
  G::LoadClass('wsBase');
  $ws = new wsBase ();
  $result = $ws->roleList();
  $rows = Array();
  $i = 1;
  if(isset ($result)) {
    foreach ( $result as $item) {
      $rows[$i++] = $item;
    }
  }
  return $rows;
}
/**
 * @method
 *
 * Returns a list of the pending cases for a specified user
 *
 * @name PMFCaseList
 * @label PMF Case List
 * @link http://wiki.processmaker.com/index.php/ProcessMaker_Functions#PMFCaseList.28.29
 *
 * @param string(32) | $userId | User ID | The unique ID of a user who is assigned to work on the cases.
 * @return array | $rows | List of cases | A list of cases
 *
 */
function PMFCaseList($userId) #its test was successfull
{
  G::LoadClass('wsBase');
  $ws = new wsBase ();
  $result = $ws->caseList($userId);
  $rows = Array();
  $i = 1;
  if(isset ($result)) {
    foreach ( $result as $item) {
      $rows[$i++] = $item;
    }
  }
  return $rows;
}
/**
 * @method
 *
 * Returns a list of processes for the current workspace
 *
 * @name PMFProcessList
 * @label PMF Process List
 * @link http://wiki.processmaker.com/index.php/ProcessMaker_Functions#PMFProcessList.28.29
 *
 * @return array | $rows | Lis ot Processes | An array of tasks in the indicated case which have open delegations
 *
 */
function PMFProcessList() #its test was successfull
{
  G::LoadClass('wsBase');
  $ws = new wsBase ();
  $result = $ws->processList();
  $rows = Array();
  $i = 1;
  if(isset ($result)) {
    foreach ( $result as $item) {
      $rows[$i++] = $item;
    }
  }
  return $rows;
}

/**
 * @method
 *
 * Sends an array of case variables to a specified case.
 *
 * @name PMFSendVariables
 * @label PMF Send Variables
 * @link http://wiki.processmaker.com/index.php/ProcessMaker_Functions#PMFSendVariables.28.29
 *
 * @param string(32) | $caseId | Case ID | The unique ID of the case to receive the variable.
 * @param array | $variables | Array of variables | An associative array to hold the case variables to send to the case.
 * @return int | $result | Result of send variables | Returns 1 if the variables were sent successfully to the case; otherwise, returns 0 if an error occurred.
 *
 */
function PMFSendVariables($caseId, $variables) {
  G::LoadClass('wsBase');
  $ws = new wsBase ();

  $result = $ws->sendVariables($caseId, $variables);
  if($result->status_code == 0) {
    return 1;
  } else {
    return 0;
  }
}
/**
 * @method
 *
 * Derivates (routes) a case to the next task in the process.
 *
 * @name PMFDerivateCase
 * @label PMF Derivate Case
 * @link http://wiki.processmaker.com/index.php/ProcessMaker_Functions#PMFDerivateCase.28.29
 *
 * @param string(32) | $caseId | Case ID | The unique ID for the case to be derivated (routed)
 * @param int | $delIndex | delegation index for the case  | The delegation index for the case to derivated (routed).
 * @param boolean | $bExecuteTriggersBeforeAssignment = false | Trigger | Optional parameter. If set to true, any triggers which are assigned to pending steps in the current task will be executed before the case is assigned to the next user.
 * @return int | $result | Result of Derivate case | Returns 1 if new case was derivated (routed) successfully; otherwise, returns 0 if an error occurred.
 *
 */
function PMFDerivateCase($caseId, $delIndex, $bExecuteTriggersBeforeAssignment = false) {
  G::LoadClass('wsBase');
  $ws = new wsBase ();
  $result = $ws->derivateCase($_SESSION['USER_LOGGED'], $caseId, $delIndex, $bExecuteTriggersBeforeAssignment);//var_dump($result);die;
  if (isset($result->status_code)) {
    return $result->status_code;
  }
  else {
    return 0;
  }
  if($result->status_code == 0) {
    return 1;
  } else {
    return 0;
  }
}
/**
 * @method
 *
 * Creates a new case with a user who can impersonate a user with the proper
 * privileges.
 *
 * @name PMFNewCaseImpersonate
 * @label PMF New Case Impersonate
 * @link http://wiki.processmaker.com/index.php/ProcessMaker_Functions#PMFNewCaseImpersonate.28.29
 *
 * @param string(32) | $processId | Process ID | The unique ID of the process.
 * @param string(32) | $userId | User ID | The unique ID of the user.
 * @param array | $variables | Array of variables | An associative array of the variables which will be sent to the case.
 * @return int | $result | Result | Returns 1 if new case was created successfully; otherwise, returns 0 if an error occurred.
 *
 */
function PMFNewCaseImpersonate($processId, $userId, $variables) {
  G::LoadClass('wsBase');
  $ws = new wsBase ();
  $result = $ws->newCaseImpersonate($processId, $userId, $variables);

  if($result->status_code == 0) {
    return 1;
  } else {
    return 0;
  }
}
/**
 * @method
 *
 * Creates a new case starting with the specified task
 *
 * @name PMFNewCase
 * @label PMF New Case
 * @link http://wiki.processmaker.com/index.php/ProcessMaker_Functions#PMFNewCase.28.29
 *
 * @param string(32) | $processId | Process ID | The unique ID of the process.
 * @param string(32) | $userId | User ID | The unique ID of the user.
 * @param string(32) | $taskId | Task ID | The unique ID of the task.
 * @param array | $variables | Array of variables | An associative array of the variables which will be sent to the case.
 * @return string | $idNewCase | Case ID | If an error occured, it returns the integer zero. Otherwise, it returns a string with the case UID of the new case.
 *
 */
function PMFNewCase($processId, $userId, $taskId, $variables) {
  G::LoadClass('wsBase');
  $ws = new wsBase ();

  $result = $ws->newCase($processId, $userId,$taskId, $variables);

  if($result->status_code == 0) {
    return $result->caseId;
  } else {
    return 0;
  }
}
/**
 * @method
 *
 * Assigns a user to a group.
 *
 * @name PMFAssignUserToGroup
 * @label PMF Assign User To Group
 * @link http://wiki.processmaker.com/index.php/ProcessMaker_Functions#PMFNewCase.28.29
 *
 * @param string(32) | $userId | User ID | The unique ID of the user.
 * @param string(32) | $groupId | Group ID | The unique ID of the group.
 * @return int | $result | Result of the assignment | Returns 1 if the user was successfully assigned to the group; otherwise, returns 0.
 *
 */
function PMFAssignUserToGroup($userId, $groupId) {
  G::LoadClass('wsBase');
  $ws = new wsBase ();
  $result = $ws->assignUserToGroup($userId, $groupId);

  if($result->status_code == 0) {
    return 1;
  } else {
    return 0;
  }
}
/**
 * @method
 *
 * Creates a new user with the given data.
 *
 * @name PMFCreateUser
 * @label PMF Create User
 * @link http://wiki.processmaker.com/index.php/ProcessMaker_Functions#PMFCreateUser.28.29
 *
 * @param string(32) | $userId | User ID | The username for the new user.
 * @param string(32) | $password | Password of the new user  | The password of the new user, which can be up to 32 characters long.
 * @param string(32) | $firstname | Firstname of the new user | The first name of the user, which can be up to 50 characters long.
 * @param string(32) | $lastname | Lastname of the new user | The last name of the user, which can be up to 50 characters long.
 * @param string(32) | $email | Email the new user | The email of the new user, which can be up to 100 characters long.
 * @param string(32) | $role | Rol of the new user | The role of the new user such as 'PROCESSMAKER_ADMIN' or 'PROCESSMAKER_OPERATOR'.
 * @return int | $result | Result of the creation | Returns 1 if the new user was created successfully; otherwise, returns 0 if an error occurred.
 *
 */
function PMFCreateUser($userId, $password, $firstname, $lastname, $email, $role) {
  G::LoadClass('wsBase');
  $ws = new wsBase ();
  $result = $ws->createUser($userId, $firstname, $lastname, $email, $role, $password);

  if($result->status_code == 0) {
    return 1;
  } else {
    return 0;
  }
}
/**
 * @method
 *
 * Creates a random string of letters and/or numbers of a specified length,which
 * can be used as the PINs (public identification numbers) and codes for cases.
 *
 * @name generateCode
 * @label generate Code
 * @link http://wiki.processmaker.com/index.php/ProcessMaker_Functions#generateCode.28.29
 *
 * @param int | $iDigits = 4 | Number of characters | The number of characters to be generated.
 * @param string(32) | $sType="NUMERIC" | Type of characters | The type of of characters to be generated
 * @return string | $generateString | Generated string | The generated string of random characters.
 *
 */
function generateCode ( $iDigits = 4, $sType = 'NUMERIC' ) {
  return G::generateCode ($iDigits, $sType );
}

/**
 * @method
 *
 * Sets the code and PIN for a case.
 *
 * @name setCaseTrackerCode
 * @label set Case Tracker Code
 * @link http://wiki.processmaker.com/index.php/ProcessMaker_Functions#setCaseTrackerCode.28.29
 *
 * @param string(32) | $sApplicationUID | Case ID | The unique ID for a case (which can be found with WSCaseList()
 * @param string(32) | $sCode | New Code for case | The new code for a case, which will be stored in the field wf_<WORKSPACE>.APPLICATION.APP_CODE
 * @param string(32) | $sPIN = "" | New Code PIN for case |The new code for a case.
 * @return int | $result | Result | If successful, returns zero, otherwise a non-zero error number.
 *
 */
function setCaseTrackerCode($sApplicationUID, $sCode, $sPIN = '') {
  if ($sCode != '') {
    G::LoadClass('case');
    $oCase   = new Cases();
    $aFields = $oCase->loadCase($sApplicationUID);
    $aFields['APP_PROC_CODE'] = $sCode;
    if ($sPIN != '') {
      $aFields['APP_DATA']['PIN'] = $sPIN;
      $aFields['APP_PIN']         = md5($sPIN);
    }
    $oCase->updateCase($sApplicationUID, $aFields);
    return 1;
  }
  else {
    return 0;
  }
}
/**
 * @method
 *
 * Routes (derivates) a case and then displays the case list.
 *
 * @name jumping
 * @label jumping
 * @link http://wiki.processmaker.com/index.php/ProcessMaker_Functions#jumping.28.29
 *
 * @param string(32) | $caseId | Case ID | The unique ID for the case to be routed (derivated).
 * @param int | $delIndex | delegation Index of case | The delegation index of the task to be routed (derivated). Counting starts from 1.
 * @return none | $none | None | None
 *
 */
function jumping ( $caseId, $delIndex ) {
  $x = $this->PMFDerivateCase($caseId, $delIndex);
  if($x==0)
    G::SendTemporalMessage('ID_NOT_DERIVATED', 'error', 'labels');

  G::header('Location: cases_List');
}
/**
 * @method
 *
 * Returns the label of a specified option from a dropdown box, listbox,
 * checkgroup or radiogroup.
 *
 * @name PMFgetLabelOption
 * @label PMF get Label Option
 * @link http://wiki.processmaker.com/index.php/ProcessMaker_Functions#PMFgetLabelOption.28.29
 *
 * @param string(32) | $PROCESS | Process ID | The unique ID of the process which contains the field.
 * @param string(32) | $DYNAFORM_UID | Dynaform ID | The unique ID of the DynaForm where the field is located.
 * @param string(32) | $FIELD_NAME | Fiel Name | The field name of the dropdown box, listbox, checkgroup or radiogroup from the specified DynaForm.
 * @param string(32) | $FIELD_SELECTED_ID | ID selected | The value (i.e., ID) of the option from the fieldName.
 * @return string | $label | Label of the specified option | A string holding the label of the specified option or NULL if the specified option does not exist.
 *
 */
function PMFgetLabelOption($PROCESS, $DYNAFORM_UID, $FIELD_NAME, $FIELD_SELECTED_ID) {
  $G_FORM = new Form ("{$PROCESS}/{$DYNAFORM_UID}", PATH_DYNAFORM, SYS_LANG, false);
  if( isset($G_FORM->fields[$FIELD_NAME]->option[$FIELD_SELECTED_ID]) ) {
    return $G_FORM->fields[$FIELD_NAME]->option[$FIELD_SELECTED_ID];
  } else {
    return null;
  }
}
/**
 * @method
 *
 * Redirects a case to any step in the current task. In order for the step to
 * be executed, the specified step much exist and if it contains a condition,
 * it must evaluate to true.
 *
 * @name PMFRedirectToStep
 * @label PMF Redirect To Step
 * @link http://wiki.processmaker.com/index.php/ProcessMaker_Functions#PMFRedirectToStep.28.29
 *
 * @param string(32) | $sApplicationUID | Case ID | The unique ID for a case,
 * @param int | $iDelegation | Delegation index | The delegation index of a case.
 * @param string(32) | $sStepType | Type of Step | The type of step, which can be "DYNAFORM", "INPUT_DOCUMENT" or "OUTPUT_DOCUMENT".
 * @param string(32) | $sStepUid | Step ID | The unique ID for the step.
 * @return none | $none | None | None
 *
 */
function PMFRedirectToStep($sApplicationUID, $iDelegation, $sStepType, $sStepUid) {
  require_once 'classes/model/AppDelegation.php';
  $oCriteria = new Criteria('workflow');
  $oCriteria->addSelectColumn(AppDelegationPeer::TAS_UID);
  $oCriteria->add(AppDelegationPeer::APP_UID, $sApplicationUID);
  $oCriteria->add(AppDelegationPeer::DEL_INDEX, $iDelegation);
  $oDataset = AppDelegationPeer::doSelectRS($oCriteria);
  $oDataset->setFetchmode(ResultSet::FETCHMODE_ASSOC);
  $oDataset->next();
  $aRow = $oDataset->getRow();
  if ($aRow) {
    require_once 'classes/model/Step.php';
    $oStep = new Step();
    $oTheStep = $oStep->loadByType($aRow['TAS_UID'], $sStepType, $sStepUid);
    $bContinue = true;
    if ($oTheStep->getStepCondition() != '') {
      G::LoadClass('case');
      $oCase   = new Cases();
      $aFields = $oCase->loadCase($sApplicationUID);
      G::LoadClass('pmScript');
      $oPMScript = new PMScript();
      $oPMScript->setFields($aFields['APP_DATA']);
      $oPMScript->setScript($oTheStep->getStepCondition());
      $bContinue = $oPMScript->evaluate();
    }
    if ($bContinue) {
      switch ($oTheStep->getStepTypeObj()) {
        case 'DYNAFORM':
          $sAction = 'EDIT';
          break;
        case 'OUTPUT_DOCUMENT':
          $sAction = 'GENERATE';
          break;
        case 'INPUT_DOCUMENT':
          $sAction = 'ATTACH';
          break;
        case 'EXTERNAL':
          $sAction = 'EDIT';
          break;
        case 'MESSAGE':
          $sAction = '';
          break;
      }
      G::header('Location: ' . 'cases_Step?TYPE=' . $sStepType . '&UID=' . $sStepUid . '&POSITION=' . $oTheStep->getStepPosition() . '&ACTION=' . $sAction);
      die;
    }
  }
}

/**
 * @method
 *
 * Returns a list of the next assigned users to a case.
 *
 * @name PMFGetNextAssignedUsers
 * @label PMFGet Next Assigned Users
 *
 * @param string(32) | $application | Case ID | Id of the case
 * @return array | $array | List of users | Return a list of users
 *
 */
function PMFGetNextAssignedUsers ($application) {

  require_once 'classes/model/AppDelegation.php';
  require_once 'classes/model/Task.php';
  require_once 'classes/model/TaskUser.php';
  require_once 'classes/model/Users.php';

  $oCriteria = new Criteria('workflow');

  $oCriteria->addSelectColumn(AppDelegationPeer::PRO_UID);
  $oCriteria->add(AppDelegationPeer::APP_UID, $application);
  $oDataset = AppDelegationPeer::doSelectRS($oCriteria);
  $oDataset->next();
  $aRow = $oDataset->getRow();
  $PRO_UID=$aRow[0];

  $c = new Criteria('workflow');
  $c->addSelectColumn(TaskPeer::TAS_UID);
  $c->add(TaskPeer::PRO_UID, $PRO_UID);
  $c->add(TaskPeer::TAS_LAST_ASSIGNED, 0);
  $oDataset = TaskPeer::doSelectRS($c);
  $oDataset->next();
  $aRow = $oDataset->getRow();
  $TAS_UID=$aRow[0];


  $k=new Criteria('workflow');
  $k->addSelectColumn(TaskUserPeer::USR_UID);
  $k->add(TaskUserPeer::TAS_UID,$TAS_UID);
  $k->add(TaskUserPeer::TU_TYPE,1);
  $ods=TaskUserPeer::doSelectRS($k);
  $ods->next();
  $row=$ods->getRow();
  $USR_UID=$row[0];

  $kk=new Criteria();
  $kk->addSelectColumn(UsersPeer::USR_UID);
  $kk->addSelectColumn(UsersPeer::USR_USERNAME);
  $kk->addSelectColumn(UsersPeer::USR_FIRSTNAME);
  $kk->addSelectColumn(UsersPeer::USR_LASTNAME);
  $kk->addSelectColumn(UsersPeer::USR_EMAIL);
  $kk->add(UsersPeer::USR_UID,$USR_UID);
  $oDataset=UsersPeer::doSelectRS($kk);
  $oDataset->setFetchmode(ResultSet::FETCHMODE_ASSOC);
  $oDataset->next();

  $aRow1 = $oDataset->getRow();

  $array=array(
          'USR_UID'      => $aRow1['USR_UID'],
          'USR_USERNAME' => $aRow1['USR_USERNAME'],
          'USR_FIRSTNAME'=> $aRow1['USR_FIRSTNAME'],
          'USR_LASTNAME' => $aRow1['USR_LASTNAME'],
          'USR_EMAIL'    => $aRow1['USR_EMAIL']
  );

  return ($array);

}


//new functions by Erik

function PMFGetUserEmailAddress($id, $APP_UID=null, $prefix='usr') {
  
  require_once 'classes/model/UsersPeer.php';
  require_once 'classes/model/AppDelegation.php';
  G::LoadClass('case');

  if( is_string($id) && trim($id) == "" ){
    return false;
  }
  if( is_array($id) && count($id) == 0 ){
    return false;
  }


  //recipient to store the email addresses
  $aRecipient = Array();
  $aItems = Array();
  
  /*
   * First at all the $id user input can be by example erik@colosa.com
   * 2. this $id param can be a array by example Array('000000000001', '000000000002')  in this case $prefix is necessary
   * 3. this same param can be a array by example Array('usr|000000000001', 'usr|-1', 'grp|2245141479413131441')
   */

  /*
   * The second thing is that the return type will be configurated depend of the input type (using $retType)
   */
  if( is_array($id) ){
    $aItems = $id;
    $retType = 'array';
  } else {
    $retType = 'string';
    if( strpos($id, ",") !== false ){
      $aItems = explode(',', $id);
    } else {
      array_push($aItems, $id);
    }
  }
  
  foreach ($aItems as $sItem) {
    //cleaning for blank spaces into each array item
    $sItem = trim($sItem);
    if( strpos($sItem, "|") !== false ){
      //explode the parameter because  always will be compose with pipe separator to indicate the type (user or group) and the target mai
      list($sType, $sID) = explode('|', $sItem);
      $sType = trim($sType);
      $sID   = trim($sID);
    } else {
      $sType = $prefix;
      $sID = $sItem;
    }

    switch($sType) {
      case 'ext':
        if( G::emailAddress($sID) ) {
          array_push($aRecipient, $sID);
        }
      break;
      case 'usr':
        if ($sID == '-1') { // -1: Cuurent user, load from user record
          if( isset($APP_UID) ){
            $oAppDelegation = new AppDelegation;
            $aAppDel = $oAppDelegation->getLastDeleration($APP_UID);
            if(isset($aAppDel)){
              $oUserRow = UsersPeer::retrieveByPK($aAppDel['USR_UID']);
              if( isset($oUserRow) ){
                $sID = $oUserRow->getUsrEmail();
              } else {
                throw new Exception('User with ID '.$oAppDelegation->getUsrUid(). 'doesn\'t exist');
              }
              if( G::emailAddress($sID) ) {
                array_push($aRecipient, $sID);
              }
            }
          }
        } else {
          $oUserRow = UsersPeer::retrieveByPK($sID);
          $sID = $oUserRow->getUsrEmail();
          if( G::emailAddress($sID) ) {
            array_push($aRecipient, $sID);
          } 
        }
        
        break;

      case 'grp':
        G::LoadClass('groups');
        $oGroups = new Groups();
        $oCriteria = $oGroups->getUsersGroupCriteria($sID);
        $oDataset = GroupwfPeer::doSelectRS($oCriteria);
        $oDataset->setFetchmode(ResultSet::FETCHMODE_ASSOC);
        while ($oDataset->next()) {
          $aGroup = $oDataset->getRow();
          //to validate email address
          if( G::emailAddress($aGroup['USR_EMAIL']) ) {
            array_push($aRecipient, $aGroup['USR_EMAIL']);
          }
        }

        break;

      case 'dyn':
        $oCase = new Cases();
        $aFields = $oCase->loadCase($APP_UID);
        $aFields['APP_DATA'] = array_merge($aFields['APP_DATA'], G::getSystemConstants());
        
        //to validate email address
        if( isset($aFields['APP_DATA'][$sID]) && G::emailAddress($aFields['APP_DATA'][$sID]) ) {
          array_push($aRecipient, $aFields['APP_DATA'][$sID]);
        }
        break;
    }
  }

  switch($retType){
    case 'array':
      return $aRecipient;
    
    case 'string':
      return implode(',', $aRecipient);

    default:
      return $aRecipient;
  }
}