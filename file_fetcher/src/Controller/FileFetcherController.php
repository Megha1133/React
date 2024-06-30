<?php

namespace Drupal\file_fetcher\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class FileFetcherController extends ControllerBase {

  public function download() {
    $primary_dir = 'sites/default/files/primary';
    $secondary_dir = 'sites/default/files/secondary';

    // Check if there are files in the primary directory
    $primary_files = $this->getFilesInDirectory($primary_dir);
    if (!empty($primary_files)) {
      $file = reset($primary_files);
      return $this->createFileResponse($file);
    }

    // If primary is empty, check the secondary directory
    $secondary_files = $this->getFilesInDirectory($secondary_dir);
    if (!empty($secondary_files)) {
      $file = reset($secondary_files);
      return $this->createFileResponse($file);
    }

    // No files found in either directory
    return [
      '#markup' => $this->t('No files available for download.'),
    ];
  }

  private function getFilesInDirectory($directory) {
    $files = [];
    if (is_dir($directory)) {
      $dh = opendir($directory);
      if ($dh) {
        while (($file = readdir($dh)) !== false) {
          if ($file !== '.' && $file !== '..' && !is_dir($directory . '/' . $file)) {
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
}
