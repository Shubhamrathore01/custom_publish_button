<?php

namespace Drupal\custom_publish_button\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;
use Drupal\webform\Entity\WebformSubmission;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Publish Submission Controller.
 */
class PublishSubmissionController extends ControllerBase {

  /**
   * Publishes the webform submission as a new node.
   */
  public function publishSubmission($webform_submission) {
    // echo $webform_submission;exit;
    $submission = WebformSubmission::load($webform_submission);

    
    // Create a new node of your desired content type.
    /*$node = Node::create([
      'type' => 'video', // Replace with the machine name of your content type.
      'title' => $submission->label(),
      'field_contributor' => [
        'value' => $submission->getData('contributor'), // Replace 'your_field_name' and 'your_webform_element_key' with the relevant field and webform element keys.
      ],
      'field_product' => [
        'value' => $submission->getData('product'), // Replace 'your_field_name' and 'your_webform_element_key' with the relevant field and webform element keys.
      ],
      'field_tags' => [
        'value' => $submission->getData('tags'), // Replace 'your_field_name' and 'your_webform_element_key' with the relevant field and webform element keys.
      ],
      'field_topics' => [
        'value' => $submission->getData('topic'), // Replace 'your_field_name' and 'your_webform_element_key' with the relevant field and webform element keys.
      ],
      'field_video_thumb' => [
        'value' => $submission->getData('video_thumbnail_image'), // Replace 'your_field_name' and 'your_webform_element_key' with the relevant field and webform element keys.
      ],
      'field_video' => [
        'value' => $submission->getData('video_photo_file'), // Replace 'your_field_name' and 'your_webform_element_key' with the relevant field and webform element keys.
      ],
    ]); */
    $data = $submission->getData();
    $node_data = [
      'type' => 'video',
      'title' => $data['author_name'],
      // 'title' => [
      //   'target_id' => $data['author_name'],
      // ],
      'field_contributor' => [
        'target_id' => $data['contributor'],
      ],
      'field_product' => [
        'target_id' => $data['product'],
      ],
      'field_tags' => [
        'target_id' => $data['tags'],
      ],
      'field_topics' => [
        'target_id' => $data['topic'],
      ],
      'field_video_thumb' => [
        'target_id' => $data['video_thumbnail_image'],
      ],
      'field_video' => [
        'value' => $data['video_photo_file'],
      ],
    ];
    /*$node_data = [
      'type' => 'video', // Replace with the machine name of your content type.
      'title' => $submission->label(),
      'field_contributor' => [
        'value' => $submission->getData('contributor'), // Replace 'your_field_name' and 'your_webform_element_key' with the relevant field and webform element keys.
      ],
      'field_product' => [
        'value' => $submission->getData('product'), // Replace 'your_field_name' and 'your_webform_element_key' with the relevant field and webform element keys.
      ],
      'field_tags' => [
        'value' => $submission->getData('tags'), // Replace 'your_field_name' and 'your_webform_element_key' with the relevant field and webform element keys.
      ],
      'field_topics' => [
        'value' => $submission->getData('topic'), // Replace 'your_field_name' and 'your_webform_element_key' with the relevant field and webform element keys.
      ],
      'field_video_thumb' => [
        'value' => $submission->getData('video_thumbnail_image'), // Replace 'your_field_name' and 'your_webform_element_key' with the relevant field and webform element keys.
      ],
      'field_video' => [
        'value' => $submission->getData('video_photo_file'), // Replace 'your_field_name' and 'your_webform_element_key' with the relevant field and webform element keys.
      ],
    ];
    dump($node_data);exit;*/
    $node = Node::create($node_data);
    $node->save();
    //dump($node);
    //dump($submission);
    //dump($node);
    //exit;
    // Save the node.
    //$node->save();
    
    // Delete the webform submission if needed.
    // $submission->delete();
    
    // Redirect the user to the newly created node.
    return new RedirectResponse($node->toUrl()->toString());
  }

}
