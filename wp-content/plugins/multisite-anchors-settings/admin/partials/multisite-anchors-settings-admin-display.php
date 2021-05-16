<?php


/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       internet-cossacks.com
 * @since      1.0.0
 *
 * @package    Multisite_Anchors_Settings
 * @subpackage Multisite_Anchors_Settings/admin/partials
 */
$sites = get_sites(array(
        'orderby' => 'domain',
));
$plugin_name = 'Multisite Anchors settings';
$link_get_param ='';
if (isset($_GET['link-pattern'])) {
    $link_get_param = $_GET['link-pattern'];
}

?>
<div class="mas-plugin-wrapper">
    <div class="mas-plugin-header"></div>
    <h2 class="mas-plugin-title"> <?php echo $plugin_name; ?></h2>
    <!-- /.mas-plugin-header -->
    <div class="mas-plugin-content">
        <form class="form-inline">
            <div class="form-group mx-sm-3 mb-2">
                <label for="inputPattern" class="sr-only">Link pattern</label>
                <input type="text" class="form-control" id="inputPattern" value="<?php echo $link_get_param; ?>" placeholder="Link pattern: like google.com">
            </div>
            <button type="submit" class="btn btn-primary mb-2" id="pattern-submit-btn">Confirm pattern</button>
        </form>
        <ul class="mas-plugin-websites">
            <?php foreach ($sites as $site) :
                switch_to_blog($site->blog_id);
                echo get_locale();
                $website_domain = get_blog_details($site->blog_id)->blogname;
                ?>
            <li class="mas-plugin-website">
                <h3 class="mas-plugin-website__domain"> <?php  esc_html_e('Website: ');
                echo $website_domain;  ?></h3>

                <ul class="mas-plugin-website__posts">
                    <?php $my_posts = get_posts(array (
                        "post_type" => array('page','post'),
                        'numberposts' => -1,
                        'orderby' =>'date',
                        'order' => 'ASC',
                    ));
                    foreach ($my_posts as $post) :
                        $post_content = $post->post_content;
                        $regex = sprintf('/<a[^>]+href=\"(?<link>https?:\/\/%s.*?)\"[^>]*>(?<anchor>.*?)<\/a>/', $link_get_param);
                        preg_match_all($regex, $post_content, $matches, PREG_SET_ORDER);
                        if ($matches) :
                            ?>
                    <li class="mas-plugin-website__post">
                        <h4 class="mas-plugin-website__post-title"><?php esc_html_e('Post: '); echo  $post->post_title ?></h4>
                        <a href="<?php echo get_post_permalink($post) ?>">Post Url</a>
                        <ul class="mas-plugin-website__post-links">
                            <?php foreach ($matches as $match) :
                                $anchor =  $match['anchor'];
                                $link = $match['link'];
                                ?>
                            <li class="mas-plugin-website__post-link-info">
                                <form class="form-group mas-plugin-form">
                                    <label for='current-anchor'>Current anchor</label>
                                    <input type='text' class="form-control" id='current-anchor' name='current-anchor' value='<?php echo $anchor; ?>' readonly>
                                    <label for='link'>Link:</label>
                                    <input type='text' class="form-control"  id='link' name='link' value='<?php echo $link; ?>' readonly>
                                    <label for='new-anchor'>New Anchor</label>
                                    <input type='text' class="form-control" id='new-anchor' name='new-anchor' value=''>
                                    <button type='submit' class="btn btn-primary" id="mas-change-anchor-btn"
                                            data-blog_id="<?php echo $site->blog_id ?>"
                                            data-post_id="<?php echo $post->ID ?>">
                                        <span class="spinner-grow spinner-grow-sm d-none" role="status" aria-hidden="true"></span>
                                        Change anchor
                                    </button>
                                    <button type='submit' class="btn btn-danger" id="mas-delete-link-btn"
                                            data-blog_id="<?php echo $site->blog_id ?>"
                                            data-post_id="<?php echo $post->ID ?>">
                                        <span class="spinner-grow spinner-grow-sm d-none" role="status" aria-hidden="true"></span>
                                        Delete link
                                    </button>
                                </form>
                            </li>
                            <?php endforeach; ?>
                            <!-- /.mas-plugin-website__post-link-anchor -->
                        </ul>
                    </li>

                    <!-- /.mas-plugin-website__post--no-links -->
                        <?php endif;
                    endforeach; ?>
                    <!-- /.mas-plugin-website__post -->
                </ul>
                <!-- /.mas-plugin-website__posts -->

            </li>
            <?php endforeach;
            wp_reset_postdata();
            restore_current_blog();
            ?>

        </ul>
        <!-- /.mas-plugin-websites -->




    </div>
    <div class="mas-plugin-footer"> Copyright 2021</div>
</div>
<!-- /.mas-plugin-wrapper -->
<!-- This file should primarily consist of HTML with a little bit of PHP. -->
