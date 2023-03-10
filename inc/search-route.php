<?php


function university_register_search(){
    register_rest_route('university/v1','search',[  
        'methods'=> WP_REST_SERVER::READABLE, //WP_REST_SERVER::READABLE => GET
        'callback'=> 'Searching'
    ]);
}
add_action('rest_api_init','university_register_search');


function Searching($data)
{
    $resultList = array(
        'GeneralInfo'=>[],
        'event'=>[],
        'professor'=>[],
        'program'=>[],
        'campus'=>[]
    );

    $mainQuery = new WP_Query([        
        'post_type'=>['post','page','event','professor','program','campus'],
        's'=> sanitize_text_field($data['val'])
    ]);
    
    $resultList = MakeResultList($mainQuery,$resultList); 

    if($resultList['program']){
        $metaQueryList = ['relation'=>'OR'];

        foreach($resultList['program'] as $program){
            array_push($metaQueryList,
            [
                'key'=>'related_program',
                'compare'=>'LIKE',
                'value'=>'"' . $program['id'] . '"'
            ]);
        }        

        $ProgramRelatedQuery = new WP_Query([        
            'post_type'=>['event','professor','campus'],
            'meta_query'=>$metaQueryList
        ]);
    
        $resultList = MakeResultList($ProgramRelatedQuery,$resultList); 
    }
    
    //$resultList=$mainResults;
    //$resultList = $mainResults+$ProgramRelatedResult;
    $resultList['professor'] = array_values(array_unique($resultList['professor'],SORT_REGULAR));
    $resultList['event'] = array_values(array_unique($resultList['event'],SORT_REGULAR));
    $resultList['campus'] = array_values(array_unique($resultList['campus'],SORT_REGULAR));

    return $resultList;
}

function MakeResultList($query,$resultList)
{   
    while($query->have_posts()){
        $query->the_post();
        $postType = get_post_type();
        $feild=$postType;
              
        if($postType=="post" or $postType=="page"){
            $feild="GeneralInfo";
            array_push($resultList[$feild],[
                'postType' => get_post_type(),
                'authorName' => get_the_author(),
                'title'=>get_the_title(),
                'link'=>get_the_permalink()
            ]); 
            continue;
        }

        if($postType=="professor"){
            array_push($resultList[$feild],[                
                'title'=>get_the_title(),
                'link'=>get_the_permalink(),
                'thumbnailLink'=>get_the_post_thumbnail_url(0,'professorLandscape')
            ]);
            continue;
        }

        if($postType=="program"){
            array_push($resultList[$feild],[
                'id'=>get_the_id(),
                'title'=>get_the_title(),
                'link'=>get_the_permalink()
            ]);
            continue;
        }
       
        if($postType=="event"){
            $eventDate = new DateTime(get_field('event_date'));
            $description = null;
            if(has_excerpt()){
                $description = get_the_excerpt();
            }
            else{
                $description = wp_trim_words(get_the_content(),50);
            }
        
            array_push($resultList[$feild],[
                'title'=>get_the_title(),
                'link'=>get_the_permalink(),
                'excerpt'=>$description,
                'eventMonth'=>$eventDate->format('M'),
                'eventDay'=>$eventDate->format('d')                
            ]);
            continue;
        }

        array_push($resultList[$feild],[
            'title'=>get_the_title(),
            'link'=>get_the_permalink()
        ]);      
    }
    return $resultList;
}
?>