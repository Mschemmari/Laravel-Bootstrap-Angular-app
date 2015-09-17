<?php

require_once("common/inc.init.php");

// User is allowed to see AdMin?

if(!$user->isEnabledTo("login", $adminModule->id))
{
        header("Location: ". $GLOBALS["CONF"]["url"]["root"]);
        exit();
}
// Preparing lang
$lang = new AdMinLang();
$lang->moduleID = $adminModule->id;

// Modules
$adminModule = getAllModules();
$extMenu = array();
$arModules = array();
foreach($adminModule AS $myModule)
{

    if($myModule->hasInterface == "no") continue;
    if ($user->isEnabledTo("read", $myModule->id))
    {
        $url = $myModule->url;
        if(!$myModule->hasJsUi) $nodo["url"] = $url;
        $arModules[] = array("id"         => $myModule->id,
                             "name"       => $myModule->name,
                             "url"        => $myModule->url,
                             "hasJsUi"    => $myModule->hasJsUi,
                             "icon"       => $myModule->ico,
                             "includeCSS" => $myModule->includeCSS,
                             "includeJS"  => $myModule->includeJS);
        
        // arreglo con los nombres de los modulos
        $arr[] = $myModule->name;
    }
}
// ordenar arreglo por nombre
asort($arr);

// arreglo para duplicar el contenido de arModules pero ya ordenado por nombre
foreach($arr as $key => $value){
        $arr2[] = $arModules[$key];
}
// los valores se regresan al arreglo original pero ya ordenado
// con esto se evita tener que cambiar el extJS que arma el arbol de modulos
$arModules = $arr2;


// Home module
if ($adminModule->homeModuleID)
{
    $homeModule = new Module($adminModule->homeModuleID);
      if(!$user->isEnabledTo("read", $adminModule->homeModuleID))
    {
        $aLog = new adminLog();
        $aLog->setDBLink($dbLink);
        $aLog->setModule($homeModule->id);
        $aLog->log('read module', $user->getID(), array("status"=>ADMIN_LOG_STATUS_ERROR,
                                                        "start_comment"=>'permission denied'));
        die(ucfirst($lang->translate('access_denied')));
    }
}


?><!-- Do NOT put any DOCTYPE here unless you want problems in IEs. -->
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!-- Ext relies on its default css so include it here. -->
<!-- This must come BEFORE javascript includes! -->
<link rel="stylesheet" type="text/css" href="<?= $GLOBALS["CONF"]["url"]["extjs"] ?>/resources/css/ext-all.css">
<link rel="stylesheet" type="text/css" href="<?= $GLOBALS["CONF"]["url"]["extjs"] ?>/resources/css/Multiselect.css">
<link rel="stylesheet" type="text/css" href="<?= $GLOBALS["CONF"]["url"]["admin"] ?>/css/fileupload.css">
<link rel="stylesheet" type="text/css" href="css/ext.css">
<style type="text/css">
<!--
/*
* GENERAL VIEWPORT
*/
#ext-gen12, .x-tree-node-anchor, #close-session
{
text-transform: capitalize
}

#ext-gen11
{
background-image: url(<?= $GLOBALS["CONF"]["url"]["admin"] ?>/images/interface/footer_logo.gif);
background-position: bottom center;
background-repeat: no-repeat;
}
-->
</style>

<!-- Include here your extended classes if you have some. -->
<link rel="stylesheet" type="text/css" href="<?= $GLOBALS["CONF"]["url"]["extjs"] ?>/ux/css/RowEditor.css">

<!-- First of javascript includes must be an adapter... -->
<?= js($GLOBALS["CONF"]["url"]["extjs"] ."/adapter/ext/ext-base.js",
       $GLOBALS["CONF"]["url"]["extjs"] ."/ext-all.js",
       $GLOBALS["CONF"]["url"]["extjs"] ."/ux/FieldLabeler.js",
       $GLOBALS["CONF"]["url"]["extjs"] ."/ux/FieldReplicator.js",
       $GLOBALS["CONF"]["url"]["extjs"] ."/ux/MultiSelect.js",
       $GLOBALS["CONF"]["url"]["extjs"] ."/ux/ItemSelector.js",
       $GLOBALS["CONF"]["url"]["extjs"] ."/ux/RowEditor.js"); ?>

<!-- Include here your extended classes if you have some. -->
<?= js($GLOBALS["CONF"]["url"]["admin"].'/js/admin.js',
       $GLOBALS["CONF"]["url"]["admin"].'/js/admin-ext.jsloader.js',
       $GLOBALS["CONF"]["url"]["admin"].'/js/admin-ext.cssloader.js',
       $GLOBALS["CONF"]["url"]["admin"].'/js/admin-ext.searchfield.js',
       $GLOBALS["CONF"]["url"]["admin"].'/js/admin-ext.datetime.js',
       $GLOBALS["CONF"]["url"]["admin"].'/js/admin-ext.tabclosemenu.js',
       $GLOBALS["CONF"]["url"]["admin"].'/js/admin-ext.fileuploadfield.js',       
       $GLOBALS["CONF"]["url"]["admin"].'/js/admin-ext.advancedsearchform.js'); ?>

<style>
.x-list-body dl {
    border-bottom: 1px solid #eee;
    cursor: default !important;
}
.x-list-body dt {
    cursor: default !important;
        /*border: 1px solid #ddd;*/
}
.x-list-over {background-color: white;cursor: default !important;}
#users-module-role-permissionsform label {
    font-size : 11px !important;
}

.x-tab-panel-noborder .x-tab-panel-header-noborder {
    border-width:0 0 0 !important;
}
</style>


<!-- Include here you application javascript file if you have it. -->

<!-- Set a title for the page (id is not necessary). -->
<title id="page-title">AdMin | <?= $GLOBALS["website"]["name"] ?></title>

<!-- You can have onReady function here or in your application file. -->
<!-- If you have it in your application file delete the whole -->
<!-- following script tag as we must have only one onReady. -->
<script type="text/javascript">

// Path to the blank image must point to a valid location on your server
Ext.BLANK_IMAGE_URL = '<?= $GLOBALS["CONF"]["url"]["extjs"] ?>/resources/images/default/s.gif';
AdMin.modules = <?= json_encode($arModules); ?>;
AdMin.base_url = "<?= base_url(); ?>/";
AdMin.admin_url = "<?= $GLOBALS["CONF"]["url"]["admin"] ?>";
AdMin.modules_url = "<?= $GLOBALS["CONF"]["url"]["modules"] ?>";
AdMin.loadedModules = [];

// Main application entry point
Ext.onReady(function() {
    var rootNode = {text : 'modulos', expanded : true, children : []};
    var showToolTip = function () {
        if(Ext.getCmp('tool-tip-cloud-accounts') == undefined)
        {
            new Ext.ToolTip({
                target:'tool-tip-accounts',
                id : 'tool-tip-cloud-accounts',
                title:AdMin.lang.translate('select_an_account'),
                anchor: 'right',
                html: AdMin.lang.translate('must_select_an_account_to_see_the_reports'),
                autoHide: false,
                closable:true
            }).show();
        }
        else Ext.getCmp('tool-tip-cloud-accounts').show();
    };

    Ext.each(AdMin.modules, function (module, index) {
        var node = {
            text: module.name,
            id: module.id,
            includeCSS: module.includeCSS,
            includeJS: module.includeJS,
            leaf: true,
            icon: module.icon,
            listeners:{
                click: function() {
                    //Marco el hash en el location
                    if(location.hash == '#'+module.id) loadModule(module.id, true);
                    else location.hash = module.id;
                }
            },
            url: module.url,
            module: module
        };
        rootNode.children.push(node);
    });

    var treePanel = new Ext.tree.TreePanel({
        region: 'west',
        collapsible: true,
        collapseMode: 'mini',
        title: '<?= ucfirst($lang->translate('modules')) ?>',
        width: 160,
        ref : "mainTreePanel",
        autoScroll: true,
        split: true,
        loader: new Ext.tree.TreeLoader(),
        root : rootNode,
        rootVisible: false
    });


    var loadModuleOnLoad = function(modulePanel)
    {
        var centerPanel = Ext.getCmp("center-panel");
        centerPanel.add(modulePanel);
        centerPanel.doLayout();
        AdMin.viewport.doLayout();
        if(modulePanel.needAccount) showToolTip();
    }

    var loadModule = function(moduleID, reload)
    {
        // Hago el select del item en el arbol
        treeNode = treePanel.getNodeById(moduleID);
        treeNode.select();

        // Obtengo la referencia del modulo que se va a cargar
        module = treeNode.attributes.module;

        // Se ocultan todos los modulos cargados hasta el momento
        for(var i = 0; i < AdMin.loadedModules.length; i++)
        {
            Ext.getCmp(AdMin.loadedModules[i]+"-module").hide();
        }
        // Si el modulo ya está cargado en loaddedModules solo se muestra
        if(AdMin.loadedModules.indexOf(module.id) > -1 && reload!=true) {
            Ext.getCmp(module.id + "-module").show();
            //AdMin.viewport.doLayout(); Purge this if not needed 20/04/2012 12:54:49 p.m.
            if(Ext.getCmp(module.id + "-module").needAccount) showToolTip();
        }
        // Si no esta cargado se carga el modulo
        else
        {
            if(module.hasJsUi)
            {
                if(module.includeJS.length)
                {
                    Ext.Loader.load(module.includeJS, function(){
                        new Ext.ux.JSLoader({
                            url: module.url,
                            onLoad: function(options) { loadModuleOnLoad(eval(module.id + "()")); },
                            onError: function(options, e) { Ext.MessageBox.hide();}
                        });
                    });
                }
                else
                {   
                    new Ext.ux.JSLoader({
                        url: module.url,
                        onLoad: function(options) { loadModuleOnLoad(eval(module.id + "()")); },
                        onError: function(options, e) { Ext.MessageBox.hide();}
                    });
                }
                
                if(module.includeCSS.length)
                {
                    Ext.ux.cssLoader.load(module.includeCSS);
                }   

            }
            else
            {
                loadModuleOnLoad(new Ext.Panel({
                                    id: module.id +'-module',
                                    flex: 1, // autoheight
                                    border:false,
                                    enableTabScroll: true, // enable scrolling when tabs exceeds TabPanel total width (tab+tab+tab+tab+...)
                                    html: '<iframe src="'+ module.url +'" style="width: 100%; height:100%; border: none" frameborder="0" id="center-iframe"></iframe>'
                                 }));
            }
            AdMin.loadedModules.push(module.id);
            Ext.MessageBox.hide();
        }
    }

    // Load modules from URL
    if("onhashchange" in window)
    {
        window.onhashchange = function() {
            uriSegments = location.hash.replace('#', '').split('/')
            moduleID = uriSegments[0];
            loadModule(moduleID);
        }
    }
    else
    {
        // For IE <= 7
        var prevHash = location.hash.replace('#', '');
        setInterval(function() {
            uriSegments = location.hash.replace('#', '').split('/')
            moduleID = uriSegments[0];
            if(prevHash != moduleID)
            {
                prevHash = moduleID

                loadModule(moduleID);
            }
        }, 200);
    }

    // My ViewPort
    AdMin.viewport = new Ext.Viewport({
        layout: 'border',
        items: [{
            region: 'north',
            html: '<h1 class="x-panel-header"><span style="margin:0px;padding:0px;float:right;">'+
                  <? if(isRegisteredModule('accounts')): ?>'<span id="tool-tip-accounts" style="float:left;padding-top:3px; padding-right:5px"><?=$lang->translate("account")?>:</span><span id="select-account" style="float:left; padding-right:10px;"></span>'+<? endif;?>
                  '<span id="close-session" style="float:left"></span></span>AdMin | <?= $GLOBALS["website"]["name"] ?></h1>',
            height: 33,
            border: false,
            margins: '0 0 5 0'
        },
        treePanel,
        {
            region: 'center',
            border : false,
            layout : "fit",
            items:[{
                id : "center-panel",
                border: false,
                layout : "vbox",
                layoutConfig : { align : 'stretch' }
                //html: '<iframe src="<?= $homeUrl ?>" style="width: 100%; height:100%; border: none" frameborder="0" id="center-tabpanel"></iframe>'
            }]
        }]
    });

    new Ext.Button({
        text: '<?= $lang->translate('close_session') ?>',
        handler: function() { location.href="<?= $GLOBALS["CONF"]["url"]["admin"] ?>/login.php?action=logout"; },
        icon: '<?= $GLOBALS["CONF"]["url"]["admin"] ?>/images/interface/icons/session.gif'
    }).render('close-session');

    <?
    if (isRegisteredModule('accounts'))
    {
        $accountsModule = new Module('accounts');
        ?>
        var accountsStore = new Ext.data.JsonStore({
            url: '<?= $accountsModule->url ?>/ajax_requests.php?type=getAccountsForLoggedUser',
            root: 'accounts',       
            fields: ['accountID', 'name'],
            autoLoad : true
        });
        
        var accountsSelectCombo = new Ext.form.ComboBox({
            renderTo: 'select-account',
            xtype: 'combo',
            mode : "local",
            typeAhead : true,
            hiddenName : 'selectedAccountID',
            forceSelection : true,
            store : accountsStore,
            valueField: 'accountID',
            value: '<?= addslashes($sessionManager->get('accountName')) ?>',
            displayField: 'name',
            triggerAction: 'all',
            emptyText: '...',
            listeners : {
                'select' : function (item) {
                    Ext.Ajax.request({url : "<?= $accountsModule->url ?>/ajax_requests.php",
                        params : {
                            type: 'setCurrentAccount',
                            accountID: item.value
                        },
                        method : "GET",
                        callback: function(options1, success1, response){
                             var obj = Ext.decode(response.responseText);
                             if (obj.status=='ok') location.reload();
                             else alert('Unable to change account');
                        }
                    });
                }
            }
        });
        <?
    }
    ?>

    if(location.hash!='')
    {
        uriSegments = location.hash.replace('#', '').split('/')
        moduleID = uriSegments[0];
        loadModule(moduleID);
    }
    else
    {
        <? if ($adminModule->homeModuleID) echo "loadModule('". $adminModule->homeModuleID ."');"; ?>
    }
});

Ext.Ajax.on('requestexception',  function(conn, response, options, e) {
    if(response.status=="401") {
        if (parent.content) parent.location.replace("<?= $GLOBALS['CONF']['url']['admin'] ?>/login.php");
        else window.location.reload("<?= $GLOBALS['CONF']['url']['admin'] ?>/login.php");
    }
});
</script>
<!-- Close the head -->

</head>

<!-- You can leave the body empty in many cases, or you write your content in it. -->
<body></body>

<!-- Close html tag at last -->
</html>
