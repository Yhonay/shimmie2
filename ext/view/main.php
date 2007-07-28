<?php

class ViewImage extends Extension {
	var $theme;

	public function receive_event($event) {
		if(is_null($this->theme)) $this->theme = get_theme_object("view", "ViewTheme");

		if(is_a($event, 'PageRequestEvent') && ($event->page_name == "post") && ($event->get_arg(0) == "view")) {
			$image_id = int_escape($event->get_arg(1));
			
			global $database;
			$image = $database->get_image($image_id);

			if(!is_null($image)) {
				send_event(new DisplayingImageEvent($image, $event->page));
			}
			else {
				$this->theme->display_error($event->page, "Image not found", "No image in the database has the ID #$image_id");
			}
		}

		if(is_a($event, 'DisplayingImageEvent')) {
			$this->theme->display_page($event->page, $event->get_image());
		}
	}
}
add_event_listener(new ViewImage());
?>
