<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
          <!--begin::Brand Link-->
          <a href="{{ route('dashboard') }}" class="brand-link">
            <!--begin::Brand Image-->
            <img
              src="{{ asset('barista/img/logo-casa-do-barista.svg') }}"
              alt="Casa do Barista Logo"
              class="brand-image"
            />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            
            <!--end::Brand Text-->
          </a>
          <!--end::Brand Link-->
        </div>
        <!--end::Sidebar Brand-->
        <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper">
          <nav class="mt-2" aria-label="Main navigation">
            <!--begin::Sidebar Menu-->
            <ul
              class="nav sidebar-menu flex-column"
              data-lte-toggle="treeview"
              data-accordion="false"
              id="navigation"
            >
              <li class="nav-item menu-open">
                <a href="{{ route('dashboard') }}" class="nav-link active">
                  <i class="nav-icon bi bi-speedometer"></i>
                  <p>
                    Dashboard                    
                  </p>
                </a>                
              </li>
              <li class="nav-header">PRODUTOS</li>
              <li class="nav-item">
                <a href="{{ route('admin.produto.index') }}" class="nav-link">
                  <i class="nav-icon bi bi-circle-fill"></i>
                  <p>Produtos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.categoria.index') }}" class="nav-link">
                  <i class="nav-icon bi bi-circle-fill"></i>
                  <p>Categorias</p>
                </a>
              </li>
              <li class="nav-header">VENDAS</li>
                <li class="nav-item">
                  <a href="{{ route('admin.venda.index') }}" class="nav-link">
                    <i class="nav-icon bi bi-circle-fill"></i>
                    <p>Vendas</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('admin.local.index') }}" class="nav-link">
                    <i class="nav-icon bi bi-circle-fill"></i>
                    <p class="text">Locais / QR Code</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('admin.cliente.index') }}" class="nav-link">
                    <i class="nav-icon bi bi-circle-fill"></i>
                    <p class="text">Clientes</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('admin.usuario.index') }}" class="nav-link">
                    <i class="nav-icon bi bi-circle-fill"></i>
                    <p class="text">Usuários</p>
                  </a>
                </li>
              <li class="nav-header">SITE</li>
              <li class="nav-item">
                <a href="{{ route('admin.mensagem.index') }}" class="nav-link">
                  <i class="nav-icon bi bi-circle-fill"></i>
                  <p>Mensagens</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.banner.index') }}" class="nav-link">
                  <i class="nav-icon bi bi-circle-fill"></i>
                  <p>
                    Banner                    
                  </p>
                </a>                
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.galeria.index') }}" class="nav-link">
                  <i class="nav-icon bi bi-circle-fill"></i>
                  <p>Galeria</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.equipe.index') }}" class="nav-link">
                  <i class="nav-icon bi bi-circle-fill"></i>
                  <p>Equipe</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.depoimento.index') }}" class="nav-link">
                  <i class="nav-icon bi bi-circle-fill"></i>
                  <p>
                    Depoimentos                    
                  </p>
                </a>                
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.linha-tempo.index') }}" class="nav-link">
                  <i class="nav-icon bi bi-circle-fill"></i>
                  <p>Linha do tempo</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.newsletter.index') }}" class="nav-link">
                  <i class="nav-icon bi bi-circle-fill"></i>
                  <p>
                    Newsletter                    
                  </p>
                </a>                
              </li>              
            </ul>
            <!--end::Sidebar Menu-->
          </nav>
        </div>
        <!--end::Sidebar Wrapper-->
      </aside>