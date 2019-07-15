<?php
$data = $vars['data'];
//print_r($data);
/*echo '<pre>';
print_r($vars);
echo '</pre>';*/
?>
<div class="media-head">
    <h1><?php echo $data['title']; ?></h1>
    <label><a href="<?php echo get_home_url(null, '/breeder-dashboard/puppies/edit/'.$vars['path_id']); ?>">Edit <?php echo $vars['type'] == 'puppies' ? 'puppy' : 'parent'; ?></a></label>
</div>
<div class="drop-photos">
    <h2>Photos</h2>
    <div class="dropUpload-holder">
        <button class="dropSelect dropSelectImage">Select image</button>
    </div>
    <div class="dropzone" id="frmDropzone" data-pid="<?php echo $data['id']; ?>" data-mime="image"></div>
    <div id="previews_photo" class="media-previews">
        <div id="template_photo">
            <div class="preview">
                <img data-dz-thumbnail>
            </div>
            <div>
                <p>Name: <span data-dz-name></span></p>
                <strong class="error" data-dz-errormessage></strong>
                <p>Size: <span data-dz-size></span></p>
                <?php if($data['display_order']) { ?>
                    <p class="ordering">Display Order: <?php echo $data['display_order']; ?></p>
                <?php } ?>
                <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                    <div class="progress-bar" data-dz-uploadprogress=""></div>
                </div>
                <div class="actions">
                    <button class="dropUpload">Upload</button>
                    <button data-dz-remove class="dropCancel btn-delete">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row-media">
        <?php echo $data['out_media']; ?>
    </div>
</div>
<?php /*if($vars['type'] == 'puppies') { ?>
<div class="drop-video" id="section-video">
    <h2>Video</h2>
    <div class="dropUpload-holder"<?php echo $data['out_media_video'] ? ' style="display:none;"' : '';  ?>>
        <button class="dropSelect dropSelectVideo">Select video</button>
    </div>
    <div class="dropzone" id="frmDropzoneVideo" data-pid="<?php echo $data['id']; ?>" data-mime="video"<?php echo $data['out_media_video'] ? ' style="display:none;"' : '';  ?>></div>
    <div id="previews_video" class="media-previews">
        <div id="template_video">
            <div class="preview">
                <img data-dz-thumbnail>
            </div>
            <div>
                <p>Name: <span data-dz-name></span></p>
                <strong class="error" data-dz-errormessage></strong>
                <p>Size: <span data-dz-size></span></p>
                <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                    <div class="progress-bar" data-dz-uploadprogress=""></div>
                </div>
                <div class="actions">
                    <button class="dropUpload">Upload</button>
                    <button data-dz-remove class="dropCancel btn-delete">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row-media">
      <?php echo $data['out_media_video']; ?>
    </div>
</div>
<?php } */ ?>
