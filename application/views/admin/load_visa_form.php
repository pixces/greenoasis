<div class="well ">
    <div class="uploadvisa-form">
        <form id="uploadform" method="POST" enctype="multipart/form-data">
            <legend>Approve Visa</legend>
            <input type="hidden" name="id" value="<?= $visa['order_id']; ?>">
            <input type="hidden" name="agent_id" value="<?= $visa['agent_id']; ?>">
            <input type="hidden" name="pax" value="<?= $visa['pax_count']; ?>">
            <label>Price per Visa</label>
            <input type="text" name="price" value="" required class="span3">
            <label>Upload Visa Document</label>
            <input class="span6" type="file" id="visaDocument" name="visaFile" style="line-height: normal">
            <span class="help-block">Select Visa file (pdf document only) and upload.</span>
            <label>Remark</label>
            <textarea rows="4" cols="50" maxlength="50" required class="span3" name="remark"></textarea>
            <br/>
            <input type="submit" class="btn btn-primary uploadBtn"  name="submit" value="Upload!!!" />
        </form>
    </div>
    <div id="loader" style="display:none;">
        <center>Please Wait loading...</center>
    </div>
    <div id="uploadStatus" style="color:green"></div>
    <div id="uploadError" style="color:red"></div>
</div>