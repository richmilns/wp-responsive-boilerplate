<?php
/**
 * Outputs only the current level of the menu
 */
class WPRB_Current_Level_Menu_Walker extends Walker_Nav_Menu {
	var $target_id = false;

	function __construct($target_id = false) {
		$this->target_id = $target_id;
	}

	function walk($items, $depth) {
		$args = array_slice(func_get_args(), 2);
		$args = $args[0];
		$parent_field = $this->db_fields['parent'];
		$target_id = $this->target_id;
		$filtered_items = array();

		// if the parent is not set, set it based on the post
		if (!$target_id) {
			global $post;
			foreach ($items as $item) {
				if ($item->object_id == $post->ID) {
					$target_id = $item->ID;
				}
			}
		}

		// if there isn't a parent, do a regular menu
		if (!$target_id) return parent::walk($items, $depth, $args);

		// get the top nav item
		$target_id = $this->top_level_id($items, $target_id);

		// only include items under the parent
		foreach ($items as $item) {
			if (!$item->$parent_field) continue;

			$item_id = $this->top_level_id($items, $item->ID);

			if ($item_id == $target_id) {
				$filtered_items[] = $item;
			}
		}

		return parent::walk($filtered_items, $depth, $args);
	}

	// gets the top level ID for an item ID
	function top_level_id($items, $item_id) {
		$parent_field = $this->db_fields['parent'];

		$parents = array();
		foreach ($items as $item) {
			if ($item->$parent_field) {
				$parents[$item->ID] = $item->$parent_field;
			}
		}

		// find the top level item
		while (array_key_exists($item_id, $parents)) {
			$item_id = $parents[$item_id];
		}

		return $item_id;
	}

}
