<!-- display error message if exists -->
<?=$errorMsg; ?>

<!-- banner add new options !!-->
<section class="box box-shadow pd20 bannerForm clearfix ">
    <fieldset>
        <legend>Add Banners</legend>
    </fieldset>
    <div class="pull-left">
        <form id="bannerFrm" method="post" action="" enctype="multipart/form-data">
            <div>
                <label class="control-label" for="inputTitle">Title / Caption</label>
                <input type="text" name="title" id="inputTitle" placeholder="Title or Banner Caption" class="span6">
            </div>
            <div>
                <label class="control-label" for="inputType">Banner Type</label>
                <label class="radio inline">
                    <input type="radio" name="type" id="banner_type_large" value="large" checked>
                    Large Banner (1349px x 450px)
                </label>
                <label class="radio inline">
                    <input type="radio" name="type" id="banner_type_small" value="small">
                    Small Banner (300px x 250px)
                </label>
            </div>
            <div>
                <label class="control-label" for="inputURL">Banner Link URL</label>
                <input type="text" name="url" id="inputURL" placeholder="Banner Link URL" class="span6">
            </div>
            <div>
                <label class="control-label" for="bannerFile">Banner Image</label>
                <input type="file" name="banner" id="bannerFile">

            </div>
            <div>
                <input type="submit" class="btn btn-primary" name="submit" value="add banner">
            </div>
        </form>
    </div>
    <div class="pull-right">
        <p>Use the form alongside to add new banners. Please remember the following while adding a new banner.</p>
        <ol>
            <li>Only JPG's & PNG file types allowed</li>
            <li>Allowed resolution: 1349 x 450 px (w x h).</li>
            <li>Banners should not be more than 600 kb's each. Small sizes banners load faster.</li>
        </ol>
        <div class="previewBannerWrapper">
            <div>
                <img id="imgPreview" src="#">
            </div>
        </div>
    </div>
</section>
<!-- banner display_area !!-->
<section class="bannerList">
    <?php foreach ($banners as $banner) { ?>
    <div id="banner-<?=$banner['Banner']['id']; ?>" class="bannerImg pull-left">
        <img class="img-polaroid" src="<?=SITE_URL.$path.'/tn_'.$banner['Banner']['filename']; ?>">
        <span class="action-bar">
            <span class="pull-left">
                <?=$banner['Banner']['title']; ?>
            </span>
            <span class="pull-right">
                <?php
                $btnType = '';
                $icon = 'icon-thumbs-down';
                if ($banner['Banner']['status'] == 'active'){
                    $icon = 'icon-thumbs-up icon-white';
                    $btnType = 'btn-inverse';
                }
                ?>
                <button class="toggle-featured btn btn-small <?=$btnType; ?>" type="button" data-type="banner" data-action="status" id="<?=$banner['Banner']['id']; ?>" data-value="<?=$banner['Banner']['status']; ?>" title="unmark <?=$banner['Banner']['status']; ?>"><i class="<?=$icon; ?>"></i></button>
                <a href="javascript:void(0);" class="delete-link btn btn-mini" id="<?=$banner['Banner']['id']; ?>" data-type="banner" data-action="delete" data-title="<?=$banner['Banner']['title']; ?>" title="Delete this Banner"><i class="icon-trash"></i></a>
            </span>

        </span>
    </div>
    <?php } ?>
</section>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#imgPreview').attr('src', e.target.result);
                $("#imgPreview").show();
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#bannerFile").change(function(){
        readURL(this);
    });

    $(document).ready(function(){
        $("#bannerFrm").validate({
            rules:{
                type:{
                    required: true
                },
                url:{
                    required: true,
                    url: true
                },
                banner: {
                    required: true,
                    extension: "png|jpg|jpeg|bmp|tiff"
                }
            },
            messages:{
                type:{
                    required: 'Select proper banner type.'
                },
                url:{
                    required: 'Enter Hyperlink URL.'
                },
                banner: {
                    required: "Select banner image.",
                    extension: "Only Images allowed."
                }
            }
        });
    })
</script>