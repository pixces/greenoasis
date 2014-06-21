
    <div class="modal-body well">
        <div>
            <div class="pull-left">
                <table width="100%" class=" table-condensed">
                    <tbody>
                        <tr><td>Order Number</td><td>:</td><td><?php echo $visa['order_id'];?></td></tr>
                        <tr><td>Agent Name</td><td>:</td><td><?php echo $visa['agent_name'];?></td></tr>
                        <tr><td>Package</td><td>:</td><td><?php echo $visa['package'];?></td></tr>
                        <tr><td>Date</td><td>:</td><td><?php echo date('F d, Y', strtotime($visa['applied_date']));?></td></tr>
                        <tr><td>Customer Name</td><td>:</td><td><?php echo $visa['parent_customername'];?></td></tr>
                        <tr><td>Passport Number</td><td>:</td><td><?php echo $visa['parent_passport'];?></td></tr>
                        <tr><td>Nationality</td><td>:</td><td><?php echo $visa['nationality'];?></td></tr>
                        <tr><td>No. of People</td><td>:</td><td><?php echo $visa['pax_count'];?></td></tr>
                    </tbody>
                </table>
            </div>
            <div style="margin-top:136px;margin-bottom: 50px;" class="pull-right">
                <h3 style="color: 90c53f;"><?php echo $visa['parent_passport_status'];?></h3>
                <a href="" class="btn btn-green bottom">download visa</a>
            </div>
        </div><br/><br/>
        <div>
            <table class="table well">
                <thead class="table-bordered">
                <tr><th>Customer's Name</th><th>Passport No</th><th>Nationality</th><th>Status</th><th>Documents</th></tr>
                </thead>
                <tbody>
                    
                    <?php foreach($visa['paxes'] as $pax){ ?>
                    <tr>
                        <td><?php echo $pax['customer_name'];?></td>
                          <td><?php echo $pax['passport_no'];?></td>
                         <td><?php echo $pax['nationality'];?></td>
                        <td class="text-success"><?php echo $pax['status'];?></td>
                        <td>
                            <?php foreach($pax['document'] as $key=>$document){ ?>
                                        <a href="<?php echo SITE_URL.'/upload/'.$document?>"><?php echo ($key+1);?></a> 
                            <?php } ?>
                        </td>
                    </tr>
               
                
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>