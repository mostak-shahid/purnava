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
    'Enabled'  => array(),
    'Disabled' => array(
        'banner' => 'Theme Banner',
        'content' => 'Page Content',
        'ads' => 'Ads Section',
        'pcategory' => 'Category Section',
        'topselling' => 'Top Selling',
    ),
);
$districts = array(
    "Dhaka" => "Dhaka",
    "Faridpur" => "Faridpur",
    "Gazipur" => "Gazipur",
    "Gopalganj" => "Gopalganj",
    "Jamalpur" => "Jamalpur",
    "Kishoreganj" => "Kishoreganj",
    "Madaripur" => "Madaripur",
    "Manikganj" => "Manikganj",
    "Munshiganj" => "Munshiganj",
    "Mymensingh" => "Mymensingh",
    "Narayanganj" => "Narayanganj",
    "Narsingdi" => "Narsingdi",
    "Netrokona" => "Netrokona",
    "Rajbari" => "Rajbari",
    "Shariatpur" => "Shariatpur",
    "Sherpur" => "Sherpur",
    "Tangail" => "Tangail",
    "Bogura" => "Bogura",
    "Joypurhat" => "Joypurhat",
    "Naogaon" => "Naogaon",
    "Natore" => "Natore",
    "Chapainawabganj" => "Chapainawabganj",
    "Pabna" => "Pabna",
    "Rajshahi" => "Rajshahi",
    "Sirajgonj" => "Sirajgonj",
    "Dinajpur" => "Dinajpur",
    "Gaibandha" => "Gaibandha",
    "Kurigram" => "Kurigram",
    "Lalmonirhat" => "Lalmonirhat",
    "Nilphamari" => "Nilphamari",
    "Panchagarh" => "Panchagarh",
    "Rangpur" => "Rangpur",
    "Thakurgaon" => "Thakurgaon",
    "Barguna" => "Barguna",
    "Barishal" => "Barishal",
    "Bhola" => "Bhola",
    "Jhalokati" => "Jhalokati",
    "Patuakhali" => "Patuakhali",
    "Pirojpur" => "Pirojpur",
    "Bandarban" => "Bandarban",
    "Brahmanbaria" => "Brahmanbaria",
    "Chandpur" => "Chandpur",
    "Chattogram" => "Chattogram",
    "Cumilla" => "Cumilla",
    "Cox's Bazar" => "Cox's Bazar",
    "Feni" => "Feni",
    "Khagrachhari" => "Khagrachhari",
    "Lakshmipur" => "Lakshmipur",
    "Noakhali" => "Noakhali",
    "Rangamati" => "Rangamati",
    "Habiganj" => "Habiganj",
    "Moulvibazar" => "Moulvibazar",
    "Sunamganj" => "Sunamganj",
    "Sylhet" => "Sylhet",
    "Bagerhat" => "Bagerhat",
    "Chuadanga" => "Chuadanga",
    "Jashore" => "Jashore",
    "Jhenaidah" => "Jhenaidah",
    "Khulna" => "Khulna",
    "Kushtia" => "Kushtia",
    "Magura" => "Magura",
    "Meherpur" => "Meherpur",
    "Narail" => "Narail",
    "Satkhira" => "Satkhira"
);
/*Variables*/