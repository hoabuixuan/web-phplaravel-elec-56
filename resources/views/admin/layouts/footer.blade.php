<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; TTCJSC.VN 2019</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Bạn có chắc muốn thoát?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Chọn đăng xuất bên dưới để kết thúc phiên làm việc.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Đăng xuất</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="asset/admin/vendor/jquery/jquery.min.js"></script>
<script src="asset/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="asset/admin/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="asset/admin/js/sb-admin-2.min.js"></script>
{{-- Ajax --}}
<script src="asset/admin/js/ajax.js"></script>
<script src="asset/admin/js/toastr.min.js"></script>
<script src="ckeditor/ckeditor.js"></script>
@yield('script')
<script>
    CKEDITOR.replace('demo');
</script>
@if(\session('success'))
<script type="text/javascript">
    toastr.success('{{session('success')}}', 'Thông báo', {timeOut: 5000});
</script>
@endif

@if(\session('error'))
    <script type="text/javascript">
        toastr.error('{{session('error')}}', 'Thông báo', {timeOut: 5000});
</script>
@endif

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
