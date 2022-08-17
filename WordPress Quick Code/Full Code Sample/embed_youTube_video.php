<div class="online-video">
    <?php
        $url = get_field('youtube_video');
        parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
    ?> 
    <iframe width="50%" height="450" src="https://www.youtube.com/embed/<?php echo $my_array_of_vars['v']; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
</div>