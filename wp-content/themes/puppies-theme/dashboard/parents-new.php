<h1>Create Parent</h1>
<form enctype="multipart/form-data" action="" accept-charset="utf-8" method="post">
    <div class="row">
        <div class="col col-50">
            <div class="form-group">
                <label for="form_name">Name*</label> <input required="required" class="form-control" name="PetName"
                                                            type="text" id="form_name">
            </div>
        </div>
        <div class="col col-50">
            <div class="form-group">
                <label>Parent Gender*</label> <br>
                <label class="radio-inline">
                    <input required="required" name="Gender" value="Male" type="radio" checked> Male
                </label>
                <label class="radio-inline">
                    <input required="required" name="Gender" value="Female" type="radio"> Female
                </label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col col-50">
            <div class="form-group">
                <label for="form_birthdate">Birthdate*</label>
                <div class="input-group date">
                    <input required="required" readonly="readonly" class="datepicker" name="BirthDate" type="text"
                           id="form_birthdate"> <span class="input-group-addon"><span
                                class="glyphicon-calendar glyphicon"></span></span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col col-50">
            <div class="form-group">
                <label for="form_breed_id">Breed*</label>
                <select class="form-control breed-dropdown-select" required="required" name="BreedName">
                    <option></option>
                  <?php
                  $categories = get_categories(array(
                    'taxonomy' => 'product_cat',
                    'child_of' => BREEDS_CATEGORY_ID,
                    'hide_empty' => false,
                  ));
                  if ($categories) {
                    foreach ($categories as $cat) {
                      echo '<option>' . $cat->name . '</option>';
                    }
                  }
                  ?>

                </select>
            </div>
        </div>
        <div class="col col-50">
            <div class="form-group">
                <label>Weight*</label>
                <select class="form-control" required="required" name="Weight">
                    <option></option>
                    <option value="10 - 13 ozs">10 - 13 ozs</option>
                    <option value="13 - 16 ozs">13 - 16 ozs</option>
                    <option value="16 - 20 ozs">16 - 20 ozs</option>
                    <option value="20 - 24 ozs">20 - 24 ozs</option>
                    <option value="24 - 28 ozs">24 - 28 ozs</option>
                    <option value="28 ozs - 2 lbs">28 ozs - 2 lbs</option>
                    <option value="2 - 2 1/2 lbs">2 - 2 1/2 lbs</option>
                    <option value="2 1/2 - 3 lbs">2 1/2 - 3 lbs</option>
                    <option value="3 - 3 1/2 lbs">3 - 3 1/2 lbs</option>
                    <option value="3 1/2 - 4 lbs">3 1/2 - 4 lbs</option>
                    <option value="4 - 4 1/2 lbs">4 - 4 1/2 lbs</option>
                    <option value="4 1/2 - 5 lbs">4 1/2 - 5 lbs</option>
                    <option value="5 - 6 lbs">5 - 6 lbs</option>
                    <option value="6 - 7 lbs">6 - 7 lbs</option>
                    <option value="7 - 8 lbs">7 - 8 lbs</option>
                    <option value="8 - 9 lbs">8 - 9 lbs</option>
                    <option value="9 - 10 lbs">9 - 10 lbs</option>
                    <option value="10 - 12 lbs">10 - 12 lbs</option>
                    <option value="12 - 14 lbs">12 - 14 lbs</option>
                    <option value="14 - 16 lbs">14 - 16 lbs</option>
                    <option value="16 - 18 lbs">16 - 18 lbs</option>
                    <option value="18 - 20 lbs">18 - 20 lbs</option>
                    <option value="20 - 22 lbs">20 - 22 lbs</option>
                    <option value="22 - 25 lbs">22 - 25 lbs</option>
                    <option value="25 - 30 lbs">25 - 30 lbs</option>
                    <option value="30 - 35 lbs">30 - 35 lbs</option>
                    <option value="35 - 40 lbs">35 - 40 lbs</option>
                    <option value="40 - 45 lbs">40 - 45 lbs</option>
                    <option value="45 - 50 lbs">45 - 50 lbs</option>
                    <option value="50 - 55 lbs">50 - 55 lbs</option>
                    <option value="55 - 60 lbs">55 - 60 lbs</option>
                    <option value="60 - 65 lbs">60 - 65 lbs</option>
                    <option value="65 - 70 lbs">65 - 70 lbs</option>
                    <option value="70 - 75 lbs">70 - 75 lbs</option>
                    <option value="75 - 80 lbs">75 - 80 lbs</option>
                    <option value="80 - 85 lbs">80 - 85 lbs</option>
                    <option value="85 - 90 lbs">85 - 90 lbs</option>
                    <option value="90 - 95 lbs">90 - 95 lbs</option>
                    <option value="95 - 100 lbs">95 - 100 lbs</option>
                    <option value="100 - 110 lbs">100 - 110 lbs</option>
                    <option value="110 - 120 lbs">110 - 120 lbs</option>
                    <option value="120 - 130 lbs">120 - 130 lbs</option>
                    <option value="130 - 140 lbs">130 - 140 lbs</option>
                    <option value="140 - 150 lbs">140 - 150 lbs</option>
                    <option value="150 - 160 lbs">150 - 160 lbs</option>
                    <option value="160 - 175 lbs">160 - 175 lbs</option>
                    <option value="175 - 190 lbs">175 - 190 lbs</option>
                    <option value="190 - 210 lbs">190 - 210 lbs</option>
                    <option value="above 210 lbs">above 210 lbs</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col col-50">
            <div class="form-group">
                <label>Registry*</label>
                <select class="form-control" required="required" name="RegistryName">
                    <option></option>
                    <option value="ACA">ACA</option>
                    <option value="AKC">AKC</option>
                    <option value="APRI">APRI</option>
                    <option value="CKC">CKC</option>
                    <option value="Not registered">Not registered</option>
                    <option value="ABA">ABA</option>
                    <option value="ABCA">ABCA</option>
                    <option value="ABRA">ABRA</option>
                    <option value="ACC">ACC</option>
                    <option value="ACHC">ACHC</option>
                    <option value="ACR">ACR</option>
                    <option value="ADBA">ADBA</option>
                    <option value="ADRK">ADRK</option>
                    <option value="AHTCA">AHTCA</option>
                    <option value="AKR">AKR</option>
                    <option value="ALAA">ALAA</option>
                    <option value="ALCA">ALCA</option>
                    <option value="AMRA">AMRA</option>
                    <option value="APR">APR</option>
                    <option value="ARBA">ARBA</option>
                    <option value="ARF">ARF</option>
                    <option value="ASCA">ASCA</option>
                    <option value="ASDR">ASDR</option>
                    <option value="AVHDA">AVHDA</option>
                    <option value="BBIR">BBIR</option>
                    <option value="BSS">BSS</option>
                    <option value="BYA">BYA</option>
                    <option value="CanKC">CanKC</option>
                    <option value="CPD">CPD</option>
                    <option value="CPR">CPR</option>
                    <option value="CWTC">CWTC</option>
                    <option value="DBR">DBR</option>
                    <option value="DRA">DRA</option>
                    <option value="FCI">FCI</option>
                    <option value="FCPR">FCPR</option>
                    <option value="FDSB">FDSB</option>
                    <option value="GKC">GKC</option>
                    <option value="HPA">HPA</option>
                    <option value="IABBR">IABBR</option>
                    <option value="IBC">IBC</option>
                    <option value="IBCA">IBCA</option>
                    <option value="IBKC">IBKC</option>
                    <option value="ICA">ICA</option>
                    <option value="ICCF">ICCF</option>
                    <option value="IDCR">IDCR</option>
                    <option value="IKC">IKC</option>
                    <option value="IMASC">IMASC</option>
                    <option value="IOEBA">IOEBA</option>
                    <option value="IPA">IPA</option>
                    <option value="MASCA">MASCA</option>
                    <option value="MSCA">MSCA</option>
                    <option value="NADSR">NADSR</option>
                    <option value="NALC">NALC</option>
                    <option value="NAPDR">NAPDR</option>
                    <option value="NAPR">NAPR</option>
                    <option value="NCA">NCA</option>
                    <option value="NHR">NHR</option>
                    <option value="NKC">NKC</option>
                    <option value="NPCR">NPCR</option>
                    <option value="NSDR">NSDR</option>
                    <option value="OBBA">OBBA</option>
                    <option value="OEPB">OEPB</option>
                    <option value="UABR">UABR</option>
                    <option value="UCA">UCA</option>
                    <option value="UCHC">UCHC</option>
                    <option value="UKC">UKC</option>
                    <option value="UKCI">UKCI</option>
                    <option value="WBA">WBA</option>
                    <option value="WDRC">WDRC</option>
                    <option value="WKC">WKC</option>
                    <option value="WWKC">WWKC</option>
                </select>
            </div>
        </div>
        <div class="col col-50">
            <div class="form-group">
                <label>Color*</label>
                <select required="required" class="form-control" name="Coloring">
                    <option value="6">Agouti &amp; White</option>
                    <option value="108">Apricot</option>
                    <option value="229">Apricot &amp; White</option>
                    <option value="195">Apricot Fawn</option>
                    <option value="175">Beaver</option>
                    <option value="181">Beaver Sable</option>
                    <option value="1">Beige</option>
                    <option value="35">Bi</option>
                    <option value="144">Bi-Color</option>
                    <option value="2">Black</option>
                    <option value="186">Black &amp; Apricot</option>
                    <option value="182">Black &amp; Brindle</option>
                    <option value="187">Black &amp; Brown</option>
                    <option value="124">Black &amp; Cream</option>
                    <option value="81">Black &amp; Fawn</option>
                    <option value="219">Black &amp; Gold</option>
                    <option value="188">Black &amp; Gray</option>
                    <option value="197">Black &amp; Mahogany</option>
                    <option value="95">Black &amp; Red</option>
                    <option value="130">Black &amp; Rust</option>
                    <option value="3">Black &amp; Silver</option>
                    <option value="159">Black &amp; Silver Brindle</option>
                    <option value="4">Black &amp; Tan</option>
                    <option value="160">Black &amp; Tan Brindle</option>
                    <option value="242">Black &amp; Tan Merle</option>
                    <option value="7">Black &amp; White</option>
                    <option value="240">Black and White Piebald</option>
                    <option value="16">Black Brindle</option>
                    <option value="239">Black Brindle &amp; White</option>
                    <option value="96">Black Sabled Fawn</option>
                    <option value="97">Black Sabled Silver</option>
                    <option value="64">Black, Brindle &amp; White</option>
                    <option value="82">Black, Fawn &amp; White</option>
                    <option value="203">Black, Gold &amp; Silver</option>
                    <option value="204">Black, Gold &amp; White</option>
                    <option value="207">Black, Gray &amp; White</option>
                    <option value="43">Black, Red &amp; White</option>
                    <option value="230">Black, Silver &amp; Tan</option>
                    <option value="44">Black, Tan &amp; Bluetick</option>
                    <option value="46">Black, Tan &amp; Redtick</option>
                    <option value="39">Black, Tan &amp; White</option>
                    <option value="205">Black, White &amp; Silver</option>
                    <option value="90">Black, White &amp; Tan</option>
                    <option value="91">Blenheim</option>
                    <option value="17">Blue</option>
                    <option value="125">Blue &amp; Cream</option>
                    <option value="220">Blue &amp; Gold</option>
                    <option value="131">Blue &amp; Rust</option>
                    <option value="93">Blue &amp; Tan</option>
                    <option value="8">Blue &amp; White</option>
                    <option value="222">Blue &amp; White Pied</option>
                    <option value="18">Blue Brindle</option>
                    <option value="98">Blue Brindled Fawn</option>
                    <option value="19">Blue Fawn</option>
                    <option value="227">Blue Fawn &amp; White</option>
                    <option value="20">Blue Fawn Brindle</option>
                    <option value="254">Blue Leopard</option>
                    <option value="37">Blue Merle</option>
                    <option value="120">Blue Merle &amp; White</option>
                    <option value="121">Blue Merle, White &amp; Tan</option>
                    <option value="31">Blue Mottled</option>
                    <option value="117">Blue Roan</option>
                    <option value="118">Blue Roan &amp; Tan</option>
                    <option value="176">Blue Sable</option>
                    <option value="32">Blue Speckled</option>
                    <option value="169">Blue Stag Red</option>
                    <option value="41">Blue, Tan &amp; White</option>
                    <option value="48">Brindle</option>
                    <option value="65">Brindle &amp; White</option>
                    <option value="216">Brindle Merle &amp; White</option>
                    <option value="248">Bronze</option>
                    <option value="249">Bronze &amp; White</option>
                    <option value="21">Brown</option>
                    <option value="209">Brown &amp; White</option>
                    <option value="22">Brown Brindle</option>
                    <option value="210">Brown, Black &amp; White</option>
                    <option value="268">Brown, Black Overlay</option>
                    <option value="42">Brown, White &amp; Tan</option>
                    <option value="115">Buff</option>
                    <option value="116">Buff &amp; White</option>
                    <option value="184">Cafe Au Lait</option>
                    <option value="166">Charcoal</option>
                    <option value="275">Chestnut</option>
                    <option value="89">Chestnut Brindle</option>
                    <option value="75">Chocolate</option>
                    <option value="189">Chocolate &amp; Apricot</option>
                    <option value="126">Chocolate &amp; Cream</option>
                    <option value="226">Chocolate &amp; Gold</option>
                    <option value="134">Chocolate &amp; Rust</option>
                    <option value="94">Chocolate &amp; Tan</option>
                    <option value="99">Chocolate &amp; White</option>
                    <option value="100">Chocolate Blue</option>
                    <option value="152">Chocolate Brindle</option>
                    <option value="101">Chocolate Brindled Fawn</option>
                    <option value="232">Chocolate Dapple</option>
                    <option value="183">Chocolate Merle</option>
                    <option value="194">Chocolate Phantom</option>
                    <option value="238">Chocolate Roan &amp; White</option>
                    <option value="161">Chocolate Sable</option>
                    <option value="102">Chocolate Sabled Fawn</option>
                    <option value="170">Chocolate Stag Red</option>
                    <option value="45">Chocolate, White &amp; Tan</option>
                    <option value="274">Cinnamon</option>
                    <option value="211">Copper &amp; White</option>
                    <option value="49">Cream</option>
                    <option value="103">Cream &amp; White</option>
                    <option value="87">Cream Brindle</option>
                    <option value="50">Cream Sable</option>
                    <option value="257">Dark Deadgrass</option>
                    <option value="145">Dark Golden</option>
                    <option value="259">Deadgrass</option>
                    <option value="148">English Cream</option>
                    <option value="23">Fawn</option>
                    <option value="127">Fawn (Isabella) Cream</option>
                    <option value="132">Fawn (Isabella) &amp; Rust</option>
                    <option value="128">Fawn (Isabella) &amp; Tan</option>
                    <option value="172">Fawn (Isabella) Stag Red</option>
                    <option value="142">Fawn &amp; Black</option>
                    <option value="84">Fawn &amp; Brindle</option>
                    <option value="171">Fawn &amp; Rust</option>
                    <option value="77">Fawn &amp; White</option>
                    <option value="24">Fawn Brindle</option>
                    <option value="78">Fawn Brindle &amp; White</option>
                    <option value="104">Fawn Brindled Black</option>
                    <option value="25">Fawn Sable</option>
                    <option value="269">Fawn, Black Overlay</option>
                    <option value="155">Fawnequin</option>
                    <option value="70">Flashy Brindle</option>
                    <option value="73">Flashy Fawn</option>
                    <option value="149">Fox Red</option>
                    <option value="54">Gold</option>
                    <option value="105">Gold &amp; White</option>
                    <option value="156">Gold Brindle</option>
                    <option value="157">Gold Sable</option>
                    <option value="228">Gold Sable &amp; White</option>
                    <option value="146">Golden</option>
                    <option value="262">Golden Rust</option>
                    <option value="51">Gray</option>
                    <option value="212">Gray &amp; Black</option>
                    <option value="9">Gray &amp; White</option>
                    <option value="79">Gray Brindle</option>
                    <option value="52">Gray Sable</option>
                    <option value="164">Grizzle</option>
                    <option value="267">Grizzle &amp; Tan</option>
                    <option value="150">Harlequin</option>
                    <option value="143">Honey Pied</option>
                    <option value="223">Isabella</option>
                    <option value="68">Lavender</option>
                    <option value="69">Lavender &amp; White</option>
                    <option value="221">Lemon</option>
                    <option value="40">Lemon &amp; White</option>
                    <option value="258">Light Deadgrass</option>
                    <option value="147">Light Golden</option>
                    <option value="55">Lilac</option>
                    <option value="107">Lilac &amp; White</option>
                    <option value="26">Liver</option>
                    <option value="53">Liver &amp; Tan</option>
                    <option value="136">Liver &amp; White</option>
                    <option value="234">Liver &amp; White, Blue Factored</option>
                    <option value="27">Liver Brindle</option>
                    <option value="241">Liver Merle</option>
                    <option value="256">Liver Pepper</option>
                    <option value="137">Liver, White &amp; Tan</option>
                    <option value="47">Mahogany</option>
                    <option value="247">Mahogany &amp; White</option>
                    <option value="151">Mantle</option>
                    <option value="153">Mantle Merle</option>
                    <option value="245">Merle</option>
                    <option value="154">Merlequin</option>
                    <option value="251">Mustard</option>
                    <option selected="selected">Not Specified</option>
                    <option value="177">Orange</option>
                    <option value="139">Orange &amp; White</option>
                    <option value="178">Orange Sable</option>
                    <option value="225">Orange Sable &amp; White</option>
                    <option value="109">Palomino</option>
                    <option value="252">Pepper</option>
                    <option value="193">Phantom</option>
                    <option value="113">Pink</option>
                    <option value="110">Pink &amp; Chocolate</option>
                    <option value="111">Pink &amp; Slate</option>
                    <option value="5">Red</option>
                    <option value="190">Red &amp; Apricot</option>
                    <option value="133">Red &amp; Rust</option>
                    <option value="135">Red &amp; Tan</option>
                    <option value="10">Red &amp; White</option>
                    <option value="28">Red Brindle</option>
                    <option value="80">Red Brindle &amp; White</option>
                    <option value="233">Red Dapple</option>
                    <option value="85">Red Fawn</option>
                    <option value="86">Red Fawn Brindle</option>
                    <option value="165">Red Gold</option>
                    <option value="264">Red Golden</option>
                    <option value="253">Red Leopard</option>
                    <option value="38">Red Merle</option>
                    <option value="217">Red Merle &amp; White</option>
                    <option value="33">Red Mottled</option>
                    <option value="119">Red Roan</option>
                    <option value="29">Red Sable</option>
                    <option value="235">Red Sable &amp; White</option>
                    <option value="243">Red Sable Blue Factored</option>
                    <option value="202">Red Sesame</option>
                    <option value="34">Red Speckled</option>
                    <option value="237">Red Tri</option>
                    <option value="88">Red Wheaten</option>
                    <option value="270">Red, Black Overlay</option>
                    <option value="71">Reverse Brindle</option>
                    <option value="72">Reverse Flashy Brindle</option>
                    <option value="92">Ruby</option>
                    <option value="261">Rust</option>
                    <option value="265">Rust Golden</option>
                    <option value="56">Sable</option>
                    <option value="11">Sable &amp; White</option>
                    <option value="57">Sable Merle</option>
                    <option value="122">Sable Merle &amp; White</option>
                    <option value="236">Sable Piebald</option>
                    <option value="250">Salt</option>
                    <option value="198">Salt &amp; Pepper</option>
                    <option value="273">Sandy</option>
                    <option value="266">Sandy Yellow</option>
                    <option value="67">Seal</option>
                    <option value="12">Seal &amp; White</option>
                    <option value="30">Seal Brown</option>
                    <option value="66">Seal, Brindle &amp; White</option>
                    <option value="260">Sedge</option>
                    <option value="224">Shaded Cream</option>
                    <option value="106">Silver</option>
                    <option value="13">Silver &amp; White</option>
                    <option value="185">Silver Beige</option>
                    <option value="158">Silver Brindle</option>
                    <option value="231">Silver Dapple</option>
                    <option value="196">Silver Fawn</option>
                    <option value="215">Silver Gray</option>
                    <option value="255">Silver Leopard</option>
                    <option value="162">Silver Sable</option>
                    <option value="271">Silver, Black Overlay</option>
                    <option value="206">Silver, Gold &amp; White</option>
                    <option value="112">Slate</option>
                    <option value="168">Stag Red</option>
                    <option value="74">Tan</option>
                    <option value="213">Tan &amp; Black</option>
                    <option value="214">Tan &amp; White</option>
                    <option value="244">Tawny</option>
                    <option value="36">Tri</option>
                    <option value="179">Tri-Colored</option>
                    <option value="999999">Unknown</option>
                    <option value="76">Wheaten</option>
                    <option value="14">White</option>
                    <option value="191">White &amp; Apricot</option>
                    <option value="276">White &amp; Badger</option>
                    <option value="15">White &amp; Biscuit</option>
                    <option value="58">White &amp; Black</option>
                    <option value="59">White &amp; Blue</option>
                    <option value="60">White &amp; Blue Merle</option>
                    <option value="140">White &amp; Brindle</option>
                    <option value="114">White &amp; Chocolate</option>
                    <option value="141">White &amp; Fawn</option>
                    <option value="138">White &amp; Liver</option>
                    <option value="61">White &amp; Red</option>
                    <option value="62">White &amp; Red Merle</option>
                    <option value="173">White &amp; Sable</option>
                    <option value="201">White &amp; Sable Merle</option>
                    <option value="192">White &amp; Silver</option>
                    <option value="277">White &amp; Tan</option>
                    <option value="123">White Merle</option>
                    <option value="63">White Ticked</option>
                    <option value="167">White with Cream</option>
                    <option value="174">White, Black &amp; Tan</option>
                    <option value="272">White, Red Shading</option>
                    <option value="129">Wild Boar</option>
                    <option value="180">Wolf Sable</option>
                    <option value="163">Yellow</option>
                </select>
            </div>
        </div>
    </div>
    <div id="registryRegistration">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="form_registry_registration">Registration Number*</label> <input class="form-control"
                                                                                                name="ReferenceNumber"
                                                                                                type="text"
                                                                                                id="form_registry_registration"
                                                                                                required></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col col-50">
            <div class="form-group">
                <label>OFA Certified?*</label> <br>
                <label class="radio-inline">
                    <input required="required" name="ofa_certified" value="yes" type="radio"> Yes
                </label>
                <label class="radio-inline">
                    <input required="required" name="ofa_certified" value="no" type="radio" checked> No
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
                <label>Does this parent have any champions in the last three generations?*</label> <br>
                <label class="radio-inline">
                    <input required="required" name="champion" value="yes" type="radio"> Yes
                </label>
                <label class="radio-inline">
                    <input required="required" name="champion" value="no" type="radio" checked> No
                </label>
            </div>
        </div>
        <div class="col col-50">
            <div class="form-group">
                <label for="form_has_been_shown">Has this parent been shown?</label> <br>
                <label class="radio-inline">
                    <input name="has_been_shown" value="yes" type="radio"> Yes
                </label>
                <label class="radio-inline">
                    <input name="has_been_shown" value="no" type="radio" checked> No
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
                <label for="form_description">What is this dog's personality like?</label> <br>
                <textarea rows="5" class="form-control" name="Description" id="form_description"></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col col-submit">
            <button type="submit" name="dashboard_parents_new">Submit</button>
        </div>
    </div>
</form>