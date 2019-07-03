<?php
class puppies_dashboard_media {

  public $orders = 0;

  public function ajax_media() {

    /*echo '<pre>';
    print_r($_FILES);
    print_r($_POST);
    echo '</pre>';*/

    if($_FILES['puppy_media'] && $_POST['pid']) {
      if( is_numeric($_POST['aid']) ) {
        $new_attach_id = $this->download_image_to_wp_media_library( $_FILES['puppy_media'], $_POST['pid'] );
        $this->update_attachment($new_attach_id, $_POST['pid'], $_POST['aid'], $_POST['is_thumb']);
      } else {
        $attach_id = $this->download_image_to_wp_media_library( $_FILES['puppy_media'], $_POST['pid'] );
        if($attach_id) $this->set_attachments($attach_id, $_POST['pid'], $_POST['order']);
      }
    } elseif($_POST['type'] == 'delete' && $_POST['pid'] && $_POST['aid']) {
      $del = wp_delete_attachment( $_POST['aid'], true );
      $product_image_gallery = get_post_meta($_POST['pid'], '_product_image_gallery', true);
      $product_image_gallery = str_replace($_POST['aid'], '', $product_image_gallery);
      $product_image_gallery = $this->sanitize_gallery_field($product_image_gallery);
      update_post_meta( $_POST['pid'], '_product_image_gallery',  $product_image_gallery);
    } elseif($_POST['type'] == 'order' && $_POST['pid'] && $_POST['aid']) {
      $this->set_attachments($_POST['aid'], $_POST['pid'], $_POST['order'], false, $_POST['is_thumb']);
    }

    wp_die();
  }

  public function get_media_data($id) {
    $product = get_post($id);
    $thumbnail_id = get_post_meta($product->ID, '_thumbnail_id', true);
    $out_media = '';
    $out_gallery = '';
    if($thumbnail_id) {
      $this->orders = 1;
      $image_gallery = get_post_meta($product->ID, '_product_image_gallery', true);
      if($image_gallery) {
        $image_gallery = $this->sanitize_gallery_field($image_gallery);
        $exp_image_gallery = explode(',', $image_gallery);
        $this->orders += count($exp_image_gallery);
        $order = 2;
        foreach ($exp_image_gallery as $image_id) {
          $out_gallery .= $this->out_media_item($product->ID, $image_id, $order);
          $order++;
        }
      }
      $out_media .= $this->out_media_item($product->ID, $thumbnail_id, 1, true);
      $out_media .= $out_gallery;
    }
    $data = array(
      'id' => $id,
      'title' => $product->post_title,
      'out_media' => $out_media,
      'display_order' => $this->display_order(),
    );

    return $data;
  }

  public function download_image_to_wp_media_library($file_array, $post_id) {

    require_once ABSPATH . 'wp-admin/includes/image.php';
    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/media.php';

    $desc = get_the_title($post_id);

    $attachment_id = media_handle_sideload( $file_array, $post_id, $desc );

    if ( is_wp_error($attachment_id) ) {
      @unlink($file_array['tmp_name']);
      return false;
    }else {
      return $attachment_id;
    }

  }

  public function set_attachments($attach_id, $product_id, $order = false, $is_new = true, $is_thumb = false) {
      //$images = array_unique($images);
      if(!has_post_thumbnail($product_id)) {
        set_post_thumbnail( $product_id, $attach_id );
      } else {
        //$images = implode(',', $images);
        if($order == 1) {
          $temp_tid = get_post_thumbnail_id($product_id);
          set_post_thumbnail( $product_id, $attach_id );
        }
        $product_image_gallery = get_post_meta($product_id, '_product_image_gallery', true);
        if($product_image_gallery) {
          $product_image_gallery = $this->sanitize_gallery_field($product_image_gallery);
          $exp_image_gallery = explode(',', $product_image_gallery);
          $count = count($exp_image_gallery);
          $order = $order - 2;
          if($order == $count) {
            $product_image_gallery .= ',' . $attach_id;
          } else {
            $new_gallery = $exp_image_gallery;
            if($is_new) {
              if($order == -1) {
                for ($i = $order; $i < $count; $i++) {
                  if($i == -1) {
                    $new_gallery[$i+1] = $temp_tid;
                  } else {
                    $new_gallery[$i+1] = $exp_image_gallery[$i];
                  }
                }
              } else {
                for ($i = $order; $i < $count; $i++) {
                  $new_gallery[$i+1] = $exp_image_gallery[$i];
                }
                $new_gallery[$order] = $attach_id;
              }
            } else {
              if($order == -1) {
                $old_order = array_search($attach_id, $exp_image_gallery);
                unset($exp_image_gallery[$old_order]);
                $exp_image_gallery = array_values($exp_image_gallery);
                $count = $count - 1;
                $new_gallery[0] = $temp_tid;
                for ($i = 0; $i < $count; $i++) {
                  $new_gallery[$i+1] = $exp_image_gallery[$i];
                }
              } else {
                if($is_thumb == 'yes') {
                  $temp_tid = get_post_thumbnail_id($product_id);
                  set_post_thumbnail( $product_id, $exp_image_gallery[0] );
                  array_shift($exp_image_gallery);
                  $count = $count - 1;
                  for ($i = 0, $j = 0; $i < $count; $i++, $j++) {
                    if($i == $order) {
                      $new_gallery[$i] = $temp_tid;
                      $new_gallery[$i+1] = $exp_image_gallery[$i];
                      $j++;
                    } else {
                      $new_gallery[$j] = $exp_image_gallery[$i];
                    }
                    if($order == $count) {
                      $new_gallery[$order] = $temp_tid;
                    }
                  }
                } else {
                  $old_order = array_search($attach_id, $exp_image_gallery);
                  if($order > $old_order) {
                    for ($i = $old_order; $i < $count; $i++) {
                      if($i == $order) {
                        $new_gallery[$i] = $attach_id;
                        break;
                      } else {
                        $new_gallery[$i] = $exp_image_gallery[$i+1];
                      }
                    }
                  } else {
                    $temp_id = $exp_image_gallery[$order];
                    for ($i = $order; $i < $count; $i++) {
                      if($i == $order) {
                        $new_gallery[$i] = $attach_id;
                      } elseif($i == $order+1) {
                        $new_gallery[$i] = $temp_id;
                      } else {
                        $new_gallery[$i] = $exp_image_gallery[$i-1];
                      }
                    }
                  }
                }
              }
            }
            $product_image_gallery = implode(',', $new_gallery);
          }
        } else {
          if($order == 1) {
            $product_image_gallery = $temp_tid;
          } else {
            $product_image_gallery = $attach_id;
          }
        }
        update_post_meta( $product_id, '_product_image_gallery',  $product_image_gallery);
      }
  }

  public function update_attachment($new_attach_id, $product_id, $old_attach_id, $is_thumb) {
    wp_delete_attachment( $old_attach_id, true );
    if($is_thumb == 'yes') {
      set_post_thumbnail( $product_id, $new_attach_id );
    } else {
      $product_image_gallery = get_post_meta($product_id, '_product_image_gallery', true);
      if($product_image_gallery) {
        $product_image_gallery = $this->sanitize_gallery_field($product_image_gallery);
        $product_image_gallery = str_replace($old_attach_id, $new_attach_id, $product_image_gallery);
      } else {
        $product_image_gallery = $new_attach_id;
      }
      update_post_meta( $product_id, '_product_image_gallery',  $product_image_gallery);
    }
  }

  public function sanitize_gallery_field($string) {
    $string = preg_split('/[\s,]+/', $string);
    $string = array_filter($string);
    $string = array_unique($string);
    return implode(',', $string);
  }

  public function out_media_item($pid, $aid, $order, $is_thumb = false) {
    $out = '
      <div class="col-media" data-aid="'.$aid.'" data-is_thumb="'.($is_thumb ? 'yes' : 'no').'">
          <h6>PHOTO #'.$order.'</h6>
          <div class="cell-media">
              <div class="media-image">
                  <a href="'.wp_get_attachment_image_url($aid, 'full').'" target="_blank">'.wp_get_attachment_image($aid, 'dashboard-media').'</a>
              </div>
              <div class="media-actions">
                  '.$this->display_order($order, 2).'
                  <button class="dropSelect dropChange">Change</button>
                  <button class="dropUpload">Upload</button>
                  <button class="dropCancel btn-delete">Cancel</button>
                  <button class="dropDelete btn-delete modal-popup-link" data-href="#popup-confirm">Delete</button>
              </div>
          </div>
      </div>';

    return $out;
  }

  public function display_order($corder = false, $min = 1) {
    if($this->orders < $min) return;
    $order = $this->orders + 1;
    if(!$corder) {
      $corder = $order;
      $order += 1;
    }
    $display_order = '<select class="dropOrder">';
    for ($i = 1; $i < $order; $i++) {
      $display_order .= '<option'.($corder == $i ? " selected" : "").' value="'.$i.'">Position #'.$i.'</option>';
    }
    $display_order .= '</select>';

    return $display_order;
  }
}