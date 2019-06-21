<?php
$data = $vars['data'];
//print_r($vars);
?>
<h1><?php echo ($vars['action'] == 'edit') ? 'Edit' : 'Create'; ?> Parent</h1>
<form enctype="multipart/form-data" action="" accept-charset="utf-8" method="post">
    <div class="row">
        <div class="col col-50">
            <div class="form-group">
                <label for="form_name">Name*</label>
                <input required class="form-control" name="PetName" type="text" id="form_name" value="<?php echo $data['PetName']; ?>">
            </div>
        </div>
        <div class="col col-50">
            <div class="form-group">
                <label>Parent Gender*</label><br>
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
                    <input required readonly class="datepicker" name="BirthDate" type="text" id="form_birthdate" value="<?php echo $data['BirthDate']; ?>"><span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col col-50">
            <div class="form-group">
                <label for="form_breed_id">Breed*</label>
                <select class="form-control breed-dropdown-select" required name="BreedName">
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
                <label>Weight*</label>
                <select class="form-control" required name="Weight">
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
    </div>
    <div class="row">
        <div class="col col-50">
            <div class="form-group">
                <label>Registry*</label>
                <select class="form-control" required name="RegistryName">
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
        <div class="col col-50">
            <div class="form-group">
                <label>Color*</label>
                <select required class="form-control" name="Coloring">
                    <option value="6"<?php if($data['Coloring'] == '6') echo ' selected'; ?>>Agouti &amp; White</option>
                    <option value="108"<?php if($data['Coloring'] == '108') echo ' selected'; ?>>Apricot</option>
                    <option value="229"<?php if($data['Coloring'] == '229') echo ' selected'; ?>>Apricot &amp; White</option>
                    <option value="195"<?php if($data['Coloring'] == '195') echo ' selected'; ?>>Apricot Fawn</option>
                    <option value="175"<?php if($data['Coloring'] == '175') echo ' selected'; ?>>Beaver</option>
                    <option value="181"<?php if($data['Coloring'] == '181') echo ' selected'; ?>>Beaver Sable</option>
                    <option value="1"<?php if($data['Coloring'] == '1') echo ' selected'; ?>>Beige</option>
                    <option value="35"<?php if($data['Coloring'] == '35') echo ' selected'; ?>>Bi</option>
                    <option value="144"<?php if($data['Coloring'] == '144') echo ' selected'; ?>>Bi-Color</option>
                    <option value="2"<?php if($data['Coloring'] == '2') echo ' selected'; ?>>Black</option>
                    <option value="186"<?php if($data['Coloring'] == '186') echo ' selected'; ?>>Black &amp; Apricot</option>
                    <option value="182"<?php if($data['Coloring'] == '182') echo ' selected'; ?>>Black &amp; Brindle</option>
                    <option value="187"<?php if($data['Coloring'] == '187') echo ' selected'; ?>>Black &amp; Brown</option>
                    <option value="124"<?php if($data['Coloring'] == '124') echo ' selected'; ?>>Black &amp; Cream</option>
                    <option value="81"<?php if($data['Coloring'] == '81') echo ' selected'; ?>>Black &amp; Fawn</option>
                    <option value="219"<?php if($data['Coloring'] == '219') echo ' selected'; ?>>Black &amp; Gold</option>
                    <option value="188"<?php if($data['Coloring'] == '188') echo ' selected'; ?>>Black &amp; Gray</option>
                    <option value="197"<?php if($data['Coloring'] == '197') echo ' selected'; ?>>Black &amp; Mahogany</option>
                    <option value="95"<?php if($data['Coloring'] == '95') echo ' selected'; ?>>Black &amp; Red</option>
                    <option value="130"<?php if($data['Coloring'] == '130') echo ' selected'; ?>>Black &amp; Rust</option>
                    <option value="3"<?php if($data['Coloring'] == '3') echo ' selected'; ?>>Black &amp; Silver</option>
                    <option value="159"<?php if($data['Coloring'] == '159') echo ' selected'; ?>>Black &amp; Silver Brindle</option>
                    <option value="4"<?php if($data['Coloring'] == '4') echo ' selected'; ?>>Black &amp; Tan</option>
                    <option value="160"<?php if($data['Coloring'] == '160') echo ' selected'; ?>>Black &amp; Tan Brindle</option>
                    <option value="242"<?php if($data['Coloring'] == '242') echo ' selected'; ?>>Black &amp; Tan Merle</option>
                    <option value="7"<?php if($data['Coloring'] == '7') echo ' selected'; ?>>Black &amp; White</option>
                    <option value="240"<?php if($data['Coloring'] == '240') echo ' selected'; ?>>Black and White Piebald</option>
                    <option value="16"<?php if($data['Coloring'] == '16') echo ' selected'; ?>>Black Brindle</option>
                    <option value="239"<?php if($data['Coloring'] == '239') echo ' selected'; ?>>Black Brindle &amp; White</option>
                    <option value="96"<?php if($data['Coloring'] == '96') echo ' selected'; ?>>Black Sabled Fawn</option>
                    <option value="97"<?php if($data['Coloring'] == '97') echo ' selected'; ?>>Black Sabled Silver</option>
                    <option value="64"<?php if($data['Coloring'] == '64') echo ' selected'; ?>>Black, Brindle &amp; White</option>
                    <option value="82"<?php if($data['Coloring'] == '82') echo ' selected'; ?>>Black, Fawn &amp; White</option>
                    <option value="203"<?php if($data['Coloring'] == '203') echo ' selected'; ?>>Black, Gold &amp; Silver</option>
                    <option value="204"<?php if($data['Coloring'] == '204') echo ' selected'; ?>>Black, Gold &amp; White</option>
                    <option value="207"<?php if($data['Coloring'] == '207') echo ' selected'; ?>>Black, Gray &amp; White</option>
                    <option value="43"<?php if($data['Coloring'] == '43') echo ' selected'; ?>>Black, Red &amp; White</option>
                    <option value="230"<?php if($data['Coloring'] == '230') echo ' selected'; ?>>Black, Silver &amp; Tan</option>
                    <option value="44"<?php if($data['Coloring'] == '44') echo ' selected'; ?>>Black, Tan &amp; Bluetick</option>
                    <option value="46"<?php if($data['Coloring'] == '46') echo ' selected'; ?>>Black, Tan &amp; Redtick</option>
                    <option value="39"<?php if($data['Coloring'] == '39') echo ' selected'; ?>>Black, Tan &amp; White</option>
                    <option value="205"<?php if($data['Coloring'] == '205') echo ' selected'; ?>>Black, White &amp; Silver</option>
                    <option value="90"<?php if($data['Coloring'] == '90') echo ' selected'; ?>>Black, White &amp; Tan</option>
                    <option value="91"<?php if($data['Coloring'] == '91') echo ' selected'; ?>>Blenheim</option>
                    <option value="17"<?php if($data['Coloring'] == '17') echo ' selected'; ?>>Blue</option>
                    <option value="125"<?php if($data['Coloring'] == '125') echo ' selected'; ?>>Blue &amp; Cream</option>
                    <option value="220"<?php if($data['Coloring'] == '220') echo ' selected'; ?>>Blue &amp; Gold</option>
                    <option value="131"<?php if($data['Coloring'] == '131') echo ' selected'; ?>>Blue &amp; Rust</option>
                    <option value="93"<?php if($data['Coloring'] == '93') echo ' selected'; ?>>Blue &amp; Tan</option>
                    <option value="8"<?php if($data['Coloring'] == '8') echo ' selected'; ?>>Blue &amp; White</option>
                    <option value="222"<?php if($data['Coloring'] == '222') echo ' selected'; ?>>Blue &amp; White Pied</option>
                    <option value="18"<?php if($data['Coloring'] == '18') echo ' selected'; ?>>Blue Brindle</option>
                    <option value="98"<?php if($data['Coloring'] == '98') echo ' selected'; ?>>Blue Brindled Fawn</option>
                    <option value="19"<?php if($data['Coloring'] == '19') echo ' selected'; ?>>Blue Fawn</option>
                    <option value="227"<?php if($data['Coloring'] == '227') echo ' selected'; ?>>Blue Fawn &amp; White</option>
                    <option value="20"<?php if($data['Coloring'] == '20') echo ' selected'; ?>>Blue Fawn Brindle</option>
                    <option value="254"<?php if($data['Coloring'] == '254') echo ' selected'; ?>>Blue Leopard</option>
                    <option value="37"<?php if($data['Coloring'] == '37') echo ' selected'; ?>>Blue Merle</option>
                    <option value="120"<?php if($data['Coloring'] == '120') echo ' selected'; ?>>Blue Merle &amp; White</option>
                    <option value="121"<?php if($data['Coloring'] == '121') echo ' selected'; ?>>Blue Merle, White &amp; Tan</option>
                    <option value="31"<?php if($data['Coloring'] == '31') echo ' selected'; ?>>Blue Mottled</option>
                    <option value="117"<?php if($data['Coloring'] == '117') echo ' selected'; ?>>Blue Roan</option>
                    <option value="118"<?php if($data['Coloring'] == '118') echo ' selected'; ?>>Blue Roan &amp; Tan</option>
                    <option value="176"<?php if($data['Coloring'] == '176') echo ' selected'; ?>>Blue Sable</option>
                    <option value="32"<?php if($data['Coloring'] == '32') echo ' selected'; ?>>Blue Speckled</option>
                    <option value="169"<?php if($data['Coloring'] == '169') echo ' selected'; ?>>Blue Stag Red</option>
                    <option value="41"<?php if($data['Coloring'] == '41') echo ' selected'; ?>>Blue, Tan &amp; White</option>
                    <option value="48"<?php if($data['Coloring'] == '48') echo ' selected'; ?>>Brindle</option>
                    <option value="65"<?php if($data['Coloring'] == '65') echo ' selected'; ?>>Brindle &amp; White</option>
                    <option value="216"<?php if($data['Coloring'] == '216') echo ' selected'; ?>>Brindle Merle &amp; White</option>
                    <option value="248"<?php if($data['Coloring'] == '248') echo ' selected'; ?>>Bronze</option>
                    <option value="249"<?php if($data['Coloring'] == '249') echo ' selected'; ?>>Bronze &amp; White</option>
                    <option value="21"<?php if($data['Coloring'] == '21') echo ' selected'; ?>>Brown</option>
                    <option value="209"<?php if($data['Coloring'] == '209') echo ' selected'; ?>>Brown &amp; White</option>
                    <option value="22"<?php if($data['Coloring'] == '22') echo ' selected'; ?>>Brown Brindle</option>
                    <option value="210"<?php if($data['Coloring'] == '210') echo ' selected'; ?>>Brown, Black &amp; White</option>
                    <option value="268"<?php if($data['Coloring'] == '268') echo ' selected'; ?>>Brown, Black Overlay</option>
                    <option value="42"<?php if($data['Coloring'] == '42') echo ' selected'; ?>>Brown, White &amp; Tan</option>
                    <option value="115"<?php if($data['Coloring'] == '115') echo ' selected'; ?>>Buff</option>
                    <option value="116"<?php if($data['Coloring'] == '116') echo ' selected'; ?>>Buff &amp; White</option>
                    <option value="184"<?php if($data['Coloring'] == '184') echo ' selected'; ?>>Cafe Au Lait</option>
                    <option value="166"<?php if($data['Coloring'] == '166') echo ' selected'; ?>>Charcoal</option>
                    <option value="275"<?php if($data['Coloring'] == '275') echo ' selected'; ?>>Chestnut</option>
                    <option value="89"<?php if($data['Coloring'] == '89') echo ' selected'; ?>>Chestnut Brindle</option>
                    <option value="75"<?php if($data['Coloring'] == '75') echo ' selected'; ?>>Chocolate</option>
                    <option value="189"<?php if($data['Coloring'] == '189') echo ' selected'; ?>>Chocolate &amp; Apricot</option>
                    <option value="126"<?php if($data['Coloring'] == '126') echo ' selected'; ?>>Chocolate &amp; Cream</option>
                    <option value="226"<?php if($data['Coloring'] == '226') echo ' selected'; ?>>Chocolate &amp; Gold</option>
                    <option value="134"<?php if($data['Coloring'] == '134') echo ' selected'; ?>>Chocolate &amp; Rust</option>
                    <option value="94"<?php if($data['Coloring'] == '94') echo ' selected'; ?>>Chocolate &amp; Tan</option>
                    <option value="99"<?php if($data['Coloring'] == '99') echo ' selected'; ?>>Chocolate &amp; White</option>
                    <option value="100"<?php if($data['Coloring'] == '100') echo ' selected'; ?>>Chocolate Blue</option>
                    <option value="152"<?php if($data['Coloring'] == '152') echo ' selected'; ?>>Chocolate Brindle</option>
                    <option value="101"<?php if($data['Coloring'] == '101') echo ' selected'; ?>>Chocolate Brindled Fawn</option>
                    <option value="232"<?php if($data['Coloring'] == '232') echo ' selected'; ?>>Chocolate Dapple</option>
                    <option value="183"<?php if($data['Coloring'] == '183') echo ' selected'; ?>>Chocolate Merle</option>
                    <option value="194"<?php if($data['Coloring'] == '194') echo ' selected'; ?>>Chocolate Phantom</option>
                    <option value="238"<?php if($data['Coloring'] == '238') echo ' selected'; ?>>Chocolate Roan &amp; White</option>
                    <option value="161"<?php if($data['Coloring'] == '161') echo ' selected'; ?>>Chocolate Sable</option>
                    <option value="102"<?php if($data['Coloring'] == '102') echo ' selected'; ?>>Chocolate Sabled Fawn</option>
                    <option value="170"<?php if($data['Coloring'] == '170') echo ' selected'; ?>>Chocolate Stag Red</option>
                    <option value="45"<?php if($data['Coloring'] == '45') echo ' selected'; ?>>Chocolate, White &amp; Tan</option>
                    <option value="274"<?php if($data['Coloring'] == '274') echo ' selected'; ?>>Cinnamon</option>
                    <option value="211"<?php if($data['Coloring'] == '211') echo ' selected'; ?>>Copper &amp; White</option>
                    <option value="49"<?php if($data['Coloring'] == '49') echo ' selected'; ?>>Cream</option>
                    <option value="103"<?php if($data['Coloring'] == '103') echo ' selected'; ?>>Cream &amp; White</option>
                    <option value="87"<?php if($data['Coloring'] == '87') echo ' selected'; ?>>Cream Brindle</option>
                    <option value="50"<?php if($data['Coloring'] == '50') echo ' selected'; ?>>Cream Sable</option>
                    <option value="257"<?php if($data['Coloring'] == '257') echo ' selected'; ?>>Dark Deadgrass</option>
                    <option value="145"<?php if($data['Coloring'] == '145') echo ' selected'; ?>>Dark Golden</option>
                    <option value="259"<?php if($data['Coloring'] == '259') echo ' selected'; ?>>Deadgrass</option>
                    <option value="148"<?php if($data['Coloring'] == '148') echo ' selected'; ?>>English Cream</option>
                    <option value="23"<?php if($data['Coloring'] == '23') echo ' selected'; ?>>Fawn</option>
                    <option value="127"<?php if($data['Coloring'] == '127') echo ' selected'; ?>>Fawn (Isabella) Cream</option>
                    <option value="132"<?php if($data['Coloring'] == '132') echo ' selected'; ?>>Fawn (Isabella) &amp; Rust</option>
                    <option value="128"<?php if($data['Coloring'] == '128') echo ' selected'; ?>>Fawn (Isabella) &amp; Tan</option>
                    <option value="172"<?php if($data['Coloring'] == '172') echo ' selected'; ?>>Fawn (Isabella) Stag Red</option>
                    <option value="142"<?php if($data['Coloring'] == '142') echo ' selected'; ?>>Fawn &amp; Black</option>
                    <option value="84"<?php if($data['Coloring'] == '84') echo ' selected'; ?>>Fawn &amp; Brindle</option>
                    <option value="171"<?php if($data['Coloring'] == '171') echo ' selected'; ?>>Fawn &amp; Rust</option>
                    <option value="77"<?php if($data['Coloring'] == '77') echo ' selected'; ?>>Fawn &amp; White</option>
                    <option value="24"<?php if($data['Coloring'] == '24') echo ' selected'; ?>>Fawn Brindle</option>
                    <option value="78"<?php if($data['Coloring'] == '78') echo ' selected'; ?>>Fawn Brindle &amp; White</option>
                    <option value="104"<?php if($data['Coloring'] == '104') echo ' selected'; ?>>Fawn Brindled Black</option>
                    <option value="25"<?php if($data['Coloring'] == '25') echo ' selected'; ?>>Fawn Sable</option>
                    <option value="269"<?php if($data['Coloring'] == '269') echo ' selected'; ?>>Fawn, Black Overlay</option>
                    <option value="155"<?php if($data['Coloring'] == '155') echo ' selected'; ?>>Fawnequin</option>
                    <option value="70"<?php if($data['Coloring'] == '70') echo ' selected'; ?>>Flashy Brindle</option>
                    <option value="73"<?php if($data['Coloring'] == '73') echo ' selected'; ?>>Flashy Fawn</option>
                    <option value="149"<?php if($data['Coloring'] == '149') echo ' selected'; ?>>Fox Red</option>
                    <option value="54"<?php if($data['Coloring'] == '54') echo ' selected'; ?>>Gold</option>
                    <option value="105"<?php if($data['Coloring'] == '105') echo ' selected'; ?>>Gold &amp; White</option>
                    <option value="156"<?php if($data['Coloring'] == '156') echo ' selected'; ?>>Gold Brindle</option>
                    <option value="157"<?php if($data['Coloring'] == '157') echo ' selected'; ?>>Gold Sable</option>
                    <option value="228"<?php if($data['Coloring'] == '228') echo ' selected'; ?>>Gold Sable &amp; White</option>
                    <option value="146"<?php if($data['Coloring'] == '146') echo ' selected'; ?>>Golden</option>
                    <option value="262"<?php if($data['Coloring'] == '262') echo ' selected'; ?>>Golden Rust</option>
                    <option value="51"<?php if($data['Coloring'] == '51') echo ' selected'; ?>>Gray</option>
                    <option value="212"<?php if($data['Coloring'] == '212') echo ' selected'; ?>>Gray &amp; Black</option>
                    <option value="9"<?php if($data['Coloring'] == '9') echo ' selected'; ?>>Gray &amp; White</option>
                    <option value="79"<?php if($data['Coloring'] == '79') echo ' selected'; ?>>Gray Brindle</option>
                    <option value="52"<?php if($data['Coloring'] == '52') echo ' selected'; ?>>Gray Sable</option>
                    <option value="164"<?php if($data['Coloring'] == '164') echo ' selected'; ?>>Grizzle</option>
                    <option value="267"<?php if($data['Coloring'] == '267') echo ' selected'; ?>>Grizzle &amp; Tan</option>
                    <option value="150"<?php if($data['Coloring'] == '150') echo ' selected'; ?>>Harlequin</option>
                    <option value="143"<?php if($data['Coloring'] == '143') echo ' selected'; ?>>Honey Pied</option>
                    <option value="223"<?php if($data['Coloring'] == '223') echo ' selected'; ?>>Isabella</option>
                    <option value="68"<?php if($data['Coloring'] == '68') echo ' selected'; ?>>Lavender</option>
                    <option value="69"<?php if($data['Coloring'] == '69') echo ' selected'; ?>>Lavender &amp; White</option>
                    <option value="221"<?php if($data['Coloring'] == '221') echo ' selected'; ?>>Lemon</option>
                    <option value="40"<?php if($data['Coloring'] == '40') echo ' selected'; ?>>Lemon &amp; White</option>
                    <option value="258"<?php if($data['Coloring'] == '258') echo ' selected'; ?>>Light Deadgrass</option>
                    <option value="147"<?php if($data['Coloring'] == '147') echo ' selected'; ?>>Light Golden</option>
                    <option value="55"<?php if($data['Coloring'] == '55') echo ' selected'; ?>>Lilac</option>
                    <option value="107"<?php if($data['Coloring'] == '107') echo ' selected'; ?>>Lilac &amp; White</option>
                    <option value="26"<?php if($data['Coloring'] == '26') echo ' selected'; ?>>Liver</option>
                    <option value="53"<?php if($data['Coloring'] == '53') echo ' selected'; ?>>Liver &amp; Tan</option>
                    <option value="136"<?php if($data['Coloring'] == '136') echo ' selected'; ?>>Liver &amp; White</option>
                    <option value="234"<?php if($data['Coloring'] == '234') echo ' selected'; ?>>Liver &amp; White, Blue Factored</option>
                    <option value="27"<?php if($data['Coloring'] == '27') echo ' selected'; ?>>Liver Brindle</option>
                    <option value="241"<?php if($data['Coloring'] == '241') echo ' selected'; ?>>Liver Merle</option>
                    <option value="256"<?php if($data['Coloring'] == '256') echo ' selected'; ?>>Liver Pepper</option>
                    <option value="137"<?php if($data['Coloring'] == '137') echo ' selected'; ?>>Liver, White &amp; Tan</option>
                    <option value="47"<?php if($data['Coloring'] == '47') echo ' selected'; ?>>Mahogany</option>
                    <option value="247"<?php if($data['Coloring'] == '247') echo ' selected'; ?>>Mahogany &amp; White</option>
                    <option value="151"<?php if($data['Coloring'] == '151') echo ' selected'; ?>>Mantle</option>
                    <option value="153"<?php if($data['Coloring'] == '153') echo ' selected'; ?>>Mantle Merle</option>
                    <option value="245"<?php if($data['Coloring'] == '245') echo ' selected'; ?>>Merle</option>
                    <option value="154"<?php if($data['Coloring'] == '154') echo ' selected'; ?>>Merlequin</option>
                    <option value="251"<?php if($data['Coloring'] == '251') echo ' selected'; ?>>Mustard</option>
                    <option <?php if(!$data['Coloring']) echo ' selected'; ?>>Not Specified</option>
                    <option value="177"<?php if($data['Coloring'] == '177') echo ' selected'; ?>>Orange</option>
                    <option value="139"<?php if($data['Coloring'] == '139') echo ' selected'; ?>>Orange &amp; White</option>
                    <option value="178"<?php if($data['Coloring'] == '178') echo ' selected'; ?>>Orange Sable</option>
                    <option value="225"<?php if($data['Coloring'] == '225') echo ' selected'; ?>>Orange Sable &amp; White</option>
                    <option value="109"<?php if($data['Coloring'] == '109') echo ' selected'; ?>>Palomino</option>
                    <option value="252"<?php if($data['Coloring'] == '252') echo ' selected'; ?>>Pepper</option>
                    <option value="193"<?php if($data['Coloring'] == '193') echo ' selected'; ?>>Phantom</option>
                    <option value="113"<?php if($data['Coloring'] == '113') echo ' selected'; ?>>Pink</option>
                    <option value="110"<?php if($data['Coloring'] == '110') echo ' selected'; ?>>Pink &amp; Chocolate</option>
                    <option value="111"<?php if($data['Coloring'] == '111') echo ' selected'; ?>>Pink &amp; Slate</option>
                    <option value="5"<?php if($data['Coloring'] == '5') echo ' selected'; ?>>Red</option>
                    <option value="190"<?php if($data['Coloring'] == '190') echo ' selected'; ?>>Red &amp; Apricot</option>
                    <option value="133"<?php if($data['Coloring'] == '133') echo ' selected'; ?>>Red &amp; Rust</option>
                    <option value="135"<?php if($data['Coloring'] == '135') echo ' selected'; ?>>Red &amp; Tan</option>
                    <option value="10"<?php if($data['Coloring'] == '10') echo ' selected'; ?>>Red &amp; White</option>
                    <option value="28"<?php if($data['Coloring'] == '28') echo ' selected'; ?>>Red Brindle</option>
                    <option value="80"<?php if($data['Coloring'] == '80') echo ' selected'; ?>>Red Brindle &amp; White</option>
                    <option value="233"<?php if($data['Coloring'] == '233') echo ' selected'; ?>>Red Dapple</option>
                    <option value="85"<?php if($data['Coloring'] == '85') echo ' selected'; ?>>Red Fawn</option>
                    <option value="86"<?php if($data['Coloring'] == '86') echo ' selected'; ?>>Red Fawn Brindle</option>
                    <option value="165"<?php if($data['Coloring'] == '165') echo ' selected'; ?>>Red Gold</option>
                    <option value="264"<?php if($data['Coloring'] == '264') echo ' selected'; ?>>Red Golden</option>
                    <option value="253"<?php if($data['Coloring'] == '253') echo ' selected'; ?>>Red Leopard</option>
                    <option value="38"<?php if($data['Coloring'] == '38') echo ' selected'; ?>>Red Merle</option>
                    <option value="217"<?php if($data['Coloring'] == '217') echo ' selected'; ?>>Red Merle &amp; White</option>
                    <option value="33"<?php if($data['Coloring'] == '33') echo ' selected'; ?>>Red Mottled</option>
                    <option value="119"<?php if($data['Coloring'] == '119') echo ' selected'; ?>>Red Roan</option>
                    <option value="29"<?php if($data['Coloring'] == '29') echo ' selected'; ?>>Red Sable</option>
                    <option value="235"<?php if($data['Coloring'] == '235') echo ' selected'; ?>>Red Sable &amp; White</option>
                    <option value="243"<?php if($data['Coloring'] == '243') echo ' selected'; ?>>Red Sable Blue Factored</option>
                    <option value="202"<?php if($data['Coloring'] == '202') echo ' selected'; ?>>Red Sesame</option>
                    <option value="34"<?php if($data['Coloring'] == '34') echo ' selected'; ?>>Red Speckled</option>
                    <option value="237"<?php if($data['Coloring'] == '237') echo ' selected'; ?>>Red Tri</option>
                    <option value="88"<?php if($data['Coloring'] == '88') echo ' selected'; ?>>Red Wheaten</option>
                    <option value="270"<?php if($data['Coloring'] == '270') echo ' selected'; ?>>Red, Black Overlay</option>
                    <option value="71"<?php if($data['Coloring'] == '71') echo ' selected'; ?>>Reverse Brindle</option>
                    <option value="72"<?php if($data['Coloring'] == '72') echo ' selected'; ?>>Reverse Flashy Brindle</option>
                    <option value="92"<?php if($data['Coloring'] == '92') echo ' selected'; ?>>Ruby</option>
                    <option value="261"<?php if($data['Coloring'] == '261') echo ' selected'; ?>>Rust</option>
                    <option value="265"<?php if($data['Coloring'] == '265') echo ' selected'; ?>>Rust Golden</option>
                    <option value="56"<?php if($data['Coloring'] == '56') echo ' selected'; ?>>Sable</option>
                    <option value="11"<?php if($data['Coloring'] == '11') echo ' selected'; ?>>Sable &amp; White</option>
                    <option value="57"<?php if($data['Coloring'] == '57') echo ' selected'; ?>>Sable Merle</option>
                    <option value="122"<?php if($data['Coloring'] == '122') echo ' selected'; ?>>Sable Merle &amp; White</option>
                    <option value="236"<?php if($data['Coloring'] == '236') echo ' selected'; ?>>Sable Piebald</option>
                    <option value="250"<?php if($data['Coloring'] == '250') echo ' selected'; ?>>Salt</option>
                    <option value="198"<?php if($data['Coloring'] == '198') echo ' selected'; ?>>Salt &amp; Pepper</option>
                    <option value="273"<?php if($data['Coloring'] == '273') echo ' selected'; ?>>Sandy</option>
                    <option value="266"<?php if($data['Coloring'] == '266') echo ' selected'; ?>>Sandy Yellow</option>
                    <option value="67"<?php if($data['Coloring'] == '67') echo ' selected'; ?>>Seal</option>
                    <option value="12"<?php if($data['Coloring'] == '12') echo ' selected'; ?>>Seal &amp; White</option>
                    <option value="30"<?php if($data['Coloring'] == '30') echo ' selected'; ?>>Seal Brown</option>
                    <option value="66"<?php if($data['Coloring'] == '66') echo ' selected'; ?>>Seal, Brindle &amp; White</option>
                    <option value="260"<?php if($data['Coloring'] == '260') echo ' selected'; ?>>Sedge</option>
                    <option value="224"<?php if($data['Coloring'] == '224') echo ' selected'; ?>>Shaded Cream</option>
                    <option value="106"<?php if($data['Coloring'] == '106') echo ' selected'; ?>>Silver</option>
                    <option value="13"<?php if($data['Coloring'] == '13') echo ' selected'; ?>>Silver &amp; White</option>
                    <option value="185"<?php if($data['Coloring'] == '185') echo ' selected'; ?>>Silver Beige</option>
                    <option value="158"<?php if($data['Coloring'] == '158') echo ' selected'; ?>>Silver Brindle</option>
                    <option value="231"<?php if($data['Coloring'] == '231') echo ' selected'; ?>>Silver Dapple</option>
                    <option value="196"<?php if($data['Coloring'] == '196') echo ' selected'; ?>>Silver Fawn</option>
                    <option value="215"<?php if($data['Coloring'] == '215') echo ' selected'; ?>>Silver Gray</option>
                    <option value="255"<?php if($data['Coloring'] == '255') echo ' selected'; ?>>Silver Leopard</option>
                    <option value="162"<?php if($data['Coloring'] == '162') echo ' selected'; ?>>Silver Sable</option>
                    <option value="271"<?php if($data['Coloring'] == '271') echo ' selected'; ?>>Silver, Black Overlay</option>
                    <option value="206"<?php if($data['Coloring'] == '206') echo ' selected'; ?>>Silver, Gold &amp; White</option>
                    <option value="112"<?php if($data['Coloring'] == '112') echo ' selected'; ?>>Slate</option>
                    <option value="168"<?php if($data['Coloring'] == '168') echo ' selected'; ?>>Stag Red</option>
                    <option value="74"<?php if($data['Coloring'] == '74') echo ' selected'; ?>>Tan</option>
                    <option value="213"<?php if($data['Coloring'] == '213') echo ' selected'; ?>>Tan &amp; Black</option>
                    <option value="214"<?php if($data['Coloring'] == '214') echo ' selected'; ?>>Tan &amp; White</option>
                    <option value="244"<?php if($data['Coloring'] == '244') echo ' selected'; ?>>Tawny</option>
                    <option value="36"<?php if($data['Coloring'] == '36') echo ' selected'; ?>>Tri</option>
                    <option value="179"<?php if($data['Coloring'] == '179') echo ' selected'; ?>>Tri-Colored</option>
                    <option value="999999"<?php if($data['Coloring'] == '999999') echo ' selected'; ?>>Unknown</option>
                    <option value="76"<?php if($data['Coloring'] == '76') echo ' selected'; ?>>Wheaten</option>
                    <option value="14"<?php if($data['Coloring'] == '14') echo ' selected'; ?>>White</option>
                    <option value="191"<?php if($data['Coloring'] == '191') echo ' selected'; ?>>White &amp; Apricot</option>
                    <option value="276"<?php if($data['Coloring'] == '276') echo ' selected'; ?>>White &amp; Badger</option>
                    <option value="15"<?php if($data['Coloring'] == '15') echo ' selected'; ?>>White &amp; Biscuit</option>
                    <option value="58"<?php if($data['Coloring'] == '58') echo ' selected'; ?>>White &amp; Black</option>
                    <option value="59"<?php if($data['Coloring'] == '59') echo ' selected'; ?>>White &amp; Blue</option>
                    <option value="60"<?php if($data['Coloring'] == '60') echo ' selected'; ?>>White &amp; Blue Merle</option>
                    <option value="140"<?php if($data['Coloring'] == '140') echo ' selected'; ?>>White &amp; Brindle</option>
                    <option value="114"<?php if($data['Coloring'] == '114') echo ' selected'; ?>>White &amp; Chocolate</option>
                    <option value="141"<?php if($data['Coloring'] == '141') echo ' selected'; ?>>White &amp; Fawn</option>
                    <option value="138"<?php if($data['Coloring'] == '138') echo ' selected'; ?>>White &amp; Liver</option>
                    <option value="61"<?php if($data['Coloring'] == '61') echo ' selected'; ?>>White &amp; Red</option>
                    <option value="62"<?php if($data['Coloring'] == '62') echo ' selected'; ?>>White &amp; Red Merle</option>
                    <option value="173"<?php if($data['Coloring'] == '173') echo ' selected'; ?>>White &amp; Sable</option>
                    <option value="201"<?php if($data['Coloring'] == '201') echo ' selected'; ?>>White &amp; Sable Merle</option>
                    <option value="192"<?php if($data['Coloring'] == '192') echo ' selected'; ?>>White &amp; Silver</option>
                    <option value="277"<?php if($data['Coloring'] == '277') echo ' selected'; ?>>White &amp; Tan</option>
                    <option value="123"<?php if($data['Coloring'] == '123') echo ' selected'; ?>>White Merle</option>
                    <option value="63"<?php if($data['Coloring'] == '63') echo ' selected'; ?>>White Ticked</option>
                    <option value="167"<?php if($data['Coloring'] == '167') echo ' selected'; ?>>White with Cream</option>
                    <option value="174"<?php if($data['Coloring'] == '174') echo ' selected'; ?>>White, Black &amp; Tan</option>
                    <option value="272"<?php if($data['Coloring'] == '272') echo ' selected'; ?>>White, Red Shading</option>
                    <option value="129"<?php if($data['Coloring'] == '129') echo ' selected'; ?>>Wild Boar</option>
                    <option value="180"<?php if($data['Coloring'] == '180') echo ' selected'; ?>>Wolf Sable</option>
                    <option value="163"<?php if($data['Coloring'] == '163') echo ' selected'; ?>>Yellow</option>
                </select>
            </div>
        </div>
    </div>
    <div id="registryRegistration">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="form_registry_registration">Registration Number*</label><input required class="form-control" name="ReferenceNumber" type="text" id="form_registry_registration" value="<?php echo $data['ReferenceNumber']; ?>">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col col-50">
            <div class="form-group">
                <label>OFA Certified?*</label><br>
                <label class="radio-inline">
                    <input required name="ofa_certified" value="yes" type="radio"<?php echo ($data['ofa_certified'] && $data['ofa_certified'] == 'yes') ? ' checked' : ''; ?>> Yes
                </label>
                <label class="radio-inline">
                    <input required name="ofa_certified" value="no" type="radio"<?php echo ($data['ofa_certified'] && $data['ofa_certified'] == 'yes') ? '' : ' checked'; ?>> No
                </label>
            </div>
            <!--div class="form-group" id="ofaBodyParts" style="display: none;">
                <div class="col">
                    <div class="body-checkbox">
                        <div class="form-group">
                            <label class="checkbox-inline">
                                <input name="ofaBodyPartElbows" value="1" type="checkbox" id="form_ofaBodyPartElbows"> Elbows </label>
                        </div>
                    </div>
                    <div class="body-certification">
                        <div class="form-group ofa_certification_num" id="ofaCertificationNumElbows" style="display: none;">
                            <label for="form_ofa_number_Elbows">OFA Certification #</label> <input class="form-control" name="ofa_number_Elbows" type="text" id="form_ofa_number_Elbows"> </div>
                    </div>
                </div>
                <div class="col">
                    <div class="body-checkbox">
                        <div class="form-group">
                            <label class="checkbox-inline">
                                <input name="ofaBodyPartEyes" value="1" type="checkbox" id="form_ofaBodyPartEyes"> Eyes </label>
                        </div>
                    </div>
                    <div class="body-certification">
                        <div class="form-group ofa_certification_num" id="ofaCertificationNumEyes" style="display: none;">
                            <label for="form_ofa_number_Eyes">OFA Certification #</label> <input class="form-control" name="ofa_number_Eyes" type="text" id="form_ofa_number_Eyes"> </div>
                    </div>
                </div>
                <div class="col">
                    <div class="body-checkbox">
                        <div class="form-group">
                            <label class="checkbox-inline">
                                <input name="ofaBodyPartHeart" value="1" type="checkbox" id="form_ofaBodyPartHeart"> Heart </label>
                        </div>
                    </div>
                    <div class="body-certification">
                        <div class="form-group ofa_certification_num" id="ofaCertificationNumHeart" style="display: none;">
                            <label for="form_ofa_number_Heart">OFA Certification #</label> <input class="form-control" name="ofa_number_Heart" type="text" id="form_ofa_number_Heart"> </div>
                    </div>
                </div>
                <div class="col">
                    <div class="body-checkbox">
                        <div class="form-group">
                            <label class="checkbox-inline">
                                <input name="ofaBodyPartHips" value="1" type="checkbox" id="form_ofaBodyPartHips"> Hips </label>
                        </div>
                    </div>
                    <div class="body-certification">
                        <div class="form-group ofa_certification_num" id="ofaCertificationNumHips" style="display: none;">
                            <label for="form_ofa_number_Hips">OFA Certification #</label> <input class="form-control" name="ofa_number_Hips" type="text" id="form_ofa_number_Hips"> </div>
                    </div>
                </div>
                <div class="col">
                    <div class="body-checkbox">
                        <div class="form-group">
                            <label class="checkbox-inline">
                                <input name="ofaBodyPartKnees" value="1" type="checkbox" id="form_ofaBodyPartKnees"> Knees </label>
                        </div>
                    </div>
                    <div class="body-certification">
                        <div class="form-group ofa_certification_num" id="ofaCertificationNumKnees" style="display: none;">
                            <label for="form_ofa_number_Knees">OFA Certification #</label> <input class="form-control" name="ofa_number_Knees" type="text" id="form_ofa_number_Knees"> </div>
                    </div>
                </div>
            </div-->
        </div>
    </div>
    <div class="row">
        <div class="col col-50">
            <div class="form-group">
                <label>Does this parent have any champions in the last three generations?*</label><br>
                <label class="radio-inline">
                    <input required name="champion" value="yes" type="radio"<?php echo ($data['champion'] && $data['champion'] == 'yes') ? ' checked' : ''; ?>> Yes
                </label>
                <label class="radio-inline">
                    <input required name="champion" value="no" type="radio"<?php echo ($data['champion'] && $data['champion'] == 'yes') ? '' : ' checked'; ?>> No
                </label>
            </div>
        </div>
        <div class="col col-50">
            <div class="form-group">
                <label for="form_has_been_shown">Has this parent been shown?</label><br>
                <label class="radio-inline">
                    <input name="has_been_shown" value="yes" type="radio"<?php echo ($data['has_been_shown'] && $data['has_been_shown'] == 'yes') ? ' checked' : ''; ?>> Yes
                </label>
                <label class="radio-inline">
                    <input name="has_been_shown" value="no" type="radio"<?php echo ($data['has_been_shown'] && $data['has_been_shown'] == 'yes') ? '' : ' checked'; ?>> No
                </label>
            </div>
        </div>
    </div>
    <!--div class="row">
        <div class="col">
            <label for="form_">What activities does this parent enjoy?</label> <div class="row-fluid">
                <div class="col col-50">
                    <div class="form-group">
                        <label class="checkbox-inline">
                            <input name="activities[]" value="902" type="checkbox" id="form_activities[]"> Hanging out </label>
                    </div>
                </div>
            </div>
            <div class="row-fluid">
                <div class="col col-50">
                    <div class="form-group">
                        <label class="checkbox-inline">
                            <input name="activities[]" value="900" type="checkbox" id="form_activities[]"> Hunting </label>
                    </div>
                </div>
            </div>
            <div class="row-fluid">
                <div class="col col-50">
                    <div class="form-group">
                        <label class="checkbox-inline">
                            <input name="activities[]" value="899" type="checkbox" id="form_activities[]"> Playing with toys </label>
                    </div>
                </div>
            </div>
            <div class="row-fluid">
                <div class="col col-50">
                    <div class="form-group">
                        <label class="checkbox-inline">
                            <input name="activities[]" value="898" type="checkbox" id="form_activities[]"> Running </label>
                    </div>
                </div>
            </div>
            <div class="row-fluid">
                <div class="col col-50">
                    <div class="form-group">
                        <label class="checkbox-inline">
                            <input name="activities[]" value="901" type="checkbox" id="form_activities[]"> Sleeping </label>
                    </div>
                </div>
            </div>
            <div class="row-fluid">
                <div class="col col-50">
                    <div class="form-group">
                        <label class="checkbox-inline">
                            <input name="activities[]" value="904" type="checkbox" id="form_activities[]"> Therapy </label>
                    </div>
                </div>
            </div>
            <div class="row-fluid">
                <div class="col col-50">
                    <div class="form-group">
                        <label class="checkbox-inline">
                            <input name="activities[]" value="903" type="checkbox" id="form_activities[]"> Working </label>
                    </div>
                </div>
            </div>
        </div>
    </div-->
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="form_description">What is this dog's personality like?</label><br>
                <textarea rows="5" class="form-control" name="Description" id="form_description"><?php echo $data['Description']; ?></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label>Photo</label><br>
                <?php
                    if($data['Photo']) {
                        echo wp_get_attachment_image($data['Photo'], 'full ');// . '<a id="deleteImage" href="">Delete</a>';
                    }
                ?>
                <input type="file" name="Photo">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col col-submit">
            <button name="dashboard_submit">Submit</button>
            <input type="hidden" name="type" value="parents">
            <input type="hidden" name="action" value="<?php echo $vars['action']; ?>">
            <?php if($vars['action'] == 'edit') { ?>
                <input type="hidden" name="product_id" value="<?php echo $vars['path_id']; ?>">
            <?php } ?>
        </div>
    </div>
</form>