<div class="content bg-white">
    <div class="container">
        <div class="heading">
            <h1>Hotel: Search Results</h1>
        </div>
        <div class="green-span3 facet-panel">
            <div class="bg-blue-grey">
                <h5>Change Search Criteria</h5>
                <div>

                </div>
            </div>
            <div class="bg-blue-grey">
                <h5>Filter by Hotel Name:</h5>
                <div>

                </div>
            </div>
            <div class="bg-blue-grey">
                <h5>Filter by Star Rating:</h5>
                <ul>
                    <li><span>None</span><span>(0)</span></li>
                    <li><span>1 Star</span><span>(0)</span></li>
                    <li><span>2 Star</span><span>(0)</span></li>
                    <li><span>3 Star</span><span>(0)</span></li>
                    <li><span>4 Star</span><span>(0)</span></li>
                    <li><span>5 Star</span><span>(0)</span></li>
                </ul>
            </div>
            <div class="bg-blue-grey">
                <h5>Filter by Location:</h5>
                <ul>
                    <li><span>Unknown</span><span>(0)</span></li>
                    <li><span>1 Star</span><span>(0)</span></li>
                    <li><span>2 Star</span><span>(0)</span></li>
                    <li><span>3 Star</span><span>(0)</span></li>
                    <li><span>4 Star</span><span>(0)</span></li>
                    <li><span>5 Star</span><span>(0)</span></li>
                </ul>
            </div>
        </div>
<<<<<<< Updated upstream
        <div class="bg-blue span825">
            Displaying 1 to 20 of 250 | Page: 1 2 3 4 5 6 7 8 9 10 11 12 13 14
        </div>
        <div class="bg-blue span825 media-list" id='media-list'>
            
          

        </div>
    </div>
</div>
<div id="abc"></div>


<div class="media" id='template' style='display:none'>
                <a class="pull-left" href="#">
                    <img class="media-object image" src="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading"><small class='hotel'></small> <small class='star'></small></h4>
                    <p ><span class='location'></span> <span class='contact'></span></p>
                    <p class='description'></p>
                    <div class='rates-holder'></div>
                </div>
            </div>


<div id='ratesTemplate'>
<div class='star'></div>
</div>

<input type='button' id='changeData' value='CHange Data'/>

<script>

	var hotelList=[
	          {
		      	'hotel':"Arabian Park Hotel",
		      	'star':"3 Star",
		      	'location':"BUR DUBAI",
		      	'contact':"Phone 971043245999, Fax  971043245656",
		      	'description':"Ideally located, Arabian Park Hotel is a short drive to Dubai International Airport, offers quick access to the Dubai World Trade Centre....",
				'image':"http://localhost/greenoasis/images/hotel01.png",
				rates:[{'star':"3 Star"},{'star':"3 Star"}]	      	    
	          },
	          {
			      	'hotel':"Arabian Park Hotel",
			      	'star':"3 Star",
			      	'location':"BUR DUBAI",
			      	'contact':"Phone 971043245999, Fax  971043245656",
			      	'description':"Ideally located, Arabian Park Hotel is a short drive to Dubai International Airport, offers quick access to the Dubai World Trade Centre....",
					'image':"http://localhost/greenoasis/images/hotel01.png",
					rates:[{'star':"3 Star"},{'star':"3 Star"}]	      	    		      	    
		          },
		          {
				      	'hotel':"Arabian Park Hotel",
				      	'star':"3 Star",
				      	'location':"BUR DUBAI",
				      	'contact':"Phone 971043245999, Fax  971043245656",
				      	'description':"Ideally located, Arabian Park Hotel is a short drive to Dubai International Airport, offers quick access to the Dubai World Trade Centre....",
						'image':"http://localhost/greenoasis/images/hotel01.png",
						rates:[{'star':"3 Star"},{'star':"3 Star"}]	      	    		      	    
			          }
	          
		     ];

	

	function DrawList(){	
	for (var i = 0; i < hotelList.length; i++) {
		var item=$("#template").clone().attr("id","template_"+i);
		
        for (var caption in hotelList[i]) {
            console.log(typeof(hotelList[i][caption])+"---"+caption);
            if(typeof(hotelList[i][caption])=="string" && caption!="image")
            item.find("."+caption).html(hotelList[i][caption]);
            else if(typeof(hotelList[i][caption])=="string" && caption=='image')
           	item.find("."+caption).attr('src',hotelList[i][caption]);
            else{

                var list=hotelList[i][caption];
					console.log(typeof(list));
                for (var j = 0; j < list.length; j++) {
            		var itm=$("#ratesTemplate").clone().attr("id","ratesTemplate_"+j);
            		
                    for (var star in list[j]) {
                    	itm.find(".star").html(list[j][star]);     
                    }
                    item.find(".rates-holder").append(itm);
                }			

                
            }               
        }
        
        $("#media-list").append(item);
    }

	}
	DrawList();
	
	   $("#changeData").on("click",function(){

		   hotelList=[
			          {
				      	'hotel':"Arabian Park Hotel",
				      	'star':"3 Star",
				      	'location':"BUR DUBAI",
				      	'contact':"Phone 971043245999, Fax  971043245656",
				      	'description':"Ideally located, Arabian Park Hotel is a short drive to Dubai International Airport, offers quick access to the Dubai World Trade Centre....",
						'image':"http://localhost/greenoasis/images/hotel01.png",
						rates:[{'star':"3 Star"},{'star':"3 Star"}]	      	    
			          }			          
				     ];
			$("#media-list").html("");
		   DrawList();
		     

	   })


	
</script>
=======
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
            <div class="bg-blue media-list">
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" data-src="" src="">
                    </a>
                    <div class="media-body">
                    <h4 class="media-heading">Arabian Park Hotel <small>3 Star</small></h4>
                    <p>BUR DUBAI. Phone: 971043245999, Fax : 971043245656</p>
                    <p>Ideally located, Arabian Park Hotel is a short drive to Dubai International Airport, offers quick access to the Dubai World Trade Centre....</p>
                    <p><a href="">Detailed Information</a></p>
                    <table class="">
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
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var hotels = '<?php echo $hotelDetails; ?>';
    SEARCH.buildHotelList();
</script>
>>>>>>> Stashed changes
