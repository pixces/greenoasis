<div class="content bg-white">
    <div class="container">
        <div class="heading">
            <h1>Hotel: Search Results</h1>
        </div>
        <div class="bg-blue-grey span4">
            <h5><i class="icon-minus-sign"></i> Change Search Criteria</h5>
            <div class="accordion-box">

            </div>
            <h5><i class="icon-minus-sign"></i> Filter Locations</h5>
            <div class="accordion-box">

            </div>
            <h5><i class="icon-minus-sign"></i> Filter Search Results</h5>
            <div class="accordion-box">

            </div>
        </div>
        <div class="bg-blue span825">
            Displaying 1 to 20 of 250 | Page: 1 2 3 4 5 6 7 8 9 10 11 12 13 14
        </div>
        <div class="bg-blue span825 media-list" id='media-list'>
            
          

        </div>
    </div>
</div>
<div id="abc"></div>


<div class="media" id='template' style='dispaly:none'>
                <a class="pull-left" href="#">
                    <img class="media-object image"  src="">
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
