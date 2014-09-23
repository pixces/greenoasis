<!-- Start: Main Content --->
<div class="content bg-white" xmlns="http://www.w3.org/1999/html">
    <div class="container">
        <div class="heading"><h1>Agent: Confirmation</h1></div>
        <div class="container-main box-shadow pull-left">
            <h1 class="thanks">Thank You!</h1>
            <p>Welcome to <span class="green-title">GreenOasis</span>.</p>
            <p>We thank you for the interest shown for being an agent of GreenOasis. The details submitted by you are as under;</p>
            <ul class="piped-info pull-left clearfix">
                <li class="pull-left bigbox">
                    <span class="pull-left info-section">
                        <span class="meta-label">Company Name::</span>
                        <span class="meta-details"><b><?=$agent['company']; ?></b></span>
                    </span>
                    <span class="pull-left info-section">
                        <span class="meta-label">Contact Person:</span>
                        <span class="meta-details"><b><?=$agent['contact']; ?></b></span>
                    </span>
                    <span class="pull-left info-section">
                        <span class="meta-label">Contact Phone:</span>
                        <span class="meta-details"><b><?=$agent['phone']; ?></b></span>
                    </span>
                </li>
            </ul>
            <p>Our representative will get in touch with you shortly to discuss this engagement with us.</p>
            <div class="footer">
            <h1>Terms Conditions:</h1>
                <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.</p>
                <p>Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.</p>
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
            <div class="clear"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- End: Main Content --->