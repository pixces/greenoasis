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
                    <th>Sl</th>
                    <th>Order#</th>
                    <th>Date</th>
                    <th>Agent's Name</th>
                    <th>Customer's Name</th>
                    <th>Passport Number</th>
                    <th>Applicants</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Details</th>
                    <th>Download Visa</th>
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
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $visa['Visa']['id']; ?></td>
                            <td><?php echo date("F j, Y", strtotime($visa['Visa']['date_added'])); ?></td>
                            <td><?php echo ucwords($visa['Visa']['agent_name']); ?></td>
                            <td><?php echo ucwords($visa['customer_name']); ?></td>
                            <td><?php echo $visa['passport']; ?></td>
                            <td><?php echo $visa['Visa']['pax_count']; ?></td>
                            <td><?php echo CURRENCY . " " . $visa['price']; ?></td>
                            <td>
                                <?php $btn = ($visa['status'] == 'approved') ? 'success' : ( ($visa['status'] == 'rejected') ? 'danger' : 'warning' ); ?>
                                <span  class="text-<?= $btn; ?> <?php echo $visa['Visa']['id']; ?>-text-status"><?= ucwords(strtolower($visa['status'])); ?></span>
                            </td>
                            <td><a href="#visaAppModal"  class="btn btn-success loadVisaView" data-toggle="modal" 
                                   data-application-id="<?php echo $visa['Visa']['id']; ?>" data-remote="<?= SITE_URL . "/admin/view_visadetails/" . $visa['Visa']['id']; ?>">view</a></td>
                            <td>   <span class="download-visa-<?php echo $visa['Visa']['id']?>"><?php if ($visa['status'] == "approved") { ?>
                              <a href="<?php echo SITE_URL . '/admin/download_visa_document/' . json_decode($visa['Visa']['visa_file_name']); ?>"><i class="icon-file"></i> </a>
                             <?php } else { ?><i style="cursor: not-allowed" class="icon-file" onclick="javascript:alert('No Visa Document To Download');"></i><?php } ?></span> </td>
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
        <h3 style="color: 90c53f;" id="visaModalLabel">Visa Application Details</h3>
    </div>
    <div class="modal-body">
        <p>One fine body…</p>
    </div>
    <div class="modal-footer"></div>
</div>
<!--ends: modal for visa application 