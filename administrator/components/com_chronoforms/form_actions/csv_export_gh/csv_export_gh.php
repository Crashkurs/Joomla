<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/

defined('_JEXEC') or die('Restricted access');

class CfactionCsvExportGH
{
	var $formname;
	var $formid;
	var $group = array('id' => 'db_operations', 'title' => 'DB Operations');
	var $events = array('success' => 0, 'fail' => 0);
	var $details = array('title' => 'CSV Export [GH]', 'tooltip' => 'Exports selected records from a table to a CSV file');
	
	function load($clear) {
		if ( $clear ) {
			$action_params = array(
				'table_name' => '',
				'include' => '',
				'exclude' => '',
				'save_path' => '',
				'file_name' => '',
				'delimiter' => '',
				'enclosure' => '',
				'download_mime_type' => '',
				'download_export' => '',
				'download_nosave' => '',
				'where' => '',
				'order_by' => '',
				'content1' => ''
			);
		}
		return array('action_params' => $action_params);
	}
	
	function run($form, $actiondata)
	{
		$mainframe = JFactory::getApplication();	
		$params = new JParameter($actiondata->params);
		$user =& JFactory::getUser();
		
		jimport('joomla.filesystem.file');

		$variables = array(
				'table_name',
				'include',
				'exclude',
				'save_path',
				'file_name',
				'delimiter', 
				'enclosure',
				'download_export',
				'download_mime_type',
				'download_nosave',
				'where',
				'order_by'
			);
		foreach ( $variables as $v ) {
			$$v = trim($params->get($v));
			// Allow over-ride from form data for registered users
			if ( $user->id ) {
				if ( isset($form->data[$v]) && $form->data[$v] ) {
					$$v = $form->data[$v];
				}
			}
		}
		$form->debug['CSV Export'][] = '$download_export: '.print_r($download_export, true);
		$form->debug['CSV Export'][] = '$download_nosave: '.print_r($download_nosave, true);
		$columns = $actiondata->content1;
		$columns = $this->paramsToArray($columns, 'Columns');

		$curly_array = array(
			'form_name' => $form->form_details->name,
			'table_name' => $table_name,
			'random' => rand(111111, 999999),
			'datetime' => date('YmdHi')
		);
		if ( $download_nosave ) {
			$form->debug['CSV Export'][] = 'Download \'No Save\' is set so no folder is created.';
		} else {
			if ( $save_path ) {
				$save_path = $form->curly_replacer($save_path, array_merge($form->data, $curly_array));
				$save_path = str_replace(array("/", "\\"), DS, $save_path).DS;
				$save_path = str_replace(DS.DS, DS, $save_path);
			} else {
				$save_path = JPATH_SITE.DS.'components'.DS.'com_chronoforms'.DS.'exports'.DS.$form->form_details->name.DS;
			}
			if ( !JFile::exists($save_path.'index.html') ) {
				if  (!JFolder::create($save_path) ) {
					$form->debug['CSV Export'][] = "Couldn't create save folder: {$save_path}";
					JError::raiseWarning(100, "Couldn't create save folder: {$save_path}");
					$this->events['fail'] = 1;
					return;
				}	
			}
			$form->debug['CSV Export'][] = 'Save folder is: <br />'.$save_path;
			$form->debug['CSV Export'][] = '$download_export: xxx';
			$form->debug['CSV Export'][] = '$download_export: '.print_r($download_export, true);


			$buffer = "<html><body bgcolor='#FFFFFF'></body></html>";
			if ( !JFile::write($save_path.'index.html', $buffer) ) {
				$form->debug['CSV Export'][] = "Couldn't write to save folder: {$save_path}";
				JError::raiseWarning(100, "Couldn't write to save folder: {$save_path}");
				$this->events['fail'] = 1;
				return;
			}
		}
		if ( $file_name ) {
			$file_name = $form->curly_replacer($file_name, array_merge($form->data, $curly_array));
		} else {
			$file_name = "csv_export_{$table_name}_".date('YmdHi').".csv"; 
		}
		if ( JFile::getExt($file_name) != 'csv' || JFile::getExt($file_name) == $file_name ) {
			$file_name .= '.csv';
		}
		$form->debug['CSV Export'][] = 'File name is: <br />'.$file_name;

		// get the data to export
		$db =& JFactory::getDBO();
		$fields_array = $db->getTableFields($table_name);
		$fields_array = array_keys($fields_array[$table_name]);
		$titles = array();
		if ( is_array($columns) && count($columns) ) {
			$include = array();
			foreach ( $columns as $k => $v ) {
				$titles[]  = $k;
				$include[] = $v;
			}
			$include = implode(', ', $include);
			$exclude = array();
		} else {
			if ( $exclude ) {
				$exclude = explode(',', $exclude);
				foreach ( $exclude as $k => $v ) {
					$exclude[$k] = trim($v);
				}
			} else {
				$exclude = array();
			}
			if ( $include ) {
				$include = explode(',', $include);
				// check the columns and drop any that are 'excluded' 
				// or are not in the table columns list.
				foreach ( $include as $k => $v ) {
					$v = trim($v);
					if ( in_array($v, $exclude) || !in_array($v, $fields_array) ) {
						unset($include[$k]);
						continue;
					}
					$include[$k] = $db->nameQuote(trim($v));
				}
				$include = implode(', ', $include);
				$exclude = array();
			} elseif ( count($exclude) ) {
				$include = array();
				foreach ( $fields_array as $k => $v ) {
					if ( !in_array($v, $exclude) ) {
						$include[] = $db->nameQuote(trim($v));
					}
				}
				$include = implode(', ', $include);
			} else {
				$include = '*';
			}
		}

		if ( $where ) {
			// strip off anything after a ;
			$sc_found = strpos($where, ';');
			if ( $sc_found ) {
				$where = substr($where, 0, $sc_found);
			}
			// clean up WHERE
			$where = str_ireplace('where ', '', $where);
			$where = 'WHERE '.$where;
		}

		if ( $order_by ) {
			// strip off anything after a ;
			$sc_found = strpos($order_by, ';');
			if ( $sc_found ) {
				$order_by = substr($order_by, 0, $sc_found);
			}
			// clean up ORDER BY
			$order_by = str_ireplace("ORDER BY ", '', $order_by);
			$order_by = 'ORDER BY '.$order_by;
		}

		$query = "
			SELECT {$include}
				FROM `{$table_name}`
				{$where}
				{$order_by};
		";
		$form->debug['CSV Export'][] = '$query: '.print_r($query, true);
		$db->setQuery($query);
		$data = $db->loadAssocList();
		
		if ( !count($data) ) {
			$this->events['fail'] = 1;
			$form->validation_errors['CSV Export'] = 'No records were found to export.';
			return;
		}
		$form->debug['CSV Export'][] = count($data).' records were found to export.';
		
		// drop excluded columns if all were selected
		if ( !count($columns) && is_array($exclude) && count($exclude) ) {
			$exclude = array_flip($exclude);
			foreach ( $data as $k => $v ) {
				$data[$k] = array_diff_key($data[$k], $exclude);
			}
		}
		
		if ( $delimiter == '##tab##' ) {
			$delimiter = chr(9);
		} elseif ( $delimiter == '##squote##' ) {
			$delimiter = chr(39);
		} elseif ( $delimiter ) {
			$delimiter = substr($delimiter, 0, 1);
		} else {
			$delimiter = ',';
		}
		if ( $enclosure ) {
			$enclosure = substr($enclosure, 0, 1);
		} else {
			$enclosure = '"';
		}
		
		// Build titles array
		if ( !count($titles) ) {
			$titles = array_keys($data[0]);
		}
		$output = '';
		if ( $download_nosave ) {
			// output up to 5MB is kept in memory, if it becomes bigger
			// it will automatically be written to a temporary file
			$csv = fopen('php://temp/maxmemory:'. (5*1024*1024), 'r+');
			
			fputcsv($csv, $titles);
			foreach ( $data as $d ) {
				fputcsv($csv, $d, $delimiter, $enclosure);
			}
			rewind($csv);
			// put it all in a variable
			$output = stream_get_contents($csv);
			$filesize = strlen($output);
		} else {
			// Open file for writing
			$file = fopen($save_path.$file_name, 'w');
			if ( $file === false ) {
				$form->validation_errors['CSV Export'] = 'Unable to open the file.';
				return;
			}

			fputcsv($file, $titles);
			// add data rows to the file
			foreach ( $data as $d ) {
				fputcsv($file, $d, $delimiter, $enclosure);
			}
			fclose($file);
			
			// Get file URL and save to the form data
			$save_url = str_replace(JPATH_SITE.DS, JURI::root(), $save_path);
			$save_url = str_replace(DS, '/', $save_url);
			$form->debug['CSV Export'][] = 'Save link is: <br />'.$save_url.$file_name;
			$form->data['csv_link']  = $save_url.$file_name;
			$form->data['csv_count'] = count($data);
			$filesize = filesize($save_path.$file_name);
			$form->data['csv_size']  = $filesize/1000;
			if ( $form->data['csv_size'] > 0 && $form->data['csv_size'] < 1 ) {
				$form->data['csv_size'] = number_format($form->data['csv_size'], 1);
			} else {
				$form->data['csv_size'] = number_format($form->data['csv_size'], 0);
			}
			$form->debug['CSV Export'][] = 'File size is: '.$form->data['csv_size'].' kb';
		}
		
		if ( $download_export || $download_nosave ) {
			// if Immediate download is checked
			jimport('joomla.environment.browser');
			$browser = JBrowser::getInstance();

			switch ($browser->getBrowser() ) {
				case 'msie':
					$inline = 'inline';
					$pragma = 'public';
					break;
				default:
					$inline = 'attachment';
					$pragma = 'no-cache';
					break;
			}
			$mimetype = 'text/csv';
			if ( $download_mime_type ) {
				switch ($browser->getBrowser() ) {
					case 'msie':
						$mimetype = 'application/octetstream';
					case 'opera':
						$mimetype = 'application/octetstream';
						break;
					default:
						$mimetype = 'application/octet-stream';
						break;
				}
			}
			@ob_end_clean();
			ob_start();
			header("Content-Type: {$mimetype}");
			header('Expires: '.gmdate('D, d M Y H:i:s').' GMT');
			header("Content-Disposition: {$inline}; filename={$file_name}");
			header("Content-Length: ".$filesize); 
			if ( $browser->getBrowser() == 'msie' ) {
				header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			}
			header("Pragma: {$pragma}");
			ob_clean();
			flush();
			if ( $download_nosave ) {
				print($output);
			} else {
				readfile($save_path.$file_name);
			}
			exit();
		}
	}

	function paramsToArray($params='', $name='Parameter') 
	{
		if ( !$params ) {
			return false;
		}
		$list = explode("\n", trim($params));
		$return = array();
		foreach ( $list as $item ) {
			$item = trim($item);
			if ( !$item ) {
				$form->debug['Export CSV [GH]'][] = "Empty string found in the {$name} box";
				continue;
			}
			$fields_data = explode("=", $item, 2);
			if ( !isset($fields_data[1]) || !$fields_data[1] ) {
				$fields_data[1] = $fields_data[0];
			}
			$param = trim($fields_data[0]);
			$value = trim($fields_data[1]);
			$return[$param] = $value;
		}
		return $return;
	}
}
?>