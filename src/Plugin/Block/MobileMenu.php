<?php

namespace Drupal\om_mobile_menu\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Cache\Cache;

/**
 * Provides a 'Mobile Menu' block.
 *
 * @Block(
 *   id = "mobile_menu",
 *   admin_label = @Translation("Mobile Menu")
 * )
 */
class MobileMenu extends BlockBase implements ContainerFactoryPluginInterface {
  public function __construct(array $configuration, $plugin_id, $plugin_definition, $menu_link_tree) {
    $this->menu_link_tree = $menu_link_tree;
    parent::__construct($configuration, $plugin_id, $plugin_definition);
  }
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('menu.link_tree')
    );
  }
  /**
   * {@inheritdoc}
   */
  public function build() {
    $parameters = $this->menu_link_tree->getCurrentRouteMenuTreeParameters('main');
    $menu = $this->menu_link_tree->load('main', $parameters);
    $build = $this->menu_link_tree->build($menu);
    $build['#attributes'] = array('id' => array('mobile-menu-list'));
    return array(
      'trigger' => array(
         '#type' => 'html_tag',
         '#tag' => 'a',
         '#value' => 'Mobile Menu',
         '#attributes' => array(
           'href' => '#mobile-menu',
           'id' => 'mobile-menu-trigger',
         )
       ),
       'menu' => $build,
       '#attached' => array(
         'library' => array('om_mobile_menu/mobile-menu')
       )
    );
  }
}
