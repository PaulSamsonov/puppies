<?php
$data = $vars['data'];
//print_r($data);
/*echo '<pre>';
print_r($vars);
echo '</pre>';*/
?>
<h1><?php echo $data['title']; ?></h1>
<h2>Add Photos</h2>
<div class="dropUpload-holder">
    <button class="dropSelect">Select image</button>
</div>
<div class="dropzone" id="frmDropzone" data-pid="<?php echo $data['id']; ?>"></div>
<div id="previews">
    <div id="template">
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