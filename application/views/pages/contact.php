<!-- Start: Main Content --->
<style>
    #map_canvas {
        width: 835px;
        height: 350px;
    }
</style>
<script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script>
    function initialize() {
        var myLatlng = new google.maps.LatLng(44.5403, -78.5463);
        var map_canvas = document.getElementById('map_canvas');
        var map_options = {
            center: myLatlng,
            zoom: 8,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        var map = new google.maps.Map(map_canvas, map_options);
        var marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
            title: 'Hello World!'
        });
    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>
<div id="page_contact" class="static-view content bg-white">
    <div class="container">
        <div class="heading"><h1><?=$page['title']; ?></h1></div>
        <div class="container-main pull-left box-shadow">
            <!-- display page content /-->
            <div class="content pull-left span4">
                <h1>Contact Details</h1>
                <?php echo $page['content']; ?>
            </div>
            <!-- display contact Form /-->
            <div class="content contact-form pull-right">
                <h1>Contact Form</h1>
                <form id="contactForm" name="contact-form" method="post">
                    <label for="fullname">Full Name</label>
                    <input type="text" name="fullname" id="fullname" maxlength="150" class="span4" />
                    <label for="phone">Contact Number</label>
                    <input type="text" name="phone" id="phone" maxlength="150" class="span4" />
                    <label for="email">Email Address</label>
                    <input type="text" name="email" id="email" maxlength="150" class="span4" />
                    <label for="subject">Subject</label>
                    <input type="text" name="subject" id="subject" maxlength="150" class="span4" />
                    <label for="details">Details</label>
                    <textarea id="details" rows="5" name="details" class="span6"></textarea>
                    <div id="contactErrors" class="errorBox"></div>
                    <input id="button" type="submit" value="Contact Us!" name="button" class="btn btn-primary">
                    <div id="contactConfirm" class="messageBox"></div>
                </form>
            </div>
            <div class="clearfix"></div>
            <!-- display map -->
            <div class="map-container">
                <div id="map_canvas"></div>
            </div>
        </div>
        <div class="sidebar pull-right">
            <div class="widget adv300-170">
                <img src="<?=SITE_URL; ?>/images/img03.png" width="300" height="170"/>
                <div class="caption inverse">
                    <span><small>Online visa for Dubai,</small></span>
                    <span class="text-large">@ $100</span>
                </div>
            </div>
            <div class="widget adv300-170">
                <img src="<?=SITE_URL; ?>/images/advt.png" width="300" height="250"/>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- End: Main Content --->
<script>
    //validate form and submit
</script>