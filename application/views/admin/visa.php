<div class="page-body-inner">
   
    <div>
        <div>
            <form class="form-inline pull-right">
                <label>Search by Order Number
                    <input type="text" class="span2">
                </label>
                <label>Custom</label>
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

     echo    '<tr><td>No Record Exist.</td></tr>';
        
    }else{
    ?>
           
<?php $i = 1; ?>
<?php foreach ($visaInfo as $visa): ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $visa['Visa']['id']; ?></td>
                <td><?php echo date("F j, Y", strtotime($visa['Visa']['date_added'])); ?></td>
                <td><?php echo ucwords($visa['agent_name']); ?></td>
                <td><?php echo ucwords($visa['customer_name']); ?></td>
                <td><?php echo $visa['passport']; ?></td>
                <td><?php echo $visa['Visa']['pax_count']; ?></td>
                <td><?php echo CURRENCY . $visa['price']; ?></td>
                <td>
                    <?php $btn = ($visa['status'] == 'approved') ? 'success' : (  ($visa['status'] == 'rejected') ? 'danger' : 'warning' ) ; ?>
                    <span class="btn btn-<?=$btn; ?>"><?=ucwords(strtolower($visa['status'])); ?></span>
                </td>
                <td>View</td>
                <td> - </td>
            </tr>
<?php endforeach; ?>


           
    <?php } ?>
                     </tbody>
        </table>
    </div>
</div>
