// =============================================================================
// JS/ADMIN/TINYMCE.JS
// -----------------------------------------------------------------------------
// v4.X TinyMCE specific functions.
// =============================================================================

(function() {

  tinymce.PluginManager.add('x_shortcodes', function(editor, url) {
 
    editor.addButton('x_shortcodes_button', {

      type  : 'menubutton',
      title : 'X – Shortcodes',
      text  : '',
      image : url + '/x-shortcodes.png',
      style : 'background-image: url("' + url + '/x-shortcodes.png' + '"); background-repeat: no-repeat; background-position: 2px 2px;"',
      icon  : true,
      menu  : [

        { text : 'Structure',
          menu : [
            { text : 'Content Band',      onclick: function() { editor.insertContent('[content_band inner_container="true" no_margin="true" border="none, top, left, right, bottom, vertical, horizontal, all" padding_top="40px" padding_bottom="40px" bg_pattern="" bg_image="" parallax="true" bg_video="" bg_video_poster=""] ... [/content_band]'); } },
            { text : 'Container',         onclick: function() { editor.insertContent('[container] ... [/container]'); } },
            { text : 'Column',            onclick: function() { editor.insertContent('[column type="whole, one-half, one-third, two-thirds, one-fourth, three-fourths, one-fifth, two-fifths, three-fifths, four-fifths, one-sixth, five-sixths" last="true" fade="true" fade_animation="in, in-from-top, in-from-left, in-from-right, in-from-bottom" fade_animation_offset="45px"] Add in your content here. [/column]'); } },
            { text : 'Line',              onclick: function() { editor.insertContent('[line]'); } },
            { text : 'Gap',               onclick: function() { editor.insertContent('[gap size="100px"]'); } },
            { text : 'Clear',             onclick: function() { editor.insertContent('[clear]'); } }
          ]
        },

        { text : 'Content',
          menu : [
            { text : 'Accordion',         onclick: function() { editor.insertContent('[accordion id="my-accordion"] [accordion_item parent_id="my-accordion" title="Accordion Item One" open="true"] Add in your content here. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Maecenas sed diam eget risus varius blandit sit amet non magna. [/accordion_item] [accordion_item parent_id="my-accordion" title="Accordion Item Two"] Add in your content here. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Maecenas sed diam eget risus varius blandit sit amet non magna. [/accordion_item] [/accordion]'); } },
            { text : 'Tabs',              onclick: function() { editor.insertContent('[tab_nav type="two-up" float="none, left, right"] [tab_nav_item title="Tab Item One" active="true"] [tab_nav_item title="Tab Item Two"] [/tab_nav] [tabs] [tab active="true"] Add in your content here. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. [/tab] [tab] Add in your content here. Cras justo odio, dapibus ac facilisis in, egestas eget quam. [/tab] [/tabs]'); } },
            { text : 'Block Grid',        onclick: function() { editor.insertContent('[block_grid type="two-up, three-up, four-up, five-up"] [block_grid_item] ... [/block_grid_item] [block_grid_item] ... [/block_grid_item] [/block_grid]'); } },
            { text : 'Columnize',         onclick: function() { editor.insertContent('[columnize] Add in your content here. Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Cras mattis consectetur purus sit amet fermentum. Maecenas faucibus mollis interdum. Donec ullamcorper nulla non metus auctor fringilla. Maecenas faucibus mollis interdum. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Nulla vitae elit libero, a pharetra augue. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Donec sed odio dui. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Etiam porta sem malesuada magna mollis euismod. [/columnize]'); } },
            { text : 'Visibility',        onclick: function() { editor.insertContent('[visibility type="hidden-desktop, hidden-tablet, hidden-phone, visible-desktop, visible-tablet, visible-phone" inline="true"] ... [/visibility]'); } },
            { text : 'Protect',           onclick: function() { editor.insertContent('[protect] Add in your content here. [/protect]'); } }
          ]
        },

        { text : 'Typography',
          menu : [
            { text : 'Custom Headline',   onclick: function() { editor.insertContent('[custom_headline type="left, center, right" level="h2" looks_like="h3" accent="true"] Custom Headline [/custom_headline]'); } },
            { text : 'Feature Headline',  onclick: function() { editor.insertContent('[feature_headline type="left, center, right" level="h2" looks_like="h3" icon="lightbulb-o"] Feature Headline [/feature_headline]'); } },
            { text : 'Blockquote',        onclick: function() { editor.insertContent('[blockquote cite="Mr. WordPress" type="left, center, right"]Maecenas faucibus mollis interdum. Maecenas faucibus mollis interdum. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.[/blockquote]'); } },
            { text : 'Pullquote',         onclick: function() { editor.insertContent('[pullquote cite="Mr. WordPress" type="left, right"]Maecenas faucibus mollis interdum. Maecenas faucibus mollis interdum. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.[/pullquote]'); } },
            { text : 'Icon',              onclick: function() { editor.insertContent('[icon type="camera-retro"]'); } },
            { text : 'Icon List',         onclick: function() { editor.insertContent('[icon_list] [icon_list_item type="check"] Icon list item [/icon_list_item] [icon_list_item type="check"] Icon list item [/icon_list_item] [icon_list_item type="check"] Icon list item [/icon_list_item] [/icon_list]'); } },
            { text : 'Social Icon',       onclick: function() { editor.insertContent('[social type="facebook"]'); } },
            { text : 'Highlight',         onclick: function() { editor.insertContent('[highlight type="standard, dark"]Highlight some text to make it stand out![/highlight]'); } },
            { text : 'Dropcap',           onclick: function() { editor.insertContent('[dropcap] ... [/dropcap]'); } },
            { text : 'Code',              onclick: function() { editor.insertContent('[code]Put your code here. You will need to use non-breaking spaces to indent your lines if desired.[/code]'); } },
            { text : 'Responsive Text',   onclick: function() { editor.insertContent('[responsive_text selector=".responsive-heading" compression="1.2" min_size="24px" max_size="54px"] Look At Me, I\'m Responding! [/responsive_text]'); } }
          ]
        },

        { text : 'Marketing',
          menu : [
            { text : 'Button',            onclick: function() { editor.insertContent('[button href="#" title="Title" target="blank" shape="square, rounded, pill" size="mini, small, regular, large, x-large, jumbo" block="true" circle="true" icon_only="true" info="popover, tooltip" info_place="top, right, bottom, left" info_trigger="hover, click, focus" info_content="This content will only show up if you have decided to show a popover."] I Am A Super Clickable Button! [/button]'); } },
            { text : 'Callout',           onclick: function() { editor.insertContent('[callout type="left, center, right" title="Title" message="Add in your content here. Etiam porta sem malesuada magna mollis euismod." button_text="Click Me!" href="" target="blank"]'); } },
            { text : 'Promo',             onclick: function() { editor.insertContent('[promo image="http://yourdomain.com/path/to/your/image.jpg" alt="Alt Text"] Add in your content here. [/promo]'); } },
            { text : 'Prompt',            onclick: function() { editor.insertContent('[prompt type="left, right" title="Title" message="I\'m the message text, and I\'m written in a way that is super engaging. Aenean lacinia bibendum nulla sed consectetur." button_text="Click me, now!" href="" target="blank"]'); } },
            { text : 'Pricing Table',     onclick: function() { editor.insertContent('[pricing_table columns="2"] [pricing_table_column featured="true" featured_sub="Most Popular" title="Standard" currency="$" price="39" interval="Per Month"] [icon_list] [icon_list_item type="ok"] Item One [/icon_list_item] [icon_list_item type="ok"] Item Two [/icon_list_item] [icon_list_item style="color: red;" type="remove"] Item Three [/icon_list_item] [/icon_list] [button href="#"] Sign Up! [/button] [/pricing_table_column] [pricing_table_column featured="false" title="Premium" currency="$" price="199" interval="Per Year"] [icon_list] [icon_list_item type="ok"] Item One [/icon_list_item] [icon_list_item type="ok"] Item Two [/icon_list_item] [icon_list_item type="ok"] Item Three [/icon_list_item] [/icon_list] [button href="#"] Sign Up! [/button] [/pricing_table_column] [/pricing_table]'); } }
          ]
        },

        { text : 'Information',
          menu : [
            { text : 'Info',              onclick: function() { editor.insertContent('[extra href="#" title="Title" target="blank" info="popover, tooltip" info_place="top, right, bottom, left" info_trigger="hover, click, focus" info_content="This content will only show up if you have decided to show a popover."] Place link text here [/extra]'); } },
            { text : 'Alert',             onclick: function() { editor.insertContent('[alert type="success, info, warning, danger, muted" close="true" heading="Heading"] ... [/alert]'); } },
            { text : 'Skill Bar',         onclick: function() { editor.insertContent('[skill_bar heading="Heading" percent="95%" bar_text=""]'); } },
            { text : 'Table of Contents', onclick: function() { editor.insertContent('[toc title="Title" type="left, right, block" columns="1, 2, 3"] [toc_item title="1. First Page" page="1"] [toc_item title="2. Second Page" page="2"] [/toc]'); } },
          ]
        },

        { text : 'Media',
          menu : [
            { text : 'Image',             onclick: function() { editor.insertContent('[image src="http://yourdomain.com/path/to/your/image.jpg" alt="Alt Text" type="rounded, circle, thumbnail, none" float="left, right, none" link="true" href="#" title="Title" target="blank" info="tooltip, popover" info_place="top, right, bottom, left" info_trigger="hover, click, focus" info_content="This content will only show up if you have decided to show a popover." lightbox_thumb="http://yourdomain.com/path/to/your/image.jpg" lightbox_video="true" lightbox_caption="This content will only show up if you use a lightbox"]'); } },
            { text : 'Slider',            onclick: function() { editor.insertContent('[slider animation="fade, slide" slide_time="4000" slide_speed="500" slideshow="true" random="true" control_nav="true" prev_next_nav="true" no_container="true"] [slide] [image src="http://yourdomain.com/path/to/your/image.jpg" alt="Alt Text" type="thumbnail"] [/slide] [slide] [image src="http://yourdomain.com/path/to/your/image.jpg" alt="Alt Text" type="thumbnail"] [/slide] [/slider]'); } },
            { text : 'Lightbox',          onclick: function() { editor.insertContent('[lightbox selector=".x-img-link" deeplink="true" opacity="0.85" prev_scale="0.65" prev_opacity="0.75" next_scale="0.65" next_opacity="0.75" orientation="vertical, horizontal" thumbnails="true"]'); } },
            { text : 'Video Player',      onclick: function() { editor.insertContent('[x_video_player type="16:9, 5:3, 5:4, 4:3, 3:2" m4v="" ogv="" poster="" hide_controls="true" autoplay="true" no_container="true"]'); } },
            { text : 'Video Embed',       onclick: function() { editor.insertContent('[x_video_embed no_container="true"] Place embed code here [/x_video_embed]'); } },
            { text : 'Audio Player',      onclick: function() { editor.insertContent('[x_audio_player mp3="" oga=""]'); } },
            { text : 'Audio Embed',       onclick: function() { editor.insertContent('[x_audio_embed] Place embed code here [/x_audio_embed]'); } },
            { text : 'Map',               onclick: function() { editor.insertContent('[map no_container="true"] Place embed code here [/map]'); } }
          ]
        },

        { text : 'Social',
          menu : [
            { text : 'Author',            onclick: function() { editor.insertContent('[author title="Title" author_id=""]'); } },
            { text : 'Entry Share',       onclick: function() { editor.insertContent('[share title="Title" facebook="true" twitter="true" google_plus="true" linkedin="true" pinterest="true" reddit="true" email="true"]'); } },
            { text : 'Recent Posts',      onclick: function() { editor.insertContent('[recent_posts type="post, portfolio" category="" count="1, 2, 3, 4" offset="1, 2, 3..." orientation="horizontal, vertical" no_image="true" fade="true"]'); } },
            { text : 'Search',            onclick: function() { editor.insertContent('[search]'); } }
          ]
        }

      ]

    });

  });

})();