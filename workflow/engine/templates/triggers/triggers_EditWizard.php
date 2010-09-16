<?php
/**
 * triggers_CreateWizard.php
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
 */

try {
        G::LoadClass ( 'triggerLibrary' );
	$triggerLibrary = triggerLibrary::getSingleton ();
	$libraryClassName = $_GET ['LIBRARY_CLASS'];
	$libraryMethod = $_GET ['PMFUNTION_NAME'];
	$sProUid = $_GET ['PRO_UID'];
	$libraryO = $triggerLibrary->getLibraryDefinition ( $libraryClassName );
	
	$libraryName = $libraryO->info ['name'];
	$libraryDescription = trim ( str_replace ( "*", "", implode ( " ", $libraryO->info ['description'] ) ) );
	$libraryIcon = isset ( $libraryO->info ['icon'] ) && ($libraryO->info ['icon'] != "") ? $libraryO->info ['icon'] : "/images/browse.gif";
	$aDataTrigger = $_GET;
	
	$sProUid = $aDataTrigger ['PRO_UID'];
	$sNameFun = $aDataTrigger ['PMFUNTION_NAME'];
	
	$methodObject = $libraryO->methods [$sNameFun];
	
	$methodName = $methodObject->info ['name'];
	$methodLabel = $methodObject->info ['label'];
	$methodDescription = trim ( str_replace ( "*", "", implode ( " ", $methodObject->info ['description'] ) ) );
	$methodReturn = $methodObject->info ['return'];
	$methodParameters = array_keys ( $methodObject->params );
	$methodLink = isset ( $methodObject->info ['link'] ) && ($methodObject->info ['link'] != "") ? $methodObject->info ['link'] : "";
	$methodreturnA = explode ( "|", $methodReturn );
	$methodReturnLabel = isset ( $methodreturnA [3] ) ? $methodreturnA [3] : $methodReturn;
	
	$aParametersFun = $methodParameters; 
	$triggerWizardTemplate = PATH_TPL . 'triggers' . PATH_SEP . 'triggers_EditWizard.html';
	$template = new TemplatePower ( $triggerWizardTemplate );
	$template->prepare ();
	
	$tds = '';
	$nrows = 2;
	
	$template->assign ( 'LIBRARY_NAME', $libraryName );
	$template->assign ( 'LIBRARY_DESCRIPTION', $libraryDescription );
	$template->assign ( 'LIBRARY_ICON', $libraryIcon );
	$template->assign ( 'LIBRARY_CLASS', $libraryClassName );
	if ($methodLink != "") {
		$template->newBlock ( 'methodLink' );
		$template->assign ( 'LIBRARY_METHOD_LINK', $methodLink );
		$template->gotoBlock ( '_ROOT' );
	}
	
	$template->assign ( 'PMFUNTION', $sNameFun );
	$template->assign ( 'PMFUNTION_LABEL', $methodLabel );
	$template->assign ( 'PMFUNTION_DESCRIPTION', $methodDescription );
	$template->assign ( 'TITLE', G::LoadTranslation ( 'ID_TITLE' ) );
        $template->assign ( 'TITLE_CONTENT', $_GET['TRI_TITLE'] );
        $template->assign ( 'TRI_UID', $_GET['TRI_UID'] );
        $template->assign ( 'SOURCE_LINK', G::LoadTranslation ( 'ID_TRIGGER_SOURCE_LINK' ) );
	$template->assign ( 'DESCRIPTION', G::LoadTranslation ( 'ID_DESCRIPTION' ) );
	$template->assign ( 'DESCRIPTION_CONTENT', $_GET['TRI_DESCRIPTION'] );
	$template->assign ( 'DETAILS_LABEL', G::LoadTranslation ( 'ID_DETAILS' ) );	
	$template->assign ( 'RETURN_TITLE', G::LoadTranslation ( 'ID_TRIGGER_RETURN_TITLE' ) );
	$template->assign ( 'RETURN_LABEL', G::LoadTranslation ( 'ID_TRIGGER_RETURN_LABEL' ) );
	$template->assign ( 'RETURN_VALUE', $_GET['TRI_ANSWER'] );
	$template->assign ( 'METHOD_LABEL', G::LoadTranslation ( 'ID_METHOD' ) );
	$template->assign ( 'ROWS', sizeof ( $aParametersFun ) + 3 );
	$template->assign ( 'TRIGGER_INFORMATION', 'Triggers Edit Form' );
	$template->assign ( 'TRIGGER_ACTION', '../triggers/triggers_WizardUpdate' );
	$template->assign ( 'PRO_UID', $sProUid );	
	$template->assign ( 'PAGED_TABLE_ID', $aDataTrigger ['PAGED_TABLE_ID'] );	
	$template->assign ( 'RETURN_DESCRIPTION', $methodReturnLabel );	
	$template->assign ( 'ID_SAVE', G::LoadTranslation ( 'ID_SAVE' ) );
	$template->assign ( 'ID_CANCEL', G::LoadTranslation ( 'ID_CANCEL' ) );
	
	$sPMfunction = $sNameFun . " (";
	$methodParametersOnlyNames = array ();
	if (count ( $aParametersFun ) > 0) {
		$template->newBlock ( 'paremetersTriggersGroup' );
		$template->assign ( 'PARAMETERS_LABEL', G::LoadTranslation ( 'ID_PARAMETERS' ) );
		foreach ( $aParametersFun as $k => $v ) {
			if ($v != '') {				
				$aParametersFunA = explode ( "|", $v );				
				$paramType = $aParametersFunA [0];
				$paramDefinition = $aParametersFunA [1];
				$paramDefinitionA = explode ( "=", $paramDefinition );
				$paramName = $paramDefinitionA [0];
				$methodParametersOnlyNames [] = $paramName;
				$paramDefaultValue = isset ( $paramDefinitionA [1] ) ? $paramDefinitionA [1] : "";
				$paramLabel = isset ( $aParametersFunA [2] ) ? $aParametersFunA [2] : $paramName;
				$paramDescription = isset ( $aParametersFunA [3] ) ? $aParametersFunA [3] : "";
				$sPMfunction .= ($nrows != 2) ? ', "' . trim ( str_replace ( "$", "", $paramName ) ) . '"' : '"' . trim ( str_replace ( "$", "", $paramName ) . '"' );				
				$template->newBlock ( 'paremetersTriggers' );
				$template->assign ( 'LABEL_PARAMETER', $paramLabel );
				$template->assign ( 'OPT_PARAMETER', trim ( str_replace ( "$", "", $paramName ) ) );
				$sNameTag = 'form.' . trim ( str_replace ( "$", "", $paramName ) ) . '.name';
				$sNameTag = trim ( $sNameTag );
				$template->assign ( 'SNAMETAG', $sNameTag );
				$tri_Button = "<input type='button' name='INSERT_VARIABLE' value='@@' onclick='showDynaformsFormVars($sNameTag ,   \"../controls/varsAjax\" ,   \"$sProUid\" ,   \"@@\");return;' >";
				$template->assign ( 'ADD_TRI_VARIABLE', $tri_Button );
//				$template->assign ( 'ADD_TRI_VALUE', str_replace ( "'", "", str_replace ( '"', '', $paramDefaultValue ) ) );
				$template->assign ( 'ADD_TRI_VALUE',  $_GET[trim( str_replace( "$", "", $paramName ) )] );
				$fieldDescription = ($paramDescription!="")?$paramDescription . "<br>":"";
				$fieldDescription .= $paramDefaultValue != "" ? $paramDefaultValue . " | " . $paramType : G::LoadTranslation ( "ID_REQUIRED_FIELD" ) . " | " . $paramType;
				$template->assign ( 'ADD_TRI_DESCRIPTION', $fieldDescription );
				$nrows ++;
			}
		}
	
	}
	$template->gotoBlock ( '_ROOT' );
	$template->assign ( 'ALLFUNCTION', implode ( ",", $methodParametersOnlyNames ) );
	$sPMfunction .= ");";
	$content = $template->getOutputContent ();
	print $content;

} catch ( Exception $oException ) {
	die ( $oException->getMessage () );
}
unset ( $_SESSION ['PROCESS'] );
?>