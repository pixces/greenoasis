<div class="page-body-inner">
    <div>
        <div>
            <form class="form-inline pull-right">
                <label>
                    <input type="text" class="span2" placeholder="Order Number">
                </label>
                <div id="dpFrom" class="input-append date" data-date-format="dd-mm-yyyy" data-date="12-04-2014">
                    <input id="dateFrom" name="" class="span2" type="text" readonly="" value="12-04-2014" placeholder="" required="required">
                    <span class="add-on"><i class="icon-calendar"></i></span>
                </div>
                <label>To</label>
                <div id="dpTo" class="input-append date" data-date-format="dd-mm-yyyy" data-date="12-04-2014">
                    <input id="dateTo" name="" class="span2" type="text" readonly="" value="12-04-2014" placeholder="Check In" required="required">
                    <span class="add-on"><i class="icon-calendar"></i></span>
                </div>
            </form>
        </div>
    </div>    <br/><br/>    

    <div class="">
        <table class="table">
            <thead class="well table-bordered">
                <tr>
                    <th>Order #</th>
                    <th>Order Date</th>
                    <th>Visa Details</th>
                    <th>Applicants</th>
                    <th>Agent's Name</th>
                    <th>Value</th>
                    <th>Visa</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if (empty($visaInfo)) {
                        echo '<tr><td>No Record Exist.</td></tr>';
                    } else {
                ?>
                    <?php $i = 1; ?>
                    <?php foreach ($visaInfo as $visa): ?>
                        <tr>
                            <td><a href="#visaAppModal" class="loadVisaView" data-toggle="modal" data-application-id="<?php echo $visa['Visa_Booking']['id']; ?>" data-remote="<?= SITE_URL . "/admin/view_visadetails/" . $visa['Visa_Booking']['id'].'?interface=admin'; ?>"><b>#<?php echo str_pad($visa['Visa_Booking']['id'], 5, 0, STR_PAD_LEFT); ?></b></a></td>
                            <td><?php echo date("M j, Y", strtotime($visa['Visa_Booking']['date_added'])); ?></td>
                            <td>
                                <span><b><?=$visa['Visa']['title']; ?></b></span>
                                <span><?="Validity: ".$visa['Visa']['validity']." days"; ?></span>
                            </td>
                            <td>
                                <span><a href="mailto:<?=$visa['Visa_Booking']['email']; ?>"><?php echo strtolower($visa['Visa_Booking']['email'])." | ".$visa['Visa_Booking']['phone']; ?></a></span>
                                <span><?="Arrival: ".date("M j, Y", strtotime($visa['Visa_Booking']['arrival'])); ?></span>
                                <span><?="Pax Size: ".str_pad($visa['Visa_Booking']['pax_count'], 2, '0', STR_PAD_LEFT); ?></span>
                            </td>
                            <td><?php echo ucwords($visa['agent_name'])." ( #".$visa['Visa_Booking']['agent_id']." )"; ?></td>
                            <td><?php echo ($visa['Visa_Booking']['price'] == 0) ? ' - ' : CURRENCY . " " . ($visa['Visa_Booking']['price']); ?></td>
                            <td>
                                <span class="download-visa-<?php echo $visa['Visa']['id']?>">
                                <?php if (!is_null($visa['Visa_Booking']['visa_file_name'])) { ?>
                                    <a href="<?php echo SITE_URL . '/admin/download_visa_document/' . json_decode($visa['Visa_Booking']['visa_file_name']); ?>"><i style="cursor: pointer" class="icon-download-visa-active"></i>Visa </a>
                                <?php } else { ?>
                                    <!-- i style="cursor: not-allowed" class="icon-file" onclick="javascript:alert('No Visa Document To Download');"></i -->
                                    <i class="icon-download-visa"></i>
                                <?php } ?>
                                </span>
                            </td>
                            <td>
                                <?php $btn = ($visa['status'] == 'approved') ? 'success' : ( ($visa['status'] == 'rejected') ? 'danger' : 'warning' ); ?>
                                <span class="badge badge-<?=$btn; ?> <?php echo $visa['Visa_Booking']['id']; ?>-status"><?= ucwords(strtolower($visa['status'])); ?></span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<!--starts: modal for visa application -->
<div id="visaAppModal" class="modal hide fade " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:620px; left:49%;">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 style="color: #90c53f;" id="visaModalLabel">Visa Application Details</h3>
    </div>
    <div class="modal-body">
        <p>One fine body…</p>
    </div>
    <div class="modal-footer"></div>
</div>
<!--ends: modal for visa application 