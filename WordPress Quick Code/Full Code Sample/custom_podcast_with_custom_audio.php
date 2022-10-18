<?php  
    $mainarray = array(
        'post_type' => array('podcast'),
        'post_status' => array('publish'),
        'orderby' => 'date',
        'order' => 'DESC',
        'posts_per_page' => 4
    );
    $q = new WP_Query($mainarray);
?>

<style>
    .podcast-card {
        background-color: #F4F6F1;
        padding: 25px;
    }
    .podcast-wrapper > .row > div {
        margin-bottom: 30px;
    }
    .about-podcast{
        display: flex;
        flex-direction: row;
        align-items: center;
    }
    .about-podcast > div:first-child {
        flex: 0 0 200px;
        margin-right: 20px;
        margin-bottom: 20px;
    }
    .podcast-title > h3 {
        font-family: 'Poppins';
        font-style: italic;
        font-weight: 400;
        font-size: 18px;
        color: #272727;
    }
    button.player-button path {
        fill: #05B210 !important;
    }
    button.sound-button path {
        fill: #978466 !important;
    }
    .podcast-card button {
        box-shadow: none !important;
    }
    .audio-player {
        --player-button-width: 3em;
        --sound-button-width: 2em;
        --space: .5em;
    }
    .audio-icon {
        width: 90%;
        height: 90%;
    }
    .controls {
        display: flex;
        flex-direction: row;
        align-items: center;
        width: 100%;
        margin-top: 10px;
    }
    .player-button {
        background-color: transparent;
        border: 0;
        width: var(--player-button-width);
        height: var(--player-button-width);
        cursor: pointer;
        padding: 0;
    }
    .timeline {
        -webkit-appearance: none;
        width: calc(100% - (var(--player-button-width) + var(--sound-button-width) + var(--space)));
        height: .5em;
        background-color: #e5e5e5;
        border-radius: 5px;
        background-size: 0% 100%;
        background-image: linear-gradient(0deg, rgba(5, 178, 16, 0.9), rgba(5, 178, 16, 0.9));
        background-repeat: no-repeat;
        margin-right: var(--space);
    }
    .timeline::-webkit-slider-thumb {
        -webkit-appearance: none;
        width: 1em;
        height: 1em;
        border-radius: 50%;
        cursor: pointer;
        opacity: 0;
        transition: all .1s;
        background-color: #05B210;
    }
    .timeline::-moz-range-thumb {
        -webkit-appearance: none;
        width: 1em;
        height: 1em;
        border-radius: 50%;
        cursor: pointer;
        opacity: 0;
        transition: all .1s;
        background-color: #05B210;
    }
    .timeline::-ms-thumb {
        -webkit-appearance: none;
        width: 1em;
        height: 1em;
        border-radius: 50%;
        cursor: pointer;
        opacity: 0;
        transition: all .1s;
        background-color: #05B210;
    }
    .timeline::-webkit-slider-thumb:hover {
        background-color: #05B210;
    }
    .timeline:hover::-webkit-slider-thumb {
        opacity: 1;
    }
    .timeline::-moz-range-thumb:hover {
        background-color: #05B210;
    }
    .timeline:hover::-moz-range-thumb {
        opacity: 1;
    }
    .timeline::-ms-thumb:hover {
        background-color: #05B210;
    }
    .timeline:hover::-ms-thumb {
    opacity: 1;
    }
    .timeline::-webkit-slider-runnable-track {
        -webkit-appearance: none;
        box-shadow: none;
        border: none;
        background: transparent;
    }
    .timeline::-moz-range-track {
        -webkit-appearance: none;
        box-shadow: none;
        border: none;
        background: transparent;
    }
    .timeline::-ms-track {
        -webkit-appearance: none;
        box-shadow: none;
        border: none;
        background: transparent;
    }
    .sound-button {
        background-color: transparent;
        border: 0;
        width: var(--sound-button-width);
        height: var(--sound-button-width);
        cursor: pointer;
        padding: 0;
    }
    @media (max-width: 767px){
        .about-podcast {
            flex-direction: column !important;
        }
    }
</style>

<div class="podcast-wrapper">
    <div class="row">
        <?php while ($q->have_posts()) : $q->the_post(); ?>
        <div class="col-md-6">
            <div class="podcast-card">
                <div class="about-podcast">
                    <div class="podcast-feature">
                        <?php if (has_post_thumbnail()):  
                		    $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(),'large', true);
                		?>
                			<img src="<?php echo $thumbnail[0]; ?>" alt="Picture" class="featured-image">			
                		<?php else: ?>
                            <img src="<?php echo site_url('/wp-content/uploads/woocommerce-placeholder.png'); ?>" alt="Picture" class="featured-image">
                	    <?php endif; ?>
                    </div>
                    <div class="podcast-title">
                        <h3><?php the_title(); ?></h3>
                    </div>
                </div>
                <div class="podcast-audio">
                    <div class="audio-player">
                        <audio src="<?php the_field('podcast_file'); ?>"></audio>
                        <div class="controls">
                            <button class="player-button">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="#3D3132">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <input type="range" class="timeline" max="100" value="0">
                            <button class="sound-button">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="#3D3132">
                                <path fill-rule="evenodd" d="M9.383 3.076A1 1 0 0110 4v12a1 1 0 01-1.707.707L4.586 13H2a1 1 0 01-1-1V8a1 1 0 011-1h2.586l3.707-3.707a1 1 0 011.09-.217zM14.657 2.929a1 1 0 011.414 0A9.972 9.972 0 0119 10a9.972 9.972 0 01-2.929 7.071 1 1 0 01-1.414-1.414A7.971 7.971 0 0017 10c0-2.21-.894-4.208-2.343-5.657a1 1 0 010-1.414zm-2.829 2.828a1 1 0 011.415 0A5.983 5.983 0 0115 10a5.984 5.984 0 01-1.757 4.243 1 1 0 01-1.415-1.415A3.984 3.984 0 0013 10a3.983 3.983 0 00-1.172-2.828 1 1 0 010-1.415z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endwhile; wp_reset_postdata(); ?>
    </div>
</div>

<script>
    const playerButton = jQuery('.player-button'),
    playIcon = `
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="#3D3132">
    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
  </svg>
      `,
      pauseIcon = `
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="#3D3132">
  <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zM7 8a1 1 0 012 0v4a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v4a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
</svg>
      `,
      soundIcon = `
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="#3D3132">
  <path fill-rule="evenodd" d="M9.383 3.076A1 1 0 0110 4v12a1 1 0 01-1.707.707L4.586 13H2a1 1 0 01-1-1V8a1 1 0 011-1h2.586l3.707-3.707a1 1 0 011.09-.217zM14.657 2.929a1 1 0 011.414 0A9.972 9.972 0 0119 10a9.972 9.972 0 01-2.929 7.071 1 1 0 01-1.414-1.414A7.971 7.971 0 0017 10c0-2.21-.894-4.208-2.343-5.657a1 1 0 010-1.414zm-2.829 2.828a1 1 0 011.415 0A5.983 5.983 0 0115 10a5.984 5.984 0 01-1.757 4.243 1 1 0 01-1.415-1.415A3.984 3.984 0 0013 10a3.983 3.983 0 00-1.172-2.828 1 1 0 010-1.415z" clip-rule="evenodd" />
</svg>`,
      muteIcon = `
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="#3D3132">
  <path fill-rule="evenodd" d="M9.383 3.076A1 1 0 0110 4v12a1 1 0 01-1.707.707L4.586 13H2a1 1 0 01-1-1V8a1 1 0 011-1h2.586l3.707-3.707a1 1 0 011.09-.217zM12.293 7.293a1 1 0 011.414 0L15 8.586l1.293-1.293a1 1 0 111.414 1.414L16.414 10l1.293 1.293a1 1 0 01-1.414 1.414L15 11.414l-1.293 1.293a1 1 0 01-1.414-1.414L13.586 10l-1.293-1.293a1 1 0 010-1.414z" clip-rule="evenodd" />
</svg>`;

jQuery('.player-button').each(function(){

    var audioA = jQuery(this).parent().parent().find('audio')[0];
    var audioB = jQuery(this).parent().parent().find('audio');
    var timelineA = jQuery(this).next();
    var soundButton = jQuery(this).parent().find('.sound-button');
    var currentPodcastButton = jQuery(this);

    currentPodcastButton.on('click', function(){
        if (audioA.paused)
        {
            audioA.play();
            jQuery(this).html(pauseIcon);
        }
        else 
        {
            audioA.pause();
            jQuery(this).html(playIcon);
        }
    });

    audioB.bind('timeupdate', function(){
        const percentagePosition = (100 * jQuery(this)[0].currentTime) / jQuery(this)[0].duration;
        timelineA.css('background-size', `${percentagePosition}% 100%`);
        timelineA.val(percentagePosition);
    });

    audioB.bind('ended', function(){
        jQuery(this).next().find('.player-button').html(playIcon);
    });

    timelineA.on('change', function(){
		var aud = jQuery(this).parent().prev();
        const time = (jQuery(this).val() * aud[0].duration) / 100;
        aud[0].currentTime = time;
    });
	
	soundButton.on('click', function(){
		var aud2 = jQuery(this).parent().prev()[0];
		aud2.muted = !aud2.muted;
		var svghtml = aud2.muted ? muteIcon : soundIcon;
		jQuery(this).html(svghtml);
	});

});
</script>