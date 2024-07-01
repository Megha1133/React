<?php

namespace Drupal\file_fetcher\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'File Fetcher' Block.
 *
 * @Block(
 *   id = "file_fetcher_block",
 *   admin_label = @Translation("File Fetcher Block"),
 * )
 */
class FileFetcherBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    return [
      '#type' => 'inline_template',
      '#template' => '<a href="{{ path("file_fetcher.download") }}" class="button">Download XLS File</a>',
    ];
  }

}
?>
