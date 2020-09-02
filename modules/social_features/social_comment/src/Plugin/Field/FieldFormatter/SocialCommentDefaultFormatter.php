<?php

namespace Drupal\social_comment\Plugin\Field\FieldFormatter;

use Drupal\comment\Plugin\Field\FieldFormatter\CommentDefaultFormatter;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\node\NodeInterface;

/**
 * Provides a default comment formatter.
 *
 * @FieldFormatter(
 *   id = "social_comment_default",
 *   module = "social_comment",
 *   label = @Translation("Social comment list"),
 *   field_types = {
 *     "comment"
 *   },
 *   quickedit = {
 *     "editor" = "disabled"
 *   }
 * )
 */
class SocialCommentDefaultFormatter extends CommentDefaultFormatter {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    // Elements from core comment formatter.
    $elements = parent::viewElements($items, $langcode);

    // Check if comments exists and used in node entity.
    if (!empty($elements[0]['comments']) && $items->getEntity() instanceof NodeInterface) {
      $comment_settings = $this->getFieldSettings();

      // Replace comments with lazy builder.
      $elements[0]['comments'] = [
        '#lazy_builder' => [
          'social_comment.lazy_renderer:renderComments',
          [
            $items->getEntity()->id(),
            $comment_settings['default_mode'],
            $items->getName(),
            $comment_settings['per_page'],
            $this->getSetting('pager_id'),
          ],
        ],
        '#create_placeholder' => TRUE,
      ];
    }

    return $elements;
  }

}
