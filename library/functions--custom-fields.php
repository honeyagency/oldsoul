<?php

function prepareHomepageFields()
{

    $leftImageId = get_field('field_5a4d2bf42917c');

    $rightImageId = get_field('field_5a4d2c632917d');

    if (!empty($leftImageId)) {

        $leftImage = new TimberImage($leftImageId);

    } else {
        $leftImage = null;
    }

    if (!empty($rightImageId)) {

        $rightImage = new TimberImage($rightImageId);

    } else {
        $rightImage = null;
    }

    $header = array(
        'leftimage'  => $leftImage,
        'rightimage' => $rightImage,
        'title'      => get_field('field_5a4d2485130a5'),
        'link'       => get_field('field_5a4d248e130a6'),
    );
    $about = array(
        'title' => get_field('field_5a4d24aa7e192'),
        'link'  => get_field('field_5a4d24b17e193'),
    );
    $home = array(
        'header' => $header,
        'about'  => $about,
    );
    return $home;

}

function prepareGlobalCafeFields()
{

    $cafe = array(
        'phone'   => get_field('field_5a4d3b56fe634'),
        'hours'   => get_field('field_5a4d3b74fe635'),
        'address' => get_field('field_5a4d3b7efe636'),
    );
    return $cafe;
}

function prepareGlobalPreFooter()
{
    $layout = get_field('field_5a4d256efce93');
    if ($layout == 'bg-img') {
        $bgImgId = get_field('field_5a4d25befce94');
        if (!empty($bgImgId)) {
            $bgImg = new TimberImage($bgImgId);
        } else {
            $bgImg = null;
        }

        $footer = array(
            'layout' => $layout,
            'image'  => $bgImg,
            'title'  => get_field('field_5a4d2660fce95'),
            'link'   => get_field('field_5a4d269afce96'),
        );

    } elseif ($layout == 'testimonial') {
        $footer = array(
            'layout'      => $layout,
            'testimonial' => get_field('field_5a4d26aafce97'),
            'author'      => get_field('field_5a4d26b8fce98'),
        );

    } else {
        $footer = 'blank';
    }
    return $footer;

}
function prepareSiteOptions()
{

    $email = array(
        'title' => get_field('field_5a4e7c9c26722', 'options'),
        'form'  => get_field('field_5a4e7cb826723', 'options'),
    );

    $contact = array(
        'title'     => get_field('field_5a4e7dadebba9', 'options'),
        'facebook'  => get_field('field_5a4e7dc6ebbab', 'options'),
        'twitter'   => get_field('field_5a4e7dd0ebbac', 'options'),
        'instagram' => get_field('field_5a4e7dd7ebbad', 'options'),
        'phone'     => get_field('field_5a4e7dbdebbaa', 'options'),
        'email'     => get_field('field_5a4e7de4ebbae', 'options'),
    );

    $shop = array(
        'title' => get_field('field_5a4e7e1eebbb1', 'options'),
        'link'  => get_field('field_5a4e7e2bebbb2', 'options'),
    );
    $subfooter = array(
        'privacy' => get_field('field_5a4e81c8daa78', 'options'),
        'press'   => get_field('field_5a4e81de20899', 'options'),
    );

    $defaultImageId = get_field('field_5a4e7eaf9fa5b', 'options');
    if ($defaultImageId != null) {
        $defaultImage = new TimberImage($defaultImageId);
    } else {
        $defaultImage = null;
    }
    $misc = array(
        'pre01'      => get_field('field_5a4e7e769fa58', 'options'),
        'pre02'      => get_field('field_5a4e7e889fa59', 'options'),
        'error_page_content_404' => get_field('field_5a4e7e999fa5a', 'options'),
        'default_site_image'     => $defaultImage,
    );

    $options = array(
        'email'   => $email,
        'contact' => $contact,
        'shop'    => $shop,
        'footer'  => $subfooter,
        'misc'    => $misc,
    );

    return $options;

}
