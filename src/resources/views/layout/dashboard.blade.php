<!doctype html>
<html lang="en">
  <!--begin::Head-->
  <head>
    @include('partials.admin.head')
  </head>
  <!--end::Head-->
  <!--begin::Body-->
  <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
      <!--begin::Header-->
      @include('partials.admin.topo')
      <!--end::Header-->
      <!--begin::Sidebar-->
      @include('partials.admin.menu-lateral')
      <!--end::Sidebar-->
      <!--begin::App Main-->
      <main class="app-main">        
        <!--begin::App Content-->
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">            
            <!--CONTEUDO DO DASHBOARD-->
            <main>
                @yield('content')
            </main>
            <!-- FIM CONTEUDO DO DASHBOARD -->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
      </main>
      <!--end::App Main-->
      <!--begin::Footer-->
      @include('partials.admin.rodape')
      <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->
    @include('partials.admin.script')
  </body>
  <!--end::Body-->
</html>