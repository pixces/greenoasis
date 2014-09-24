<!-- Start: Main Content -->
<div id="page_booking" class="static-view content bg-white">
    <div class="container">
        <div class="heading"><h1>Transaction History</h1></div>
        <div class="container-main  box-shadow" style="width:100%;">
            <div class="row">
                <div class="span6">
                    <h1 style="margin:0;padding:0;">Current Balance :</h1>
                    <h1 style="margin:0;font-size:31.5px;padding:0;">USD <?=number_format($summary['balance'], 0); ?></h1>
                    <p>Last Successful Payment <?=date('j/m/Y', strtotime($summary['lastTranDate'])); ?> <!--5/8/2014 -->
                        ($<?=number_format($summary['lastTranAmt'], 0); ?>)</p></div>
                <div class="pull-right span8">
                    <!-- form class="form-inline pull-right">
                        <label>From : </label>
                        <div id="dpFrom" class="input-append date" data-date-format="dd-mm-yyyy" data-date="12-04-2014">
                            <input id="dateFrom" name="" class="span2" type="text" readonly="" value="12-04-2014" placeholder="" required="required">
                            <span class="add-on"><i class="icon-calendar"></i></span>
                        </div>
                        <label>To : </label>
                        <div id="dpTo" class="input-append date" data-date-format="dd-mm-yyyy" data-date="12-04-2014">
                            <input id="dateTo" name="" class="span2" type="text" readonly="" value="12-04-2014" placeholder="Check In" required="required">
                            <span class="add-on"><i class="icon-calendar"></i></span>
                        </div>
                    </form -->
                </div>
            </div>
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th class="span3">Date</th>
                            <th>Description</th>
                            <th class="span2">Debits</th>
                            <th class="span2">Credits</th>
                            <th class="span2">Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($data) {
                            $balance = 0;
                            foreach($data as $rec) {
                                if ($rec['Agent_Wallet']['type'] == 'deposite'){
                                    $balance += $rec['Agent_Wallet']['value'];
                                } else {
                                    $balance -= $rec['Agent_Wallet']['value'];
                                }
                        ?>
                        <tr>
                            <td><?=date('M j, Y', strtotime($rec['Agent_Wallet']['date'])); ?></td>
                            <td>
                                <?php
                                    if ($rec['Agent_Wallet']['type'] == 'deposite'){
                                        echo "TRAX#".str_pad($rec['Agent_Wallet']['id'],5,0,STR_PAD_LEFT)." - Amount Added to Wallet";
                                    } else {
                                        if($rec['Agent_Wallet']['item_type'] != 'none'){
                                            echo strtoupper($rec['Agent_Wallet']['item_type']).": Booking Id#".str_pad($rec['Agent_Wallet']['item_id'],5,0,STR_PAD_LEFT);
                                        }
                                    }
                                ?>
                            </td>
                            <td>
                                <?=($rec['Agent_Wallet']['type'] == 'withdrawl') ? number_format($rec['Agent_Wallet']['value'], 0) : '-'; ?>
                            </td>
                            <td>
                                <?=($rec['Agent_Wallet']['type'] == 'deposite') ? number_format($rec['Agent_Wallet']['value'], 0) : '-'; ?>
                            </td>
                            <td><?php echo '$'."  ".number_format($balance,0); ?></td>
                        </tr>
                        <?php } } else { ?>
                        <tr>
                            <td colspan="5">No transaction details found.</td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
    </div>
</div>
<!-- End: Main Content -->