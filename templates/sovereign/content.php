<div class="content" id="content">
              
          <?
            defined('_JEXEC') or die;
            if(substr(JURI::current(),strlen(JURI::base()),30) == "index.php/charakter-bearbeiten")
            {
              $var = JRequest::getVar('level');
              if($var != "")
              {
                $cname = JRequest::getVar('charedit');
                $sql = "UPDATE joomla_raidplanner_character SET char_level='$var' WHERE char_name='$cname'";
                $db->setQuery($sql);
                $db->query();
              }
              $sql = "SELECT * FROM joomla_raidplanner_character WHERE profile_id = '$user->id'";
              ?>
              </script>
              <?
              $db->setQuery($sql);
              $db->query();
              if($db->getNumRows() > 0)
              {
                echo '<div class=edit><center><form name="editchar" method="post" action="'.JURI::base().'index.php/charakter-bearbeiten" >';
                echo "Hier kannst du deine Charaktere f&uuml;r den Raidplaner bearbeiten<br><br>";
                echo "<select name=charedit>";
                $zahl = $db->getNumRows();
                $result = $db->loadObjectList();
                for($x = 0; $x < $zahl; $x=$x+1)
                {
                  $name = $result[$x]->char_name;
                  $str = "document.editchar.level.value=".$result[$x]->char_level.";document.editchar.butt.value=\"Speichern\";";
                  echo "<option onClick='$str' value='$name'>".$name."</option>";
                }
                echo '</select>';
                $val = $result[0]->char_level;
                echo "<br>Level: <input type=text value='$val' name='level' maxlength='2' />";
                echo '<br><input type=submit value="Speichern" />';
                echo "</form></center></div>";
              }
                
            }
            
            if($user_right <= 4 && substr(JURI::current(),strlen(JURI::base()),19) == "index.php/bewerbung")
            {
             if((JRequest::getVar('charname')) != "")
             {
                if(JRequest::getVar('level') == "")
                {
                  $char = JRequest::getVar('charname');
                  $sql = "SELECT * FROM joomla_bewerbung WHERE charname='$char'";
                  $db->setQuery($sql);
                  $result = $db->query();
                  if($db->getNumRows() > 0)//Bewerbung laden
                  {
                    $rows = $db->loadObjectList();
                    $data = $rows[0]->status;
                    echo "<style>";
                    include ('/css/bewerbung.css');
                    echo "</style><div style='padding-left: 20px; padding-right: 20px'>Dein Bewerbungsstatus f&uuml;r den Charakter ".$char." wurde abgerufen!<br /><br /><b>";
                    switch($data) //0-unbearbeitet,1-angeguckt,2-ueberpruefung,3-angenommen,4-abgelehnt
                    {
                      case "0": echo "<div style='background-color:red'>Deine Bewerbung wurde noch nicht bearbeitet!</div>";break;
                      case "1": echo "<div style='background-color:orange'>Deine Bewerbung wird zurzeit bearbeitet!</div>";break;
                      case "2": echo "<div style='background-color:yellow'>Deine Bewerbung befindet sich zurzeit im &Uuml;berpr&uuml;fungsstatus!</div>";break;
                      case "3": echo "<div style='background-color:green'>Deine Bewerbung wurde angenommen. Bitte kontaktiere einen Gildenleader!</div>";break;
                      case "4":{
                        echo "<div style='background-color:red'>Deine Bewerbung wurde leider abgelehnt.
                        Sie wird jetzt gel&ouml;scht!</div>";
                        $sql = "DELETE FROM joomla_bewerbung WHERE charname='$char'";
                        $db->setQuery($sql);
                        $db->query();break;
                      }
                      default: echo "<div style='background-color:red'>Deine Bewerbung wurde nicht gefunden!</div>";break;
                    }
                    echo "</b><br><a href='".JURI::current()."'>Zur&uuml;ck zur &Uuml;bersicht</a></div>";
                  }else{
                    //echo "<style>";
                    //include ('/css/bewerbung.css');
                    echo "</style><center><div style='padding-top: 50px'>F&uuml;r diesen Charakter gibt es keine Bewerbung!</div>";
                    echo "<a style='text-decoration: none, color: black' href='".JURI::current()."'>Zur&uuml;ck zur &Uuml;bersicht</a></center>";
                  }
                }else{
                  $data =new stdClass();//Bewerbung eintragen
                  $data->id = null;
                  $data->charname = JRequest::getVar('charname');
                  $data->level = JRequest::getVar('level');
                  $data->klasse = JRequest::getVar('klasse');
                  $data->erwartung = JRequest::getVar('erwartungen');
                  $data->einbringen = JRequest::getVar('einbringen');
                  $data->erfahrung = JRequest::getVar('erfahrung');
                  $data->sonstiges = JRequest::getVar('sonstiges');
                  $db->insertObject( 'joomla_bewerbung', $data, 1 );
               }
             }else{
               echo '<jdoc:include type="component" />';//Normalen Content anzeigen
               echo '<jdoc:include type="modules" name="bewerbung" />';
             }
           }else{//Admin-Anzeige fuer Bewerbungen
           if(substr(JURI::current(),strlen(JURI::base()),19) == "index.php/bewerbung" && $user_right >=5)
           {
              if(JRequest::getVar('status') != "")
              {
                $charname = JRequest::getVar('charname');
                $status = JRequest::getVar('status');
                $sql = "UPDATE joomla_bewerbung SET status='$status' WHERE charname='$charname'";
                $db->setQuery($sql);
                $db->query();
              }
              $sql = "SELECT * FROM joomla_bewerbung ORDER BY status DESC";
              $db->setQuery($sql);
              $db->query();
              $ende = $db->getNumRows();
              $result = $db->loadRowList();
              echo "<center>Alle Bewerbungen werden hier aufgelistet, rot bedeutet dabei nicht bearbeitet, orange nur angeguckt, gelb &uuml;berpr&uuml;fung, und gr&uuml;n best&auml;tigt</center><br /><br />";
              if($ende > 0)
              {
                for($x = 0; $x < $ende; $x=$x+1)
                {
                  echo "<div style='padding-left: 50px'>";
                  $val = $result[$x][1];
                  $info = $result[$x];
                  $divname = "bewerbung".$result[$x][8];
                  $str = "";
                  $str = $info[1].'101'.$info[2].'101'.$info[3].'101'.$info[4].'101'.$info[5].'101'.$info[6].'101'.$info[7].'101'.$info[8];
                  $str = str_replace(" ","____",$str);
                  $str = str_replace("'","####",$str);
                  $str = str_replace("\"","<<<<",$str);
                  echo "<input type='button' value='$val' onClick=javascript:show_info(\"$str\") class='$divname'/>";
                  if($x%8 == 7)echo "<br>";
                  echo "</div>";
                }
                  echo '<br /><br /><center><form name=bewerbungen method=post action="/bewerbung"><br>
                  <input type="text" name="charname" value="Name" readonly/><br>
                  <input type="text" name="level" value="Level" readonly/><br>
                  <select name="klasse" disabled><option value="0">Klasse</option><option value="1">Kopfgeldj&auml;ger</option><option value="2">Sith-Krieger</option><option value="3">Imperialer Agent</option><option value="4">Sith-Inquisitor</option></select><br>
                  <textarea rows=5 cols=50 name="erwartungen" readonly>Erwartungen</textarea><br>
                  <textarea rows=5 cols=50 name="einbringen" readonly>Einbringungen</textarea><br>
                  <textarea rows=5 cols=50 name="erfahrung" readonly>Erfahrung</textarea><br>
                  <textarea rows=5 cols=50 name="sonstiges" readonly>Sonstiges</textarea><br>
                  <select name="status"><option value="0">Nicht bearbeitet</option><option value="1">In Bearbeitung</option><option value="2">In &Uuml;berpr&uuml;fung</option><option value="3">Angenommen</option><option value="4">Abgelehnt</option></select><br>
                  <input type="submit" value="Status &auml;ndern">
                  </form></center>';
              }else{
                echo "<br>Es wurden keine Bewerbungen gefunden!";
              }
            }else{
           
              echo '<jdoc:include type="component" />';
              if(substr(JURI::current(),strlen(JURI::base()),19) == "index.php/bewerbung")
              {
                echo '<jdoc:include type="modules" name="bewerbung" />';
              }
            }
          }
            
          
            $char_name = JRequest::getVar('input_text_0');
            if($char_name != "")
            {
                  $data =new stdClass();//Bewerbung eintragen
                  $data->character_id = null;
                  $data->profile_id = JFactory::getUser()->id;
                  $data->class_id = JRequest::getVar('input_select_2');
                  $data->role_id = 0;
                  $data->gender_id = 1;
                  $data->guild_id = 1;
                  $data->race_id = JRequest::getVar('input_select_4');
                  $data->char_level = JRequest::getVar('input_text_1');
                  $data->char_name = JRequest::getVar('input_text_0');
                  $data->rank = 2;
                  $sql = "SELECT * FROM joomla_raidplanner_character WHERE char_name='$data->char_name'";
                  $db->setQuery($sql);
                  $db->query();
                  if($db->getNumRows() == 0)
                  {
                    $db->insertObject( 'joomla_raidplanner_character', $data, 1 );
                  }else{
                    echo "Ein Charakter mit diesem Namen existiert bereits!";
                  }
            }
           ?>
  </div> 