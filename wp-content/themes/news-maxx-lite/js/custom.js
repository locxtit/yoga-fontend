/*
 * Custom js (for karo theme)
 * http://kopatheme.com
 * Copyright (c) 2014 Kopatheme
 *
 * Licensed under the GPL license:
 *  http://www.gnu.org/licenses/gpl.html
 */
/**
 *   1- Main menu
 *   2- Mobile menu
 *   3- Video wrapper
 *   4- Masonry
 *   5- Owl Carousel
 *   6- Validate form
 *   7- Breadking News
 *   8- Flickr
 *   9- Toggle Boxes
 *   10- Accordion
 *   11- Dynamic Progress Bar
 *   12- Boostrap slider
 *   13 - Seach
 *   14 - match height
 *-----------------------------------------------------------------
 **/
 
"use strict";
var kopa_variable = {
    "contact": {
        "address": "Lorem ipsum dolor sit amet, consectetur adipiscing elit",
        "marker": "/url image"
    },
    "i18n": {
        "VIEW": "View",
        "VIEWS": "Views",
        "validate": {
            "form": {
                "SUBMIT": "Submit",
                "SENDING": "Sending..."
            },
            "name": {
                "REQUIRED": "Please enter your name",
                "MINLENGTH": "At least {0} characters required"
            },
            "email": {
                "REQUIRED": "Please enter your email",
                "EMAIL": "Please enter a valid email"
            },
            "url": {
                "REQUIRED": "Please enter your url",
                "URL": "Please enter a valid url"
            },
            "message": {
                "REQUIRED": "Please enter a message",
                "MINLENGTH": "At least {0} characters required"
            },
            "comment": {
                "REQUIRED": "Please enter your comment",
                "MINLENGTH": "At least {0} characters required"
            }
        },
        "tweets": {
            "failed": "Sorry, twitter is currently unavailable for this user.",
            "loading": "Loading tweets..."
        }
    },
    "url": {
        "template_directory_uri":news_maxx_lite_custom_front_localization.url.template_directory_uri
    }
};

/* =========================================================
1. Main Menu
============================================================ */

Modernizr.load([
  {
    load: kopa_variable.url.template_directory_uri + '/js/superfish.js',
    complete: function () {

        //Main menu
        jQuery('.main-menu').superfish({
          cssArrows: true
        });

    }
  }
]);

Modernizr.load([
  {
    load: kopa_variable.url.template_directory_uri + '/js/superfish.js',
    complete: function () {

        //Main menu
        jQuery('.secondary-menu').superfish({
          cssArrows: false
        });

    }
  }
]);


/* =========================================================
2. Mobile Menu
============================================================ */
Modernizr.load([
  {
    load: kopa_variable.url.template_directory_uri + '/js/jquery.navgoco.js',
    complete: function () {

        jQuery('#mobile-menu').navgoco({accordion: true});
        jQuery( ".main-nav i" ).click(function(){
            jQuery( "#mobile-menu" ).slideToggle( "slow" );
        });
    }
  }
]);


Modernizr.load([
  {
    load: kopa_variable.url.template_directory_uri + '/js/jquery.navgoco.js',
    complete: function () {

        jQuery('#secondary-mobile-menu').navgoco({accordion: true});
        jQuery( ".secondary-nav span" ).click(function(){
            jQuery( "#secondary-mobile-menu" ).slideToggle( "slow" );
        });
    }
  }
]);


Modernizr.load([
  {
    load: kopa_variable.url.template_directory_uri + '/js/jquery.navgoco.js',
    complete: function () {

        jQuery('#bottom-mobile-menu').navgoco({accordion: true});
        jQuery( "#bottom-nav i" ).click(function(){
            jQuery( "#bottom-mobile-menu" ).slideToggle( "slow" );
        });
    }
  }
]);

/* =========================================================
3. Video wrapper
============================================================ */
if (jQuery(".video-wrapper").length > 0) {
	Modernizr.load([{
		load: kopa_variable.url.template_directory_uri + '/js/fitvids.js',
		complete: function () {
			jQuery(".video-wrapper").fitVids();
		}
	}]);
};

/* =========================================================
4. Masonry
============================================================ */

if (jQuery('.masonry-list').length > 0) {

    jQuery('.masonry-list').each(function(){
        var $this = jQuery(this);
        var kopa_container = $this.data('id');
        var kopa_current_page = $this.data('currentpage');
        var kopa_show_per_page = $this.data('showperpage');
        var kopa_page_navigation = $this.data('pagenavigation');
        // number items per page
        var show_per_page = 4;
        //total items
        var number_of_items = $this.children().size();
        //total pages
        var number_of_pages = Math.ceil(number_of_items/show_per_page);

        //store current page and show per page in hidden input
        jQuery(kopa_current_page).val(0);
        jQuery(kopa_show_per_page).val(show_per_page);
        var navigation_html = '<li><span class="prev page-numbers fa fa-angle-double-left" onclick="previous(\'' + kopa_current_page +'\',\'' + kopa_container + '\',\'' + kopa_show_per_page + '\',' + number_of_pages + ');"></span></li>';
        var current_link = 0;
        while(number_of_pages > current_link){
            navigation_html += '<li><span class="page-numbers page_link" onclick="go_to_page(' + current_link +',\'' + kopa_container + '\',\'' + kopa_show_per_page + '\', \'' + kopa_current_page + '\')" longdesc="' + current_link +'">'+ (current_link + 1) +'</span></li>';
            current_link++;
        }
        navigation_html += '<li><span onclick="next(\'' + kopa_current_page +'\',\'' + kopa_container + '\',\'' + kopa_show_per_page + '\', ' + number_of_pages + ');" class="next page-numbers fa fa-angle-double-right"></span></li>';

        jQuery(kopa_page_navigation).html(navigation_html);

        //add current class to the first item
        jQuery(kopa_page_navigation + ' .page_link:first').addClass('current');

        //hide all item in container
        $this.children().css('display', 'none');

        //show the first n (show_per_page) items
        $this.children().slice(0, show_per_page).css('display', 'block');
        if ( number_of_pages <= 1 ) {
            $this.parent().parent().find('.pagination').remove();
        }

        Modernizr.load([
            {
                load: [kopa_variable.url.template_directory_uri + '/js/masonry.pkgd.js', kopa_variable.url.template_directory_uri + '/js/imagesloaded.js'],
                complete: function () {
                    // initialize
                    imagesLoaded($this,function(){
                        $this.masonry({
                            columnWidth: 1,
                            itemSelector: '.masonry-item'
                        });
                        $this.masonry('bindResize')
                    });
                }
            }
        ]);

    });
};
function previous(current_page, obj, show_per_page, number_of_pages){
    var new_page = parseInt(jQuery(current_page).val()) - 1;
    if ( new_page >= 0 && new_page < number_of_pages){
        go_to_page(new_page, obj, show_per_page, current_page);
    }
}
function next(current_page, obj, show_per_page, number_of_pages){
    var new_page = parseInt(jQuery(current_page).val()) + 1;
    if ( new_page >= 0 && new_page < number_of_pages){
        go_to_page(new_page, obj, show_per_page, current_page);
    }
}
function go_to_page(page_num, obj, show_per_page, current_page){
    //get items per page
    var show_per_page = parseInt(jQuery(show_per_page).val());

    //get element number start
    var start_from = page_num * show_per_page;

    //get the element number end
    var end_on = start_from + show_per_page;

    //hide all item in container, get items in current page to show
    jQuery(obj).children().css('display', 'none').slice(start_from, end_on).css('display', 'block');

    /* add current class to current page */
    jQuery('.page_link').removeClass('current');
    jQuery('.page_link[longdesc=' + page_num +']').addClass('current');

    //update the current page
    jQuery(current_page).val(page_num);

    Modernizr.load([
        {
            load: [kopa_variable.url.template_directory_uri + '/js/masonry.pkgd.js', kopa_variable.url.template_directory_uri + '/js/imagesloaded.js'],
            complete: function () {
                var $container = jQuery(obj);
                // initialize
                imagesLoaded($container,function(){
                    $container.masonry({
                        columnWidth: 1,
                        itemSelector: '.masonry-item'
                    });
                    $container.masonry('bindResize')
                });
            }
        }
    ]);
}


if (jQuery('.entry-masonry-list').length > 0) {
Modernizr.load([
  {
    load: [kopa_variable.url.template_directory_uri + '/js/masonry.pkgd.js',kopa_variable.url.template_directory_uri + '/js/imagesloaded.js'],
    complete: function () {
      var $container = jQuery('.entry-masonry-list');
      // initialize
      
      imagesLoaded($container,function(){
        $container.masonry({
          columnWidth: 1,
          itemSelector: '.masonry-item'
        });
        $container.masonry('bindResize')
      });
    }
  }
]);
};

if (jQuery('.kopa-gallery-list').length > 0) {
  Modernizr.load([
    {
      load: [kopa_variable.url.template_directory_uri + '/js/masonry.pkgd.js',kopa_variable.url.template_directory_uri + '/js/imagesloaded.js', kopa_variable.url.template_directory_uri + '/js/filtermasonry.js'],
      complete: function () {
          jQuery('.kopa-gallery-list').each(function(){
              var $this = jQuery(this);
              var filter_id = $this.data('filter-id');
              $this.imagesLoaded(function(){
                  $this.multipleFilterMasonry({
                      itemSelector: '.gallery-item',
                      filtersGroupSelector:filter_id
                  });
                  jQuery('.options li label').click(function(){
                      jQuery('.options li label').removeClass('active');
                      jQuery(this).addClass('active');
                  });
              });
          });
      }
    }
  ]);
};

/* =========================================================
5. Owl Carousel
============================================================ */
if (jQuery('.kopa-home-slider').length > 0) {

    Modernizr.load([
      {
        load: kopa_variable.url.template_directory_uri + '/js/owl.carousel.js',
        complete: function () {
            jQuery('.kopa-home-slider').each( function(){
                var $this = jQuery(this);
                var data_autoPlay = $this.data('autoplay');
                var data_slideSpeed = $this.data('slidespeed');
                $this.owlCarousel({
                    items : 1,
                    itemsDesktop : [1120,1],
                    itemsDesktopSmall : [979,1],
                    itemsTablet : [799,1],
                    lazyLoad : true,
                    navigation : false,
                    pagination: true,
                    navigationText : false,
                    slideSpeed: data_slideSpeed,
                    autoPlay: data_autoPlay,
                    stopOnHover: true
                });
            } );

        }
      }
    ]);
};


if (jQuery('.kopa-home-slider-2').length > 0) {

    Modernizr.load([
      {
        load: kopa_variable.url.template_directory_uri + '/js/owl.carousel.js',
        complete: function () {
          var sync1 = jQuery(".sync1");
          var sync2 = jQuery(".sync2");
           
          sync1.owlCarousel({
            singleItem : true,
            slideSpeed : 1000,
            navigation: false,
            pagination:false,
            autoPlay: true,
            afterAction : syncPosition,
            responsiveRefreshRate : 200
          });
           
          sync2.owlCarousel({
            items : 15,
            itemsDesktop : [1199,10],
            itemsDesktopSmall : [979,10],
            itemsTablet : [768,8],
            itemsMobile : [479,4],
            pagination:false,
            responsiveRefreshRate : 100,
            afterInit : function(el){
              el.find(".owl-item").eq(0).addClass("synced");
            }
          });
           
          function syncPosition(el){
            var current = this.currentItem;
            jQuery(".sync2")
            .find(".owl-item")
            .removeClass("synced")
            .eq(current)
            .addClass("synced")
            if(jQuery(".sync2").data("owlCarousel") !== undefined){
              center(current)
            }
          }
           
          jQuery(".sync2").on("click", ".owl-item", function(e){
            e.preventDefault();
            var number = jQuery(this).data("owlItem");
            sync1.trigger("owl.goTo",number);
          });
           
          function center(number){
            var sync2visible = sync2.data("owlCarousel").owl.visibleItems;
            var num = number;
            var found = false;
            for(var i in sync2visible){
            if(num === sync2visible[i]){
              var found = true;
            }
          } 
        }
      }
    }
  ]);
};


if (jQuery('.kopa-home-slider-3').length > 0) {

    Modernizr.load([
      {
        load: kopa_variable.url.template_directory_uri + '/js/owl.carousel.js',
        complete: function () {
            jQuery('.kopa-home-slider-3').owlCarousel({
                items : 5,
                itemsTablet : [799,3],
                itemsMobile : [479,2],
                lazyLoad : true,
                navigation : false,
                pagination: false,
                autoPlay: true,
                stopOnHover: true,
                navigationText : false
            });
        }
      }
    ]);
};

if (jQuery('.kopa-nothumb-carousel').length > 0) {

    Modernizr.load([
      {
        load: kopa_variable.url.template_directory_uri + '/js/owl.carousel.js',
        complete: function () {
            jQuery('.kopa-nothumb-carousel').owlCarousel({
                items : 3,
                itemsDesktop : [1120,2],
                itemsDesktopSmall : [979,2],
                itemsMobile : [767,1],
                lazyLoad : true,
                navigation : true,
                pagination: false,
                navigationText : false
            });
        }
      }
    ]);
};

if (jQuery('.kopa-owl-carousel-1').length > 0) {
    Modernizr.load([
      {
        load: kopa_variable.url.template_directory_uri + '/js/owl.carousel.js',
        complete: function () {
            jQuery('.kopa-owl-carousel-1').each( function(){
                var $this = jQuery(this);
                var data_autoPlay = $this.data('autoplay');
                var data_slideSpeed = $this.data('slidespeed');
                $this.owlCarousel({
                    items : 1,
                    itemsDesktop : [1120,1],
                    itemsDesktopSmall : [979,1],
                    itemsTablet : [799,1],
                    lazyLoad : true,
                    navigation : false,
                    pagination: true,
                    navigationText : false,
                    slideSpeed: data_slideSpeed,
                    autoPlay: data_autoPlay,
                    stopOnHover: true
                });
            } );
        }
      }
    ]);
};


if (jQuery('.kopa-gallery-slider').length > 0) {

    Modernizr.load([
      {
        load: kopa_variable.url.template_directory_uri + '/js/owl.carousel.js',
        complete: function () {
          var sync3 = jQuery(".sync3");
          var sync4 = jQuery(".sync4");
           
          sync3.owlCarousel({
            singleItem : true,
            slideSpeed : 1000,
            navigation: true,
            pagination:false,
            navigationText : false,
            afterAction : syncPosition,
            responsiveRefreshRate : 200,
          });
           
          sync4.owlCarousel({
            items : 5,
            itemsDesktop : [1120,3],
            itemsDesktopSmall : [979,3],
            itemsTablet : [799,4],
            itemsMobile : [639,3],
            pagination:false,
            responsiveRefreshRate : 100,
            afterInit : function(el){
              el.find(".owl-item").eq(0).addClass("synced");
            }
          });
           
          function syncPosition(el){
            var current = this.currentItem;
              jQuery(".sync4")
            .find(".owl-item")
            .removeClass("synced")
            .eq(current)
            .addClass("synced")
            if(jQuery(".sync4").data("owlCarousel") !== undefined){
              center(current)
            }
          }

            jQuery(".sync4").on("click", ".owl-item", function(e){
            e.preventDefault();
            var number = jQuery(this).data("owlItem");
            sync3.trigger("owl.goTo",number);
          });
           
          function center(number){
            var sync4visible = sync4.data("owlCarousel").owl.visibleItems;
            var num = number;
            var found = false;
            for(var i in sync4visible){
            if(num === sync4visible[i]){
              var found = true;
            }
          } 
        }
      }
    }
  ]);
};


if (jQuery('.kopa-related-post-carousel').length > 0) {

    Modernizr.load([
      {
        load: kopa_variable.url.template_directory_uri + '/js/owl.carousel.js',
        complete: function () {
            jQuery('.kopa-related-post-carousel').owlCarousel({
                items : 1,
                itemsDesktop : [1120,1],
                itemsDesktopSmall : [979,1],
                itemsTablet : [799,1],
                lazyLoad : true,
                navigation : true,
                pagination: false,
                navigationText : false
            });
        }
      }
    ]);
};


if (jQuery('.related-product-carousel').length > 0) {

    Modernizr.load([
      {
        load: kopa_variable.url.template_directory_uri + '/js/owl.carousel.js',
        complete: function () {
            jQuery('.related-product-carousel').owlCarousel({
                items : 4,
                itemsDesktop : [1120,3],
                itemsDesktopSmall : [979,2],
                lazyLoad : true,
                navigation : true,
                pagination: false,
                navigationText : false
            });
        }
      }
    ]);
};


if (jQuery('.single-post-carousel').length > 0) {

    Modernizr.load([
      {
        load: kopa_variable.url.template_directory_uri + '/js/owl.carousel.js',
        complete: function () {
            jQuery('.single-post-carousel').owlCarousel({
                items : 1,
                itemsDesktop : [1120,1],
                lazyLoad : true,
                navigation : true,
                pagination: false,
                navigationText : false
            });
        }
      }
    ]);
};

/* =========================================================
7. Breadking News
============================================================ */

if (jQuery('.ticker-1').length > 0) {
	Modernizr.load([{
		load: kopa_variable.url.template_directory_uri + '/js/jquery.carouFredSel-6.2.1.js',
		complete: function () {
            jQuery('.ticker-1').each(function(){
                var $this = jQuery(this);
                var speed = $this.data('speed');
                var _scroll = {
                    delay: 1000,
                    easing: 'linear',
                    items: 1,
                    duration: speed,
                    timeoutDuration: 0,
                    pauseOnHover: 'immediate'
                };
                $this.carouFredSel({
                    width: 1046,
                    align: false,
                    items: {
                        width: 'variable',
                        height: 39,
                        visible: 1
                    },
                    scroll: _scroll
                });
            });
		}
	}]);
}

/* =========================================================
9. Toggle Boxes
============================================================ */
jQuery(document).ready(function () {
     
  jQuery('.toggle-view li').click(function (event) {
      
      var text = jQuery(this).children('.kopa-panel');

      if (text.is(':hidden')) {
          jQuery(this).addClass('active');
          text.slideDown('300');
          jQuery(this).children('span').removeClass('fa-plus-square-o');
          jQuery(this).children('span').addClass('fa-minus-square-o');                 
      } else {
          jQuery(this).removeClass('active');
          text.slideUp('300');
          jQuery(this).children('span').removeClass('fa-minus-square-o');
          jQuery(this).children('span').addClass('fa-plus-square-o');               
      }
       
  });
 
});


/* =========================================================
10. Accordion
========================================================= */
jQuery(document).ready(function() {
    var acc_wrapper=jQuery('.acc-wrapper');
    if (acc_wrapper.length >0) 
    {
        
        jQuery('.acc-wrapper .accordion-container').hide();
        jQuery.each(acc_wrapper, function(index, item){
            jQuery(this).find(jQuery('.accordion-title')).first().addClass('active').next().show();
            
        });
        
        jQuery('.accordion-title').on('click', function(e) {
            kopa_accordion_click(jQuery(this));
            e.preventDefault();
        });
        
        var titles = jQuery('.accordion-title');
        
        jQuery.each(titles,function(){
            kopa_accordion_click(jQuery(this));
        });
    }        
});

function kopa_accordion_click (obj) {
    if( obj.next().is(':hidden') ) {
        obj.parent().find(jQuery('.active')).removeClass('active').next().slideUp(300);
        obj.toggleClass('active').next().slideDown(300);
                            
    }
jQuery('.accordion-title span').addClass('fa-plus-square-o');
    if (obj.hasClass('active')) {
        obj.find('span').removeClass('fa-plus-square-o');
        obj.find('span').addClass('fa-minus-square-o');              
    } 
}


/* =========================================================
11. Dynamic Progress Bar
============================================================ */
jQuery(window).load(function(){    
  jQuery('.progress-bar').css('width',  function(){ return (jQuery(this).attr('data-percentage')+'%')});
});

/* 13 - Seach */
jQuery(document).ready(function() {
    jQuery('body').click(function(e){
        var target = jQuery(e.target);
        //sb-search-submit
        if(target.is('.sb-icon-search') || target.is('.sb-search-submit')){
            jQuery('#sb-search').addClass('sb-search-open');
        }else{
            if (target.is('.sb-search-input')){

            }else{
                if(jQuery('#sb-search').hasClass('sb-search-open')){
                    jQuery('#sb-search').removeClass('sb-search-open');
                }
            }
        }
    });

    /* 14 - match height */
    if (jQuery('.kopa-article-list-2-widget ul>li').length > 0) {
        jQuery('.kopa-article-list-2-widget ul>li>article.entry-item').matchHeight();
        jQuery('.kopa-article-list-2-widget ul>li>article.entry-item .entry-content p').matchHeight();
    }
    //latest product
    if (jQuery('.kopa-product-list-widget > ul > li').length > 0) {
        jQuery('.kopa-product-list-widget > ul > li').matchHeight();
    }

    //shops
    if (jQuery('.woocommerce-page .shop_columns_3 ul.products li.product').length > 0) {
        jQuery('.woocommerce-page .shop_columns_3 ul.products li.product').matchHeight();
    }
});
