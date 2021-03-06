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
                <h5>Filter by Hotel Name:<span class="pull-right clear-wrap"><a class="clear-filter" href="">Clear All</a></span></h5>
                <div class="facet facet-hotel">
                    <div class="input-append">
                        <input style="width:170px; font-size: 12px" id="appendedInputButton" type="text" placeholder="Enter Hotel Name....">
                        <button class="btn" type="button">Go!</button>
                    </div>
                </div>
            </div>
            <div class="facet-blue box-shadow">
                <h5>Filter by Star Rating:<span class="pull-right clear-wrap"><a class="clear-filter" href="">Clear All</a></span></h5>
                <div class="facet facet-stars">
                    <?php for($i=1; $i<=5; $i++){ ?>
                        <?php
                            $disabled = "";
                            $badgeClass = "badge-success";

                            $starCount = isset($facet['stars'][$i]) ? $facet['stars'][$i] : 0;
                            if($starCount == 0){
                                $disabled = "disabled";
                                $badgeClass = "";
                            }
                        ?>
                        <p>
                            <input class="pull-left" type="checkbox" name="star" data-name="filter" data-value="hotel_star" onclick="showForThisStar(this,<?=$i; ?>)" value="<?=$i; ?>" <?=$disabled; ?>>
                            <span class="facet-label star star<?=$i; ?>"></span>
                            <span class="facet-count badge pull-right <?=$badgeClass; ?>"><?=$starCount; ?></span>
                            <span class="clearfix"></span>
                        </p>
                    <?php }  ?>
                </div>
            </div>
            <?php if ($facet['area']){ ?>
            <div class="facet-blue box-shadow">
                <h5>Filter by Location:<span class="pull-right clear-wrap"><a class="clear-filter" href="">Clear All</a></span></h5>
                <div class="facet facet-area">

                    <?php foreach($facet['area'] as $area => $count){ ?>
                    <?php if ($area == '') { $area = 'Unknown'; } ?>
                        <p>
                            <input type="radio" onclick="showForThisLocation(this)" name="area" data-name="filter" data-value="hotel_area" value="<?=$area; ?>">
                            <span class="facet-label"><?=$area; ?></span>
                            <span class="facet-count badge pull-right badge-success"><?=$count; ?></span>
                        </p>
                    <?php } ?>
                </div>
            </div>
            <?php } ?>
        </div>
        <div class="green-span9 result-panel">
            <div class="searchCriteria">
                <div class="criteria-group-location pull-left">
                    <span class="criteria-count"><?=$criteria['total']; ?></span><span class="criteria-label"> Hotels available for:</span><br>
                    <span class="criteria-label"><?=$criteria['location']; ?></span>
                </div>
                <ul class="criteria-group-meta pull-left clearfix">
                    <li>
                        <span class="pull-left criteria-meta-date">
                            <span class="criteria-label">Check-in:</span>
                            <span class="criteria-date"><?=date('D d M, Y', $criteria['checkin']); ?></span>
                        </span>
                        <span class="pull-left criteria-meta-date">
                            <span class="criteria-label">Check-out:</span>
                            <span class="criteria-date"><?=date('D d M, Y', $criteria['checkout']); ?></span>
                        </span>
                    </li>
                    <li>
                        <span class="pull-left criteria-meta-room">
                            <span class="criteria-label">Nights:</span>
                            <span class="criteria-meta-night"><?=str_pad($criteria['nights'], 2, "0", STR_PAD_LEFT); ?></span>
                        </span>
                        <span class="pull-left criteria-meta-room">
                            <span class="criteria-label">Room(s):</span>
                            <span class="criteria-meta-rooms"><?=str_pad($criteria['rooms'], 2, "0", STR_PAD_LEFT); ?></span>
                        </span>
                        <span class="pull-left criteria-meta-room">
                            <span class="criteria-label">Pax size:</span>
                            <span class="criteria-meta-pax">01 Adult(s)</span>
                        </span>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="list-controls">
                <div class="paginate pull-left">
                    <span>1-25 of 200 Hotels</span>
                    <span>Previous | Next</span>
                </div>
                <div class="sortSection pull-right">
                    <span>Sort By:</span>
                    <span></span>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="media-list">
            </div>
        </div>
    </div>
</div>

<!-- actual hotel display template -->
<div id="hotel" class="media hotel-item box-shadow" data-type="hotel" data-value="hotelname" style="display:none">
    <a class="pull-left" href="#">
        <img class="media-object img-polaroid" src="">
    </a>
    <div class="media-body">
        <h4><span class="media-heading">Arabian Park Hotel</span><span class="star">3 Star</span></h4>
        <span class="hotel_location">BUR DUBAI</span><span class="hotel_contact"> Phone: 971043245999, Fax : 971043245656</span>
        <p class="hotel_details">Ideally located, Arabian Park Hotel is a short drive to Dubai International Airport, offers quick access to the Dubai World Trade Centre....</p>
        <span class="hotel_url"><a href=""><i class="icon-bookmark"></i> Hotel Information</a></span>
        <table class="table availability-list">
            <thead>
                <tr>
                    <th>Room Type</th>
                    <th>Rate Basis</th>
                    <th>Total Price</th>
                    <th>Rate Breakup</th>
                    <th class="noBg"></th>
                    <th class="noBg"></th>
                </tr>
            </thead>
            <tbody class="tariff-list">
                <tr id="tariff" style="display: none">
                    <td class="room_type">Standard Room</td>
                    <td class="meal_plan">RO</td>
                    <td class=""><a href="">Total</a></td>
                    <td class=""><a href="">Rate Breakup/Details</a></td>
                    <td class="available">Available</td>
                    <td class="book booking"><a href="javascript:void(0);" class="btn-book-hotel" id="tariffId" data-search-session="<?=$criteria['search_session']; ?>" data-hotel="hotel_id" data-action="booking" data-title="Book Hotel Room" title="Book Hotel Room"><i class="icon-shopping-cart icon-white"></i> Book Now!</a></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<!-- template ends -->

<script>
var hotelList = <?php echo $hotelDetails; ?>;
var workableList=hotelList;// this is to persist original data coming from server in hotelList
var facetsData=[];
SEARCH.buildHotelList(workableList);


function showForThisStar(dis,index)
{
	var chks=$(dis).parent().parent().find("input:checked");
	console.log(chks.length)
	for(var i=0;i<chks.length;i++)
	{
		var slice=workableList.where([["Hotel.hotel_stars","==",$(chks[i]).val()]]);
		 for(var j=0;j<slice.length;j++)
			facetsData.push(slice[j]);		
	}
	console.log(facetsData.length)
	if(facetsData.length>0)
		$(".media-list").children().remove();
	
	SEARCH.buildHotelList(facetsData);
	

// RESET Location Filter
	//console.log()
	resetLocationFilter(facetsData.groupBy("Hotel.hotel_area"))
	facetsData=[];
	
	    
}


function resetLocationFilter(data)
{
console.log(JSON.stringify(data));
    var radios=$("input:radio");

     for(var i=0;i<radios.length;i++)
     {
console.log("--"+$(radios[i]).next().text()+"--")
			var index =data.hasKey($(radios[i]).next().text());
			if(index>-1){
				$(radios[i]).next().next().text(data[index].value.length);
				$(radios[i]).removeAttr("disabled")
			}
			else{
				$(radios[i]).next().next().text("0");
				$(radios[i]).attr("disabled","disbaled")
			}
	 }   
}


function showForThisLocation(dis)
{
	$(".media-list").children().remove();
	console.log($(dis).next().text());
	SEARCH.buildHotelList(workableList.where([["Hotel.hotel_area","==","'"+$(dis).next().text()+"'"]])); 
}



</script>
