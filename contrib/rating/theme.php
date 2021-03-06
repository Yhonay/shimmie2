<?php

class RatingsTheme extends Themelet {
	public function get_rater_html(/*int*/ $image_id, /*string*/ $rating) {
		$i_image_id = int_escape($image_id);
		$s_checked = $rating == 's' ? " checked" : "";
		$q_checked = $rating == 'q' ? " checked" : "";
		$e_checked = $rating == 'e' ? " checked" : "";
		$html = "
			<tr>
				<th>Rating</th>
				<td>
					<input type='radio' name='rating' value='s' id='s'$s_checked><label for='s'>Safe</label>
					<input type='radio' name='rating' value='q' id='q'$q_checked><label for='q'>Questionable</label>
					<input type='radio' name='rating' value='e' id='e'$e_checked><label for='e'>Explicit</label>
				</td>
			</tr>
		";
		return $html;
	}

	public function display_bulk_rater() {
		global $page;
		$html = "
			".make_form(make_link("admin/bulk_rate"))."
				<table class='form'>
					<tr>
						<th>Search</th>
						<td>
							<input type='text' name='query'>
						</td>
					</tr>
					<tr>
						<th>Rating</th>
						<td>
							<select name='rating'>
								<option value='s'>Safe</option>
								<option value='q'>Questionable</option>
								<option value='e'>Explicit</option>
								<option value='u'>Unrated</option>
							</select>
						</td>
					</tr>
					<tr>
						<td colspan='2'><input type='submit' value='Go'></td>
					</tr>
				</table>
			</form>
		";
		$page->add_block(new Block("Bulk Rating", $html));
	}

	public function rating_to_name(/*string*/ $rating) {
		switch($rating) {
			case 's': return "Safe";
			case 'q': return "Questionable";
			case 'e': return "Explicit";
			default: return "Unknown";
		}
	}
}

?>
