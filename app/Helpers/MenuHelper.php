<?php

function maticpressMenu(){
    return array(
        array(
            'title' => 'Dashboard',
            'icon'  => 'bi bi-grid-fill',
            'url'   => route('dashboard'),
            'routes' => ['dashboard']
        ),
        array(
            'title' => 'Website Manager',
            'icon'  => 'bi bi-stack',
            'url'   => '#',
            'routes'    => ['groups.index', 'websites.index', 'websites.show', 'websites.settings.websecurity', 'websites.settings.dboptimization', 'websites.settings.seo', 'wordpress.posts', 'wordpress.posts.lists', 'wordpress.comments', 'wordpress.comments.lists'],
            'submenus'  => array(
                array(
                    'title' => 'Wordpress Websites',
                    'icon'  => '',
                    'url'   => Route('websites.index'),
                    'routes' => ['websites.index', 'websites.show', 'websites.settings.websecurity', 'websites.settings.dboptimization', 'websites.settings.seo']
                ),
                array(
                    'title' => 'Wordpress Users',
                    'icon'  => '',
                    'url'   => Route('wordpress.users'),
                    'routes' => ['wordpress.users', 'wordpress.users.lists']
                ),
                array(
                    'title' => 'Wordpress Posts',
                    'icon'  => '',
                    'url'   => Route('wordpress.posts'),
                    'routes' => ['wordpress.posts', 'wordpress.posts.lists']
                ),
                array(
                    'title' => 'Wordpress Comments',
                    'icon'  => '',
                    'url'   => Route('wordpress.comments'),
                    'routes' => ['wordpress.comments', 'wordpress.comments.lists']
                ),
                array(
                    'title' => 'Groups',
                    'icon'  => '',
                    'url'   => Route('groups.index'),
                    'routes' => ['groups.index']
                ),
            )
        )
    );
}

?>