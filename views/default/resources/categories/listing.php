<?php
/**
 * List entities by category
 *
 * @package ElggCategories
 */

$limit = get_input("limit", elgg_get_config('default_limit'));
$offset = get_input("offset", 0);
$category = get_input("category");
$owner_guid = get_input("owner_guid", ELGG_ENTITIES_ANY_VALUE);
$subtype = get_input("subtype", ELGG_ENTITIES_ANY_VALUE);
$type = get_input("type", 'object');

$title = elgg_echo('categories:results', array($category));

if (elgg_is_logged_in()){
$params = array(
	'metadata_name' => 'universal_categories',
	'metadata_value' => $category,
	'type' => $type,
	'subtype' => $subtype,
	'owner_guid' => $owner_guid,
	'full_view' => FALSE,
	'metadata_case_sensitive' => FALSE,
);}

if (!elgg_is_logged_in()){
$params = array(
	'metadata_name' => 'universal_categories',
	'metadata_value' => $category,
	'type' => $type,
	'subtype' => 'posts',
	'owner_guid' => $owner_guid,
	'full_view' => FALSE,
	'metadata_case_sensitive' => FALSE,
);}
$content = elgg_list_entities_from_metadata($params);

$body = elgg_view_layout('one_sidebar', array(
	'title' => $title,
	'content' => $content	
));

echo elgg_view_page($title, $body);
