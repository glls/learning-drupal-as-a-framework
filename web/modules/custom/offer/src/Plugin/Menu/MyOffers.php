<?php
namespace Drupal\offer\Plugin\Menu;

use Drupal\Core\Menu\MenuLinkDefault;
use Drupal\Core\Cache\Cache;

/**
 * displays number of offers.
 */
class MyOffers extends MenuLinkDefault {

  /**
   * {@inheritdoc}
   */
  public function getTitle() {
    $count = 0;
    if(\Drupal::currentUser()->isAuthenticated()) {
      $offers = \Drupal::entityTypeManager()
        ->getStorage('offer')
        ->loadByProperties(['user_id' => \Drupal::currentUser()->id()]);
      $count = count($offers);
      return $this->t('My offers <span class="count-badge">(@count)</span>', ['@count' => $count]);
    } else {
      return null;
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheTags() {
    return Cache::mergeTags(parent::getCacheTags(), array('my_offers_user_'. \Drupal::currentUser()->id()));
  }

}
