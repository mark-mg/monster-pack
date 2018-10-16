<strong>SITE MAP</strong>
<br/>
<hr/>
<br/>
<ul>
    <?php /* wp_list_pages( array( 'title_li' => '' ) ); */ ?>
    <?php
    wp_list_pages( array(
        'title_li'    => '',
        'child_of'    => $post->ID,
        'show_date'   => 'modified',
        'date_format' => $date_format
    ) );
    ?> 
</ul>
<?php echo $api_url; ?>