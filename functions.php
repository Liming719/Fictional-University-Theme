<?php
require get_theme_file_path('/inc/search-route.php');
require get_theme_file_path('/inc/switch-locale.php');

function university_files(){
    wp_enqueue_script('main-js',get_theme_file_uri('/build/index.js'), array('jquery'),'1.0', true);

    wp_enqueue_style('custom-font','//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('font-awsome','//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('main-style',get_theme_file_uri('/build/style-index.css'));
    wp_enqueue_style('sub-style',get_theme_file_uri('/build/index.css'));
    wp_enqueue_style('tailwind-style',get_theme_file_uri('/build/output.css'));

    // wp_localize_script('main-university-js','universityData',[
    //     'root_url'=>get_site_url()
    // ]);
}

add_action('wp_enqueue_scripts','university_files');

function university_features(){
    register_nav_menu('headerMenuLocation','Header Menu Location');
    register_nav_menu('footerMenuLocation1','Footer Menu Location 1');
    register_nav_menu('footerMenuLocation2','Footer Menu Location 2');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_image_size('professorLandscape',400,260,true);
    add_image_size('professorProtrait',480,650,true);
    add_image_size('PageBanner',1500,350,true);
}    
add_action('after_setup_theme','university_features');

function university_adjust_queries($query){
    if(!is_admin() AND is_post_type_archive('program') AND is_main_query()){
        $query->set('posts_per_page', -1);
        $query->set('orderby', 'title');
        $query->set('order', 'ASC');               
    }


    if(!is_admin() AND is_post_type_archive('event') AND is_main_query()){
        $today=date('Ymd');
        $query->set('meta_key', 'event_date');
        $query->set('orderby', 'meta_value');
        $query->set('order', 'ASC');
        $query->set('meta_query', [
            [
                'key'=>'event_date',
                'compare'=>'>=',
                'value'=>$today,
                'type'=>'numeric'
            ]
        ]);        
    }
}
add_action('pre_get_posts', 'university_adjust_queries');

function PageBanner($args = ['title'=>'','subtitle'=>'','bg-image'=>'']){
    
    if(!$args['title'])
    {
        $args['title'] = get_the_title();
    }

    if(!$args['subtitle'])
    {
        $args['subtitle'] = get_field('page_banner_subtitle');
    }

    if(!$args['bg-image'])
    {
        if(get_field('page_banner_background_image'))
            $args['bg-image'] = get_field('page_banner_background_image')['sizes']['PageBanner'];
        else
            $args['bg-image'] = get_theme_file_uri('images/ocean.jpg');
    }
    ?>
    <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?php echo $args['bg-image'] ?>)"></div>
        <div class="page-banner__content container container--narrow">
            <h1 class="page-banner__title"><?php echo $args['title']; ?></h1>
            <div class="page-banner__intro">
                <p><?php echo $args['subtitle']; ?></p>
            </div>
        </div>
    </div>
    <?php
}

function university_custom_rest(){
    register_rest_field('post','authorName',[
        'get_callback'=>function(){
            return get_the_author();
        }
    ]);
    
}
add_action('rest_api_init','university_custom_rest');

function RedirectOnSubcriberLogin()
{
    $CurrentUser = wp_get_current_user();
    if(count($CurrentUser->roles)==1 and $CurrentUser->roles[0]=="subscriber"){
        wp_redirect(esc_url(site_url('/')));        
    }
}
add_action('admin_init','RedirectOnSubcriberLogin');

function HideAdminBar()
{
    $CurrentUser = wp_get_current_user();
    if(count($CurrentUser->roles)==1 and $CurrentUser->roles[0]=="subscriber"){
        show_admin_bar(false);    
    }
}
add_action('wp_loaded','HideAdminBar');

function CustomLoginPageHeaderUrl()
{
    return esc_url(site_url('/'));
}
add_filter('login_headerurl','CustomLoginPageHeaderUrl');

function OurLoginCSS(){
    wp_enqueue_style('custom-font','//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('font-awsome','//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('main-style',get_theme_file_uri('/build/style-index.css'));
    wp_enqueue_style('sub-style',get_theme_file_uri('/build/index.css'));
    wp_enqueue_style('tailwind-style',get_theme_file_uri('/build/output.css'));
}
add_action('login_enqueue_scripts','OurLoginCSS');

function CustomLoginPageHeaderTitle(){
    return get_bloginfo('name');    
}
add_filter('login_headertitle','CustomLoginPageHeaderTitle');

function languages(){
    //echo get_theme_file_path('/src/lang/zh_TW.mo');
    load_theme_textdomain('FU_domain', get_template_directory() . '/src/lang');
}
add_action('init','languages');
?>