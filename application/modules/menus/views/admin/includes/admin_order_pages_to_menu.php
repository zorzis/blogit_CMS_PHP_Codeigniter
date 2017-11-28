<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

echo get_ol($menu_items);

function get_ol ($array, $child = FALSE)
{
	$str = '';
	
	if (count($array)) 
	{
		$str .= $child == FALSE ? '<ol class="list-group gutter list-group-lg list-group-sp sortable">' : '<ol>';
		
		foreach ($array as $item) {
			//Here we set as the item_id to store it to the menu_m->save_menu_items_order ($menu_items, $menu_id),
			//were we use as item id from the <script>items: 'li'<script>, the page_id of each page assigned to the current menu
			$str .= '<li id="list_' . $item['page_id'] .'" class="list-group-item box-shadow">';
			$str .= '<div class="clear"><span class="pull-left media-xs"><i class="fa fa-arrows fa-2x m-r-sm text-warning"></i></span>' . $item['title'] .'</div>';
			
			// Do we have any children?
			if (isset($item['children']) && count($item['children'])) 
			{
				$str .= get_ol($item['children'], TRUE);
			}
			
			$str .= '</li>' . PHP_EOL;
		}
		
		$str .= '</ol>' . PHP_EOL;
	}
	
	return $str;
}
?>

<script>
$(document).ready(function(){

    $('.sortable').nestedSortable({
        handle: 'div',
        items: 'li',
        toleranceElement: '> div',
        maxLevels: 3
    });

});
</script>