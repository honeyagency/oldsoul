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

function prepareGlobalCafeFields($id)
{
    $cafe = array(
        'phone'    => get_field('field_5a4d3b56fe634', $id),
        'hours'    => get_field('field_5a4d3b74fe635', $id),
        'address'  => get_field('field_5a4d3b7efe636', $id),
        'email'    => get_field('field_5a540c28d632e', $id),
        'facebook' => get_field('field_5b05ee7731f4c', $id),
        'online'   => get_field('field_5cf6eececb37c', $id),
    );
    return $cafe;
}
function prepareCafeFields($id)
{
    $detailImageId = get_field('field_5a540d6554d78');
    if ($detailImageId != null) {
        $detailImage = new TimberImage($detailImageId);
    } else {
        $detailImage = null;
    }

    $buildingImageId = get_field('field_5a540d7954d79');
    if ($buildingImageId != null) {
        $buildingImage = new TimberImage($buildingImageId);
    } else {
        $buildingImage = null;
    }

    if (have_rows('field_5a540e5f365b2')) {
        $events = array();
        while (have_rows('field_5a540e5f365b2')) {
            the_row();

            $eventExpireDate = get_sub_field('field_5aecdaea3d196');
            $date_now        = date("Ymd");

            if ($date_now > $eventExpireDate) {
            } else {
                $eventImageId = get_sub_field('field_5a540e6b365b3');
                if ($eventImageId != null) {
                    $eventImage = new TimberImage($eventImageId);
                } else {
                    $eventImage = null;
                }
                $dateFormat = get_sub_field('field_5a540efb365b5');
                if ($dateFormat == 'date') {
                    $date = get_sub_field('field_5a540fc3365b6');
                } else {
                    $date = get_sub_field('field_5a540fdc365b7');
                }
                $time = array(
                    'start' => get_sub_field('field_5a540ff0365b8'),
                    'end'   => get_sub_field('field_5a5521c88e8eb'),
                );
                $events[] = array(
                    'image'       => $eventImage,
                    'expire'      => get_sub_field('field_5aecdaea3d196'),
                    'title'       => get_sub_field('field_5a540eed365b4'),
                    'format'      => $dateFormat,
                    'date'        => $date,
                    'time'        => $time,
                    'link'        => get_sub_field('field_5a541008365b9'),
                    'descirption' => get_sub_field('field_5b05e7ee20985'),
                );
            }
        }
    }
    $images = array(
        'detail'   => $detailImage,
        'building' => $buildingImage,
    );

    $cafe = array(
        'info'   => prepareGlobalCafeFields($id),
        'images' => $images,
        'events' => $events,
        'map'    => get_field('field_5a55424fcf199'),
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
    $search = array(
        'form' => get_search_form(false),
    );
    $featuredPostId = get_field('field_5afb2271440ed', 'options');
    if (!empty($featuredPostId)) {
        $featuredPost = getSinglePost('product', $featuredPostId);
    }
    $shop = array(
        'title'    => get_field('field_5a4e7e1eebbb1', 'options'),
        'link'     => get_field('field_5a4e7e2bebbb2', 'options'),
        'featured' => $featuredPost,
        'header'   => get_field('field_5bf604ef67d35', 'options'),
    );

    if (have_rows('field_5bbe8cf3acf9f', 'options')) {
        $bottom = array();
        while (have_rows('field_5bbe8cf3acf9f', 'options')) {
            the_row();

            $bottom[] = get_sub_field('field_5bbe8d13acfa0', 'options');
        }
    }
    $defaultImageId = get_field('field_5a4e7eaf9fa5b', 'options');
    if ($defaultImageId != null) {
        $defaultImage = new TimberImage($defaultImageId);
    } else {
        $defaultImage = null;
    }
    $misc = array(
        'pre01'                  => get_field('field_5a4e7e769fa58', 'options'),
        'pre02'                  => get_field('field_5a4e7e889fa59', 'options'),
        'error_page_content_404' => get_field('field_5a4e7e999fa5a', 'options'),
        'default_site_image'     => $defaultImage,
    );

    $options = array(
        'email'   => $email,
        'contact' => $contact,
        'shop'    => $shop,
        'search'  => $search,
        'footer'  => $bottom,
        'misc'    => $misc,
    );

    return $options;
}
function prepareProductFields($id = null)
{
    if ($id == null) {
        $id = get_the_ID();
    }
    $reviewImageId = get_field('field_5afb18be24c30', $id);
    if (!empty($reviewImageId)) {
        $reviewImage = new TimberImage($reviewImageId);
    } else {
        $reviewImage = null;
    }
    $featImgId = get_field('field_5afb1b010b1fb', $id);
    if (!empty($featImgId)) {
        $featImg = new TimberImage($featImgId);
    } else {
        $featImg = null;
    }
    $feature = array(
        'type'        => get_field('field_5a57ebfdf9f5c', $id),
        'title'       => get_field('field_5afb189024c2d', $id),
        'subtitle'    => get_field('field_5afb18ae24c2f', $id),
        'reviewimage' => $reviewImage,
        'featimg'     => $featImg,
        'link'        => get_field('field_5afb18ce24c31', $id),
    );

    $details = array(
        'subtitle' => get_field('field_5bd255e27f2e2', $id),
        'process'  => get_field('field_5a67a57d683ae'),
        'altitude' => get_field('field_5a67a95b683af'),
        'varietal' => get_field('field_5a67a974683b0'),
        'flavors'  => get_field('field_5a8e028dca29a'),
        'producer' => get_field('field_5a67a99f683b1'),
        'roast'    => get_field('field_5afb636045138'),
    );
    $product = array(
        'feature' => $feature,
        'details' => $details,
    );
    return $product;
}
function prepareBasePageFields()
{
    $header = array(
        'title'    => get_field('field_5a4ec16d65fdf'),
        'subtitle' => get_field('field_5bfc94f1fa397'),
    );
    $base = array(
        'header' => $header,
    );
    return $base;
}
function prepareAboutPagePartners()
{
    if (have_rows('field_5a68c95b0295e')) {
        $grid = array();
        while (have_rows('field_5a68c95b0295e')) {
            the_row();
            $partnerImageId = get_sub_field('field_5a68c96f0295f');

            if ($partnerImageId != null) {
                $partnerImage = new TimberImage($partnerImageId);
            } else {
                $partnerImage = null;
            }
            $grid[] = array(
                'image' => $partnerImage,
                'name'  => get_sub_field('field_5a68c98802960'),
            );
        }
    }

    $partners = array(
        'title' => get_field('field_5a627cb9f3f38'),
        'grid'  => $grid,
    );

    return $partners;
}
function prepareContentFields()
{
    if (have_rows('field_5a6b8ac104c9f')) {
        $pageContentSection = array();

        while (have_rows('field_5a6b8ac104c9f')) {
            the_row();
            $sidebarType = get_sub_field('field_5a6b8aea04ca2');
            $sidebar     = null;
            if ($sidebarType == 'image') {
                $sidebarImageId = get_sub_field('field_5a6b8b0d04ca3');
                if ($sidebarImageId != null) {
                    $sidebarImage = new TimberImage($sidebarImageId);
                } else {
                    $sidebarImage = null;
                }
                $sidebar = array(
                    'image'   => $sidebarImage,
                    'caption' => get_sub_field('field_5a6b8b1b04ca4'),
                );
            }
            if ($sidebarType == 'content') {
                if (have_rows('field_5a6b8b3204ca5')) {
                    $sidebarContent = array();
                    while (have_rows('field_5a6b8b3204ca5')) {
                        the_row();
                        $sidebarContent[] = array(
                            'title'   => get_sub_field('field_5a6b8b3d04ca6'),
                            'content' => get_sub_field('field_5a6b8b5804ca7'),
                        );
                    }
                    $sidebar = $sidebarContent;
                }
            }

            $pageContentSection[] = array(
                'title'       => get_sub_field('field_5a6b8acc04ca0'),
                'content'     => get_sub_field('field_5a6b8ad504ca1'),
                'sidebartype' => $sidebarType,
                'sidebar'     => $sidebar,
            );
        }
    }

    return $pageContentSection;
}

function prepareEventFields($id)
{

    $event = array(
        'start'       => get_field('field_5cd232b968b50', $id),
        'description' => get_field('field_5cd5fd0e4e6ab', $id),
        'time'        => get_field('field_5cd5fd9c0d568', $id),
        'product'     => get_field('field_5cd2335268b52', $id),
        'cafe'        => get_field('field_5cd5ff3213d36', $id),
    );

    return $event;
}
