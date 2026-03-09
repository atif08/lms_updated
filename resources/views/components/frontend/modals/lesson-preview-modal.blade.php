
{{--<div class="modal fade" id="lessonPreviewModal">--}}
{{--    <div class="modal-dialog modal-dialog-centered modal-xl">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="page-wrapper-new p-0">--}}
{{--                <div class="content">--}}
{{--                    <div class="modal-header border-0 custom-modal-header">--}}
{{--                        <div class="page-title">--}}
{{--                            <h4 class="pdf-title"></h4>--}}
{{--                        </div>--}}
{{--                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">--}}
{{--                            <i class="feather-x"></i>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                    <div class="modal-body custom-modal-body">--}}
{{--                        <img alt="image" id="image-frame" src=""/>--}}
{{--                        <iframe id="pdfFrame" src="" style="width:100%; height:1000px;"></iframe>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

<div class="modal fade" id="lessonPreviewModal">
    <div class="modal-dialog modal-dialog-centered modal-xl" style="text-align: center;    width: 100%;">
        <div class="modal-content">
            <div class="page-wrapper-new p-0">
                <div class="content">
                    <div class="modal-header border-0 custom-modal-header">
                        <div class="page-title">
                            <h4 class="pdf-title"></h4>
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i class="feather-x"></i>
                        </button>
                    </div>
                    <div class="modal-body lesson-preview-body">
                        <canvas id="pdfCanvas"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


