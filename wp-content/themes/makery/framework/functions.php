<?php
/**
 * Removes slashes
 *
 * @param string $string
 * @return string
 */
function themex_stripslashes($string) {
	if(!is_array($string)) {
		return stripslashes(stripslashes($string));
	}

	return $string;
}

/**
 * Gets page number
 *
 * @return int
 */
function themex_paged() {
	$paged=get_query_var('paged')?get_query_var('paged'):1;
	$paged=(get_query_var('page'))?get_query_var('page'):$paged;

	return $paged;
}

/**
 * Checks search page
 *
 * @param string $type
 * @return bool
 */
function themex_search($type) {
	if(isset($_GET['s']) && ((isset($_GET['post_type']) && $_GET['post_type']==$type) || (!isset($_GET['post_type']) && $type=='post'))) {
		return true;
	}

	return false;
}

/**
 * Gets array value
 *
 * @param string $key
 * @param array $array
 * @param string $default
 * @return mixed
 */
function themex_value($key, $array, $default='') {
	$value='';

	if(isset($array[$key])) {
		if(is_array($array[$key])) {
			$value=reset($array[$key]);
		} else {
			$value=$array[$key];
		}
	} else if ($default!='') {
		$value=$default;
	}

	return $value;
}

/**
 * Gets array item
 *
 * @param string $key
 * @param array $array
 * @param string $default
 * @return mixed
 */
function themex_array($key, $array, $default='') {
	$value='';

	if(isset($array[$key])) {
		$value=$array[$key];
	} else if ($default!='') {
		$value=$default;
	}

	return $value;
}

/**
 * Gets number value
 *
 * @param string $string
 * @return int
 */
function themex_number($string, $decimal=false) {
	$number=0;

	if($decimal) {
		$number=round(abs(floatval($string)), 2);
	} else {
		$number=abs(intval($string));
	}

	if($number>PHP_INT_MAX) {
		$number=PHP_INT_MAX;
	}

	return $number;
}

/**
 * Gets items list
 *
 * @param array $array
 * @param array $keys
 * @return array
 */
function themex_list($array, $keys) {
	$list='';
	$items=array();

	foreach($keys as $key) {
		if(isset($array[$key])) {
			$items[]=trim(str_replace('&nbsp;', '', $array[$key]));
		}
	}

	$list=implode(', ', $items);

	return $list;
}

/**
 * Gets period name
 *
 * @param int $period
 * @return string
 */
function themex_period($period) {
	switch($period) {
		case 7:
			$period=__('week', 'makery');
		break;

		case 31:
			$period=__('month', 'makery');
		break;

		case 365:
			$period=__('year', 'makery');
		break;

		default:
			$period=round($period/31).' '.__('months', 'makery');
		break;
	}

	return $period;
}

/**
 * Implodes array or value
 *
 * @param string $value
 * @param string $prefix
 * @return string
 */
function themex_implode($value, $prefix='') {
	if(is_array($value)) {
		$value=array_map('sanitize_key', $value);
		$value=implode("', '".$prefix, $value);
	} else {
		$value=sanitize_key($value);
	}

	$value="'".$prefix.$value."'";
	return $value;
}

/**
 * Gets current URL
 *
 * @return string
 */
function themex_url() {
	global $wp;

	$query_string='/';

	if(!empty($_GET)) {
		$query_string.='?'.http_build_query($_GET);
	}

	return home_url($wp->request.$query_string);
}

/**
 * Gets file name
 *
 * @param string $url
 * @return string
 */
function themex_filename($url) {
	$name=__('Untitled', 'makery');
	$parts=parse_url($url);

	if(isset($parts['path'])) {
		$name=basename($parts['path']);
	}

	return $name;
}

/**
 * Checks empty taxonomy
 *
 * @param string $name
 * @return bool
 */
function themex_taxonomy($name) {
	$terms=get_terms($name, array(
		'fields' => 'count',
		'hide_empty' => false,
	));

	if($terms!=0) {
		return true;
	}

	return false;
}

/**
 * Gets post status
 *
 * @param int $ID
 * @return string
 */
function themex_status($ID) {
	$status='draft';
	if(!empty($ID)) {
		$status=get_post_status($ID);
	}

	return $status;
}

/**
 * Gets post author
 *
 * @param int $ID
 * @return int
 */
function themex_author($ID) {
	$author=intval(get_post_field('post_author', $ID));

	return $author;
}

/**
 * Replaces string keywords
 *
 * @param string $string
 * @param array $keywords
 * @return string
 */
function themex_keywords($string, $keywords) {
	foreach($keywords as $keyword => $value) {
		$string=str_replace('%'.$keyword.'%', $value, $string);
	}

	return $string;
}

/**
 * Sends encoded email
 *
 * @param string $recipient
 * @param string $subject
 * @param string $message
 * @param string $reply
 * @return bool
 */
function themex_mail($recipient, $subject, $message, $reply='') {
	$headers=array();

	if(!empty($reply)) {
		$headers[]='Reply-To: '.$reply;
	}

	if(wp_mail($recipient, $subject, $message, $headers)) {
		return true;
	}

	return false;
}

/**
 * Gets static string
 *
 * @param string $key
 * @param string $type
 * @param string $default
 * @return string
 */
function themex_get_string($key, $type, $default) {
	$name=$key.'-'.$type;
	$string=$default;
	$strings=array();
	include(THEMEX_PATH.'strings.php');

	if(isset($strings[$name])) {
		$string=$strings[$name];
	}

	return themex_stripslashes($string);
}

/**
 * Adds static string
 *
 * @param string $key
 * @param string $type
 * @param string $string
 * @return void
 */
function themex_add_string($key, $type, $string) {
	$name=$key.'-'.$type;
	$string=themex_stripslashes($string);
	$strings=array();
	include(THEMEX_PATH.'strings.php');

	if(!isset($strings[$name])) {
		$string=str_replace("'", "’", $string);
		$file=@fopen(THEMEX_PATH.'strings.php', 'a');

		if($file!==false) {
			fwrite($file, "\r\n".'$strings'."['".$name."']=__('".$string."', 'makery');");
			fclose($file);
		}
	}
}

/**
 * Removes static strings
 *
 * @return void
 */
function themex_remove_strings() {
	$file=@fopen(THEMEX_PATH.'strings.php', 'w');
	if($file!==false) {
		fwrite($file, '<?php ');
		fclose($file);
	}
}

/**
 * Sanitizes key
 *
 * @param string $string
 * @return string
 */
function themex_sanitize_key($string) {
	$replacements=array(
		// Latin
		'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C',
		'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I',
		'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O',
		'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH',
		'ß' => 'ss',
		'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c',
		'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
		'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o',
		'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th',
		'ÿ' => 'y',

		// Greek
		'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',
		'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',
		'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',
		'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',
		'Ϋ' => 'Y',
		'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',
		'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',
		'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',
		'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',
		'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',

		// Turkish
		'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',
		'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g',

		// Russian
		'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',
		'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
		'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
		'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',
		'Я' => 'Ya',
		'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
		'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
		'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
		'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
		'я' => 'ya',

		// Ukrainian
		'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',
		'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',

		// Czech
		'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U',
		'Ž' => 'Z',
		'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',
		'ž' => 'z',

		// Polish
		'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z',
		'Ż' => 'Z',
		'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',
		'ż' => 'z',

		// Latvian
		'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N',
		'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',
		'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',
		'š' => 's', 'ū' => 'u', 'ž' => 'z'
	);

	$string=str_replace(array_keys($replacements), $replacements, $string);
	$string=preg_replace('/\s+/', '-', $string);
	$string=preg_replace('!\-+!', '-', $string);
	$filtered=$string;

	$string=preg_replace('/[^A-Za-z0-9-]/', '', $string);
	$string=strtolower($string);
	$string=trim($string, '-');

	if(empty($string) || $string[0]=='-') {
		$string='a'.md5($filtered);
	}

	return $string;
}

/**
 * Resize image
 *
 * @param string $url
 * @param int $width
 * @param int $height
 * @return array
 */
function themex_resize($url, $width, $height) {
	add_filter('image_resize_dimensions', 'themex_scale', 10, 6);

	$upload_info=wp_upload_dir();
	$upload_dir=$upload_info['basedir'];
	$upload_url=$upload_info['baseurl'];

	//check prefix
	$http_prefix='http://';
	$https_prefix='https://';

	if(!strncmp($url, $https_prefix, strlen($https_prefix))){
		$upload_url=str_replace($http_prefix, $https_prefix, $upload_url);
	} else if (!strncmp($url, $http_prefix, strlen($http_prefix))){
		$upload_url=str_replace($https_prefix, $http_prefix, $upload_url);
	}

	//check URL
	if (strpos($url, $upload_url)===false) {
		return false;
	}

	//define path
	$rel_path=str_replace($upload_url, '', $url);
	$img_path=$upload_dir.$rel_path;

	//check file
	if (!file_exists($img_path) or !getimagesize($img_path)) {
		return false;
	}

	//get file info
	$info=pathinfo($img_path);
	$ext=$info['extension'];
	list($orig_w, $orig_h)=getimagesize($img_path);

	//get image size
	$dims=image_resize_dimensions($orig_w, $orig_h, $width, $height, true);
	$dst_w=$dims[4];
	$dst_h=$dims[5];

	//resize image
	if((($height===null && $orig_w==$width) xor ($width===null && $orig_h==$height)) xor ($height==$orig_h && $width==$orig_w)) {
		$img_url=$url;
		$dst_w=$orig_w;
		$dst_h=$orig_h;
	} else {
		$suffix=$dst_w.'x'.$dst_h;
		$dst_rel_path=str_replace('.'.$ext, '', $rel_path);
		$destfilename=$upload_dir.$dst_rel_path.'-'.$suffix.'.'.$ext;

		if(!$dims) {
			return false;
		} else if(file_exists($destfilename) && getimagesize($destfilename) && empty($_FILES)) {
			$img_url=$upload_url.$dst_rel_path.'-'.$suffix.'.'.$ext;
		} else {
			if (function_exists('wp_get_image_editor')) {
				$editor=wp_get_image_editor($img_path);
				if (is_wp_error($editor) || is_wp_error($editor->resize($width, $height, true))) {
					return false;
				}

				$resized_file=$editor->save();

				if (!is_wp_error($resized_file)) {
					$resized_rel_path=str_replace($upload_dir, '', $resized_file['path']);

					$img_url=$upload_url.$resized_rel_path.'?'.time();
				} else {
					return false;
				}
			} else {
				$resized_img_path=image_resize($img_path, $width, $height, true);

				if (!is_wp_error($resized_img_path)) {
					$resized_rel_path=str_replace($upload_dir, '', $resized_img_path);
					$img_url=$upload_url.$resized_rel_path;
				} else {
					return false;
				}
			}
		}
	}

	remove_filter('image_resize_dimensions', 'themex_scale');
	return $img_url;
}

/**
 * Scale image
 *
 * @param string $default
 * @param int $orig_w
 * @param int $orig_h
 * @param int $dest_w
 * @param int $dest_h
 * @param bool $crop
 * @return array
 */
function themex_scale($default, $orig_w, $orig_h, $dest_w, $dest_h, $crop) {
	$aspect_ratio=$orig_w/$orig_h;
	$new_w=$dest_w;
	$new_h=$dest_h;

	if (!$new_w) {
		$new_w=intval($new_h*$aspect_ratio);
	}

	if (!$new_h) {
		$new_h=intval($new_w/$aspect_ratio);
	}

	$size_ratio=max($new_w/$orig_w, $new_h/$orig_h);
	$crop_w=round($new_w/$size_ratio);
	$crop_h=round($new_h/$size_ratio);

	$s_x=floor(($orig_w-$crop_w)/2);
	$s_y=floor(($orig_h-$crop_h)/2);
	$scale=array(0, 0, (int)$s_x, (int)$s_y, (int)$new_w, (int)$new_h, (int)$crop_w, (int)$crop_h);

	return $scale;
}

/**
 * Check multiple select
 */
class themex_walker extends Walker {
	public $tree_type='category';
	public $db_fields=array('parent'=>'parent', 'id'=>'term_id');

	public function start_el(&$output, $category, $depth=0, $args=array(), $id=0) {
		$pad=str_repeat('&nbsp;', $depth*3);
		$cat_name=apply_filters('list_cats', $category->name, $category);

		if (isset($args['value_field']) && isset($category->{$args['value_field']})) {
			$value_field=$args['value_field'];
		} else {
			$value_field='term_id';
		}

		$output.="\t<option class=\"level-$depth\" value=\"".esc_attr($category->{$value_field})."\"";

		if(is_array($args['selected']) && in_array($category->term_id, $args['selected'])) {
			$output.=' selected="selected"';
		}

		$output.='>';
		$output.=$pad.$cat_name;
		if ($args['show_count'])
			$output.='&nbsp;&nbsp;('.number_format_i18n($category->count).')';

		$output.="</option>\n";
	}
}
