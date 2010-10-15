<?php
/**
 * class.g.php
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

try{
  if( isset($_GET['result']) && $_GET['result'] == 'done') {
    $G_PUBLISH = new Publisher;
    $G_PUBLISH->AddContent('view', 'setup/clearCompiledResult');
    G::RenderPage('publish', 'blank');
  } else {
    if( isset($_GET['result']) && $_GET['result'] == 'confirm' ){
      if( defined('PATH_C') ){
        G::rm_dir(PATH_C);
        G::SendTemporalMessage('ID_CLEAR_CACHE_MSG1', 'tmp-info', 'label');
        G::header('location: clearCompiled?result=done');
      }
    } else {
      echo '<script>parent.parent.msgBox("'.G::LoadTranslation('ID_CLEAR_CACHE_CONFIRM1').'", "confirm", function(){location.href = "clearCompiled?result=confirm"}, function(){history.back()});</script>';
    }
  }
} catch(Exception $e){
  G::SendTemporalMessage($oError->getMessage(), 'error', 'string');
}