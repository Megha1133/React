<?php

namespace Drupal\file_fetcher\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class FileFetcherController extends ControllerBase {

  public function download() {
    $primary_dir = 'sites/default/files/primary';
    $secondary_dir = 'sites/default/files/secondary';

    // Check if there are XLS files in the primary directory
    $primary_files = $this->getXlsFilesInDirectory($primary_dir);
    if (!empty($primary_files)) {
      echo "hi file is there";
      $file = reset($primary_files);
      return $this->createFileResponse($file);
    }

    // If primary is empty, check the secondary directory
    $secondary_files = $this->getXlsFilesInDirectory($secondary_dir);
    if (!empty($secondary_files)) {
      $file = reset($secondary_files);
      return $this->createFileResponse($file);
    }

    // No files found in either directory
    return [
      '#markup' => $this->t('No XLS files available for download.'),
    ];
  }

  private function getXlsFilesInDirectory($directory) {
    $files = [];
    if (is_dir($directory)) {
      $dh = opendir($directory);
      if ($dh) {
        while (($file = readdir($dh)) !== false) {
          if ($file !== '.' && $file !== '..' && !is_dir($directory . '/' . $file) && pathinfo($file, PATHINFO_EXTENSION) == 'xls') {
            $files[] = $directory . '/' . $file;
          }
        }
        closedir($dh);
      }
    }
    return $files;
  }

  private function createFileResponse($file) {
    $response = new BinaryFileResponse($file);
    $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, basename($file));
    return $response;
  }

  public function downloadButton() {
    return [
      '#theme' => 'file_fetcher_button',
    ];
  }
}
?>
