<?php
defined('_JEXEC') or die;
jimport( 'joomla.access.access' );

JHtml::_('behavior.framework', true);

$app                = JFactory::getApplication();
$doc        = JFactory::getDocument();
$templateparams     = $app->getTemplate(true)->params;
$db = JFactory::getDBO();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >
      <head>
        <jdoc:include type="head" />
        <link rel="stylesheet" href="/templates/sovereign/css/template.css" />
        <?
            
            $user = JFactory::getUser();
            $userid = $user->id;
            $sql = "SELECT * FROM joomla_user_usergroup_map WHERE user_id='$userid'";
            $db->setQuery($sql);
            $db->query();
            $zahl = $db->getNumRows();
            $result = $db->loadObjectList();
            $user_right = null;
            if($zahl > 0)
            {
              $user_right = $result[0]->group_id;
            }else{ $user_right = 0;}
        if($user_right > 4 && substr(JURI::current(),strlen(JURI::base()),19) == "index.php/bewerbung")
        {?>
        <script type="text/javascript">
        function show_info(Wert)
        {
          var str = Wert.replace(/____/g," ");
          str = str.replace(/####/g,"'");
          str = str.replace(/<<<</g,"\"");
          str = str.split("101");
          document.bewerbungen.charname.value = str[0];
          document.bewerbungen.level.value = str[1];
          document.bewerbungen.klasse.selectedIndex = str[2];
          document.bewerbungen.erwartungen.value = str[3];
          document.bewerbungen.einbringen.value = str[4];
          document.bewerbungen.erfahrung.value = str[5];
          document.bewerbungen.sonstiges.value = str[6];
          document.bewerbungen.status.selectedIndex = str[7];
        }
          
        </script>
        <?
        }
        ?>
      </head>
      <body>
      <div class="foreground">
        <div class="header">
          <div class="logo">
            <jdoc:include type="modules" name="logo" />
          </div>
          <div class="menu_center">
              <jdoc:include type="modules" name="mainmenu" />
          </div>
        </div>       
        <div class="wrapper">         
          <div class="login"><?
            if($user_right > 0)
            {
              echo "Hallo ".$user->username."! Warst du heute schon im <a href='/index.php/forum'>Forum</a>?<br />";
            }
            ?>
            
            <jdoc:include type="modules" name="profil" />
            <jdoc:include type="modules" name="login" />
          </div>
             
            <?
            include('content.php');
            
            if($user_right >= 2)
            {
            ?>
            <div class="news">
              <jdoc:include type="modules" name="news" /><br><br>
              <jdoc:include type="modules" name="kontostand" />
            </div>
            <?
            }           
           
           if(strlen(JURI::current()) > strlen(JURI::base()))
           {
             if(substr(JURI::current(),strlen(JURI::base()),16) == "index.php/guides")
             {
              ?>
               <div class="submenu">
                <jdoc:include type="modules" name="submenu" />
              </div>
             <? }
             
             
          }
          ?>    
            </div>
           
                           
        </div>
        <div class="rights">
        <center>Star Wars: The Old Republic All rights reserved</center>
        </div>
      </div>
      </body>
      
</html>