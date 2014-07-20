<?php if ($visa['status'] == 'pending') { ?>
    <!-- visa upload form -->
    <div class="well ">
        <div class="uploadvisa-form">
            <form id="uploadform" method="POST" enctype="multipart/form-data">
                <legend>Upload Visa Document</legend>
                <input type="hidden" name="id" value="<?= $visa['order_id']; ?>">
                <input type="hidden" name="agent_id" value="<?= $visa['agent_id']; ?>">

                <input class="span6" type="file" id="visaDocument" name="visaFile" style="line-height: normal">
                <span class="help-block">Select Visa file (pdf document only) and upload.</span>
                <input type="submit" class="btn btn-primary uploadBtn"  name="submit" value="Upload!!!" />
            </form>
        </div>
        <div id="loader" style="display:none;">
            <center>Please Wailt loading...</center>
        </div>
        <div id="uploadStatus" style="color:green"></div>
        <div id="uploadError" style="color:red"></div>
    </div>
<?php } ?>
    <div class="parent-visa-div">
<table width="100%" style="border-bottom: 1px solid #EFEFEF; margin-bottom: 10px">
    <tr>
        <td width="35%">
            <span class="tdLabel">Order No.#</span>
            <span class="tdContent"><?= str_pad($visa['order_id'], 5, 0, STR_PAD_LEFT); ?></span>
        </td>
        <td width="30%">
            <span class="tdLabel">Order Date</span>
            <span class="tdContent"><?= date('F d, Y', strtotime($visa['applied_date'])); ?></span>
        </td>
        <td width="35%">
            <span class="tdLabel">Agent</span>
            <span class="tdContent"><?= $visa['agent_name'] . " (" . $visa['agent_id'] . ")"; ?></span>
        </td>
    </tr>
</table>
<table width="100%" style="border-bottom: 1px solid #EFEFEF; margin-bottom: 10px">
    <tr>
        <td width="65%">
            <span class="tdLabel">Visa Package</span>
            <span class="tdContent"><?= $visa['package'] . " - " . $visa['validity'] . " days"; ?></span>
            <span class="tdContent"><?= $booking['Hotel']['hotel_address']; ?></span>
        </td>
        <td width="35%">
            <span class="tdLabel">Total Applicants</span>
            <span class="tdContent"><?php echo $visa['pax_count'] . " no(s)"; ?></span>
        </td>
    </tr>
</table>
<?php if ($visa['paxes']) { ?>
    <table class="info" width="100%">
        <tr>
            <td><span class="tdLabel">Name:</span></td>
            <td><span class="tdLabel">Passport#:</td>
            <td><span class="tdLabel">Nationality:</td>
            <td><span class="tdLabel">Status:</td>
            <td><span class="tdLabel">Documents:</td>
        </tr>
        <?php foreach ($visa['paxes'] as $pax) { ?>
            <tr>
                <td class="btmBrdr"><span class="tdContent"><?= ucwords($pax['customer_name']); ?></span></td>
                <td class="btmBrdr"><span class="tdContent"><?= $pax['passport_no']; ?></span></td>
                <td class="btmBrdr"><span class="tdContent"><?= $pax['nationality']; ?></span></td>
                <td class="btmBrdr">
                    <?php $btn = (strtolower($pax['status']) == 'pending') ? 'warning' : ((strtolower($pax['status']) == 'approved') ? 'success' : 'danger'); ?>
                    <span class="tdContent text-<?= $btn; ?> <?php echo $visa['order_id']; ?>-text-status">
                        <?= $pax['status']; ?>
                    </span></td>
                <td class="btmBrdr">
                    <span class="tdContent download-visa-<?php echo $visa['order_id']?>">
                        <?php foreach($pax['document'] as $doc){ ?>
                            <a href="<?php echo SITE_URL . '/admin/download_visa_document/'.$doc; ?>"><i class="icon-file" style="cursor: pointer"></i> </a>&nbsp;
                        <?php } ?>
                    </span>
                </td>
            </tr>
        <?php } ?>
    </table>
<?php } ?>
    </div>