@extends('templates.admin.default')
@section('title')
    Mi titulo
@endsection
@section('css')
<link href="<?=base_url('assets/common/js/fancybox/dist/jquery.fancybox.css')?>" type="text/css" rel="stylesheet">
@endsection
@section('js')
    <script src="<?=base_url('assets/common/js/fancybox/dist/jquery.fancybox.js')?>"></script>
@endsection
@section('script')
<script>
    $(document).ready(function (){
        $('[data-fancybox]').fancybox({
            iframe: {
                css: {
                    height: '500px'
                }
            }
        });
    });
function setImage(imagen) {
    $('#imagen').attr('src','{{base_url('assets/common/uploads/')}}'+imagen);
    $.fancybox.close('all');
}
</script>
@endsection
@section('content')
    <div class="wrapper wrapper-content">
        <div class="middle-box text-center animated fadeInRightBig">
            <h3 class="font-bold">This is page content</h3>
            <div class="error-desc">
                You can create here any grid layout you want. And any variation layout you imagine:) Check out
                main dashboard and other site. It use many different layout.
                <br/><a href="index.html" class="btn btn-primary m-t">Dashboard</a>
            </div>
            <img src="" alt="" id="imagen">
            <a data-fancybox data-src="{{ site_url('upload/dir') }}" href="javascript:;" class="btn btn-default">Abrir</a>
        </div>
    </div>
@endsection
