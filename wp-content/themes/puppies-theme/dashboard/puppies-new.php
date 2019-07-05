<?php
$data = $vars['data'];
/*echo '<pre>';
print_r($vars['data']);
echo '</pre>';*/
?>
<h1><?php echo ($vars['action'] == 'edit') ? 'Edit' : 'Create'; ?> Puppy</h1>
<form enctype="multipart/form-data" action="" accept-charset="utf-8" method="post">
    <div class="row">
        <div class="col col-50">
            <div class="form-group">
                <label for="form_name">Puppy's Name*</label>
                <input required class="form-control" name="PetName" type="text" id="form_name" value="<?php echo $data['PetName']; ?>">
                <a class="modal-popup-link puppyNames" href="#popup-puppynames">View Sample Puppy Names</a>
            </div>
        </div>
        <div class="col col-50">
            <div class="form-group">
                <label>Gender*</label><br>
                <label class="radio-inline">
                    <input required name="Gender" value="Male" type="radio"<?php echo ($data['Gender'] && $data['Gender'] == 'Female') ? '' : ' checked'; ?>> Male
                </label>
                <label class="radio-inline">
                    <input required name="Gender" value="Female" type="radio"<?php echo ($data['Gender'] && $data['Gender'] == 'Female') ? ' checked' : ''; ?>> Female
                </label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col col-50">
            <div class="form-group">
                <label for="form_birthdate">Birthdate*</label>
                <div class="input-group date">
                    <input required autocomplete="off" class="datepicker" name="BirthDate" type="text" id="form_birthdate" value="<?php echo $data['BirthDate']; ?>"><span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col col-50">
            <div class="form-group">
                <label>Breed*</label>
                <select class="form-control select-search" required name="BreedName">
                    <option></option>
                    <?php
                      $categories = get_categories(array(
                        'taxonomy' => 'product_cat',
                        'child_of' => BREEDS_CATEGORY_ID,
                        'hide_empty' => false,
                      ));
                      if ($categories) {
                        foreach ($categories as $cat) {
                          echo '<option'.($cat->name == $data["BreedName"] ? " selected" : "").'>' . $cat->name . '</option>';
                        }
                      }
                    ?>
                </select>
            </div>
        </div>
        <div class="col col-50">
            <div class="form-group">
                <label>Puppy Color*</label>
                <select required class="form-control select-search" name="Coloring">
                    <option<?php if($data['Coloring'] == 'Agouti & White') echo ' selected'; ?>>Agouti & White</option>
                    <option<?php if($data['Coloring'] == 'Apricot') echo ' selected'; ?>>Apricot</option>
                    <option<?php if($data['Coloring'] == 'Apricot & White') echo ' selected'; ?>>Apricot & White</option>
                    <option<?php if($data['Coloring'] == 'Apricot Fawn') echo ' selected'; ?>>Apricot Fawn</option>
                    <option<?php if($data['Coloring'] == 'Beaver') echo ' selected'; ?>>Beaver</option>
                    <option<?php if($data['Coloring'] == 'Beaver Sable') echo ' selected'; ?>>Beaver Sable</option>
                    <option<?php if($data['Coloring'] == 'Beige') echo ' selected'; ?>>Beige</option>
                    <option<?php if($data['Coloring'] == 'Bi') echo ' selected'; ?>>Bi</option>
                    <option<?php if($data['Coloring'] == 'Bi-Color') echo ' selected'; ?>>Bi-Color</option>
                    <option<?php if($data['Coloring'] == 'Black') echo ' selected'; ?>>Black</option>
                    <option<?php if($data['Coloring'] == 'Black & Apricot') echo ' selected'; ?>>Black & Apricot</option>
                    <option<?php if($data['Coloring'] == 'Black & Brindle') echo ' selected'; ?>>Black & Brindle</option>
                    <option<?php if($data['Coloring'] == 'Black & Brown') echo ' selected'; ?>>Black & Brown</option>
                    <option<?php if($data['Coloring'] == 'Black & Cream') echo ' selected'; ?>>Black & Cream</option>
                    <option<?php if($data['Coloring'] == 'Black & Fawn') echo ' selected'; ?>>Black & Fawn</option>
                    <option<?php if($data['Coloring'] == 'Black & Gold') echo ' selected'; ?>>Black & Gold</option>
                    <option<?php if($data['Coloring'] == 'Black & Gray') echo ' selected'; ?>>Black & Gray</option>
                    <option<?php if($data['Coloring'] == 'Black & Mahogany') echo ' selected'; ?>>Black & Mahogany</option>
                    <option<?php if($data['Coloring'] == 'Black & Red') echo ' selected'; ?>>Black & Red</option>
                    <option<?php if($data['Coloring'] == 'Black & Rust') echo ' selected'; ?>>Black & Rust</option>
                    <option<?php if($data['Coloring'] == 'Black & Silver') echo ' selected'; ?>>Black & Silver</option>
                    <option<?php if($data['Coloring'] == 'Black & Silver Brindle') echo ' selected'; ?>>Black & Silver Brindle</option>
                    <option<?php if($data['Coloring'] == 'Black & Tan') echo ' selected'; ?>>Black & Tan</option>
                    <option<?php if($data['Coloring'] == 'Black & Tan Brindle') echo ' selected'; ?>>Black & Tan Brindle</option>
                    <option<?php if($data['Coloring'] == 'Black & Tan Merle') echo ' selected'; ?>>Black & Tan Merle</option>
                    <option<?php if($data['Coloring'] == 'Black & White') echo ' selected'; ?>>Black & White</option>
                    <option<?php if($data['Coloring'] == 'Black and White Piebald') echo ' selected'; ?>>Black and White Piebald</option>
                    <option<?php if($data['Coloring'] == 'Black Brindle') echo ' selected'; ?>>Black Brindle</option>
                    <option<?php if($data['Coloring'] == 'Black Brindle & White') echo ' selected'; ?>>Black Brindle & White</option>
                    <option<?php if($data['Coloring'] == 'Black Sabled Fawn') echo ' selected'; ?>>Black Sabled Fawn</option>
                    <option<?php if($data['Coloring'] == 'Black Sabled Silver') echo ' selected'; ?>>Black Sabled Silver</option>
                    <option<?php if($data['Coloring'] == 'Black, Brindle & White') echo ' selected'; ?>>Black, Brindle & White</option>
                    <option<?php if($data['Coloring'] == 'Black, Fawn & White') echo ' selected'; ?>>Black, Fawn & White</option>
                    <option<?php if($data['Coloring'] == 'Black, Gold & Silver') echo ' selected'; ?>>Black, Gold & Silver</option>
                    <option<?php if($data['Coloring'] == 'Black, Gold & White') echo ' selected'; ?>>Black, Gold & White</option>
                    <option<?php if($data['Coloring'] == 'Black, Gray & White') echo ' selected'; ?>>Black, Gray & White</option>
                    <option<?php if($data['Coloring'] == 'Black, Red & White') echo ' selected'; ?>>Black, Red & White</option>
                    <option<?php if($data['Coloring'] == 'Black, Silver & Tan') echo ' selected'; ?>>Black, Silver & Tan</option>
                    <option<?php if($data['Coloring'] == 'Black, Tan & Bluetick') echo ' selected'; ?>>Black, Tan & Bluetick</option>
                    <option<?php if($data['Coloring'] == 'Black, Tan & Redtick') echo ' selected'; ?>>Black, Tan & Redtick</option>
                    <option<?php if($data['Coloring'] == 'Black, Tan & White') echo ' selected'; ?>>Black, Tan & White</option>
                    <option<?php if($data['Coloring'] == 'Black, White & Silver') echo ' selected'; ?>>Black, White & Silver</option>
                    <option<?php if($data['Coloring'] == 'Black, White & Tan') echo ' selected'; ?>>Black, White & Tan</option>
                    <option<?php if($data['Coloring'] == 'Blenheim') echo ' selected'; ?>>Blenheim</option>
                    <option<?php if($data['Coloring'] == 'Blue') echo ' selected'; ?>>Blue</option>
                    <option<?php if($data['Coloring'] == 'Blue & Cream') echo ' selected'; ?>>Blue & Cream</option>
                    <option<?php if($data['Coloring'] == 'Blue & Gold') echo ' selected'; ?>>Blue & Gold</option>
                    <option<?php if($data['Coloring'] == 'Blue & Rust') echo ' selected'; ?>>Blue & Rust</option>
                    <option<?php if($data['Coloring'] == 'Blue & Tan') echo ' selected'; ?>>Blue & Tan</option>
                    <option<?php if($data['Coloring'] == 'Blue & White') echo ' selected'; ?>>Blue & White</option>
                    <option<?php if($data['Coloring'] == 'Blue & White Pied') echo ' selected'; ?>>Blue & White Pied</option>
                    <option<?php if($data['Coloring'] == 'Blue Brindle') echo ' selected'; ?>>Blue Brindle</option>
                    <option<?php if($data['Coloring'] == 'Blue Brindled Fawn') echo ' selected'; ?>>Blue Brindled Fawn</option>
                    <option<?php if($data['Coloring'] == 'Blue Fawn') echo ' selected'; ?>>Blue Fawn</option>
                    <option<?php if($data['Coloring'] == 'Blue Fawn & White') echo ' selected'; ?>>Blue Fawn & White</option>
                    <option<?php if($data['Coloring'] == 'Blue Fawn Brindle') echo ' selected'; ?>>Blue Fawn Brindle</option>
                    <option<?php if($data['Coloring'] == 'Blue Leopard') echo ' selected'; ?>>Blue Leopard</option>
                    <option<?php if($data['Coloring'] == 'Blue Merle') echo ' selected'; ?>>Blue Merle</option>
                    <option<?php if($data['Coloring'] == 'Blue Merle & White') echo ' selected'; ?>>Blue Merle & White</option>
                    <option<?php if($data['Coloring'] == 'Blue Merle, White & Tan') echo ' selected'; ?>>Blue Merle, White & Tan</option>
                    <option<?php if($data['Coloring'] == 'Blue Mottled') echo ' selected'; ?>>Blue Mottled</option>
                    <option<?php if($data['Coloring'] == 'Blue Roan') echo ' selected'; ?>>Blue Roan</option>
                    <option<?php if($data['Coloring'] == 'Blue Roan & Tan') echo ' selected'; ?>>Blue Roan & Tan</option>
                    <option<?php if($data['Coloring'] == 'Blue Sable') echo ' selected'; ?>>Blue Sable</option>
                    <option<?php if($data['Coloring'] == 'Blue Speckled') echo ' selected'; ?>>Blue Speckled</option>
                    <option<?php if($data['Coloring'] == 'Blue Stag Red') echo ' selected'; ?>>Blue Stag Red</option>
                    <option<?php if($data['Coloring'] == 'Blue, Tan & White') echo ' selected'; ?>>Blue, Tan & White</option>
                    <option<?php if($data['Coloring'] == 'Brindle') echo ' selected'; ?>>Brindle</option>
                    <option<?php if($data['Coloring'] == 'Brindle & White') echo ' selected'; ?>>Brindle & White</option>
                    <option<?php if($data['Coloring'] == 'Brindle Merle & White') echo ' selected'; ?>>Brindle Merle & White</option>
                    <option<?php if($data['Coloring'] == 'Bronze') echo ' selected'; ?>>Bronze</option>
                    <option<?php if($data['Coloring'] == 'Bronze & White') echo ' selected'; ?>>Bronze & White</option>
                    <option<?php if($data['Coloring'] == 'Brown') echo ' selected'; ?>>Brown</option>
                    <option<?php if($data['Coloring'] == 'Brown & White') echo ' selected'; ?>>Brown & White</option>
                    <option<?php if($data['Coloring'] == 'Brown Brindle') echo ' selected'; ?>>Brown Brindle</option>
                    <option<?php if($data['Coloring'] == 'Brown, Black & White') echo ' selected'; ?>>Brown, Black & White</option>
                    <option<?php if($data['Coloring'] == 'Brown, Black Overlay') echo ' selected'; ?>>Brown, Black Overlay</option>
                    <option<?php if($data['Coloring'] == 'Brown, White & Tan') echo ' selected'; ?>>Brown, White & Tan</option>
                    <option<?php if($data['Coloring'] == 'Buff') echo ' selected'; ?>>Buff</option>
                    <option<?php if($data['Coloring'] == 'Buff & White') echo ' selected'; ?>>Buff & White</option>
                    <option<?php if($data['Coloring'] == 'Cafe Au Lait') echo ' selected'; ?>>Cafe Au Lait</option>
                    <option<?php if($data['Coloring'] == 'Charcoal') echo ' selected'; ?>>Charcoal</option>
                    <option<?php if($data['Coloring'] == 'Chestnut') echo ' selected'; ?>>Chestnut</option>
                    <option<?php if($data['Coloring'] == 'Chestnut Brindle') echo ' selected'; ?>>Chestnut Brindle</option>
                    <option<?php if($data['Coloring'] == 'Chocolate') echo ' selected'; ?>>Chocolate</option>
                    <option<?php if($data['Coloring'] == 'Chocolate & Apricot') echo ' selected'; ?>>Chocolate & Apricot</option>
                    <option<?php if($data['Coloring'] == 'Chocolate & Cream') echo ' selected'; ?>>Chocolate & Cream</option>
                    <option<?php if($data['Coloring'] == 'Chocolate & Gold') echo ' selected'; ?>>Chocolate & Gold</option>
                    <option<?php if($data['Coloring'] == 'Chocolate & Rust') echo ' selected'; ?>>Chocolate & Rust</option>
                    <option<?php if($data['Coloring'] == 'Chocolate & Tan') echo ' selected'; ?>>Chocolate & Tan</option>
                    <option<?php if($data['Coloring'] == 'Chocolate & White') echo ' selected'; ?>>Chocolate & White</option>
                    <option<?php if($data['Coloring'] == 'Chocolate Blue') echo ' selected'; ?>>Chocolate Blue</option>
                    <option<?php if($data['Coloring'] == 'Chocolate Brindle') echo ' selected'; ?>>Chocolate Brindle</option>
                    <option<?php if($data['Coloring'] == 'Chocolate Brindled Fawn') echo ' selected'; ?>>Chocolate Brindled Fawn</option>
                    <option<?php if($data['Coloring'] == 'Chocolate Dapple') echo ' selected'; ?>>Chocolate Dapple</option>
                    <option<?php if($data['Coloring'] == 'Chocolate Merle') echo ' selected'; ?>>Chocolate Merle</option>
                    <option<?php if($data['Coloring'] == 'Chocolate Phantom') echo ' selected'; ?>>Chocolate Phantom</option>
                    <option<?php if($data['Coloring'] == 'Chocolate Roan & White') echo ' selected'; ?>>Chocolate Roan & White</option>
                    <option<?php if($data['Coloring'] == 'Chocolate Sable') echo ' selected'; ?>>Chocolate Sable</option>
                    <option<?php if($data['Coloring'] == 'Chocolate Sabled Fawn') echo ' selected'; ?>>Chocolate Sabled Fawn</option>
                    <option<?php if($data['Coloring'] == 'Chocolate Stag Red') echo ' selected'; ?>>Chocolate Stag Red</option>
                    <option<?php if($data['Coloring'] == 'Chocolate, White & Tan') echo ' selected'; ?>>Chocolate, White & Tan</option>
                    <option<?php if($data['Coloring'] == 'Cinnamon') echo ' selected'; ?>>Cinnamon</option>
                    <option<?php if($data['Coloring'] == 'Copper & White') echo ' selected'; ?>>Copper & White</option>
                    <option<?php if($data['Coloring'] == 'Cream') echo ' selected'; ?>>Cream</option>
                    <option<?php if($data['Coloring'] == 'Cream & White') echo ' selected'; ?>>Cream & White</option>
                    <option<?php if($data['Coloring'] == 'Cream Brindle') echo ' selected'; ?>>Cream Brindle</option>
                    <option<?php if($data['Coloring'] == 'Cream Sable') echo ' selected'; ?>>Cream Sable</option>
                    <option<?php if($data['Coloring'] == 'Dark Deadgrass') echo ' selected'; ?>>Dark Deadgrass</option>
                    <option<?php if($data['Coloring'] == 'Dark Golden') echo ' selected'; ?>>Dark Golden</option>
                    <option<?php if($data['Coloring'] == 'Deadgrass') echo ' selected'; ?>>Deadgrass</option>
                    <option<?php if($data['Coloring'] == 'English Cream') echo ' selected'; ?>>English Cream</option>
                    <option<?php if($data['Coloring'] == 'Fawn') echo ' selected'; ?>>Fawn</option>
                    <option<?php if($data['Coloring'] == 'Fawn (Isabella) Cream') echo ' selected'; ?>>Fawn (Isabella) Cream</option>
                    <option<?php if($data['Coloring'] == 'Fawn (Isabella) & Rust') echo ' selected'; ?>>Fawn (Isabella) & Rust</option>
                    <option<?php if($data['Coloring'] == 'Fawn (Isabella) & Tan') echo ' selected'; ?>>Fawn (Isabella) & Tan</option>
                    <option<?php if($data['Coloring'] == 'Fawn (Isabella) Stag Red') echo ' selected'; ?>>Fawn (Isabella) Stag Red</option>
                    <option<?php if($data['Coloring'] == 'Fawn & Black') echo ' selected'; ?>>Fawn & Black</option>
                    <option<?php if($data['Coloring'] == 'Fawn & Brindle') echo ' selected'; ?>>Fawn & Brindle</option>
                    <option<?php if($data['Coloring'] == 'Fawn & Rust') echo ' selected'; ?>>Fawn & Rust</option>
                    <option<?php if($data['Coloring'] == 'Fawn & White') echo ' selected'; ?>>Fawn & White</option>
                    <option<?php if($data['Coloring'] == 'Fawn Brindle') echo ' selected'; ?>>Fawn Brindle</option>
                    <option<?php if($data['Coloring'] == 'Fawn Brindle & White') echo ' selected'; ?>>Fawn Brindle & White</option>
                    <option<?php if($data['Coloring'] == 'Fawn Brindled Black') echo ' selected'; ?>>Fawn Brindled Black</option>
                    <option<?php if($data['Coloring'] == 'Fawn Sable') echo ' selected'; ?>>Fawn Sable</option>
                    <option<?php if($data['Coloring'] == 'Fawn, Black Overlay') echo ' selected'; ?>>Fawn, Black Overlay</option>
                    <option<?php if($data['Coloring'] == 'Fawnequin') echo ' selected'; ?>>Fawnequin</option>
                    <option<?php if($data['Coloring'] == 'Flashy Brindle') echo ' selected'; ?>>Flashy Brindle</option>
                    <option<?php if($data['Coloring'] == 'Flashy Fawn') echo ' selected'; ?>>Flashy Fawn</option>
                    <option<?php if($data['Coloring'] == 'Fox Red') echo ' selected'; ?>>Fox Red</option>
                    <option<?php if($data['Coloring'] == 'Gold') echo ' selected'; ?>>Gold</option>
                    <option<?php if($data['Coloring'] == 'Gold & White') echo ' selected'; ?>>Gold & White</option>
                    <option<?php if($data['Coloring'] == 'Gold Brindle') echo ' selected'; ?>>Gold Brindle</option>
                    <option<?php if($data['Coloring'] == 'Gold Sable') echo ' selected'; ?>>Gold Sable</option>
                    <option<?php if($data['Coloring'] == 'Gold Sable & White') echo ' selected'; ?>>Gold Sable & White</option>
                    <option<?php if($data['Coloring'] == 'Golden') echo ' selected'; ?>>Golden</option>
                    <option<?php if($data['Coloring'] == 'Golden Rust') echo ' selected'; ?>>Golden Rust</option>
                    <option<?php if($data['Coloring'] == 'Gray') echo ' selected'; ?>>Gray</option>
                    <option<?php if($data['Coloring'] == 'Gray & Black') echo ' selected'; ?>>Gray & Black</option>
                    <option<?php if($data['Coloring'] == '>Gray & White') echo ' selected'; ?>>Gray & White</option>
                    <option<?php if($data['Coloring'] == 'Gray Brindle') echo ' selected'; ?>>Gray Brindle</option>
                    <option<?php if($data['Coloring'] == 'Gray Sable') echo ' selected'; ?>>Gray Sable</option>
                    <option<?php if($data['Coloring'] == 'Grizzle') echo ' selected'; ?>>Grizzle</option>
                    <option<?php if($data['Coloring'] == 'Grizzle & Tan') echo ' selected'; ?>>Grizzle & Tan</option>
                    <option<?php if($data['Coloring'] == 'Harlequin') echo ' selected'; ?>>Harlequin</option>
                    <option<?php if($data['Coloring'] == 'Honey Pied') echo ' selected'; ?>>Honey Pied</option>
                    <option<?php if($data['Coloring'] == 'Isabella') echo ' selected'; ?>>Isabella</option>
                    <option<?php if($data['Coloring'] == 'Lavender') echo ' selected'; ?>>Lavender</option>
                    <option<?php if($data['Coloring'] == 'Lavender & White') echo ' selected'; ?>>Lavender & White</option>
                    <option<?php if($data['Coloring'] == 'Lemon') echo ' selected'; ?>>Lemon</option>
                    <option<?php if($data['Coloring'] == 'Lemon & White') echo ' selected'; ?>>Lemon & White</option>
                    <option<?php if($data['Coloring'] == 'Light Deadgrass') echo ' selected'; ?>>Light Deadgrass</option>
                    <option<?php if($data['Coloring'] == 'Light Golden') echo ' selected'; ?>>Light Golden</option>
                    <option<?php if($data['Coloring'] == 'Lilac') echo ' selected'; ?>>Lilac</option>
                    <option<?php if($data['Coloring'] == 'Lilac & White') echo ' selected'; ?>>Lilac & White</option>
                    <option<?php if($data['Coloring'] == 'Liver') echo ' selected'; ?>>Liver</option>
                    <option<?php if($data['Coloring'] == 'Liver & Tan') echo ' selected'; ?>>Liver & Tan</option>
                    <option<?php if($data['Coloring'] == 'Liver & White') echo ' selected'; ?>>Liver & White</option>
                    <option<?php if($data['Coloring'] == 'Liver & White, Blue Factored') echo ' selected'; ?>>Liver & White, Blue Factored</option>
                    <option<?php if($data['Coloring'] == 'Liver Brindle') echo ' selected'; ?>>Liver Brindle</option>
                    <option<?php if($data['Coloring'] == 'Liver Merle') echo ' selected'; ?>>Liver Merle</option>
                    <option<?php if($data['Coloring'] == 'Liver Pepper') echo ' selected'; ?>>Liver Pepper</option>
                    <option<?php if($data['Coloring'] == 'Liver, White & Tan') echo ' selected'; ?>>Liver, White & Tan</option>
                    <option<?php if($data['Coloring'] == 'Mahogany') echo ' selected'; ?>>Mahogany</option>
                    <option<?php if($data['Coloring'] == 'Mahogany & White') echo ' selected'; ?>>Mahogany & White</option>
                    <option<?php if($data['Coloring'] == 'Mantle') echo ' selected'; ?>>Mantle</option>
                    <option<?php if($data['Coloring'] == 'Mantle Merle') echo ' selected'; ?>>Mantle Merle</option>
                    <option<?php if($data['Coloring'] == 'Merle') echo ' selected'; ?>>Merle</option>
                    <option<?php if($data['Coloring'] == 'Merlequin') echo ' selected'; ?>>Merlequin</option>
                    <option<?php if($data['Coloring'] == 'Mustard') echo ' selected'; ?>>Mustard</option>
                    <option <?php if(!$data['Coloring']) echo ' selected'; ?>>Not Specified</option>
                    <option<?php if($data['Coloring'] == 'Orange') echo ' selected'; ?>>Orange</option>
                    <option<?php if($data['Coloring'] == 'Orange & White') echo ' selected'; ?>>Orange & White</option>
                    <option<?php if($data['Coloring'] == 'Orange Sable') echo ' selected'; ?>>Orange Sable</option>
                    <option<?php if($data['Coloring'] == 'Orange Sable & White') echo ' selected'; ?>>Orange Sable & White</option>
                    <option<?php if($data['Coloring'] == 'Palomino') echo ' selected'; ?>>Palomino</option>
                    <option<?php if($data['Coloring'] == 'Pepper') echo ' selected'; ?>>Pepper</option>
                    <option<?php if($data['Coloring'] == 'Phantom') echo ' selected'; ?>>Phantom</option>
                    <option<?php if($data['Coloring'] == 'Pink') echo ' selected'; ?>>Pink</option>
                    <option<?php if($data['Coloring'] == 'Pink & Chocolate') echo ' selected'; ?>>Pink & Chocolate</option>
                    <option<?php if($data['Coloring'] == 'Pink & Slate') echo ' selected'; ?>>Pink & Slate</option>
                    <option<?php if($data['Coloring'] == 'Red') echo ' selected'; ?>>Red</option>
                    <option<?php if($data['Coloring'] == 'Red & Apricot') echo ' selected'; ?>>Red & Apricot</option>
                    <option<?php if($data['Coloring'] == 'Red & Rust') echo ' selected'; ?>>Red & Rust</option>
                    <option<?php if($data['Coloring'] == 'Red & Tan') echo ' selected'; ?>>Red & Tan</option>
                    <option<?php if($data['Coloring'] == 'Red & White') echo ' selected'; ?>>Red & White</option>
                    <option<?php if($data['Coloring'] == 'Red Brindle') echo ' selected'; ?>>Red Brindle</option>
                    <option<?php if($data['Coloring'] == 'Red Brindle & White') echo ' selected'; ?>>Red Brindle & White</option>
                    <option<?php if($data['Coloring'] == 'Red Dapple') echo ' selected'; ?>>Red Dapple</option>
                    <option<?php if($data['Coloring'] == 'Red Fawn') echo ' selected'; ?>>Red Fawn</option>
                    <option<?php if($data['Coloring'] == 'Red Fawn Brindle') echo ' selected'; ?>>Red Fawn Brindle</option>
                    <option<?php if($data['Coloring'] == 'Red Gold') echo ' selected'; ?>>Red Gold</option>
                    <option<?php if($data['Coloring'] == 'Red Golden') echo ' selected'; ?>>Red Golden</option>
                    <option<?php if($data['Coloring'] == 'Red Leopard') echo ' selected'; ?>>Red Leopard</option>
                    <option<?php if($data['Coloring'] == 'Red Merle') echo ' selected'; ?>>Red Merle</option>
                    <option<?php if($data['Coloring'] == 'Red Merle & White') echo ' selected'; ?>>Red Merle & White</option>
                    <option<?php if($data['Coloring'] == 'Red Mottled') echo ' selected'; ?>>Red Mottled</option>
                    <option<?php if($data['Coloring'] == 'Red Roan') echo ' selected'; ?>>Red Roan</option>
                    <option<?php if($data['Coloring'] == 'Red Sable') echo ' selected'; ?>>Red Sable</option>
                    <option<?php if($data['Coloring'] == 'Red Sable & White') echo ' selected'; ?>>Red Sable & White</option>
                    <option<?php if($data['Coloring'] == 'Red Sable Blue Factored') echo ' selected'; ?>>Red Sable Blue Factored</option>
                    <option<?php if($data['Coloring'] == 'Red Sesame') echo ' selected'; ?>>Red Sesame</option>
                    <option<?php if($data['Coloring'] == 'Red Speckled') echo ' selected'; ?>>Red Speckled</option>
                    <option<?php if($data['Coloring'] == 'Red Tri') echo ' selected'; ?>>Red Tri</option>
                    <option<?php if($data['Coloring'] == 'Red Wheaten') echo ' selected'; ?>>Red Wheaten</option>
                    <option<?php if($data['Coloring'] == 'Red, Black Overlay') echo ' selected'; ?>>Red, Black Overlay</option>
                    <option<?php if($data['Coloring'] == 'Reverse Brindle') echo ' selected'; ?>>Reverse Brindle</option>
                    <option<?php if($data['Coloring'] == 'Reverse Flashy Brindle') echo ' selected'; ?>>Reverse Flashy Brindle</option>
                    <option<?php if($data['Coloring'] == 'Ruby') echo ' selected'; ?>>Ruby</option>
                    <option<?php if($data['Coloring'] == 'Rust') echo ' selected'; ?>>Rust</option>
                    <option<?php if($data['Coloring'] == 'Rust Golden') echo ' selected'; ?>>Rust Golden</option>
                    <option<?php if($data['Coloring'] == 'Sable') echo ' selected'; ?>>Sable</option>
                    <option<?php if($data['Coloring'] == 'Sable & White') echo ' selected'; ?>>Sable & White</option>
                    <option<?php if($data['Coloring'] == 'Sable Merle') echo ' selected'; ?>>Sable Merle</option>
                    <option<?php if($data['Coloring'] == 'Sable Merle & White') echo ' selected'; ?>>Sable Merle & White</option>
                    <option<?php if($data['Coloring'] == 'Sable Piebald') echo ' selected'; ?>>Sable Piebald</option>
                    <option<?php if($data['Coloring'] == 'Salt') echo ' selected'; ?>>Salt</option>
                    <option<?php if($data['Coloring'] == 'Salt & Pepper') echo ' selected'; ?>>Salt & Pepper</option>
                    <option<?php if($data['Coloring'] == 'Sandy') echo ' selected'; ?>>Sandy</option>
                    <option<?php if($data['Coloring'] == 'Sandy Yellow') echo ' selected'; ?>>Sandy Yellow</option>
                    <option<?php if($data['Coloring'] == 'Seal') echo ' selected'; ?>>Seal</option>
                    <option<?php if($data['Coloring'] == 'Seal & White') echo ' selected'; ?>>Seal & White</option>
                    <option<?php if($data['Coloring'] == 'Seal Brown') echo ' selected'; ?>>Seal Brown</option>
                    <option<?php if($data['Coloring'] == 'Seal, Brindle & White') echo ' selected'; ?>>Seal, Brindle & White</option>
                    <option<?php if($data['Coloring'] == 'Sedge') echo ' selected'; ?>>Sedge</option>
                    <option<?php if($data['Coloring'] == 'Shaded Cream') echo ' selected'; ?>>Shaded Cream</option>
                    <option<?php if($data['Coloring'] == 'Silver') echo ' selected'; ?>>Silver</option>
                    <option<?php if($data['Coloring'] == 'Silver & White') echo ' selected'; ?>>Silver & White</option>
                    <option<?php if($data['Coloring'] == 'Silver Beige') echo ' selected'; ?>>Silver Beige</option>
                    <option<?php if($data['Coloring'] == 'Silver Brindle') echo ' selected'; ?>>Silver Brindle</option>
                    <option<?php if($data['Coloring'] == 'Silver Dapple') echo ' selected'; ?>>Silver Dapple</option>
                    <option<?php if($data['Coloring'] == 'Silver Fawn') echo ' selected'; ?>>Silver Fawn</option>
                    <option<?php if($data['Coloring'] == 'Silver Gray') echo ' selected'; ?>>Silver Gray</option>
                    <option<?php if($data['Coloring'] == 'Silver Leopard') echo ' selected'; ?>>Silver Leopard</option>
                    <option<?php if($data['Coloring'] == 'Silver Sable') echo ' selected'; ?>>Silver Sable</option>
                    <option<?php if($data['Coloring'] == 'Silver, Black Overlay') echo ' selected'; ?>>Silver, Black Overlay</option>
                    <option<?php if($data['Coloring'] == 'Silver, Gold & White') echo ' selected'; ?>>Silver, Gold & White</option>
                    <option<?php if($data['Coloring'] == 'Slate') echo ' selected'; ?>>Slate</option>
                    <option<?php if($data['Coloring'] == 'Stag Red') echo ' selected'; ?>>Stag Red</option>
                    <option<?php if($data['Coloring'] == 'Tan') echo ' selected'; ?>>Tan</option>
                    <option<?php if($data['Coloring'] == 'Tan & Black') echo ' selected'; ?>>Tan & Black</option>
                    <option<?php if($data['Coloring'] == 'Tan & White') echo ' selected'; ?>>Tan & White</option>
                    <option<?php if($data['Coloring'] == 'Tawny') echo ' selected'; ?>>Tawny</option>
                    <option<?php if($data['Coloring'] == 'Tri') echo ' selected'; ?>>Tri</option>
                    <option<?php if($data['Coloring'] == 'Tri-Colored') echo ' selected'; ?>>Tri-Colored</option>
                    <option<?php if($data['Coloring'] == 'Unknown') echo ' selected'; ?>>Unknown</option>
                    <option<?php if($data['Coloring'] == 'Wheaten') echo ' selected'; ?>>Wheaten</option>
                    <option<?php if($data['Coloring'] == 'White') echo ' selected'; ?>>White</option>
                    <option<?php if($data['Coloring'] == 'White & Apricot') echo ' selected'; ?>>White & Apricot</option>
                    <option<?php if($data['Coloring'] == 'White & Badger') echo ' selected'; ?>>White & Badger</option>
                    <option<?php if($data['Coloring'] == 'White & Biscuit') echo ' selected'; ?>>White & Biscuit</option>
                    <option<?php if($data['Coloring'] == 'White & Black') echo ' selected'; ?>>White & Black</option>
                    <option<?php if($data['Coloring'] == 'White & Blue') echo ' selected'; ?>>White & Blue</option>
                    <option<?php if($data['Coloring'] == 'White & Blue Merle') echo ' selected'; ?>>White & Blue Merle</option>
                    <option<?php if($data['Coloring'] == 'White & Brindle') echo ' selected'; ?>>White & Brindle</option>
                    <option<?php if($data['Coloring'] == 'White & Chocolate') echo ' selected'; ?>>White & Chocolate</option>
                    <option<?php if($data['Coloring'] == 'White & Fawn') echo ' selected'; ?>>White & Fawn</option>
                    <option<?php if($data['Coloring'] == 'White & Liver') echo ' selected'; ?>>White & Liver</option>
                    <option<?php if($data['Coloring'] == 'White & Red') echo ' selected'; ?>>White & Red</option>
                    <option<?php if($data['Coloring'] == 'White & Red Merle') echo ' selected'; ?>>White & Red Merle</option>
                    <option<?php if($data['Coloring'] == 'White & Sable') echo ' selected'; ?>>White & Sable</option>
                    <option<?php if($data['Coloring'] == 'White & Sable Merle') echo ' selected'; ?>>White & Sable Merle</option>
                    <option<?php if($data['Coloring'] == 'White & Silver') echo ' selected'; ?>>White & Silver</option>
                    <option<?php if($data['Coloring'] == 'White & Tan') echo ' selected'; ?>>White & Tan</option>
                    <option<?php if($data['Coloring'] == 'White Merle') echo ' selected'; ?>>White Merle</option>
                    <option<?php if($data['Coloring'] == 'White Ticked') echo ' selected'; ?>>White Ticked</option>
                    <option<?php if($data['Coloring'] == '>White with Cream') echo ' selected'; ?>>White with Cream</option>
                    <option<?php if($data['Coloring'] == 'White, Black & Tan') echo ' selected'; ?>>White, Black & Tan</option>
                    <option<?php if($data['Coloring'] == 'White, Red Shading') echo ' selected'; ?>>White, Red Shading</option>
                    <option<?php if($data['Coloring'] == 'Wild Boar') echo ' selected'; ?>>Wild Boar</option>
                    <option<?php if($data['Coloring'] == 'Wolf Sable') echo ' selected'; ?>>Wolf Sable</option>
                    <option<?php if($data['Coloring'] == 'Yellow') echo ' selected'; ?>>Yellow</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col col-50">
            <div class="form-group">
                <label>Markings</label>
                <select class="form-control select-search" <?php /*onchange="javascript:displayHearingTest();"*/?> name="marking_id" id="form_marking_id">
                    <option"></option>
                    <option<?php if($data['marking_id'] == 'Apricot Markings') echo ' selected'; ?>>Apricot Markings</option>
                    <option<?php if($data['marking_id'] == 'Badger Marking') echo ' selected'; ?>>Badger Markings</option>
                    <option<?php if($data['marking_id'] == 'Black & Tan Markings') echo ' selected'; ?>>Black & Tan Markings</option>
                    <option<?php if($data['marking_id'] == 'Black Brindling') echo ' selected'; ?>>Black Brindling</option>
                    <option<?php if($data['marking_id'] == 'Black Markings') echo ' selected'; ?>>Black Markings</option>
                    <option<?php if($data['marking_id'] == 'Black Mask') echo ' selected'; ?>>Black Mask</option>
                    <option<?php if($data['marking_id'] == 'Black Mask & Ticked') echo ' selected'; ?>>Black Mask & Ticked</option>
                    <option<?php if($data['marking_id'] == 'Black Mask & White Markings') echo ' selected'; ?>>Black Mask & White Markings</option>
                    <option<?php if($data['marking_id'] == 'Black Mask With Tips') echo ' selected'; ?>>Black Mask With Tips</option>
                    <option<?php if($data['marking_id'] == 'Black Mask, Black Markings') echo ' selected'; ?>>Black Mask, Black Markings</option>
                    <option<?php if($data['marking_id'] == 'Black Mask, Brindle Markings') echo ' selected'; ?>>Black Mask, Brindle Markings</option>
                    <option<?php if($data['marking_id'] == 'Black Mask, Fawn Markings') echo ' selected'; ?>>Black Mask, Fawn Markings</option>
                    <option<?php if($data['marking_id'] == 'Black Mask, White Markings') echo ' selected'; ?>>Black Mask, White Markings</option>
                    <option<?php if($data['marking_id'] == 'Black Points') echo ' selected'; ?>>Black Points</option>
                    <option<?php if($data['marking_id'] == 'Black Sabling') echo ' selected'; ?>>Black Sabling</option>
                    <option<?php if($data['marking_id'] == 'Black Tips') echo ' selected'; ?>>Black Tips</option>
                    <option<?php if($data['marking_id'] == 'Blue Factored') echo ' selected'; ?>>Blue Factored</option>
                    <option<?php if($data['marking_id'] == 'Blue Fawn') echo ' selected'; ?>>Blue Fawn</option>
                    <option<?php if($data['marking_id'] == 'Blue Markings') echo ' selected'; ?>>Blue Markings</option>
                    <option<?php if($data['marking_id'] == 'Blue Mask') echo ' selected'; ?>>Blue Mask</option>
                    <option<?php if($data['marking_id'] == 'Blue Merle Markings') echo ' selected'; ?>>Blue Merle Markings</option>
                    <option<?php if($data['marking_id'] == 'Blue Patchwork') echo ' selected'; ?>>Blue Patchwork</option>
                    <option<?php if($data['marking_id'] == 'Blue Ticking') echo ' selected'; ?>>Blue Ticking</option>
                    <option<?php if($data['marking_id'] == 'Brindle') echo ' selected'; ?>>Brindle</option>
                    <option<?php if($data['marking_id'] == 'Brindle Domino') echo ' selected'; ?>>Brindle Domino</option>
                    <option<?php if($data['marking_id'] == 'Brindle Markings') echo ' selected'; ?>>Brindle Markings</option>
                    <option<?php if($data['marking_id'] == 'Brindle Piebald') echo ' selected'; ?>>Brindle Piebald</option>
                    <option<?php if($data['marking_id'] == 'Brindle Points') echo ' selected'; ?>>Brindle Points</option>
                    <option<?php if($data['marking_id'] == 'Brindle Points & Ticked') echo ' selected'; ?>>Brindle Points & Ticked</option>
                    <option<?php if($data['marking_id'] == 'Bronze Markings') echo ' selected'; ?>>Bronze Markings</option>
                    <option<?php if($data['marking_id'] == 'Brown Markings') echo ' selected'; ?>>Brown Markings</option>
                    <option<?php if($data['marking_id'] == 'Buff Markings') echo ' selected'; ?>>Buff Markings</option>
                    <option<?php if($data['marking_id'] == 'Chocolate Markings') echo ' selected'; ?>>Chocolate Markings</option>
                    <option<?php if($data['marking_id'] == 'Chocolate Mask') echo ' selected'; ?>>Chocolate Mask</option>
                    <option<?php if($data['marking_id'] == 'Chocolate Points') echo ' selected'; ?>>Chocolate Points</option>
                    <option<?php if($data['marking_id'] == 'Cream Markings') echo ' selected'; ?>>Cream Markings</option>
                    <option<?php if($data['marking_id'] == 'Dapple') echo ' selected'; ?>>Dapple</option>
                    <option<?php if($data['marking_id'] == 'Dapple Piebald') echo ' selected'; ?>>Dapple Piebald</option>
                    <option<?php if($data['marking_id'] == 'Domino') echo ' selected'; ?>>Domino</option>
                    <option<?php if($data['marking_id'] == 'Double Dapple') echo ' selected'; ?>>Double Dapple</option>
                    <option<?php if($data['marking_id'] == 'Fawn Markings') echo ' selected'; ?>>Fawn Markings</option>
                    <option<?php if($data['marking_id'] == 'Fawn Mask') echo ' selected'; ?>>Fawn Mask</option>
                    <option<?php if($data['marking_id'] == 'Gray Markings') echo ' selected'; ?>>Gray Markings</option>
                    <option<?php if($data['marking_id'] == 'Gray Mask') echo ' selected'; ?>>Gray Mask</option>
                    <option<?php if($data['marking_id'] == 'Irish Marked') echo ' selected'; ?>>Irish Marked</option>
                    <option<?php if($data['marking_id'] == 'Irish Pied') echo ' selected'; ?>>Irish Pied</option>
                    <option<?php if($data['marking_id'] == 'Merle Markings') echo ' selected'; ?>>Merle Markings</option>
                    <option<?php if($data['marking_id'] == 'No Marking') echo ' selected'; ?>>No Marking</option>
                    <option<?php if($data['marking_id'] == 'Orange Markings') echo ' selected'; ?>>Orange Markings</option>
                    <option<?php if($data['marking_id'] == 'Parti Belton') echo ' selected'; ?>>Parti Belton</option>
                    <option<?php if($data['marking_id'] == 'Parti-Color') echo ' selected'; ?>>Parti-Color</option>
                    <option<?php if($data['marking_id'] == 'Patched') echo ' selected'; ?>>Patched</option>
                    <option<?php if($data['marking_id'] == 'Phantom') echo ' selected'; ?>>Phantom</option>
                    <option<?php if($data['marking_id'] == 'Piebald') echo ' selected'; ?>>Piebald</option>
                    <option<?php if($data['marking_id'] == 'Piebald, Black Markings') echo ' selected'; ?>>Piebald, Black Markings</option>
                    <option<?php if($data['marking_id'] == 'Pinto') echo ' selected'; ?>>Pinto</option>
                    <option<?php if($data['marking_id'] == 'Red Markings') echo ' selected'; ?>>Red Markings</option>
                    <option<?php if($data['marking_id'] == 'Red Merl') echo ' selected'; ?>>Red Merle</option>
                    <option<?php if($data['marking_id'] == 'Red Patchwork') echo ' selected'; ?>>Red Patchwork</option>
                    <option<?php if($data['marking_id'] == 'Red Ticking') echo ' selected'; ?>>Red Ticking</option>
                    <option<?php if($data['marking_id'] == 'Roan') echo ' selected'; ?>>Roan</option>
                    <option<?php if($data['marking_id'] == 'Sable') echo ' selected'; ?>>Sable</option>
                    <option<?php if($data['marking_id'] == 'Sable & White Markings') echo ' selected'; ?>>Sable & White Markings</option>
                    <option<?php if($data['marking_id'] == 'Sable Markings') echo ' selected'; ?>>Sable Markings</option>
                    <option<?php if($data['marking_id'] == 'Sable Merle Markings') echo ' selected'; ?>>Sable Merle Markings</option>
                    <option<?php if($data['marking_id'] == 'Silver Markings') echo ' selected'; ?>>Silver Markings</option>
                    <option<?php if($data['marking_id'] == 'Silver Patchwor') echo ' selected'; ?>>Silver Patchwork</option>
                    <option<?php if($data['marking_id'] == 'Silver Points') echo ' selected'; ?>>Silver Points</option>
                    <option<?php if($data['marking_id'] == '5') echo ' selected'; ?>>Spotted</option>
                    <option<?php if($data['marking_id'] == '34') echo ' selected'; ?>>Spotted On White</option>
                    <option<?php if($data['marking_id'] == 'Spotted Or Patched') echo ' selected'; ?>>Spotted Or Patched</option>
                    <option<?php if($data['marking_id'] == 'Tan Markings') echo ' selected'; ?>>Tan Markings</option>
                    <option<?php if($data['marking_id'] == 'Tan Points') echo ' selected'; ?>>Tan Points</option>
                    <option<?php if($data['marking_id'] == 'Tan Points & Ticked') echo ' selected'; ?>>Tan Points & Ticked</option>
                    <option<?php if($data['marking_id'] == 'Ticked') echo ' selected'; ?>>Ticked</option>
                    <option<?php if($data['marking_id'] == 'Tri Color Markings') echo ' selected'; ?>>Tri Color Markings</option>
                    <option<?php if($data['marking_id'] == 'Wheaten Markings') echo ' selected'; ?>>Wheaten Markings</option>
                    <option<?php if($data['marking_id'] == 'White Marking, Brindle Points, Ticked') echo ' selected'; ?>>White Marking, Brindle Points, Ticked</option>
                    <option<?php if($data['marking_id'] == 'White Markings') echo ' selected'; ?>>White Markings</option>
                    <option<?php if($data['marking_id'] == 'White Markings & Tan Points') echo ' selected'; ?>>White Markings & Tan Points</option>
                    <option<?php if($data['marking_id'] == 'White Markings, Brindle Points') echo ' selected'; ?>>White Markings, Brindle Points</option>
                    <option<?php if($data['marking_id'] == 'White Markings, Tan Points') echo ' selected'; ?>>White Markings, Tan Points</option>
                    <option<?php if($data['marking_id'] == 'White Markings, Tan Points, Ticked') echo ' selected'; ?>>White Markings, Tan Points, Ticked</option>
                    <option<?php if($data['marking_id'] == 'White Markings, Ticked') echo ' selected'; ?>>White Markings, Ticked</option>
                    <option<?php if($data['marking_id'] == 'White Mask') echo ' selected'; ?>>White Mask</option>
                    <option<?php if($data['marking_id'] == 'Yellow Markings') echo ' selected'; ?>>Yellow Markings</option>
                </select>
            </div>
        </div>
        <div class="col col-50">
            <div class="form-group">
                <label for="asking_price">Your Asking Price*</label>
                <input required class="form-control" name="asking_price" type="text" id="asking_price" value="<?php echo $data['asking_price']; ?>">
                <div class="tooltip-content">
                    <a href="" class="close">×</a>
                    <strong>Your Asking Price:</strong>
                    <p>Base Price + Health Exam + Crate + Transportation Costs = Asking Price</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label>Are you willing to discount this puppy?</label><br>
                <label class="radio-inline">
                    <input class="form-control" required name="puppy_discount" value="Yes" type="radio"<?php echo $data['puppy_discount_amount'] ? ' checked' : ''; ?>> Yes
                </label>
                <label class="radio-inline">
                    <input class="form-control" required name="puppy_discount" value="No" type="radio"<?php echo $data['puppy_discount_amount'] ? '' : ' checked'; ?>> No
                </label>
                <div class="hidden-fields<?php echo $data['puppy_discount_amount'] ? ' display-field' : ''; ?>">
                    <div class="form-group">
                        <label for="puppy_discount_amount">How much of a discount are you willing to offer on this puppy?</label>
                        <input class="form-control" name="puppy_discount_amount" type="text" id="puppy_discount_amount" value="<?php echo $data['puppy_discount_amount']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="puppy_discount_reason">When are you willing to offer this discount?</label>
                        <input class="form-control" placeholder="Ex:  ''Military discount''  or  ''If over 12 weeks''" name="puppy_discount_reason" type="text" id="puppy_discount_reason" value="<?php echo $data['puppy_discount_reason']; ?>">
                        <p class="field-info">Discounts will only be offered under the circumstances that you note, but please be aware that you will not receive a call to confirm these discounts when they are offered to potential customers.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="special_feeding_instructions">Special Feeding Instructions</label>
                <input class="form-control" name="special_feeding_instructions" type="text" id="special_feeding_instructions" value="<?php echo $data['special_feeding_instructions']; ?>">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col col-50">
            <div class="form-group">
                <label>Puppy's Current Weight*</label>
                <select class="form-control select-search" required name="Weight">
                    <option></option>
                    <option value="10 - 13 ozs"<?php if($data['Weight'] == '10 - 13 ozs') echo ' selected'; ?>>10 - 13 ozs</option>
                    <option value="13 - 16 ozs"<?php if($data['Weight'] == '13 - 16 ozs') echo ' selected'; ?>>13 - 16 ozs</option>
                    <option value="16 - 20 ozs"<?php if($data['Weight'] == '16 - 20 ozs') echo ' selected'; ?>>16 - 20 ozs</option>
                    <option value="20 - 24 оzs"<?php if($data['Weight'] == '20 - 24 оzs') echo ' selected'; ?>>20 - 24 ozs</option>
                    <option value="24 - 28 ozs"<?php if($data['Weight'] == '24 - 28 оzs') echo ' selected'; ?>>24 - 28 ozs</option>
                    <option value="28 ozs - 2 lbs"<?php if($data['Weight'] == '28 ozs - 2 lbs') echo ' selected'; ?>>28 ozs - 2 lbs</option>
                    <option value="2 - 2 1/2 lbs"<?php if($data['Weight'] == '2 - 2 1/2 lbs') echo ' selected'; ?>>2 - 2 1/2 lbs</option>
                    <option value="2 1/2 - 3 lbs"<?php if($data['Weight'] == '2 1/2 - 3 lbs') echo ' selected'; ?>>2 1/2 - 3 lbs</option>
                    <option value="3 - 3 1/2 lbs"<?php if($data['Weight'] == '3 - 3 1/2 lbs') echo ' selected'; ?>>3 - 3 1/2 lbs</option>
                    <option value="3 1/2 - 4 lbs"<?php if($data['Weight'] == '3 1/2 - 4 lbs') echo ' selected'; ?>>3 1/2 - 4 lbs</option>
                    <option value="4 - 4 1/2 lbs"<?php if($data['Weight'] == '4 - 4 1/2 lbs') echo ' selected'; ?>>4 - 4 1/2 lbs</option>
                    <option value="4 1/2 - 5 lbs"<?php if($data['Weight'] == '4 1/2 - 5 lbs') echo ' selected'; ?>>4 1/2 - 5 lbs</option>
                    <option value="5 - 6 lbs"<?php if($data['Weight'] == '5 - 6 lbs') echo ' selected'; ?>>5 - 6 lbs</option>
                    <option value="6 - 7 lbs"<?php if($data['Weight'] == '6 - 7 lbs') echo ' selected'; ?>>6 - 7 lbs</option>
                    <option value="7 - 8 lbs"<?php if($data['Weight'] == '7 - 8 lbs') echo ' selected'; ?>>7 - 8 lbs</option>
                    <option value="8 - 9 lbs"<?php if($data['Weight'] == '8 - 9 lbs') echo ' selected'; ?>>8 - 9 lbs</option>
                    <option value="9 - 10 lbs"<?php if($data['Weight'] == '9 - 10 lbs') echo ' selected'; ?>>9 - 10 lbs</option>
                    <option value="10 - 12 lbs"<?php if($data['Weight'] == '10 - 12 lbs') echo ' selected'; ?>>10 - 12 lbs</option>
                    <option value="12 - 14 lbs"<?php if($data['Weight'] == '12 - 14 lbs') echo ' selected'; ?>>12 - 14 lbs</option>
                    <option value="14 - 16 lbs"<?php if($data['Weight'] == '14 - 16 lbs') echo ' selected'; ?>>14 - 16 lbs</option>
                    <option value="16 - 18 lbs"<?php if($data['Weight'] == '16 - 18 lbs') echo ' selected'; ?>>16 - 18 lbs</option>
                    <option value="18 - 20 lbs"<?php if($data['Weight'] == '18 - 20 lbs') echo ' selected'; ?>>18 - 20 lbs</option>
                    <option value="20 - 22 lbs"<?php if($data['Weight'] == '20 - 22 lbs') echo ' selected'; ?>>20 - 22 lbs</option>
                    <option value="22 - 25 lbs"<?php if($data['Weight'] == '22 - 25 lbs') echo ' selected'; ?>>22 - 25 lbs</option>
                    <option value="25 - 30 lbs"<?php if($data['Weight'] == '25 - 30 lbs') echo ' selected'; ?>>25 - 30 lbs</option>
                    <option value="30 - 35 lbs"<?php if($data['Weight'] == '30 - 35 lbs') echo ' selected'; ?>>30 - 35 lbs</option>
                    <option value="35 - 40 lbs"<?php if($data['Weight'] == '35 - 40 lbs') echo ' selected'; ?>>35 - 40 lbs</option>
                    <option value="40 - 45 lbs"<?php if($data['Weight'] == '40 - 45 lbs') echo ' selected'; ?>>40 - 45 lbs</option>
                    <option value="45 - 50 lbs"<?php if($data['Weight'] == '45 - 50 lbs') echo ' selected'; ?>>45 - 50 lbs</option>
                    <option value="50 - 55 lbs"<?php if($data['Weight'] == '50 - 55 lbs') echo ' selected'; ?>>50 - 55 lbs</option>
                    <option value="55 - 60 lbs"<?php if($data['Weight'] == '55 - 60 lbs') echo ' selected'; ?>>55 - 60 lbs</option>
                    <option value="60 - 65 lbs"<?php if($data['Weight'] == '60 - 65 lbs') echo ' selected'; ?>>60 - 65 lbs</option>
                    <option value="65 - 70 lbs"<?php if($data['Weight'] == '65 - 70 lbs') echo ' selected'; ?>>65 - 70 lbs</option>
                    <option value="70 - 75 lbs"<?php if($data['Weight'] == '70 - 75 lbs') echo ' selected'; ?>>70 - 75 lbs</option>
                    <option value="75 - 80 lbs"<?php if($data['Weight'] == '75 - 80 lbs') echo ' selected'; ?>>75 - 80 lbs</option>
                    <option value="80 - 85 lbs"<?php if($data['Weight'] == '80 - 85 lbs') echo ' selected'; ?>>80 - 85 lbs</option>
                    <option value="85 - 90 lbs"<?php if($data['Weight'] == '85 - 90 lbs') echo ' selected'; ?>>85 - 90 lbs</option>
                    <option value="90 - 95 lbs"<?php if($data['Weight'] == '90 - 95 lbs') echo ' selected'; ?>>90 - 95 lbs</option>
                    <option value="95 - 100 lbs"<?php if($data['Weight'] == '95 - 100 lbs') echo ' selected'; ?>>95 - 100 lbs</option>
                    <option value="100 - 110 lbs"<?php if($data['Weight'] == '100 - 110 lbs') echo ' selected'; ?>>100 - 110 lbs</option>
                    <option value="110 - 120 lbs"<?php if($data['Weight'] == '110 - 120 lbs') echo ' selected'; ?>>110 - 120 lbs</option>
                    <option value="120 - 130 lbs"<?php if($data['Weight'] == '120 - 130 lbs') echo ' selected'; ?>>120 - 130 lbs</option>
                    <option value="130 - 140 lbs"<?php if($data['Weight'] == '130 - 140 lbs') echo ' selected'; ?>>130 - 140 lbs</option>
                    <option value="140 - 150 lbs"<?php if($data['Weight'] == '140 - 150 lbs') echo ' selected'; ?>>140 - 150 lbs</option>
                    <option value="150 - 160 lbs"<?php if($data['Weight'] == '150 - 160 lbs') echo ' selected'; ?>>150 - 160 lbs</option>
                    <option value="160 - 175 lbs"<?php if($data['Weight'] == '160 - 175 lbs') echo ' selected'; ?>>160 - 175 lbs</option>
                    <option value="175 - 190 lbs"<?php if($data['Weight'] == '175 - 190 lbs') echo ' selected'; ?>>175 - 190 lbs</option>
                    <option value="190 - 210 lbs"<?php if($data['Weight'] == '190 - 210 lbs') echo ' selected'; ?>>190 - 210 lbs</option>
                    <option value="above 210 lbs"<?php if($data['Weight'] == 'above 210 lbs') echo ' selected'; ?>>above 210 lbs</option>
                </select>
            </div>
        </div>
        <div class="col col-50">
            <div class="form-group">
                <label>Is puppy smallest/largest in the litter?</label>
                <select class="form-control" name="size_compared_to_litter">
                    <option selected></option>
                    <option value="Smallest"<?php if($data['size_compared_to_litter'] == 'Smallest') echo ' selected'; ?>>Smallest</option>
                    <option value="Largest"<?php if($data['size_compared_to_litter'] == 'Largest') echo ' selected'; ?>>Largest</option>
                    <option value="Neither"<?php if($data['size_compared_to_litter'] == 'Neither') echo ' selected'; ?>>Neither</option>
                    <option value="Only Puppy in Litter"<?php if($data['size_compared_to_litter'] == 'Only Puppy in Litter') echo ' selected'; ?>>Only Puppy in Litter</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col col-50">
            <div class="form-group">
                <label>Registry*</label>
                <select class="form-control select-search" required name="RegistryName">
                    <option></option>
                    <option value="ACA"<?php if($data['RegistryName'] == 'ACA') echo ' selected'; ?>>ACA</option>
                    <option value="AKC"<?php if($data['RegistryName'] == 'AKC') echo ' selected'; ?>>AKC</option>
                    <option value="APRI"<?php if($data['RegistryName'] == 'APRI') echo ' selected'; ?>>APRI</option>
                    <option value="CKC"<?php if($data['RegistryName'] == 'CKC') echo ' selected'; ?>>CKC</option>
                    <option value="Not registered"<?php if($data['RegistryName'] == 'Not registered') echo ' selected'; ?>>Not registered</option>
                    <option value="ABA"<?php if($data['RegistryName'] == 'ABA') echo ' selected'; ?>>ABA</option>
                    <option value="ABCA"<?php if($data['RegistryName'] == 'ABCA') echo ' selected'; ?>>ABCA</option>
                    <option value="ABRA"<?php if($data['RegistryName'] == 'ABRA') echo ' selected'; ?>>ABRA</option>
                    <option value="ACC"<?php if($data['RegistryName'] == 'ACC') echo ' selected'; ?>>ACC</option>
                    <option value="ACHC"<?php if($data['RegistryName'] == 'ACHC') echo ' selected'; ?>>ACHC</option>
                    <option value="ACR"<?php if($data['RegistryName'] == 'ACR') echo ' selected'; ?>>ACR</option>
                    <option value="ADBA"<?php if($data['RegistryName'] == 'ADBA') echo ' selected'; ?>>ADBA</option>
                    <option value="ADRK"<?php if($data['RegistryName'] == 'ADRK') echo ' selected'; ?>>ADRK</option>
                    <option value="AHTCA"<?php if($data['RegistryName'] == 'AHTCA') echo ' selected'; ?>>AHTCA</option>
                    <option value="AKR"<?php if($data['RegistryName'] == 'AKR') echo ' selected'; ?>>AKR</option>
                    <option value="ALAA"<?php if($data['RegistryName'] == 'ALAA') echo ' selected'; ?>>ALAA</option>
                    <option value="ALCA"<?php if($data['RegistryName'] == 'ALCA') echo ' selected'; ?>>ALCA</option>
                    <option value="AMRA"<?php if($data['RegistryName'] == 'AMRA') echo ' selected'; ?>>AMRA</option>
                    <option value="APR"<?php if($data['RegistryName'] == 'AAAAA') echo ' selected'; ?>>APR</option>
                    <option value="ARBA"<?php if($data['RegistryName'] == 'ARBA') echo ' selected'; ?>>ARBA</option>
                    <option value="ARF"<?php if($data['RegistryName'] == 'ARF') echo ' selected'; ?>>ARF</option>
                    <option value="ASCA"<?php if($data['RegistryName'] == 'ASCA') echo ' selected'; ?>>ASCA</option>
                    <option value="ASDR"<?php if($data['RegistryName'] == 'ASDR') echo ' selected'; ?>>ASDR</option>
                    <option value="AVHDA"<?php if($data['RegistryName'] == 'AVHDA') echo ' selected'; ?>>AVHDA</option>
                    <option value="BBIR"<?php if($data['RegistryName'] == 'BBIR') echo ' selected'; ?>>BBIR</option>
                    <option value="BSS"<?php if($data['RegistryName'] == 'BSS') echo ' selected'; ?>>BSS</option>
                    <option value="BYA"<?php if($data['RegistryName'] == 'BYA') echo ' selected'; ?>>BYA</option>
                    <option value="CanKC"<?php if($data['RegistryName'] == 'CanKC') echo ' selected'; ?>>CanKC</option>
                    <option value="CPD"<?php if($data['RegistryName'] == 'CPD') echo ' selected'; ?>>CPD</option>
                    <option value="CPR"<?php if($data['RegistryName'] == 'CPR') echo ' selected'; ?>>CPR</option>
                    <option value="CWTC"<?php if($data['RegistryName'] == 'CWTC') echo ' selected'; ?>>CWTC</option>
                    <option value="DBR"<?php if($data['RegistryName'] == 'DBR') echo ' selected'; ?>>DBR</option>
                    <option value="DRA"<?php if($data['RegistryName'] == 'DRA') echo ' selected'; ?>>DRA</option>
                    <option value="FCI"<?php if($data['RegistryName'] == 'FCI') echo ' selected'; ?>>FCI</option>
                    <option value="FCPR"<?php if($data['RegistryName'] == 'FCPR') echo ' selected'; ?>>FCPR</option>
                    <option value="FDSB"<?php if($data['RegistryName'] == 'FDSB') echo ' selected'; ?>>FDSB</option>
                    <option value="GKC"<?php if($data['RegistryName'] == 'GKC') echo ' selected'; ?>>GKC</option>
                    <option value="HPA"<?php if($data['RegistryName'] == 'HPA') echo ' selected'; ?>>HPA</option>
                    <option value="IABBR"<?php if($data['RegistryName'] == 'IABBR') echo ' selected'; ?>>IABBR</option>
                    <option value="IBC"<?php if($data['RegistryName'] == 'IBC') echo ' selected'; ?>>IBC</option>
                    <option value="IBCA"<?php if($data['RegistryName'] == 'IBCA') echo ' selected'; ?>>IBCA</option>
                    <option value="IBKC"<?php if($data['RegistryName'] == 'IBKC') echo ' selected'; ?>>IBKC</option>
                    <option value="ICA"<?php if($data['RegistryName'] == 'ICA') echo ' selected'; ?>>ICA</option>
                    <option value="ICCF"<?php if($data['RegistryName'] == 'ICCF') echo ' selected'; ?>>ICCF</option>
                    <option value="IDCR"<?php if($data['RegistryName'] == 'IDCR') echo ' selected'; ?>>IDCR</option>
                    <option value="IKC"<?php if($data['RegistryName'] == 'IKC') echo ' selected'; ?>>IKC</option>
                    <option value="IMASC"<?php if($data['RegistryName'] == 'IMASC') echo ' selected'; ?>>IMASC</option>
                    <option value="IOEBA"<?php if($data['RegistryName'] == 'IOEBA') echo ' selected'; ?>>IOEBA</option>
                    <option value="IPA"<?php if($data['RegistryName'] == 'IPA') echo ' selected'; ?>>IPA</option>
                    <option value="MASCA"<?php if($data['RegistryName'] == 'MASCA') echo ' selected'; ?>>MASCA</option>
                    <option value="MSCA"<?php if($data['RegistryName'] == 'MSCA') echo ' selected'; ?>>MSCA</option>
                    <option value="NADSR"<?php if($data['RegistryName'] == 'NADSR') echo ' selected'; ?>>NADSR</option>
                    <option value="NALC"<?php if($data['RegistryName'] == 'NALC') echo ' selected'; ?>>NALC</option>
                    <option value="NAPDR"<?php if($data['RegistryName'] == 'NAPDR') echo ' selected'; ?>>NAPDR</option>
                    <option value="NAPR"<?php if($data['RegistryName'] == 'NAPR') echo ' selected'; ?>>NAPR</option>
                    <option value="NCA"<?php if($data['RegistryName'] == 'NCA') echo ' selected'; ?>>NCA</option>
                    <option value="NHR"<?php if($data['RegistryName'] == 'NHR') echo ' selected'; ?>>NHR</option>
                    <option value="NKC"<?php if($data['RegistryName'] == 'NKC') echo ' selected'; ?>>NKC</option>
                    <option value="NPCR"<?php if($data['RegistryName'] == 'NPCR') echo ' selected'; ?>>NPCR</option>
                    <option value="NSDR"<?php if($data['RegistryName'] == 'NSDR') echo ' selected'; ?>>NSDR</option>
                    <option value="OBBA"<?php if($data['RegistryName'] == 'OBBA') echo ' selected'; ?>>OBBA</option>
                    <option value="OEPB"<?php if($data['RegistryName'] == 'OEPB') echo ' selected'; ?>>OEPB</option>
                    <option value="UABR"<?php if($data['RegistryName'] == 'UABR') echo ' selected'; ?>>UABR</option>
                    <option value="UCA"<?php if($data['RegistryName'] == 'UCA') echo ' selected'; ?>>UCA</option>
                    <option value="UCHC"<?php if($data['RegistryName'] == 'UCHC') echo ' selected'; ?>>UCHC</option>
                    <option value="UKC"<?php if($data['RegistryName'] == 'UKC') echo ' selected'; ?>>UKC</option>
                    <option value="UKCI"<?php if($data['RegistryName'] == 'UKCI') echo ' selected'; ?>>UKCI</option>
                    <option value="WBA"<?php if($data['RegistryName'] == 'WBA') echo ' selected'; ?>>WBA</option>
                    <option value="WDRC"<?php if($data['RegistryName'] == 'WDRC') echo ' selected'; ?>>WDRC</option>
                    <option value="WKC"<?php if($data['RegistryName'] == 'WKC') echo ' selected'; ?>>WKC</option>
                    <option value="WWKC"<?php if($data['RegistryName'] == 'WWKC') echo ' selected'; ?>>WWKC</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="form_registry_registration">Registration Number*</label>
                <input required class="form-control" name="RegisterNumber" type="text" id="form_registry_registration" value="<?php echo $data['RegisterNumber']; ?>">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col col-50">
            <div class="form-group">
                <label>Umbilical Hernia?</label><br>
                <label class="radio-inline">
                    <input class="form-control" required name="umbilical_hernia" value="Yes" type="radio"<?php echo ($data['umbilical_hernia'] && $data['umbilical_hernia'] == 'Yes') ? ' checked' : ''; ?>> Yes
                </label>
                <label class="radio-inline">
                    <input class="form-control" required name="umbilical_hernia" value="No" type="radio"<?php echo ($data['umbilical_hernia'] && $data['umbilical_hernia'] == 'Yes') ? '' : ' checked'; ?>> No
                </label>
            </div>
        </div>
        <div class="col col-50">
            <div class="form-group">
                <label>Inguinal Hernia?</label><br>
                <label class="radio-inline">
                    <input class="form-control" required name="inguinal_hernia" value="Yes" type="radio"<?php echo ($data['inguinal_hernia'] && $data['inguinal_hernia'] == 'Yes') ? ' checked' : ''; ?>> Yes
                </label>
                <label class="radio-inline">
                    <input class="form-control" required name="inguinal_hernia" value="No" type="radio"<?php echo ($data['inguinal_hernia'] && $data['inguinal_hernia'] == 'Yes') ? '' : ' checked'; ?>> No
                </label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col col-50">
            <div class="form-group">
                <label>Undescended Testicles?</label><br>
                <label class="radio-inline">
                    <input class="form-control" required name="undescended_testicles" value="Yes" type="radio"<?php echo ($data['undescended_testicles'] && $data['undescended_testicles'] == 'Yes') ? ' checked' : ''; ?>> Yes
                </label>
                <label class="radio-inline">
                    <input class="form-control" required name="undescended_testicles" value="No" type="radio"<?php echo ($data['undescended_testicles'] && $data['undescended_testicles'] == 'Yes') ? '' : ' checked'; ?>> No
                </label>
            </div>
        </div>
        <div class="col col-50">
            <div class="form-group">
                <label for="form_open_font">Open Font?</label><br>
                <label class="radio-inline">
                    <input class="form-control" required name="open_font" value="Yes" type="radio"<?php echo ($data['open_font'] && $data['open_font'] == 'Yes') ? ' checked' : ''; ?>> Yes
                </label>
                <label class="radio-inline">
                    <input class="form-control" required name="open_font" value="No" type="radio"<?php echo ($data['open_font'] && $data['open_font'] == 'Yes') ? '' : ' checked'; ?>> No
                </label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col col-50">
            <div class="form-group">
                <label>Underbite?</label><br>
                <label class="radio-inline">
                    <input class="form-control" required name="underbite" value="Yes" type="radio"<?php echo ($data['underbite'] && $data['underbite'] == 'Yes') ? ' checked' : ''; ?>> Yes
                </label>
                <label class="radio-inline">
                    <input class="form-control" required name="underbite" value="No" type="radio"<?php echo ($data['underbite'] && $data['underbite'] == 'Yes') ? '' : ' checked'; ?>> No
                </label>
            </div>
        </div>
        <div class="col col-50">
            <div class="form-group">
                <label>Overbite?</label><br>
                <label class="radio-inline">
                    <input class="form-control" required name="overbite" value="Yes" type="radio"<?php echo ($data['overbite'] && $data['overbite'] == 'Yes') ? ' checked' : ''; ?>> Yes
                </label>
                <label class="radio-inline">
                    <input class="form-control" required name="overbite" value="No" type="radio"<?php echo ($data['overbite'] && $data['overbite'] == 'Yes') ? '' : ' checked'; ?>> No
                </label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col col-50">
            <div class="form-group">
                <label>Dewclaws Removed?</label><br>
                <label class="radio-inline">
                    <input class="form-control" required name="dewclaws" value="Yes" type="radio"<?php echo ($data['dewclaws'] && $data['dewclaws'] == 'Yes') ? ' checked' : ''; ?>>  Yes
                </label>
                <label class="radio-inline">
                    <input class="form-control" required name="dewclaws" value="No" type="radio"<?php echo ($data['dewclaws'] && $data['dewclaws'] == 'Yes') ? '' : ' checked'; ?>> No
                </label>
            </div>
        </div>
        <div class="col col-50">
            <div class="form-group">
                <label>Spayed/Neutered?</label><br>
                <label class="radio-inline">
                    <input class="form-control" required name="spayed_neutered" value="Yes" type="radio"<?php echo ($data['spayed_neutered'] && $data['spayed_neutered'] == 'Yes') ? ' checked' : ''; ?>> Yes
                </label>
                <label class="radio-inline">
                    <input class="form-control" required name="spayed_neutered" value="No" type="radio"<?php echo ($data['spayed_neutered'] && $data['spayed_neutered'] == 'Yes') ? '' : ' checked'; ?>> No
                </label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col col-50">
            <div class="form-group">
                <label>Microchip?</label><br>
                <label class="radio-inline">
                    <input class="form-control" name="microchip" required value="Yes" type="radio"<?php echo $data['microchip_id'] ? ' checked' : ''; ?>> Yes
                </label>
                <label class="radio-inline">
                    <input class="form-control" name="microchip" required value="no" type="radio"<?php echo $data['microchip_id'] ? '' : ' checked'; ?>> No
                </label>
                <div class="hidden-fields<?php echo $data['microchip_id'] ? ' display-field' : ''; ?>">
                    <div class="form-group">
                        <label for="form_microchip_id">Microchip ID*</label>
                        <input class="form-control" name="microchip_id" type="text" id="form_microchip_id" value="<?php echo $data['microchip_id']; ?>">
                    </div>
                </div>
            </div>
        </div>
        <?php /* ?>
        <div class="col col-50 taildocked" style="display: none;">
            <div class="form-group">
                <label>Tail Docked?*</label><br>
                <label class="radio-inline">
                    <input class="form-control" required name="undocked_tail" value="Yes" type="radio"<?php echo ($data['undocked_tail'] && $data['undocked_tail'] == 'No') ? ' checked' : ''; ?>> Yes
                </label>
                <label class="radio-inline">
                    <input class="form-control" required name="undocked_tail" value="No" type="radio"<?php echo ($data['undocked_tail'] && $data['undocked_tail'] == 'No') ? ' checked' : ''; ?>> No
                </label>
            </div>
        </div>
        <?php */ ?>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="known_health">Known Health/Cosmetic Issues, if any</label>
                <textarea rows="5" class="form-control" name="known_health" id="known_health"><?php echo $data['known_health']; ?></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="form_description">Description</label><br>
                <textarea rows="5" class="form-control" name="Description" id="form_description"><?php echo $data['Description']; ?></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="form_breeder_notes">Notes to PuppySpot</label>
                <p class="label-info">Is there other information we should know about this puppy? Add your notes or comments here.</p>
                <textarea rows="5" maxlength="500" data-max-length="500" class="form-control" name="breeder_notes" id="form_breeder_notes"><?php echo $data['breeder_notes']; ?></textarea>
                <!--div class="field-explanation">0 / 500 characters.</div-->
                <p class="field-info">Is there anything else you would like us to know about this puppy? (Examples: negotiable price, spay/neuter contract required, video available, etc.)</p>
            </div>
        </div>
    </div>
    <?php if($vars['action'] == 'new') { ?>
        <div class="row">
            <div class="col">
                <div class="agreement">
                    <label>
                        <input required name="usda_agreement" value="1" type="checkbox">
                        <span>By checking this box, you are electronically signing and certifying that you consent to the terms of our <a target="_blank" href="/breeders/agreement">Membership Agreement</a> and that the information provided above is true and accurate.</span>
                    </label>
                </div>
                <div class="agreement">
                    <label>
                        <input required name="price_agreement" value="1" type="checkbox">
                        <span>Yes, all of my puppy’s costs are accounted for in the asking price field.</span>
                    </label>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="row">
        <div class="col col-submit">
            <button name="dashboard_submit">Submit</button>
            <input type="hidden" name="type" value="puppies">
            <input type="hidden" name="action" value="<?php echo $vars['action']; ?>">
            <?php if($vars['action'] == 'edit') { ?>
                <input type="hidden" name="product_id" value="<?php echo $vars['path_id']; ?>">
            <?php } ?>
        </div>
    </div>
</form>

<div class="modal-popup" id="popup-puppynames">
    <div class="modal-popup-content">
        <a href="" class="close">×</a>
        <div class="ast-col-sm-12">
            <div class="ast-row">
                <h5>Puppy Name Ideas</h5>
                <p>
                    Choosing the right display name can be a tough decision, whether you're listing one puppy or a dozen.
                    There are many places to pull inspiration from, like <a href="https://www.babycenter.com/baby-names" target="_blank">baby name</a>
                    sites or annual "<a href="https://www.rover.com/blog/100-most-popular-male-female-dog-names-2016/" target="_blank">most popular pet name</a>"
                    lists, but we'd like to offer the following suggestions.
                </p>
                <p>
                    Please keep in mind that each puppy name can only appear once per breed listed on PuppySpot, so you may need to have a few back-up names
                    in case your preferred option has already been taken. We also suggest trying different spellings (ex: Lily instead of Lilly)
                    if you are set on a particular name for one of your pups.
                </p>
                <p>
                    Here are a few names that we've found to be most popular with customers. We've listed them
                    here as "male" and "female" names, but feel free to mix and match.
                </p>
            </div>
            <div class="ast-col-sm-12 ast-col-md-6 ast-col-lg-6">
                <h6>Female Names</h6>
                <ul>
                    <li>Lilly</li>
                    <li>Angel</li>
                    <li>Jasmine</li>
                    <li>Amber</li>
                    <li>Hope</li>
                    <li>Bella</li>
                    <li>Daisy</li>
                    <li>Molly</li>
                    <li>Chloe</li>
                    <li>Lucy</li>
                    <li>Sophie</li>
                    <li>Maggie</li>
                    <li>Ruby</li>
                    <li>Bailey</li>
                    <li>Gracie</li>
                    <li>Sadie</li>
                    <li>Abby</li>
                    <li>Stella</li>
                    <li>Zoey</li>
                    <li>Belle</li>
                    <li>Princess</li>
                    <li>Mia</li>
                    <li>Lola</li>
                    <li>Rosie</li>
                    <li>Luna</li>
                    <li>Rose</li>
                    <li>Penny</li>
                    <li>Candy</li>
                    <li>Ellie</li>
                    <li>Holly</li>
                    <li>Faith</li>
                    <li>Grace</li>
                    <li>Joy</li>
                    <li>Callie</li>
                    <li>Missy</li>
                    <li>Gabby</li>
                    <li>Roxy</li>
                    <li>Dolly</li>
                    <li>Annie</li>
                    <li>Lexi</li>
                    <li>Coco</li>
                    <li>Heidi</li>
                    <li>Amber</li>
                    <li>Hope</li>
                    <li>Ginger</li>
                    <li>Dixie</li>
                    <li>Roxie</li>
                    <li>Pearl</li>
                    <li>Layla</li>
                    <li>Sally</li>
                    <li>Emma</li>
                </ul>
            </div>
            <div class="ast-col-sm-12 ast-col-md-6 ast-col-lg-6">
                <h6>Male Names</h6>
                <ul>
                    <li>Romeo</li>
                    <li>Dakota</li>
                    <li>Baxter</li>
                    <li>Dallas</li>
                    <li>Duke</li>
                    <li>Max</li>
                    <li>Charlie</li>
                    <li>Buddy</li>
                    <li>Bentley</li>
                    <li>Cooper</li>
                    <li>Rocky</li>
                    <li>Teddy</li>
                    <li>Jack</li>
                    <li>Sammy</li>
                    <li>Jake</li>
                    <li>Toby</li>
                    <li>Harley</li>
                    <li>Oliver</li>
                    <li>Tucker</li>
                    <li>Bear</li>
                    <li>Jax</li>
                    <li>Luke</li>
                    <li>Winston</li>
                    <li>Buster</li>
                    <li>Brody</li>
                    <li>Beau</li>
                    <li>Jackson</li>
                    <li>Blake</li>
                    <li>Cody</li>
                    <li>Ace</li>
                    <li>Champ</li>
                    <li>Hunter</li>
                    <li>Chase</li>
                    <li>Benji</li>
                    <li>Sam</li>
                    <li>Tank</li>
                    <li>Leo</li>
                    <li>Zeus</li>
                    <li>King</li>
                    <li>Oscar</li>
                    <li>Alex</li>
                    <li>Apollo</li>
                    <li>Hank</li>
                    <li>Dexter</li>
                    <li>Jasper</li>
                    <li>Blaze</li>
                    <li>Cash</li>
                    <li>Tommy</li>
                    <li>Bruno</li>
                    <li>Drake</li>
                    <li>Tyson</li>
                </ul>
            </div>
        </div>
    </div>
</div>