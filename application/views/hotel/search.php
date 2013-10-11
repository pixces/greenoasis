<div class="content bg-white">
    <div class="container">
        <div class="heading">
            <h1>Hotel: Search Results</h1>
        </div>
        <div class="green-span3 facet-panel">
            <div class="facet-blue box-shadow">
                <h5>Change Search Criteria</h5>
                <div class="modify-search">

                </div>
            </div>
            <div class="facet-blue box-shadow">
                <h5>Filter by Hotel Name:</h5>
                <div class="facet facet-hotel">
                    <div class="input-append">
                        <input style="width:170px; font-size: 12px" id="appendedInputButton" type="text" placeholder="Enter Hotel Name....">
                        <button class="btn" type="button">Go!</button>
                    </div>
                </div>
            </div>
            <div class="facet-blue box-shadow">
                <h5>Filter by Star Rating:</h5>
                <div class="facet facet-stars">
                    <p>
                        <input class="pull-left" type="checkbox" name="star" data-name="filter" data-value="hotel_star" value="1">
                        <span class="facet-label star star1"></span>
                        <span class="facet-count badge pull-right"></span>
                        <span class="clearfix"></span>
                    </p>
                    <p>
                        <input class="pull-left" type="checkbox" name="star" data-name="filter" data-value="hotel_star" value="2">
                        <span class="facet-label star star2"></span>
                        <span class="facet-count badge pull-right"></span>
                        <span class="clearfix"></span>
                    </p>
                    <p>
                        <input class="pull-left" type="checkbox" name="star" data-name="filter" data-value="hotel_star" value="3">
                        <span class="facet-label star star3"></span>
                        <span class="facet-count badge pull-right"></span>
                        <span class="clearfix"></span>
                    </p>
                    <p>
                        <input class="pull-left" type="checkbox" name="star" data-name="filter" data-value="hotel_star" value="4">
                        <span class="facet-label star star4"></span>
                        <span class="facet-count badge pull-right"></span>
                        <span class="clearfix"></span>
                    </p>
                    <p>
                        <input class="pull-left" type="checkbox" name="star" data-name="filter" data-value="hotel_star" value="5">
                        <span class="facet-label star star5"></span>
                        <span class="facet-count badge pull-right"></span>
                        <span class="clearfix"></span>
                    </p>
                </div>
            </div>
            <?php if ($facet['area']){ ?>
            <div class="facet-blue box-shadow">
                <h5>Filter by Location:</h5>
                <div class="facet facet-area">
                    <?php foreach($facet['area'] as $area => $count){ ?>
                    <?php if ($area == '') { $area = 'Unknown'; } ?>
                        <p>
                            <input type="radio" name="area" data-name="filter" data-value="hotel_area" value="<?=$area; ?>">
                            <span class="facet-label"><?=$area; ?></span>
                            <span class="facet-count badge pull-right"><?=$count; ?></span>
                        </p>
                    <?php } ?>
                </div>
            </div>
            <?php } ?>
        </div>
        <div class="green-span9 result-panel">
            <div class="bg-blue searchCriteria">
                <div class="">
                    <span><?=$criteria['total']; ?></span><span> Hotels for:</span>
                    <span><?=$criteria['location']; ?></span>
                </div>
                <ul>
                    <li>
                        <span>
                            <span>Check-in:</span>
                            <span><?=date('d M, Y', $criteria['checkin']); ?></span>
                        </span>
                        <span>
                            <span>Check-out:</span>
                            <span><?=date('d M, Y', $criteria['checkout']); ?></span>
                        </span>
                    </li>
                    <li>
                        <span>
                            <span>Nights:</span>
                            <span><?=str_pad($criteria['nights'], 2, "0", STR_PAD_LEFT); ?></span>
                        </span>
                        <span>
                            <span>Room(s):</span>
                            <span><?=str_pad($criteria['rooms'], 2, "0", STR_PAD_LEFT); ?></span>
                        </span>
                        <span>
                            <span>Pax size:</span>
                            <span>01 Adult(s)</span>
                        </span>
                    </li>
                </ul>
            </div>
            <div class="list-controls">
                <div class="paginate">
                    <span>1-25 of 200 Hotels</span>
                    <span>Previous | Next</span>
                </div>
                <div class="sortSection">
                    <span>Sort By:</span>
                    <span></span>
                </div>
            </div>
            <div class="media-list">
            </div>
        </div>
    </div>
</div>

<!-- actual hotel display template -->
<div id="hotel" class="media hotel-item box-shadow" data-type="hotel" data-value="hotelname" style="display:none">
    <a class="pull-left" href="#">
        <img class="media-object" src="">
    </a>
    <div class="media-body">
        <h4><span class="media-heading">Arabian Park Hotel</span><span class="star">3 Star</span></h4>
        <span class="hotel_location">BUR DUBAI</span><span class="hotel_contact"> Phone: 971043245999, Fax : 971043245656</span>
        <p class="hotel_details">Ideally located, Arabian Park Hotel is a short drive to Dubai International Airport, offers quick access to the Dubai World Trade Centre....</p>
        <span class="hotel_url"><a href=""><i class="icon-bookmark"></i> Hotel Information</a></span>
        <!-- table class="">
            <thead>
            <tr>
                <th class="">Room Type</th>
                <th class="">Rate Basis</th>
                <th class="">Rate Breakup</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="">Standard Room</td>
                <td class="">RO</td>
                <td class="">Rate breakup / details</td>
                <td class="available">Available</td>
                <td class="book"><a href="">Book</a></td>
            </tr>
            <tr>
                <td>Standard Room</td>
                <td>BB</td>
                <td>Rate breakup / details</td>
                <td class="request">On Request</td>
                <td class="on-request"><a href="">Request</a></td>
            </tr>
            <tr>
                <td>Standard Room</td>
                <td>HB</td>
                <td>Rate breakup / details</td>
                <td class="available">Available</td>
                <td class="book"><a href="">Book</a></td>
            </tr>
            </tbody>
        </table -->
    </div>
</div>
<!-- template ends -->

<script>
    var hotelList = <?php echo $hotelDetails; ?>;
    SEARCH.buildHotelList(hotelList);
</script>
