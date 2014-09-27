<div class="well ">
    <div class="uploadinvoice-form">
        <form id="uploadinvoiceform" method="POST" enctype="multipart/form-data">
            <legend>Upload Invoice</legend>
            <input type="hidden" name="id" value="<?= $visa['order_id']; ?>">
            <label>Invoice Number</label>
            <input type="text" name="invoice_no" value="" required class="span3">
            <label>Upload Invoice Document</label>
            <input class="span6" type="file" id="invoiceDocument" name="invoiceFile" style="line-height: normal">
            <span class="help-block">Select Invoice file (pdf document only) and upload.</span>
            <input type="submit" class="btn btn-primary uploadBtn"  name="submit" value="Upload!!!" />
        </form>
    </div>
    <div id="loader" style="display:none;">
        <center>Please Wait loading...</center>
    </div>
    <div id="uploadStatus" style="color:green"></div>
    <div id="uploadError" style="color:red"></div>
</div>