<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class CfactionDbMultiRecordLoaderHelper{
	function load($form = null, $actiondata = null){
		$params = new JParameter($actiondata->params);
		$output = '';		
		
		if((bool)$params->get('enable_data_displayer', 0) === true && $params->get('load_type', 'all') == 'all'){
			//find the model data
			$table_name = $params->get('table_name', '');
			$model_id_sub = preg_replace('/(?:^|_)(.?)/e', "strtoupper('$1')", $table_name);
			$model_id = $params->get('model_id', '');
			if(empty($model_id)){
				$model_id = $model_id_sub;
			}
			//pre output creation
			$fields_names = array();
			$fields_headings = array();
			$order_fields = array();
			//get order fields
			$order_str = trim($params->get('data_order_fields', ''));
			if(!empty($order_str)){
				$order_fields = explode(",", trim($params->get('data_order_fields', '')));
			}
			//get display fields
			$fields_data = trim($params->get('data_display_fields', ''));
			if(!empty($fields_data)){
				$fields_data = explode(",", $fields_data);
				foreach($fields_data as $field_data){
					$field_data = explode(":", trim($field_data));
					$fields_names[] = $field_name = $field_data[0];
					if(!isset($field_data[1])){
						$field_data[1] = strtoupper($field_data[0]);
					}
					$fields_headings[] = $field_heading = $field_data[1];
				}
			}
			//create the table code
			$output .= '<table id="db_multi_record_loader_'.$actiondata->id.'">';
			$output .= '<thead>';
			$output .= '<tr>';
			$form->loadActionHelper('show_html');
			$showHTMLHelper = new CfactionShowHtmlHelper();
			foreach($fields_headings as $k => $field_heading){
				if(in_array($fields_names[$k], $order_fields)){
					$direction = 'asc';
					if(isset($form->data['order']) && ($form->data['order'] == $fields_names[$k]) && isset($form->data['direction'])){
						if($form->data['direction'] == 'asc'){
							$direction = 'desc';
						}else{
							$direction = 'asc';
						}
					}
					$class = '';
					if(isset($form->data['order']) && ($form->data['order'] == $fields_names[$k])){
						$class = ' direction_'.(isset($form->data['direction']) ? $form->data['direction']: 'asc');
					}
					$field_heading = '<a class="order_link'.$class.'" href="'.$showHTMLHelper->generateURL($showHTMLHelper->selfURL(), array('order' => $fields_names[$k], 'direction' => $direction)).'">'.$field_heading.'</a>';
				}else{
					$field_heading = $field_heading;
				}
				$output .= '<th class="col'.($k+1).' cell">'.$field_heading.'</th>';
			}
			$output .= '</tr>';
			$output .= '</thead>';
			$output .= '<tbody>';
			$i = 0;
			foreach($form->data[$model_id] as $r => $record){
				$output .= '<tr class="row_'.$i.'">';
				foreach($fields_names as $k => $field_name){
					$output .= '<td class="col'.($k+1).' cell">'.$record[$field_name].'</td>';
				}
				$output .= '</tr>';
				$i = 1 - $i;
			}
			$output .= '</tbody>';
			$output .= '</table>';
		}
		
		if((bool)$params->get('enable_pagination', 0) === true && isset($form->paginatior_footer)){			
			//check the position of the pagination
			if((int)$params->get('enable_pagination', 0) == 1){
				$output = $form->paginatior_footer.$output;
			}else if((int)$params->get('enable_pagination', 0) == 2){
				$output = $output.$form->paginatior_footer;
			}
		}
		//add CSS
		$this->_addCSS($form, $actiondata);
		//end
		echo $output;
	}
	
	function _addCSS($form, $actiondata){
		$document =& JFactory::getDocument();
		//add some CSS formatting for pagination
		ob_start();
		?>
		.list-footer ul li {
			display: inline;
		}
		#db_multi_record_loader_<?php echo $actiondata->id; ?> {
			width: 100%;
			margin: 0px 0px;
		}
		#db_multi_record_loader_<?php echo $actiondata->id; ?> .cell {
			padding: 2px;
		}
		#db_multi_record_loader_<?php echo $actiondata->id; ?> .cell {
			padding: 2px;
		}
		#db_multi_record_loader_<?php echo $actiondata->id; ?> thead {
			background-color: #dedede;
		}
		<?php
		$script = ob_get_clean();
		$document->addStyleDeclaration($script);
	}
}
?>