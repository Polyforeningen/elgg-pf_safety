<?php

// Have this run absolutely last, so all other plugins have already initiated.
register_elgg_event_handler('init','system','pf_safety_init',20000);
 
function pf_safety_init() {
  // Have the members page be removed from the site menu if the visitor isn't
  // logged in, as well as protected with a gatekeeper() call
  if (!elgg_is_logged_in()) 
    elgg_unregister_menu_item('site', 'members');
  elgg_unregister_page_handler('members');
  elgg_register_page_handler('members', 'pf_safety_members_page_handler');

  // Have the groups page protected in a similar fashion.
  if (!elgg_is_logged_in()) 
    elgg_unregister_menu_item('site', 'groups');
  elgg_unregister_page_handler('groups');
  elgg_register_page_handler('groups', 'pf_safety_groups_page_handler');

  // Have the activity page protected in a similar fashion.
  if (!elgg_is_logged_in()) 
    elgg_unregister_menu_item('site', 'activity');
  elgg_unregister_page_handler('activity');
  elgg_register_page_handler('activity', 'pf_safety_elgg_river_page_handler');

  // Have the profile viewing page protected as well.  No menu to remove.
  elgg_unregister_page_handler('profile');
  elgg_register_page_handler('profile', 'pf_safety_profile_page_handler');
}

function pf_safety_members_page_handler($page) {
  gatekeeper();
  return call_user_func('members_page_handler', $page);
}    

function pf_safety_groups_page_handler($page) {
  gatekeeper();
  return call_user_func('groups_page_handler', $page);
}    

function pf_safety_elgg_river_page_handler($page) {
  gatekeeper();
  return call_user_func('elgg_river_page_handler', $page);

function pf_safety_profile_page_handler($page) {
  gatekeeper();
  return call_user_func('profile_page_handler', $page);
}    

?>
