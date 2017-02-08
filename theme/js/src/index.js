import $ from 'jquery';
import mmenu from 'jquery.mmenu';


const MOUNT_ELEMENT = '#block-mobilemenu';

const init = function() {
  var $block = $(MOUNT_ELEMENT),
    $trigger = $block.find('#mobile-menu-trigger'),
    $menu = $block.find('#mobile-menu-list').detach(),
    $mobileMenuNav = $('<nav/>').prop('id', 'mobile-menu').append($menu).appendTo('body');
    $mobileMenuNav.mmenu({navbar: {add: false}});
}

$('document').ready(init);
