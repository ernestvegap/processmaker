<?php
G::LoadClass('plugin');

class {className}Plugin extends PMPlugin
{
  function {className}Plugin($sNamespace, $sFilename = null) {
       $res = parent::PMPlugin($sNamespace, $sFilename);
       $this->sFriendlyName = '{className} Plugin';
       $this->sDescription  = 'Autogenerated plugin for class {className}';
       $this->sPluginFolder = '{className}';
       $this->sSetupPage    = '{className}';
       $this->iVersion      = 0.78;
       //$this->iPMVersion    = 2425;
       $this->aWorkspaces   = null;
       //$this->aWorkspaces = array('os');
       return $res;
  }

  function setup() {
<!-- START BLOCK : changeLogo -->
    $this->setCompanyLogo ('/plugin/{className}/{className}.png');
<!-- END BLOCK : changeLogo -->
<!-- START BLOCK : menu -->
    $this->registerMenu( 'setup', 'menu{className}.php');
<!-- END BLOCK : menu -->
<!-- START BLOCK : ontransit -->
    $this->registerMenu( 'processmaker', 'menu{className}OnTransit.php');
<!-- END BLOCK : ontransit -->
<!-- START BLOCK : externalStep -->
    $this->registerStep( '{GUID}', 'step{className}', '{className} external step' );
<!-- END BLOCK : externalStep -->
<!-- START BLOCK : dashboard -->
    $this->registerDashboard();
<!-- END BLOCK : dashboard -->
<!-- START BLOCK : report -->
    $this->registerReport();
<!-- END BLOCK : report -->
<!-- START BLOCK : PmFunction -->
    $this->registerPmFunction();
<!-- END BLOCK : PmFunction -->
<!-- START BLOCK : redirectLogin -->
    $this->redirectLogin( 'PROCESSMAKER_{className}', 'users/users_List' );
<!-- END BLOCK : redirectLogin -->
  }

  function install() {
<!-- START BLOCK : createPermission -->
    $RBAC = RBAC::getSingleton() ;
    $RBAC->initRBAC();
    $roleData = array();
    $roleData['ROL_UID'] = G::GenerateUniqueId();
    $roleData['ROL_PARENT'] = '';
    $roleData['ROL_SYSTEM'] = '00000000000000000000000000000002';
    $roleData['ROL_CODE'] = 'PROCESSMAKER_{className}';
    $roleData['ROL_CREATE_DATE'] = date('Y-m-d H:i:s');
    $roleData['ROL_UPDATE_DATE'] = date('Y-m-d H:i:s');
    $roleData['ROL_STATUS'] = '1';
    $RBAC->createRole ( $roleData );
    $RBAC->createPermision ('PM_{className}' );
<!-- END BLOCK : createPermission -->
  }
}

$oPluginRegistry =& PMPluginRegistry::getSingleton();
$oPluginRegistry->registerPlugin('{className}', __FILE__);
