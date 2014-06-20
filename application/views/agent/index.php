<!-- Start: Main Content --->
<div id="page_booking" class="static-view content bg-white">
<div class="container">
<div class="heading"><h1>Booking</h1></div>
<div class="container-main  box-shadow" style="width:100%;">
<!---Starts: Modal for Hotel booking -->
<div id="hotelBookingModal" class="modal hide fade " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header well">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 style="color: 90c53f;" id="hotelModalLabel">Hotel Booking Details</h3>
    </div>
    <div class="modal-body well">
        <table width="100%" class=" table-condensed">
            <tr><td>Order Number</td><td>:</td><td>124621</td></tr>
            <tr><td>Agent Name</td><td>:</td><td>Thomas Varghese</td></tr>
            <tr><td>Customer Name</td><td>:</td><td>Jijo Jacob</td></tr>
            <tr><td>Booking Date</td><td>:</td><td>01-04-2014</td></tr>
            <tr><td>Hotel Name</td><td>:</td><td>Holiday Inn Bur Dubai</td></tr>
            <tr><td>Hotel Address</td><td>:</td><td>Dubai</td></tr>
            <tr><td>Checkin Date</td><td>:</td><td>10-04-2014</td></tr>
            <tr><td>Checkout Date</td><td>:</td><td>12-04-2014</td></tr>
            <tr><td>Room Type</td><td>:</td><td>Double</td></tr>
            <tr><td>No. of Adults</td><td>:</td><td>2</td></tr>
            <tr><td>No. of Childs</td><td>:</td><td>0</td></tr>
            <tr><td>Extra Meal</td><td>:</td><td>0</td></tr>
            <tr><td>Extra Bed</td><td>:</td><td>0</td></tr>
            <tr><td>Amount</td><td>:</td><td>1,258 $</td></tr>
        </table>

    </div>
    <div class="modal-footer">
        <h3 style="color: 90c53f;" class="pull-left">Confirmed</h3>
    </div>
</div>
<!---Ends: Modal for Hotel booking -->

<!--starts: modal for visa application -->
<div id="visaAppModal" class="modal hide fade " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:620px; left:49%;">
    <div class="modal-header well">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 style="color: 90c53f;" id="visaModalLabel">Visa Application Details</h3>
    </div>
    <div class="modal-body well">
        <div>
            <div class="pull-left">
                <table width="100%" class=" table-condensed">
                    <tbody>
                    <tr><td>Order Number</td><td>:</td><td>124621</td></tr>
                    <tr><td>Agent Name</td><td>:</td><td>Thomas Varghese</td></tr>
                    <tr><td>Package</td><td>:</td><td>Loreum epsum</td></tr>
                    <tr><td>Date</td><td>:</td><td>01-04-2014</td></tr>
                    <tr><td>Customer Name</td><td>:</td><td>Riju Jacob</td></tr>
                    <tr><td>Passport Number</td><td>:</td><td>G876786</td></tr>
                    <tr><td>Nationality</td><td>:</td><td>Indian</td></tr>
                    <tr><td>No. of People</td><td>:</td><td>02</td></tr>
                    </tbody>
                </table>
            </div>
            <div style="margin-top:136px;margin-bottom: 50px;" class="pull-right">
                <h3 style="color: 90c53f;">Approved</h3>
                <a href="" class="btn btn-green bottom">download visa</a>
            </div>
        </div><br/><br/>
        <div>
            <table class="table well">
                <thead class="table-bordered">
                <tr><th>Customer's Name</th><th>Passport No</th><th>Nationality</th><th>Status</th><th>Documents</th></tr>
                </thead>
                <tbody>
                <tr>
                    <td>Krishnakumar Unni</td>
                    <td>G46573233</td>
                    <td>Indian</td>
                    <td class="text-success">Approved</td>
                    <td><a href="#">1</a> <a href="#">2</a> <a href="#">3</a> <a href="#">4</a> <a href="#">5</a></td>
                </tr>
                <tr>
                    <td>Krishnakumar Unni</td>
                    <td>G46573233</td>
                    <td>Indian</td>
                    <td class="text-error">Rejected</td>
                    <td><a href="#">1</a> <a href="#">2</a> <a href="#">3</a> <a href="#">4</a> <a href="#">5</a></td>
                </tr>
                <tr>
                    <td>Krishnakumar Unni</td>
                    <td>G46573233</td>
                    <td>Indian</td>
                    <td class="text-success">Approved</td>
                    <td><a href="#">1</a> <a href="#">2</a> <a href="#">3</a> <a href="#">4</a> <a href="#">5</a></td>
                </tr>
                </tbody>
            </table>
        </div>

    </div>
</div>
<!--ends: modal for visa application -->
<div class="tabbable"> <!-- Only required for left/right tabs -->
<ul class="nav nav-tabs">
    <li class="active"><a href="#tabHotelBooking" data-toggle="tab">Hotel Bookings</a></li>
    <li><a href="#tabVisaOrder" data-toggle="tab">Visa Requests</a></li>
    <li><a href="#tabPackageBooking" data-toggle="tab">Tour Packages</a></li>
</ul>
<div class="tab-content">
<div class="tab-pane active" id="tabHotelBooking">
    <table class="table well">
        <thead class="well table-bordered">
        <tr>
            <th>Sl</th>
            <th>Order</th>
            <th>Date</th>
            <th>Customer's Name</th>
            <th>Hotel</th>
            <th>Check In</th>
            <th>Check out</th>
            <th>Status</th>
            <th>Amount</th>
            <th>Details</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>01</td>
            <td>01258</td>
            <td>04-04-14</td>
            <td>Thomas Varghese</td>
            <td>Coral Diera</td>
            <td>04-04-14</td>
            <td>05-04-14</td>
            <td class="text-success">Approved</td>
            <td>$1,245</td>
            <td><a href="#hotelBookingModal" class="btn btn-green" data-toggle="modal">view</a></td>
        </tr>
        </tbody>
    </table>


</div>
<div class="tab-pane" id="tabVisaOrder">
    <table class="table well">
        <thead class="well table-bordered">
        <tr>
            <th>Sl</th>
            <th>Order</th>
            <th>Date</th>
            <th>Customer's Name</th>
            <th>Passport No</th>
            <th>Package</th>
            <th>Status</th>
            <th>Amount</th>
            <th>Details</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>01</td>
            <td>01258</td>
            <td>04-04-14</td>
            <td>Thomas Varghese</td>
            <td>F2845785</td>
            <td>Package Name</td>
            <td class="text-success">Approved</td>
            <td>$1,245</td>
            <td><a href="#visaAppModal" class="btn btn-green" data-toggle="modal">view</a></td>
        </tr>
        </tbody>
    </table>
</div>
<div class="tab-pane" id="tabPackageBooking">
    <table class="table well">
        <thead class="well table-bordered">
        <tr>
            <th>Sl</th>
            <th>Order</th>
            <th>Date</th>
            <th>Customer's Name</th>
            <th>Package</th>
            <th>No.of People</th>
            <th>Tour Date</th>
            <th>Amount</th>
            <th>Details</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>01</td>
            <td>01258</td>
            <td>04-04-14</td>
            <td>Thomas Varghese</td>
            <td>Package Name</td>
            <td>04</td>
            <td>12-04-14</td>
            <td>$1,245</td>
            <td><button class="btn-small btn-green">view</button></td>
        </tr>
        </tbody>
    </table>
</div>
</div>
</div>
</div>

<div class="clearfix"></div>
</div>
</div>
<!-- End: Main Content ---><div class="footer-sub">