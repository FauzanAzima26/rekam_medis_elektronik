@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-4 mb-6">Page 1</h4>
        <p>
            Sample page.<br />For more layout options, <a href="" target="_blank" class="fw-medium"></a> refer
            <a
                href="https://demos.pixinvent.com/vuexy-html-admin-template/documentation//layouts.html"
                target="_blank"
                class="fw-medium">Layout docs</a>.
        </p>
    </div>
    <!-- / Content -->

    <!-- Footer -->
    <footer class="content-footer footer bg-footer-theme">
        <div class="container-xxl">
            <div
                class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">
                <div class="text-body">
                    ©
                    <script>
                        document.write(new Date().getFullYear());
                    </script>
                    , made with ❤️ by <a href="https://pixinvent.com" target="_blank" class="footer-link">Pixinvent</a>
                </div>
                <div class="d-none d-lg-inline-block">
                    <a
                        href="https://demos.pixinvent.com/vuexy-html-admin-template/documentation/"
                        target="_blank"
                        class="footer-link me-4">Documentation</a>
                </div>
            </div>
        </div>
    </footer>
    <!-- / Footer -->

    <div class="content-backdrop fade"></div>
</div>

@endsection