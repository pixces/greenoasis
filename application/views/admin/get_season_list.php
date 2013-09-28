<?php
if ($list) { ?>
<div class="accordion" id="seasonsTariff">
    <?php foreach($list as $season) { ?>
    <div class="accordion-group">
        <div class="accordion-heading">
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#seasonsTariff" href="#season-<?=$season['Season']['id']; ?>">
                <?="Season: ".$season['Season']['season_name']." <small>(".date('M d, Y', strtotime($season['Season']['date_start']))." - ".date('M d, Y', strtotime($season['Season']['date_end'])) .")</small>"; ?>
            </a>
        </div>
        <div id="season-<?=$season['Season']['id']; ?>" class="accordion-body collapse">
            <div class="accordion-inner">
                <?php if($season['Tariff']) { ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Room Type</th>
                                <th>Meal Plan</th>
                                <th>Market</th>
                                <th>Single</th>
                                <th>Double</th>
                                <th>Triple</th>
                                <th>Unit</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($season['Tariff'] as $tariff) { ?>
                            <tr id="tariff-<?=$tariff['Hotel_tariff']['id']; ?>">
                                <td><?=$tariff['Hotel_tariff']['room_type']; ?></td>
                                <td><?=$tariff['Hotel_tariff']['meal_plan']; ?></td>
                                <td><?=$tariff['Hotel_tariff']['market']; ?></td>
                                <td><?=$tariff['Hotel_tariff']['single']; ?></td>
                                <td><?=$tariff['Hotel_tariff']['double']; ?></td>
                                <td><?=$tariff['Hotel_tariff']['triple']; ?></td>
                                <td><?=$tariff['Hotel_tariff']['unit']; ?></td>
                                <td></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>


                <?php } else { ?>
                    <h6>No Tariff added. Please use the form below to add new season.</h6>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php } ?>
</div>
<?php } else { ?>
    <h6>No Seasons / Tariff added. Please use the form below to add new season.</h6>
<?php } ?>