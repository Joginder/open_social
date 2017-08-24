<?php

namespace Drupal\socialbase\Plugin\Preprocess;

use Drupal\bootstrap\Plugin\Preprocess\PreprocessBase;
use Drupal\bootstrap\Plugin\Preprocess\PreprocessInterface;

/**
 * Pre-processes variables for the "views_exposed_form" theme hook.
 *
 * @ingroup plugins_preprocess
 *
 * @BootstrapPreprocess("views_exposed_form")
 */
class SocialBaseViewsExposedForm extends PreprocessBase implements PreprocessInterface {

  /**
   * {@inheritdoc}
   */
  public function preprocess(array &$variables, $hook, array $info) {

    if (isset($variables['theme_hook_original']) && $variables['theme_hook_original'] === 'views_exposed_form') {

      // Set variable to to read by SocialbaseContainer.
      $variables['form']['actions']['#exposed_form'] = TRUE;

      $variables['form']['actions']['submit']['#button_type'] = 'default';
      $variables['form']['actions']['reset']['#button_type'] = 'flat';
    }

  }

}