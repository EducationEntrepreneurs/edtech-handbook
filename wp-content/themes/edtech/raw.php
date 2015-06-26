               $args = array(
	                'posts_per_page' => $posts_per_page,
	                'paged' => $paged,
	                'offset' => $offset,
	                'category_name' => $category_name,
	                'meta_query' => array(
                                        array(
                                            'order'   => 'ASC',
                                            'key'     => 'featured',
                                            'value'   => serialize(strval('featured')),
                                            'compare' => 'LIKE',
                                        ),
                                    )
                );
                
                
                
                $args = array(
	                'posts_per_page' => $posts_per_page,
	                'paged' => $paged,
	                'offset' => $offset,
	                'category_name' => $category_name,
	                'order'   => 'DSC',
	                'meta_key' => 'vote_count_yes',
                    'orderby'   => 'meta_value_num'
                );