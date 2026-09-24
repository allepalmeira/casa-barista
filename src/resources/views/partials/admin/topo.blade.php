<nav class="app-header navbar navbar-expand bg-body">
        <!--begin::Container-->
        <div class="container-fluid">
          <!--begin::Start Navbar Links-->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a
                class="nav-link"
                data-lte-toggle="sidebar"
                href="#"
                role="button"
                aria-label="Abrir/fechar menu"
              >
                <i class="bi bi-list"></i>
              </a>
            </li>
          </ul>
          <!--end::Start Navbar Links-->

          <!--begin::End Navbar Links-->
          <ul class="navbar-nav ms-auto">
            <!--begin::Messages Dropdown Menu (mensagens do formulário de contato do site)-->
            <li class="nav-item dropdown">
              <a
                class="nav-link"
                data-bs-toggle="dropdown"
                href="#"
                aria-label="Mensagens: {{ $qtdeMensagensNovas }} não lidas"
              >
                <i class="bi bi-chat-text"></i>
                @if ($qtdeMensagensNovas > 0)
                  <span class="navbar-badge badge text-bg-danger">{{ $qtdeMensagensNovas }}</span>
                @endif
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                @forelse ($mensagensNovas as $mensagem)
                  <a href="{{ route('admin.mensagem.index', ['status' => 'novo', 'ler' => $mensagem->id_contato]) }}" class="dropdown-item">
                    <!--begin::Message-->
                    <div class="d-flex">
                      <div class="flex-shrink-0">
                        <i class="bi bi-person-circle fs-2 me-3" aria-hidden="true"></i>
                      </div>
                      <div class="flex-grow-1">
                        <p class="dropdown-item-title">
                          {{ $mensagem->nome_contato }}
                          <span class="float-end fs-7">{{ $mensagem->assunto_contato }}</span>
                        </p>
                        <p class="fs-7">{{ \Illuminate\Support\Str::limit($mensagem->mensagem_contato, 40) }}</p>
                        <p class="fs-7 text-secondary">
                          <i class="bi bi-clock-fill me-1"></i>
                          {{ \Illuminate\Support\Carbon::parse($mensagem->data_criacao_contato)->locale('pt_BR')->diffForHumans() }}
                        </p>
                      </div>
                    </div>
                    <!--end::Message-->
                  </a>
                  <div class="dropdown-divider"></div>
                @empty
                  <span class="dropdown-item dropdown-header">Nenhuma mensagem nova</span>
                  <div class="dropdown-divider"></div>
                @endforelse
                <a href="{{ route('admin.mensagem.index') }}" class="dropdown-item dropdown-footer">Ver todas as mensagens</a>
              </div>
            </li>
            <!--end::Messages Dropdown Menu-->

            <!--begin::Notifications Dropdown Menu (o que está esperando alguma ação)-->
            <li class="nav-item dropdown">
              <a
                class="nav-link"
                data-bs-toggle="dropdown"
                href="#"
                aria-label="Notificações: {{ $qtdeNotificacoes }} pendentes"
              >
                <i class="bi bi-bell-fill"></i>
                @if ($qtdeNotificacoes > 0)
                  <span class="navbar-badge badge text-bg-warning">{{ $qtdeNotificacoes }}</span>
                @endif
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <span class="dropdown-item dropdown-header">
                  {{ $qtdeNotificacoes > 0 ? $qtdeNotificacoes . ' pendências' : 'Nada pendente por aqui' }}
                </span>
                @foreach ($notificacoes as $notificacao)
                  <div class="dropdown-divider"></div>
                  <a href="{{ $notificacao['link'] }}" class="dropdown-item">
                    <i class="bi {{ $notificacao['icone'] }} me-2"></i> {{ $notificacao['texto'] }}
                    @if ($notificacao['quando'])
                      <span class="float-end text-secondary fs-7">
                        {{ \Illuminate\Support\Carbon::parse($notificacao['quando'])->locale('pt_BR')->diffForHumans() }}
                      </span>
                    @endif
                  </a>
                @endforeach
                <div class="dropdown-divider"></div>
                <a href="{{ route('dashboard') }}" class="dropdown-item dropdown-footer">Ir para o dashboard</a>
              </div>
            </li>
            <!--end::Notifications Dropdown Menu-->

            <!--begin::Fullscreen Toggle-->
            <li class="nav-item">
              <a
                class="nav-link"
                href="#"
                data-lte-toggle="fullscreen"
                aria-label="Tela cheia"
              >
                <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                <i data-lte-icon="minimize" class="bi bi-fullscreen-exit d-none"></i>
              </a>
            </li>
            <!--end::Fullscreen Toggle-->

            <!--begin::Color Mode Toggle (o AdminLTE salva a escolha no navegador)-->
            <li class="nav-item dropdown">
              <a
                class="nav-link"
                href="#"
                id="bd-theme"
                aria-label="Tema claro ou escuro"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                <i class="bi bi-sun-fill" data-lte-theme-icon="light"></i>
                <i class="bi bi-moon-fill d-none" data-lte-theme-icon="dark"></i>
                <i class="bi bi-circle-half d-none" data-lte-theme-icon="auto"></i>
              </a>
              <ul
                class="dropdown-menu dropdown-menu-end"
                aria-labelledby="bd-theme"
                style="--bs-dropdown-min-width: 8rem"
              >
                <li>
                  <button
                    type="button"
                    class="dropdown-item d-flex align-items-center"
                    data-bs-theme-value="light"
                    aria-pressed="false"
                  >
                    <i class="bi bi-sun-fill me-2"></i>
                    Claro
                    <i class="bi bi-check-lg ms-auto d-none"></i>
                  </button>
                </li>
                <li>
                  <button
                    type="button"
                    class="dropdown-item d-flex align-items-center"
                    data-bs-theme-value="dark"
                    aria-pressed="false"
                  >
                    <i class="bi bi-moon-fill me-2"></i>
                    Escuro
                    <i class="bi bi-check-lg ms-auto d-none"></i>
                  </button>
                </li>
                <li>
                  <button
                    type="button"
                    class="dropdown-item d-flex align-items-center active"
                    data-bs-theme-value="auto"
                    aria-pressed="true"
                  >
                    <i class="bi bi-circle-half me-2"></i>
                    Automático
                    <i class="bi bi-check-lg ms-auto d-none"></i>
                  </button>
                </li>
              </ul>
            </li>
            <!--end::Color Mode Toggle-->


           <!--begin::User Menu Dropdown-->
            <li class="nav-item dropdown user-menu">

                <!-- Usuário no topo -->
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">

                    <img src="{{ auth()->user()->urlFoto() }}"
                        class="user-image rounded-circle shadow" alt="{{ auth()->user()->nome_usuarios }}" />

                    <span class="d-none d-md-inline">
                        {{ auth()->user()->nome_usuarios }}
                    </span>

                </a>


                <!-- Dropdown -->
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">

                    <!-- Cabeçalho do usuário -->
                    <li class="user-header text-bg-primary">

                        <img src="{{ auth()->user()->urlFoto() }}" class="rounded-circle shadow"
                            alt="{{ auth()->user()->nome_usuarios }}" />

                        <p>

                            {{ auth()->user()->nome_usuarios }}

                            <small>
                                {{ ucfirst(strtolower(auth()->user()->nivel_usuarios)) }}
                            </small>

                        </p>

                    </li>


                    <!-- Informações do usuário -->
                    <li class="user-body">

                        <div class="row">

                            <div class="col-12">

                                <p class="mb-1">
                                    <strong>E-mail:</strong>
                                    {{ auth()->user()->email_usuarios }}
                                </p>

                                <p class="mb-1">
                                    <strong>Nível:</strong>
                                    {{ ucfirst(strtolower(auth()->user()->nivel_usuarios)) }}
                                </p>

                                <p class="mb-0">
                                    <strong>Status:</strong>

                                    @if (auth()->user()->status_usuarios === 'ATIVO')
                                        <span class="badge text-bg-success">
                                            Ativo
                                        </span>
                                    @else
                                        <span class="badge text-bg-danger">
                                            Inativo
                                        </span>
                                    @endif

                                </p>

                            </div>

                        </div>

                    </li>


                    <!-- Rodapé -->
                    <li class="user-footer">

                        <a href="{{ route('admin.perfil.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-person me-1"></i>
                            Perfil
                        </a>


                        <form action="{{ route('logout') }}" method="POST" class="d-inline float-end">

                            @csrf

                            <button type="submit" class="btn btn-outline-danger">

                                <i class="bi bi-box-arrow-right me-1"></i>
                                Sair

                            </button>

                        </form>

                    </li>

                </ul>

            </li>
            <!--end::User Menu Dropdown-->

          </ul>
          <!--end::End Navbar Links-->
        </div>
        <!--end::Container-->
      </nav>
