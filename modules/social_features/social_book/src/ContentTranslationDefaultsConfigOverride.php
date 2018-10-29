<?php

namespace Drupal\social_book;

use Drupal\Core\Cache\CacheableMetadata;
use Drupal\Core\Config\ConfigFactoryOverrideInterface;
use Drupal\Core\Config\StorageInterface;

/**
 * Provides content translation defaults for the book content type.
 *
 * @package Drupal\social_book
 */
class ContentTranslationDefaultsConfigOverride implements ConfigFactoryOverrideInterface {

  /**
   * {@inheritdoc}
   */
  public function loadOverrides($names) {
    $overrides = [];

    // TODO: This doesn't work if the setting is enabled by an override but allowing the override will create an endless loop.
    $settings = \Drupal::configFactory()->getEditable('social_content_translation.settings');
    $translate_book = $settings->getOriginal('social_book', FALSE);

    // If the social_content_translation settings object doesn't exist or we are
    // disabled then we perform no overrides.
    if ($translate_book) {
      $this->addTranslationOverrides($names, $overrides);
    }

    return $overrides;
  }

  /**
   * Adds the overrides for this config overrides for field translations.
   *
   * By making this a separate method it can easily be overwritten in child
   * classes without having to duplicate the logic of whether it should be
   * invoked.
   *
   * @param array $names
   *   The names of the configuration keys for which overwrites are requested.
   * @param array $overrides
   *   The array of overrides that should be adjusted.
   */
  protected function addTranslationOverrides(array $names, array &$overrides) {
    $field_overrides = [
      'core.base_field_override.node.book.title' => [
        'translatable' => TRUE,
      ],
      'core.base_field_override.node.book.menu_link' => [
        'translatable' => TRUE,
      ],
      'core.base_field_override.node.book.path' => [
        'translatable' => TRUE,
      ],
      'field.field.node.book.body' => [
        'translatable' => TRUE,
      ],
      'field.field.node.book.field_book_image' => [
        'third_party_settings' => [
          'content_translation' => [
            'translation_sync' => [
              'file' => 'file',
              'alt' => '0',
              'title' => '0',
            ],
          ],
        ],
        'translatable' => TRUE,
      ],
    ];

    foreach ($field_overrides as $name => $override) {
      if (in_array($name, $names)) {
        $overrides[$name] = $override;
      }
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheSuffix() {
    return __CLASS__;
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheableMetadata($name) {
    return new CacheableMetadata();
  }

  /**
   * {@inheritdoc}
   */
  public function createConfigObject($name, $collection = StorageInterface::DEFAULT_COLLECTION) {
    return NULL;
  }

}
