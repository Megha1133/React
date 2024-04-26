<?php

namespace Drupal\custom_api\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Drupal\node\Entity\Node;
/**
 * Provides a Demo Resource
 *
 * @RestResource(
 *   id = "products",
 *   label = @Translation("Products list"),
 *   uri_paths = {
 *     "canonical" = "/get/products",
 *     "create" = "add/products"
 *   }
 * )
 */

class GetProducts extends ResourceBase {

    /**
     * Responds to entity GET requests.
     * @return \Drupal\rest\ResourceResponse
     */
    public function get() {
     try{ 
      $nids = \Drupal::entityQuery('node')->condition('type','product')->execute();
      $nodes =  \Drupal\node\Entity\Node::loadMultiple($nids);
      //$response = ['message' => 'Hello, this is a rest service'];
      $response =$this->processNodes($nodes);
      return new ResourceResponse($response);
     } catch (EntityStorageException $e) {
       \Drupal::logger('custom_api') ->error($e->getMessage());
     }
    }

    private function processNodes($nodes) {
      $output = [];
      foreach ($nodes as $key => $node){
        $output[$key]['field_product_id'] = $node->get('field_product_id')->getValue();
        $output[$key]['field_product_name'] = $node->get('field_product_name')->getValue();
        $output[$key]['field_description'] = $node->get('field_description')->getValue();
        $output[$key]['type'] = $node->get('type')->getValue();
        $output[$key]['field_product_id'] = $node->get('field_product_id')->getValue();
        $output[$key]['title'] = $node->get('title')->getValue();
        $output[$key]['field_price'] = $node->get('field_price')->getValue();
      }
      return $output;
     
    }
    
    /***
     *  post api
     */

    public function post($data) {
      try{ 
        //print_r($data);

        $database = \Drupal::database();
        
        $output ;
        foreach ($data as $x => $x_value) {
          $y = $x;
          $y_value = $x_value;

        }
      
        //$sql = "SELECT `field_product_id_value`,`field_product_name_value` FROM node_revision__field_product_id P JOIN node_revision__field_product_name N ON P.entity_id=N.entity_id WHERE field_product_id_value='1001'";
        //$sql = "SELECT `field_product_id_value`,`field_product_name_value` FROM node_revision__field_product_id P JOIN node_revision__field_product_name N ON P.entity_id=N.entity_id WHERE $y='$y_value'";
        //$sql = "SELECT `field_product_id_value`,`field_product_name_value`,`field_price_value` FROM node_revision__field_product_id I JOIN node_revision__field_product_name N ON I.entity_id=N.entity_id JOIN `node_revision__field_price` P ON I.entity_id=P.entity_id  WHERE $y='$y_value'";
        //$sql = "SELECT `field_product_id_value`,`field_product_name_value`,`field_description_value`,`field_price_value` FROM node_revision__field_product_id I JOIN node_revision__field_product_name N ON I.entity_id=N.entity_id JOIN `node_revision__field_price` P ON I.entity_id=P.entity_id JOIN `node_revision__field_description` D ON I.entity_id=D.entity_id WHERE $y='$y_value'";
        $sql = "SELECT `field_product_id_value` as `Product ID`,`field_product_name_value`as `Product name`,`field_description_value` as `Description`,`name` as `Category`,`field_price_value` as `Price` FROM node_revision__field_product_id I JOIN node_revision__field_product_name N ON I.entity_id=N.entity_id JOIN `node_revision__field_price` P ON I.entity_id=P.entity_id JOIN `node_revision__field_description` D ON I.entity_id=D.entity_id  JOIN `node_revision__field_category` C ON I.entity_id=C.entity_id JOIN `taxonomy_term_field_data` T ON C.field_category_target_id=T.tid WHERE $y LIKE'%$y_value' ";
        //print_r($sql);
        $query = $database->query($sql);
        /*$rows = $query->fetchAll();
        foreach ($rows as $key =>$row)
        {
          
          //print_r($row);
           //echo json_encode($row, JSON_FORCE_OBJECT);
         $output = json_encode($row, JSON_FORCE_OBJECT);
        
        } */   
        while($rows = $query->fetchALL())  {
         $output = json_encode($rows,JSON_FORCE_OBJECT);
        }
      return new ResourceResponse(json_decode($output, JSON_FORCE_OBJECT));
      //return new ResourceResponse($output);

       } catch (EntityStorageException $e) {
         \Drupal::logger('custom_api') ->error($e->getMessage());
       }

      }
      
  }



  
?>