<?php
function mos_home_url_replace($data) {
    $replace_fnc = str_replace('home_url()', home_url(), $data);
    $replace_br = str_replace('{{home_url}}', home_url(), $replace_fnc);
    return $replace_br;
}
// var_dump(mos_get_posts('product'));
function mos_get_posts($post_type = 'post', $count=-1, $taxonomy='', $terms=''){
    $output = array();
    $args = array(
        'posts_per_page'=> $count,
        'post_type'=> $post_type,
    );
    if ($taxonomy AND $terms) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => $taxonomy,
                'field'    => 'term_id',
                'terms'    =>  $terms,
            )
        );
    }
    $query = new WP_Query($args);
    if ($query -> have_posts()){
        while ($query -> have_posts()) { 
            $query -> the_post();
            $output[get_the_ID()] = get_the_title();
        }
    }
    return $output;
}
function mos_get_terms ($taxonomy = 'category') {
    global $wpdb;
    $output = array();
    $all_taxonomies = $wpdb->get_results( "SELECT {$wpdb->prefix}term_taxonomy.term_id, {$wpdb->prefix}term_taxonomy.taxonomy, {$wpdb->prefix}terms.name, {$wpdb->prefix}terms.slug, {$wpdb->prefix}term_taxonomy.description, {$wpdb->prefix}term_taxonomy.parent, {$wpdb->prefix}term_taxonomy.count, {$wpdb->prefix}terms.term_group FROM {$wpdb->prefix}term_taxonomy INNER JOIN {$wpdb->prefix}terms ON {$wpdb->prefix}term_taxonomy.term_id={$wpdb->prefix}terms.term_id", ARRAY_A);

    foreach ($all_taxonomies as $key => $value) {
        if ($value["taxonomy"] == $taxonomy) {
            $output[] = $value;
        }
    }
    return $output;
}

/*Variables*/
$template_parts = array(
    'Enabled'  => array(
        'content' => 'Page Content',
    ),
    'Disabled' => array(
        'banner' => 'Theme Banner',
        // 'ads' => 'Ads Section',
        // 'pcategory' => 'Category Section',
        // 'topselling' => 'Top Selling',
    ),
);
$districts = array(
    "BD-05" => "Bagerhat",
    "BD-01" => "Bandarban",
    "BD-02" => "Barguna",
    "BD-06" => "Barishal",
    "BD-07" => "Bhola",
    "BD-03" => "Bogura",
    "BD-04" => "Brahmanbaria",
    "BD-09" => "Chandpur",
    "BD-10" => "Chattogram",
    "BD-12" => "Chuadanga",
    "BD-11" => "Coxs Bazar",
    "BD-08" => "Cumilla",
    "BD-13" => "Dhaka",
    "BD-14" => "Dinajpur",
    "BD-15" => "Faridpur ",
    "BD-16" => "Feni",
    "BD-19" => "Gaibandha",
    "BD-18" => "Gazipur",
    "BD-17" => "Gopalganj",
    "BD-20" => "Habiganj",
    "BD-21" => "Jamalpur",
    "BD-22" => "Jashore",
    "BD-25" => "Jhalokati",
    "BD-23" => "Jhenaidah",
    "BD-24" => "Joypurhat",
    "BD-29" => "Khagrachhari",
    "BD-27" => "Khulna",
    "BD-26" => "Kishoreganj",
    "BD-28" => "Kurigram",
    "BD-30" => "Kushtia",
    "BD-31" => "Lakshmipur",
    "BD-32" => "Lalmonirhat",
    "BD-36" => "Madaripur",
    "BD-37" => "Magura",
    "BD-33" => "Manikganj ",
    "BD-39" => "Meherpur",
    "BD-38" => "Moulvibazar",
    "BD-35" => "Munshiganj",
    "BD-34" => "Mymensingh",
    "BD-48" => "Naogaon",
    "BD-43" => "Narail",
    "BD-40" => "Narayanganj",
    "BD-42" => "Narsingdi",
    "BD-44" => "Natore",
    "BD-45" => "Nawabganj",
    "BD-41" => "Netrakona",
    "BD-46" => "Nilphamari",
    "BD-47" => "Noakhali",
    "BD-49" => "Pabna",
    "BD-52" => "Panchagarh",
    "BD-51" => "Patuakhali",
    "BD-50" => "Pirojpur",
    "BD-53" => "Rajbari",
    "BD-54" => "Rajshahi",
    "BD-56" => "Rangamati",
    "BD-55" => "Rangpur",
    "BD-58" => "Satkhira",
    "BD-62" => "Shariatpur",
    "BD-57" => "Sherpur",
    "BD-59" => "Sirajganj",
    "BD-61" => "Sunamganj",
    "BD-60" => "Sylhet",
    "BD-63" => "Tangail",
    "BD-64" => "Thakurgaon",
);

/*Variables*/