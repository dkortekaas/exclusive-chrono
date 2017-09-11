<?php
// Social Icons

function wb_social_icons() {

    $wbase_social_options = get_option('wb_social_options');

    //if ( (isset($wbase_social_options['wb_footer_social_icons'])) && (trim($wbase_social_options['wb_footer_social_icons']) == "1" ) ) :
        echo '<ul class="footer-social">';
            $facebook = $pinterest = $linkedin = $twitter = $googleplus = $instagram = $youtube = "";
            // $rss = $tumblr = $vimeo = $behance = $dribble = $flickr = $git = $skype = $soundcloud = "";
            
            if ( isset ($wbase_social_options['wb_facebook_url']) ) $facebook = $wbase_social_options['wb_facebook_url'];
            if ( isset ($wbase_social_options['wb_pinterest_url']) ) $pinterest = $wbase_social_options['wb_pinterest_url'];
            if ( isset ($wbase_social_options['wb_linkedin_url']) ) $linkedin = $wbase_social_options['wb_linkedin_url'];
            if ( isset ($wbase_social_options['wb_twitter_url']) ) $twitter = $wbase_social_options['wb_twitter_url'];
            if ( isset ($wbase_social_options['wb_googleplus_url']) ) $googleplus = $wbase_social_options['wb_googleplus_url'];
            // if ( isset ($wbase_social_options['rss_url']) ) $rss = $wbase_social_options['rss_url'];
            // if ( isset ($wbase_social_options['tumblr_url']) ) $tumblr = $wbase_social_options['tumblr_url'];
            if ( isset ($wbase_social_options['wb_instagram_url']) ) $instagram = $wbase_social_options['wb_instagram_url'];
            if ( isset ($wbase_social_options['wb_youtube_url']) ) $youtube = $wbase_social_options['wb_youtube_url'];
            // if ( isset ($wbase_social_options['vimeo_url']) ) $vimeo = $wbase_social_options['vimeo_url'];
            if ( isset ($wbase_social_options['wb_behance_url']) ) $behance = $wbase_social_options['wb_behance_url'];
            // if ( isset ($wbase_social_options['dribble_url']) ) $dribble = $wbase_social_options['dribble_url'];
            // if ( isset ($wbase_social_options['flickr_url']) ) $flickr = $wbase_social_options['flickr_url'];
            // if ( isset ($wbase_social_options['git_url']) ) $git = $wbase_social_options['git_url'];
            // if ( isset ($wbase_social_options['skype_url']) ) $skype = $wbase_social_options['skype_url'];
            // if ( isset ($wbase_social_options['soundcloud_url']) ) $soundcloud = $wbase_social_options['soundcloud_url'];
            
            if ( $facebook != "" ) echo('<li><a href="' . $facebook . '" target="_blank" rel="nofollow" class="social_media"><i class="fa fa-facebook"></i></a></li>' );
            if ( $pinterest != "" ) echo('<li><a href="' . $pinterest . '" target="_blank" rel="nofollow" class="social_media"><i class="fa fa-pinterest"></i></a></li>' );
            if ( $linkedin != "" ) echo('<li><a href="' . $linkedin . '" target="_blank" rel="nofollow" class="social_media"><i class="fa fa-linkedin"></i></a></li>' );
            if ( $twitter != "" ) echo('<li><a href="' . $twitter . '" target="_blank" rel="nofollow" class="social_media"><i class="fa fa-twitter"></i></a></li>' );
            if ( $googleplus != "" ) echo('<li><a href="' . $googleplus . '" target="_blank" rel="nofollow" class="social_media"><i class="fa fa-google-plus"></i></a></li>' );
            // if ( $rss != "" ) echo('<li><a href="' . $rss . '" target="_blank" class="social_media"><i class="fa fa-rss"></i></a></li>' );
            // if ( $tumblr != "" ) echo('<li><a href="' . $tumblr . '" target="_blank" class="social_media"><i class="fa fa-tumblr"></i></a></li>' );
            if ( $instagram != "" ) echo('<li><a href="' . $instagram . '" target="_blank" rel="nofollow" class="social_media"><i class="fa fa-instagram"></i></a></li>' );
            if ( $youtube != "" ) echo('<li><a href="' . $youtube . '" target="_blank" rel="nofollow" class="social_media"><i class="fa fa-youtube"></i></a></li>' );
            // if ( $vimeo != "" ) echo('<li><a href="' . $vimeo . '" target="_blank" class="social_media"><i class="fa fa-vimeo-square"></i></a></li>' );
            if ( $behance != "" ) echo('<li><a href="' . $behance . '" target="_blank" rel="nofollow" class="social_media"><i class="fa fa-behance"></i></a></li>' );
            // if ( $dribble != "" ) echo('<li><a href="' . $dribble . '" target="_blank" class="social_media"><i class="fa fa-dribbble"></i></a></li>' );
            // if ( $flickr != "" ) echo('<li><a href="' . $flickr . '" target="_blank" class="social_media"><i class="fa fa-flickr"></i></a></li>' );
            // if ( $git != "" ) echo('<li><a href="' . $git . '" target="_blank" class="social_media"><i class="fa fa-git"></i></a></li>' );
            // if ( $skype != "" ) echo('<li><a href="' . $skype . '" target="_blank" class="social_media"><i class="fa fa-skype"></i></a></li>' );
            // if ( $soundcloud != "" ) echo('<li><a href="' . $soundcloud . '" target="_blank" class="social_media"><i class="fa fa-soundcloud"></i></a></li>' );            
        echo '</ul>';
    //endif;
}