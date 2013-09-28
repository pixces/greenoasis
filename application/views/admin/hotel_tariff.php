<div class="hotel-detail-box no-Bottom">
    <header class="section-title"><?=$hotel['hotel_name']; ?></header>
    <p>
        <?php for($i=1; $i<=$hotel['hotel_stars']; $i++) { ?>
            <i class="icon-star"></i>
        <?php } ?>
    </p>
    <p><i class="icon-map-marker"></i> <?=$hotel['hotel_address']; ?></p><br>
    <h5>Seasons/Tariff already added:</h5>
    <div class="seasonList" data-action="get_season_list" data-value="<?=$hotel['id']; ?>">
        <h6>No Seasons / Tariff added.</h6>
    </div>
</div>

<fieldset>
    <legend>Add/Edit Room Tariff</legend>
    <form method="post" name="addTariff">
        <input type="hidden" name="hotel_id" value="<?=$hotel['id']; ?>">
        <div>
            <label>Season Title</label>
            <input type="text" name="season" value="" placeholder="Enter Season title" class="span6" required>
        </div>
        <div>
            <label>Season Period (Star & End Dates</label>
            <div id="dpStart" class="input-append date" data-date-format="dd-mm-yyyy" data-date="<?=date('d-m-Y'); ?>">
                <input name="date_start" class="span2" size="16" type="text" readonly="" value="<?=date('d-m-Y'); ?>" required>
                <span class="add-on"><i class="icon-calendar"></i></span>
            </div>&nbsp;To&nbsp;
            <div id="dpEnd" class="input-append date" data-date-format="dd-mm-yyyy" data-date="<?=date('d-m-Y'); ?>">
                <input name="date_end" class="span2" size="16" type="text" readonly="" value="<?=date('d-m-Y'); ?>" required>
                <span class="add-on"><i class="icon-calendar"></i></span>
            </div>
        </div>
        <div>
            <label>Hotel Rooms & Tariff</label>
            <table class="table tariffForm multiValued" id="tariff_form" class="">
                <thead>
                <tr>
                    <th colspan="8" style="text-align: center; background: #EEEEEE">Basic Tariff</th>
                    <th colspan="3" style="text-align: center; background: #EEEEEE">Child Extra Meal</th>
                    <th colspan="3" style="text-align: center; background: #EEEEEE">Adult Extra Meal</th>
                    <th colspan="2" style="text-align: center; background: #EEEEEE">Extra Beds</th>
                </tr>
                <tr>
                    <th>Room Type</th>
                    <th>Meal Plan</th>
                    <th>Market</th>
                    <th>Rooms</th>
                    <th>Single</th>
                    <th>Double</th>
                    <th>Triple</th>
                    <th>Unit</th>
                    <th>Breakfast</th>
                    <th>Lunch</th>
                    <th>Dinner</th>
                    <th>Breakfast</th>
                    <th>Lunch</th>
                    <th>Dinner</th>
                    <th>Adult</th>
                    <th>Child</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><input type="text" class="span2" id="tariff_room_type_1" name="tariff[1][room_type]" data-provide="typeahead" data-source='["Standard Room","Royal Room","Executive Room","Deluxe Room","Premium Room"]' data-items="4"></td>
                    <td><input type="text" class="span1" id="tariff_tariff_meal_plan_1" name="tariff[1][meal_plan]" data-provide="typeahead" data-source='["RO","BB","HB","FB"]' data-items="4"></td>
                    <td><input type="text" class="span1" id="tariff_market_1" name="tariff[1][market]" data-provide="typeahead" data-source='["All","GCC","Intl"]' data-items="4"></td>
                    <td><input type="text" class="span0" id="tariff_room_count_1" name="tariff[1][room_count]" placeholder="0"></td>
                    <td><input type="text" class="span0" id="tariff_single_1" name="tariff[1][single]" placeholder="0"></td>
                    <td><input type="text" class="span0" id="tariff_double_1" name="tariff[1][double]" placeholder="0"></td>
                    <td><input type="text" class="span0" id="tariff_tripple_1" name="tariff[1][triple]" placeholder="0"></td>
                    <td><input type="text" class="span0" id="tariff_unit_1" name="tariff[1][unit]" placeholder="0"></td>
                    <td><input type="text" class="span0" id="tariff_child_breakfast_1" name="tariff[1][child_breakfast]" placeholder="0"></td>
                    <td><input type="text" class="span0" id="tariff_child_lunch_1" name="tariff[1][child_lunch]" placeholder="0"></td>
                    <td><input type="text" class="span0" id="tariff_child_dinner_1" name="tariff[1][child_dinner]" placeholder="0"></td>
                    <td><input type="text" class="span0" id="tariff_adult_breakfast_1" name="tariff[1][adult_breakfast]" placeholder="0"></td>
                    <td><input type="text" class="span0" id="tariff_adult_lunch_1" name="tariff[1][adult_lunch]" placeholder="0"></td>
                    <td><input type="text" class="span0" id="tariff_adult_dinner_1" name="tariff[1][adult_dinner]" placeholder="0"></td>
                    <td><input type="text" class="span0" id="tariff_adult_bed_1" name="tariff[1][adult_extra_bed]" placeholder="0"></td>
                    <td><input type="text" class="span0" id="tariff_child_bed_1" name="tariff[1][child_extra_bed]" placeholder="0"></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div>
            <button type="submit" class="btn btn-primary">Save & Continue</button>
        </div>
    </form>
</fieldset>
<script type="text/javascript">
    var currentRowCounter = 1;

    function init() {
        var row = $("#tariff_form tr:last");
        // alert($("#tariff_form tr").length);
        var market = row.children().slice(2, 3);
        market
            .children(":first")
            .blur(function () {
                var pass = 0;
                if ($(this).val().length > 1) pass += 1;
                if ($(this).parent().prev().children(":first").val().length > 1) pass += 1;
                if ($(this).parent().prev().prev().children(":first").val().length > 1) pass += 1;
                if (pass == 3) {
                    AddNewRow($("#tariff_form"), row);

                    $("#tariff_form tr:last input")
                        .each(function () {
                            var name = $(this).val("").attr("name").split(currentRowCounter.toString()).join((currentRowCounter + 1).toString());
                            var idArr = $(this).attr("id").split("_");
                            $(this).attr("name", name);
                            idArr[idArr.length - 1] = (currentRowCounter + 1).toString();
                            $(this).attr("id", idArr.join("_"));

                        })
                    currentRowCounter++;
                    init();

                    $(this).unbind("blur");
                }
            })

    }

    function AddNewRow(table, row) {
        var newRow = $(row).clone();
        $(table).children(":last").append(newRow);
    }

    $(document).ready(function () {
        init();

        //prepare the datepicker
        $("#dpStart").datepicker();
        $("#dpEnd").datepicker();


        //make ajax call to get the season list
        ADMIN.getSeasons();

    });
</script>