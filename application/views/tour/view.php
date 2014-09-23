<!-- Start: Main Content --->
<div class="content bg-white">
    <div class="container">
        <div class="heading"><h1><?=$package['Package']['title']; ?></h1></div>
        <div class="container-main pull-left box-shadow">
            <div class="tour-masthead">
                <div class="tour-gallery">
                    <!-- images -->
                    <?php if ($package['Package_Image']) { ?>
                        <div id="myCarousel" class="carousel slide">
                            <ol class="carousel-indicators">
                                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                <li data-target="#myCarousel" data-slide-to="1"></li>
                                <li data-target="#myCarousel" data-slide-to="2"></li>
                                <li data-target="#myCarousel" data-slide-to="3"></li>
                            </ol>
                            <!-- Carousel items -->
                            <div class="carousel-inner">
                                <?php
                                $t=0;
                                foreach($package['Package_Image'] as $pkImg) {
                                    ?>
                                    <div class="item <?php echo ($t==0) ? 'active' : ""; ?>">
                                        <img alt="Dubai Desert Safari" src="<?=SITE_UPLOAD.PREFIX_SMALL.$pkImg['Package_Image']['image_name']; ?>">
                                    </div>
                                    <?php $t++; } ?>
                            </div>
                            <!-- Carousel nav -->
                            <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
                            <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
                        </div>
                    <?php } ?>
                    <div class="package-basic">
                        <span class="pull-left">
                            <span class="title"><?=$package['Package']['title']; ?></span>
                            <span class="duration"></span>
                        </span>
                        <span class="pill pull-right">Duration: <?=$package['Package_Time'][0]['Package_Time']['duration']; ?></span>
                        <!--
                        <span class="pill pull-right"><i class="icon-family"></i>Family Vacation</span>
                        //-->
                        <span class="clearfix"></span>
                    </div>
                </div>
                <div class="tour-rtside-panel box-shadow square package-price">
                    <ul class="">
                        <li>
                            <span class="pkLabel">Choose your dates:</span>
                            <div id="dpCheckout" class="input-append date" data-date-format="dd/mm/yyyy" data-date="<?=date('d/m/Y'); ?>">
                                <input  type="text" id="pkPxDate" name="pk[date]" class="span2" readonly value="<?=date('d/m/Y'); ?>" style="font-size: 12px;" required>
                                <span class="add-on"><i class="icon-calendar"></i></span>
                            </div>
                        </li>
                        <li class="noBorder">
                            <span class="pkLabel">Enter number of passengers:</span>
                            <span>
                                <span class="pkFrmLabel">Adult:<span>(age 10+)</span></span>
                                <span><select class="pkSelect" name="pk[qty][adult]" id="pkPxAdult" required="required">
                                        <option selected="selected" value="1">1</option>
                                        <?php for($i=2; $i<=25; $i++){?>
                                            <option value="<?=$i; ?>"><?=$i; ?></option>
                                        <?php } ?>
                                    </select>
                                </span>
                                <span>x <span class="pkFrmLabel" id="pkPriceAdult"><?=$package['Package_Rate'][0]['Package_Rate']['price']; ?></span></span>
                            </span>
                        </li>
                        <li>
                            <span>
                                <span class="pkFrmLabel">Child:<span>(age 3-9)</span></span>
                                <span><select class="pkSelect" name="pk[qty][child]" id="pkPxChild" required="required">
                                        <option selected="selected" value="0">0</option>
                                        <?php for($i=1; $i<=25; $i++){?>
                                            <option value="<?=$i; ?>"><?=$i; ?></option>
                                        <?php } ?>
                                    </select>
                                </span>
                                <span>x <span class="pkFrmLabel" id="pkPriceChild"><?=$package['Package_Rate'][0]['Package_Rate']['price_child']; ?></span></span>
                            </span>
                        </li>
                    </ul>
                    <div class="pkgPrice">
                        <div>
                            <p class="">Total Package price</p>
                            <p class="price">
                                <span class="curSymbl">$</span>
                                <span id="pkTotalPrice">0</span>
                            </p>

                        </div>
                        <!-- put the selected pakagetime details -->
                        <span class="hidden" id="pkSelectedTimeId"><?=$package['Package_Time'][0]['Package_Time']['id']; ?></span>
                        <span class="hidden" id="pkUnit"><?=$package['Package_Rate'][0]['Package_Rate']['pax_unit']; ?></span>
                        <button class="btn btn-danger" type="button">Book Package Now!</button>
                    </div>
                </div>
            </div>
            <div class="tour-main-panel">
                <!-- tabbed naviagtion -->
                <div class="clearfix package-details tabbable">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab1" data-toggle="tab">Tour Overview</a></li>
                        <li><a href="#tab2" data-toggle="tab">Tour Time & Rates</a></li>
                        <li><a href="#tab3" data-toggle="tab">Terms & Conditions</a></li>
                        <li><a href="#tab4" data-toggle="tab">Useful Info.</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab1">
                            <section>
                                <h3>Description</h3>
                                <?=$package['Package']['description']; ?>
                            </section>
                            <section>
                                <h3>Inclusions</h3>
                                <?=$package['Package']['inclusions']; ?>
                            </section>
                            <section>
                                <h3>Exclusions</h3>
                                <?=$package['Package']['exclusions']; ?>
                            </section>
                            <section>
                                <h3>Rates</h3>
                                <table class="table availability-list">
                                    <thead>
                                        <tr>
                                            <th>Transfer Type</th>
                                            <th>Adult Rate</th>
                                            <th>Children Rate</th>
                                            <th>Languages</th>
                                            <th>Vehicle</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?foreach($package['Package_Rate'] as $item){ ?>
                                        <tr id="package-tariff-<?=$item['Package_Rate']['id']; ?>" style="">
                                            <td class="room_type"><?=$item['Package_Rate']['transfer_type']; ?></td>
                                            <td class="meal_plan"><?='$ '.$item['Package_Rate']['price']; ?></td>
                                            <td class=""><a href=""><?='$ '.$item['Package_Rate']['price_child']; ?></a></td>
                                            <td class=""><a href=""><?=$item['Package_Rate']['language']; ?></a></td>
                                            <td class=""><a href=""><?=$item['Package_Rate']['vehicle']; ?></a></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </section>
                        </div>
                        <div class="tab-pane" id="tab2">
                            <section>
                                <h3>Tour Time</h3>
                                <table class="table availability-list">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Tour Duration</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>Reporting Time</th>
                                        <th>Pick-up-point</th>
                                        <th>Day of Operation</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $t=0;
                                        foreach($package['Package_Time'] as $item){
                                        $checked = ($t == 0) ? 'checked' : '';
                                    ?>
                                        <tr id="package-time-<?=$item['Package_Time']['id']; ?>" style="">
                                            <td><input type="radio" name="pk[time]" id="pkTimeRadio" value="<?=$item['Package_Time']['id']; ?>" <?=$checked; ?>></td>
                                            <td><?=$item['Package_Time']['duration']; ?></td>
                                            <td><?=$item['Package_Time']['start']; ?></td>
                                            <td><?=$item['Package_Time']['end']; ?></td>
                                            <td><?=$item['Package_Time']['reporting']; ?></td>
                                            <td><?=$item['Package_Time']['pickup']; ?></td>
                                            <td><?=$item['Package_Time']['operation']; ?></td>
                                        </tr>
                                    <?php $t++; } ?>
                                    </tbody>
                                </table>
                            </section>
                            <section>
                                <h3>Rates</h3>
                                <table class="table availability-list">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Transfer Type</th>
                                        <th>Adult Rate</th>
                                        <th>Children Rate</th>
                                        <th>Languages</th>
                                        <th>Vehicle</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $t=0;
                                        foreach($package['Package_Rate'] as $item){
                                            $checked = ($t == 0) ? 'checked="checked"' : '';
                                    ?>
                                        <tr id="package-tariff-<?=$item['Package_Rate']['id']; ?>" style="">
                                            <td><input type="radio" name="pk[rate]" id="pkRateRadio" value="<?=$item['Package_Rate']['price']."|".$item['Package_Rate']['price_child']."|".$item['Package_Rate']['pax_unit']; ?>" <?=$checked; ?>></td>
                                            <td class="room_type"><?=$item['Package_Rate']['transfer_type']; ?></td>
                                            <td class="meal_plan"><?='$ '.$item['Package_Rate']['price']; ?></td>
                                            <td class=""><a href=""><?='$ '.$item['Package_Rate']['price_child']; ?></a></td>
                                            <td class=""><a href=""><?=$item['Package_Rate']['language']; ?></a></td>
                                            <td class=""><a href=""><?=$item['Package_Rate']['vehicle']; ?></a></td>
                                        </tr>
                                    <?php $t++; } ?>
                                    </tbody>
                                </table>
                            </section>
                        </div>
                        <div class="tab-pane" id="tab3">
                            <?=$package['Package']['terms']; ?>
                        </div>
                        <div class="tab-pane" id="tab4">
                            <?=$package['Package']['info']; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sidebar pull-right">
            <?php foreach(Utils::getBanners('small') as $banner){ ?>
                <div class="widget adv300-170">
                    <a href="<?=$banner['url']; ?>" class="">
                        <img src="<?=$banner['image']; ?>" width="300" height="250"/>
                    </a>
                </div>
            <?php } ?>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- End: Main Content --->
<script>
    $(function(){
        PACKAGE.init();
        //on change of pax selection
        $(".pkSelect").on('change',PACKAGE.calculate);

        //on selection on new time or rates
        $('input[type="radio"]').on('change',PACKAGE.optionsSelect);
    });
</script>