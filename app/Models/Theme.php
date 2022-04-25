<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;

    public function layout() {
    	return $this->hasMany(ThemeFile::class)->where('title', 'theme.twig');
    }

    public function images() {
    	return $this->hasMany(ThemeImage::class);
    }

    public function store()  {
    	return $this->hasOne(Store::class);
    }

    public function files() {
    	return $this->hasMany(ThemeFile::class)->where('title', 'theme.twig');
    }


    public function themeContent() {
        $body_content = $this->sections();
        $html = '';
        $wrappers = $body_content['wrappers'];
        if(is_array($wrappers)) {
            foreach($wrappers as $wrapper) {
                $html .= '<'.$wrapper['node'];
                if($wrapper['id']) $html .= ' id='.$wrapper['id'];
                if($wrapper['class']) $html .= ' class='.$wrapper['class'];
                $html .= '>';
            }
        }else{
            $html .= $wrappers ? '<'.$section['wrappers'].'>' : '<main>';
        }

        foreach($body_content['sections'] as $section) {
            $section_wrappers = $section['wrappers'];
            if(is_array($section_wrappers)) {
            foreach($section_wrappers as $wrapper) {
                $html .= '<'.$wrapper['node'];
                if($wrapper['id']) $html .= ' id='.$wrapper['id'];
                if($wrapper['class']) $html .= ' class='.$wrapper['class'];
                $html .= '>';
            }
            }else{
                $html .= $wrappers ? '<'.$section['wrappers'].'>' : '<div>';
            }

            foreach ($section['blocks'] as $key => $block) {
                $html .= $block['content'];
            }

            if(is_array($section_wrappers)) {
            foreach($section_wrappers as $wrapper) {
                $html .= '</'.$wrapper['node'];
                $html .= '>';
            }
            }else{
                $html .= $wrappers ? '</'.$section['wrappers'].'>' : '</div>';
            }
        }

        if(is_array($wrappers)) {
            foreach($wrappers as $wrapper) {
                $html .= '</'.$wrapper['node'];
                $html .= '>';
            }
        }else{
            $html .= $wrappers ? '</'.$section['wrappers'].'>' : '</main>';
        }

    }

    public function sections() {
        //if is_editable, look through all p tags and make it editable
        //make all img tag
        //in real time, generate a json object with all the editable sections, img and text
        $main_body_content = [
            'wrappers'=>[
                ['node'=>'main', 'id'=>'', 'class'=>'']
            ],
            'class'=>'',
            'id'=>'',
            'sections'=> [
                1=>[
                    'sort_order'=>1,
                    'wrappers'=>[
                        ['node'=>'div', 'class'=>'', 'id'=>'']
                    ],
                    'is_slide_show'=>1,
                    'blocks'=>[
                        [
                            'content' => '<div class="content-slider relative">
                                        <div class="img-slider img-zoom-container">
                                            <a href="#" class="inline-block relative">
                                                <img src="[[ image ]]" class="img-responsive" id="myimage1" alt="">
                                                <div id="myresult1" class="img-zoom-result"></div>
                                            </a>

                                        </div>
                                        <div class="absolute text-slider">
                                            <h1 class="title-font title-slider delay2">Kombiniertes<br>oversize- shirt</h1>
                                            <p class="des-font des-slider delay1_5">BlackBird collection of minimal, sleek and<br>functional Carryalls were designedwith<br>creatives in mind.</p>
                                            <div class="flex delay03 social-home3">
                                                    <a href="#" class="delay03 space_right_20"><i class="ti-facebook"></i></a>
                                                    <a href="#" class="delay03 container_20"><i class="ti-twitter-alt"></i></a>
                                                    <a href="#" class="delay03 container_20"><i class="ti-pinterest"></i></a>
                                                    <a href="#" class="delay03 container_20"><i class="ti-linkedin"></i></a>
                                            </div>
                                        </div>
                                        <div class="absolute seasion">
                                            <p class="number-font delay2">Summner 2018</p>
                                        </div>
                                    </div>'
                                ]
                        ]

                ],
                2=>[
                    'sort_order'=>2,
                    'wrappers'=>[
                        ['node'=>'div', 'id'=>'', 'class'=>'collection-home4 container margin_bottom_150 margin_top_120'],
                        ['node'=>'div', 'id'=>'', 'class'=>'row'],
                    ],
                    'blocks'=>[
                        ['content' => '<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 clear-space">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 product relative margin_bottom_20">

                                        <div class="img-product relative">
                                            <a href="#"><img src="asset/img/product_collection_home4_1.jpg" class="img-responsive" alt=""></a>
                                            <figure class="absolute uppercase label-new title-font text-center">new</figure>
                                            <div class="product-icon text-center absolute">
                                                <form method="post" action="/cart/add" enctype="multipart/form-data" class="inline-block icon-addcart">
                                                      <input type="hidden" name="id" value="" />
                                                      <button type="submit" name="add" class="enj-add-to-cart-btn btn-default"><i class="ti-bag"></i></button>
                                                </form>
                                                <a href="#" class="icon-heart inline-block"><i class="ti-heart"></i></a>
                                                <a href="#" class="engoj_btn_quickview icon-quickview inline-block" title="quickview">
                                                      <i class="ti-more-alt"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="info-product text-center absolute full-width delay03 hidden-sm hidden-xs">
                                            <h4 class="des-font capital title-product space_top_20"><a href="#">embossed backpack in brown</a></h4>
                                            <p class="number-font price-product"><span class="price">$123.00</span></p>
                                        </div>

                                        </div>
                                        <!--  -->
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 product relative margin_bottom_20">

                                            <div class="img-product relative">
                                                <a href="#"><img src="asset/img/product_collection_home4_2.jpg" class="img-responsive" alt=""></a>
                                                <figure class="absolute uppercase label-sale title-font text-center">sale</figure>
                                                <div class="product-icon text-center absolute">
                                                    <form method="post" action="/cart/add" enctype="multipart/form-data" class="inline-block icon-addcart">
                                                      <input type="hidden" name="id" value="" />
                                                      <button type="submit" name="add" class="enj-add-to-cart-btn btn-default"><i class="ti-bag"></i></button>
                                                    </form>
                                                    <a href="#" class="icon-heart inline-block"><i class="ti-heart"></i></a>
                                                    <a href="#" class="engoj_btn_quickview icon-quickview inline-block" title="quickview">
                                                      <i class="ti-more-alt"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="info-product text-center absolute full-width delay03 hidden-sm hidden-xs">
                                                <h4 class="des-font capital title-product space_top_20"><a href="#">embossed backpack in brown</a></h4>
                                                <p class="number-font price-product"><span class="price">$123.00</span></p>
                                            </div>

                                        </div>
                                        <!--  -->
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 product relative margin_bottom_20">

                                            <div class="img-product relative">
                                                <a href="#"><img src="asset/img/product_collection_home4_3.jpg" class="img-responsive" alt=""></a>
                                                <figure class="absolute uppercase label-new title-font text-center">new</figure>
                                                <div class="product-icon text-center absolute">
                                                    <form method="post" action="/cart/add" enctype="multipart/form-data" class="inline-block icon-addcart">
                                                      <input type="hidden" name="id" value="" />
                                                      <button type="submit" name="add" class="enj-add-to-cart-btn btn-default"><i class="ti-bag"></i></button>
                                                    </form>
                                                    <a href="#" class="icon-heart inline-block"><i class="ti-heart"></i></a>
                                                    <a href="#" class="engoj_btn_quickview icon-quickview inline-block" title="quickview">
                                                      <i class="ti-more-alt"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="info-product text-center absolute full-width delay03 hidden-sm hidden-xs">
                                                <h4 class="des-font capital title-product space_top_20"><a href="#">embossed backpack in brown</a></h4>
                                                <p class="number-font price-product"><span class="price">$123.00</span></p>
                                            </div>

                                        </div>
                                        <!--  -->
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 product relative margin_bottom_20">

                                            <div class="img-product relative">
                                                <a href="#"><img src="asset/img/product_collection_home4_4.jpg" class="img-responsive" alt=""></a>
                                                <figure class="absolute uppercase label-sale title-font text-center">sale</figure>
                                                <div class="product-icon text-center absolute">
                                                    <form method="post" action="/cart/add" enctype="multipart/form-data" class="inline-block icon-addcart">
                                                      <input type="hidden" name="id" value="" />
                                                      <button type="submit" name="add" class="enj-add-to-cart-btn btn-default"><i class="ti-bag"></i></button>
                                                    </form>
                                                    <a href="#" class="icon-heart inline-block"><i class="ti-heart"></i></a>
                                                    <a href="#" class="engoj_btn_quickview icon-quickview inline-block" title="quickview">
                                                      <i class="ti-more-alt"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="info-product text-center absolute full-width delay03 hidden-sm hidden-xs">
                                                <h4 class="des-font capital title-product space_top_20"><a href="#">embossed backpack in brown</a></h4>
                                                <p class="number-font price-product"><span class="price">$123.00</span></p>
                                            </div>

                                        </div>
                                        <!--  -->
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 over-hidden relative banner_collection space_left_10">
                                        <a href="#"><img src="asset/img/banner_collection_home4_1.jpg" class="img-responsive hover-zoom-out" alt=""></a>
                                        <a href="#" class="title-font name_collection absolute">New collection 2018</a>
                                    </div>
                                </div>'
                            ]
                        ]
                ],
                3=>[
                    'sort_order'=>3,
                    'wrappers'=>[
                        ['node'=>'div', 'id'=>'', 'class'=>'container shipping-home4 margin_bottom_150'],
                        ['node'=>'div', 'id'=>'', 'class'=>'row'],
                    ],
                    'blocks'=>[
                        ['content'=>'<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 content">
                                    <div class="flex">
                                        <img src="asset/img/icon_ship.png" class="img-responsive" alt="">
                                        <span class="title-font title-ship space_left_30">Free shipping</span>
                                    </div>
                                    <p class="des-font des-ship">I did not even know that there were any better conditions to escape to, but I was more than willing to take my chances among people fashioned after.
                                    </p>
                                </div>',
                        'schema'=> [
                            ''
                            ]
                        ],
                        ['content'=>'<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 content">
                                    <div class="flex">
                                        <img src="asset/img/icon_ship.png" class="img-responsive" alt="">
                                        <span class="title-font title-ship space_left_30">Free shipping</span>
                                    </div>
                                    <p class="des-font des-ship">I did not even know that there were any better conditions to escape to, but I was more than willing to take my chances among people fashioned after.
                                    </p>
                                </div>',
                        'schema'=> [
                            ''
                            ]
                        ],
                        ['content'=>'<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 content">
                                    <div class="flex">
                                        <img src="asset/img/icon_ship.png" class="img-responsive" alt="">
                                        <span class="title-font title-ship space_left_30">Free shipping</span>
                                    </div>
                                    <p class="des-font des-ship">I did not even know that there were any better conditions to escape to, but I was more than willing to take my chances among people fashioned after.
                                    </p>
                                </div>',
                        'schema'=> [
                            ''
                            ]
                        ],

                        ]
                    ]
                ]

        ];

        return $main_body_content;
    }
}
