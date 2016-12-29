// =============================================================================
// JS/ADMIN/TINYMCE-LEGACY.JS
// -----------------------------------------------------------------------------
// v3.X TinyMCE specific functions.
// =============================================================================

(function() {
  tinymce.create('tinymce.plugins.xShortcodeMce', {

    init : function(ed, url){
      tinymce.plugins.xShortcodeMce.theurl = url;
    },

    createControl : function(btn, e) {
      if ( btn == 'x_shortcodes_button' ) {
        var a   = this;
        var btn = e.createSplitButton('x_button', {
          title: 'Insert Shortcode',
          image: tinymce.plugins.xShortcodeMce.theurl + '/x-shortcodes.png',
          icons: false,
        });

        btn.onRenderMenu.add(function (c, b) {


          //
          // Structure.
          //

          c = b.addMenu({title:'Structure'});

          a.render( c, 'Content Band', 'content-band' );
          a.render( c, 'Container', 'container' );
          a.render( c, 'Column', 'column' );
          a.render( c, 'Line', 'line' );
          a.render( c, 'Gap', 'gap' );
          a.render( c, 'Clear', 'clear' );


          //
          // Content.
          //

          c = b.addMenu({title:'Content'});

          a.render( c, 'Accordion', 'accordion' );
          a.render( c, 'Tabs', 'tabs' );
          a.render( c, 'Block Grid', 'block-grid' );
          a.render( c, 'Columnize', 'columnize' );
          a.render( c, 'Visibility', 'visibility' );
          a.render( c, 'Protect', 'protect' );


          //
          // Typography.
          //

          c = b.addMenu({title:'Typography'});

          a.render( c, 'Custom Headline', 'custom-headline' );
          a.render( c, 'Feature Headline', 'feature-headline' );
          a.render( c, 'Blockquote', 'blockquote' );
          a.render( c, 'Pullquote', 'pullquote' );
          a.render( c, 'Icon', 'icon' );
          a.render( c, 'Icon List', 'icon-list' );
          a.render( c, 'Social Icon', 'social-icon' );
          a.render( c, 'Highlight', 'highlight' );
          a.render( c, 'Dropcap', 'dropcap' );
          a.render( c, 'Code', 'code' );
          a.render( c, 'Responsive Text', 'responsive-text' );


          //
          // Marketing.
          //

          c = b.addMenu({title:'Marketing'});

          a.render( c, 'Button', 'button' );
          a.render( c, 'Callout', 'callout' );
          a.render( c, 'Promo', 'promo' );
          a.render( c, 'Prompt', 'prompt' );
          a.render( c, 'Pricing Table', 'pricing-table' );


          //
          // Information.
          //

          c = b.addMenu({title:'Information'});

          a.render( c, 'Info', 'info' );
          a.render( c, 'Alert', 'alert' );
          a.render( c, 'Skill Bar', 'skill-bar' );
          a.render( c, 'Table of Contents', 'table-of-contents' );


          //
          // Media.
          //

          c = b.addMenu({title:'Media'});

          a.render( c, 'Image', 'image' );
          a.render( c, 'Slider', 'slider' );
          a.render( c, 'Lightbox', 'lightbox' );
          a.render( c, 'Video Player', 'video-player' );
          a.render( c, 'Video Embed', 'video-embed' );
          a.render( c, 'Audio Player', 'audio-player' );
          a.render( c, 'Audio Embed', 'audio-embed' );
          a.render( c, 'Map', 'map' );


          //
          // Social.
          //

          c = b.addMenu({title:'Social'});

          a.render( c, 'Author', 'author' );
          a.render( c, 'Entry Share', 'entry-share' );
          a.render( c, 'Recent Posts', 'recent-posts' );
          a.render( c, 'Search', 'search' );

        });
        return btn;
      }
      return null;
    },

    render : function(ed, title, id) {
      ed.add({
        title: title,
        onclick: function () {


          //
          // Structure.
          //

          if(id === 'content-band') {
            tinyMCE.activeEditor.selection.setContent('[content_band inner_container="true" no_margin="true" border="none, top, left, right, bottom, vertical, horizontal, all" padding_top="40px" padding_bottom="40px" bg_pattern="" bg_image="" parallax="true" bg_video="" bg_video_poster=""] ... [/content_band]');
          }

          if(id === 'container') {
            tinyMCE.activeEditor.selection.setContent('[container] ... [/container]');
          }

          if(id === 'column') {
            tinyMCE.activeEditor.selection.setContent('[column type="whole, one-half, one-third, two-thirds, one-fourth, three-fourths, one-fifth, two-fifths, three-fifths, four-fifths, one-sixth, five-sixths" last="true" fade="true" fade_animation="in, in-from-top, in-from-left, in-from-right, in-from-bottom" fade_animation_offset="45px"] Add in your content here. [/column]');
          }

          if(id === 'line') {
            tinyMCE.activeEditor.selection.setContent('[line]');
          }

          if(id === 'gap') {
            tinyMCE.activeEditor.selection.setContent('[gap size="100px"]');
          }

          if(id === 'clear') {
            tinyMCE.activeEditor.selection.setContent('[clear]');
          }


          //
          // Content.
          //

          if(id === 'accordion') {
            tinyMCE.activeEditor.selection.setContent('[accordion id="my-accordion"] [accordion_item parent_id="my-accordion" title="Accordion Item One" open="true"] Add in your content here. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Maecenas sed diam eget risus varius blandit sit amet non magna. [/accordion_item] [accordion_item parent_id="my-accordion" title="Accordion Item Two"] Add in your content here. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Maecenas sed diam eget risus varius blandit sit amet non magna. [/accordion_item] [/accordion]');
          }

          if(id === 'tabs') {
            tinyMCE.activeEditor.selection.setContent('[tab_nav type="two-up" float="none, left, right"] [tab_nav_item title="Tab Item One" active="true"] [tab_nav_item title="Tab Item Two"] [/tab_nav] [tabs] [tab active="true"] Add in your content here. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. [/tab] [tab] Add in your content here. Cras justo odio, dapibus ac facilisis in, egestas eget quam. [/tab] [/tabs]');
          }

          if(id === 'block-grid') {
            tinyMCE.activeEditor.selection.setContent('[block_grid type="two-up, three-up, four-up, five-up"] [block_grid_item] ... [/block_grid_item] [block_grid_item] ... [/block_grid_item] [/block_grid]');
          }

          if(id === 'columnize') {
            tinyMCE.activeEditor.selection.setContent('[columnize] Add in your content here. Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Cras mattis consectetur purus sit amet fermentum. Maecenas faucibus mollis interdum. Donec ullamcorper nulla non metus auctor fringilla. Maecenas faucibus mollis interdum. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Nulla vitae elit libero, a pharetra augue. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Donec sed odio dui. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Etiam porta sem malesuada magna mollis euismod. [/columnize]');
          }

          if(id === 'visibility') {
            tinyMCE.activeEditor.selection.setContent('[visibility type="hidden-desktop, hidden-tablet, hidden-phone, visible-desktop, visible-tablet, visible-phone" inline="true"] ... [/visibility]');
          }

          if(id === 'protect') {
            tinyMCE.activeEditor.selection.setContent('[protect] Add in your content here. [/protect]');
          }


          //
          // Typography.
          //

          if(id === 'custom-headline') {
            tinyMCE.activeEditor.selection.setContent('[custom_headline type="left, center, right" level="h2" looks_like="h3" accent="true"] Custom Headline [/custom_headline]');
          }

          if(id === 'feature-headline') {
            tinyMCE.activeEditor.selection.setContent('[feature_headline type="left, center, right" level="h2" looks_like="h3" icon="lightbulb-o"] Feature Headline [/feature_headline]');
          }

          if(id === 'blockquote') {
            tinyMCE.activeEditor.selection.setContent('[blockquote cite="Mr. WordPress" type="left, center, right"]Maecenas faucibus mollis interdum. Maecenas faucibus mollis interdum. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.[/blockquote]');
          }

          if(id === 'pullquote') {
            tinyMCE.activeEditor.selection.setContent('[pullquote cite="Mr. WordPress" type="left, right"]Maecenas faucibus mollis interdum. Maecenas faucibus mollis interdum. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.[/pullquote]');
          }

          if(id === 'icon') {
            tinyMCE.activeEditor.selection.setContent('[icon type="camera-retro"]');
          }

          if(id === 'icon-list') {
            tinyMCE.activeEditor.selection.setContent('[icon_list] [icon_list_item type="check"] Icon list item [/icon_list_item] [icon_list_item type="check"] Icon list item [/icon_list_item] [icon_list_item type="check"] Icon list item [/icon_list_item] [/icon_list]');
          }

          if(id === 'social-icon') {
            tinyMCE.activeEditor.selection.setContent('[social type="facebook"]');
          }

          if(id === 'highlight') {
            tinyMCE.activeEditor.selection.setContent('[highlight type="standard, dark"]Highlight some text to make it stand out![/highlight]');
          }

          if(id === 'dropcap') {
            tinyMCE.activeEditor.selection.setContent('[dropcap] ... [/dropcap]');
          }

          if(id === 'code') {
            tinyMCE.activeEditor.selection.setContent('[code]Put your code here. You will need to use non-breaking spaces to indent your lines if desired.[/code]');
          }

          if(id === 'responsive-text') {
            tinyMCE.activeEditor.selection.setContent('[responsive_text selector=".responsive-heading" compression="1.2" min_size="24px" max_size="54px"] Look At Me, I\'m Responding! [/responsive_text]');
          }


          //
          // Marketing.
          //

          if(id === 'button') {
            tinyMCE.activeEditor.selection.setContent('[button href="#" title="Title" target="blank" shape="square, rounded, pill" size="mini, small, regular, large, x-large, jumbo" block="true" circle="true" icon_only="true" info="popover, tooltip" info_place="top, right, bottom, left" info_trigger="hover, click, focus" info_content="This content will only show up if you have decided to show a popover."] I Am A Super Clickable Button! [/button]');
          }

          if(id === 'callout') {
            tinyMCE.activeEditor.selection.setContent('[callout type="left, center, right" title="Title" message="Add in your content here. Etiam porta sem malesuada magna mollis euismod." button_text="Click Me!" href="" target="blank"]');
          }

          if(id === 'promo') {
            tinyMCE.activeEditor.selection.setContent('[promo image="http://yourdomain.com/path/to/your/image.jpg" alt="Alt Text"] Add in your content here. [/promo]');
          }

          if(id === 'prompt') {
            tinyMCE.activeEditor.selection.setContent('[prompt type="left, right" title="Title" message="I\'m the message text, and I\'m written in a way that is super engaging. Aenean lacinia bibendum nulla sed consectetur." button_text="Click me, now!" href="" target="blank"]');
          }

          if(id === 'pricing-table') {
            tinyMCE.activeEditor.selection.setContent('[pricing_table columns="2"] [pricing_table_column featured="true" featured_sub="Most Popular" title="Standard" currency="$" price="39" interval="Per Month"] [icon_list] [icon_list_item type="ok"] Item One [/icon_list_item] [icon_list_item type="ok"] Item Two [/icon_list_item] [icon_list_item style="color: red;" type="remove"] Item Three [/icon_list_item] [/icon_list] [button href="#"] Sign Up! [/button] [/pricing_table_column] [pricing_table_column featured="false" title="Premium" currency="$" price="199" interval="Per Year"] [icon_list] [icon_list_item type="ok"] Item One [/icon_list_item] [icon_list_item type="ok"] Item Two [/icon_list_item] [icon_list_item type="ok"] Item Three [/icon_list_item] [/icon_list] [button href="#"] Sign Up! [/button] [/pricing_table_column] [/pricing_table]');
          }


          //
          // Information.
          //

          if(id === 'info') {
            tinyMCE.activeEditor.selection.setContent('[extra href="#" title="Title" target="blank" info="popover, tooltip" info_place="top, right, bottom, left" info_trigger="hover, click, focus" info_content="This content will only show up if you have decided to show a popover."] Place link text here [/extra]');
          }

          if(id === 'alert') {
            tinyMCE.activeEditor.selection.setContent('[alert type="success, info, warning, danger, muted" close="true" heading="Heading"] ... [/alert]');
          }

          if(id === 'skill-bar') {
            tinyMCE.activeEditor.selection.setContent('[skill_bar heading="Heading" percent="95%" bar_text=""]');
          }

          if(id === 'table-of-contents') {
            tinyMCE.activeEditor.selection.setContent('[toc title="Title" type="left, right, block" columns="1, 2, 3"] [toc_item title="1. First Page" page="1"] [toc_item title="2. Second Page" page="2"] [/toc]');
          }


          //
          // Media.
          //

          if(id === 'image') {
            tinyMCE.activeEditor.selection.setContent('[image src="http://yourdomain.com/path/to/your/image.jpg" alt="Alt Text" type="rounded, circle, thumbnail, none" float="left, right, none" link="true" href="#" title="Title" target="blank" info="tooltip, popover" info_place="top, right, bottom, left" info_trigger="hover, click, focus" info_content="This content will only show up if you have decided to show a popover." lightbox_thumb="http://yourdomain.com/path/to/your/image.jpg" lightbox_video="true" lightbox_caption="This content will only show up if you use a lightbox"]');
          }

          if(id === 'slider') {
            tinyMCE.activeEditor.selection.setContent('[slider animation="fade, slide" slide_time="4000" slide_speed="500" slideshow="true" random="true" control_nav="true" prev_next_nav="true" no_container="true"] [slide] [image src="http://yourdomain.com/path/to/your/image.jpg" alt="Alt Text" type="thumbnail"] [/slide] [slide] [image src="http://yourdomain.com/path/to/your/image.jpg" alt="Alt Text" type="thumbnail"] [/slide] [/slider]');
          }

          if(id === 'lightbox') {
            tinyMCE.activeEditor.selection.setContent('[lightbox selector=".x-img-link" deeplink="true" opacity="0.85" prev_scale="0.65" prev_opacity="0.75" next_scale="0.65" next_opacity="0.75" orientation="vertical, horizontal" thumbnails="true"]');
          }

          if(id === 'video-player') {
            tinyMCE.activeEditor.selection.setContent('[x_video_player type="16:9, 5:3, 5:4, 4:3, 3:2" m4v="" ogv="" poster="" hide_controls="true" autoplay="true" no_container="true"]');
          }

          if(id === 'video-embed') {
            tinyMCE.activeEditor.selection.setContent('[x_video_embed no_container="true"] Place embed code here [/x_video_embed]');
          }

          if(id === 'audio-player') {
            tinyMCE.activeEditor.selection.setContent('[x_audio_player mp3="" oga=""]');
          }

          if(id === 'audio-embed') {
            tinyMCE.activeEditor.selection.setContent('[x_audio_embed] Place embed code here [/x_audio_embed]');
          }

          if(id === 'map') {
            tinyMCE.activeEditor.selection.setContent('[map no_container="true"] Place embed code here [/map]');
          }


          //
          // Social.
          //

          if(id === 'author') {
            tinyMCE.activeEditor.selection.setContent('[author title="Title" author_id=""]');
          }

          if(id === 'entry-share') {
            tinyMCE.activeEditor.selection.setContent('[share title="Title" facebook="true" twitter="true" google_plus="true" linkedin="true" pinterest="true" reddit="true" email="true"]');
          }

          if(id === 'recent-posts') {
            tinyMCE.activeEditor.selection.setContent('[recent_posts type="post, portfolio" category="" count="1, 2, 3, 4" offset="1, 2, 3..." orientation="horizontal, vertical" no_image="true" fade="true"]');
          }

          if(id === 'search') {
            tinyMCE.activeEditor.selection.setContent('[search]');
          }

          return false;

        }
      });
    }
  
  });

  tinymce.PluginManager.add('x_shortcodes', tinymce.plugins.xShortcodeMce);

})();