<?php

namespace Drupal\social_private_message\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\Plugin\Field\FieldFormatter\EntityReferenceLabelFormatter;

/**
 * Plugin implementation of the formatter for private message owner.
 *
 * @FieldFormatter(
 *   id = "social_private_message_owner_formatter",
 *   label = @Translation("Social Private Message Owner"),
 *   description = @Translation("Display the label of the referenced entities even if based entity type is user and entity is deleted."),
 *   field_types = {
 *     "entity_reference"
 *   }
 * )
 */
class SocialPrivateMessageOwnerFormatter extends EntityReferenceLabelFormatter {

}
