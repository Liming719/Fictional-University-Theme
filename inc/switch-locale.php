<?php 


function switchLocale($data){
    //switch_to_locale($data['lan']);
    
    //echo get_template_directory() .  '/src/lang/' .$data['lan'] .'.mo';
    echo load_textdomain('FU_domain', get_template_directory() . '/src/lang' .$data['lan'] .'.mo');
    echo ($data['lan']);
}

function university_register_language(){
  register_rest_route('university/v1','language',[  
      'methods'=> WP_REST_SERVER::READABLE, //WP_REST_SERVER::READABLE => GET
      'callback'=> 'switchLocale'
  ]);
}
add_action('rest_api_init','university_register_language');