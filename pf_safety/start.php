<?php

// Have this run absolutely last, so all other plugins have already initiated.
register_elgg_event_handler('init','system','pf_safety_init',20000);
 
function pf_safety_init() {
  // Have the members page be protected with a gatekeeper() call
  elgg_unregister_page_handler('members');
  if (!elgg_is_logged_in()) 
    elgg_unregister_menu_item('site', 'members');
  elgg_register_page_handler('members', 'pf_safety_members_page_handler');
}

function pf_safety_members_page_handler($page) {
  gatekeeper();
  return call_user_func('members_page_handler', $page);
}    

?>
