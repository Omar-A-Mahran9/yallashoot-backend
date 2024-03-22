<!--begin::Image input-->
<div class="image-input image-input-outline" data-kt-image-input="true" >

    <!-- begin :: Image preview wrapper -->
    <div class="image-input-wrapper w-125px h-125px" style="background-image: url('{{ $imagePath }}'); background-position:center; background-size:contain"></div>
    <!-- end   :: Image preview wrapper -->

    @if( $type === 'editable')

    <!-- begin :: Edit button -->
        <label
            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
            data-kt-image-input-action="change"
            data-bs-toggle="tooltip"
            data-bs-dismiss="click"
            title="{{ __("Change image") }}">
            <i class="bi bi-pencil-fill fs-7"></i>

            <!-- begin :: Inputs-->
            <input type="file" name="{{ $name }}" accept="image/*"/>
            <!-- end   :: Inputs-->

        </label>
    <!-- end   :: Edit button -->

    @endif

</div>
<!--end::Image input-->
