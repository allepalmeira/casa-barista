<!-- CONTEÚDO CONTATO -->
        <section class="contato">
            <h2>Casa do Barista</h2>
            <h3>
                
            </h3>
            <div class="site">

                <!-- TEXTO -->
                <div class="contato-txt">
                    <p>A Casa do Barista nasceu da vontade de unir pessoas através de algo simples e profundo: o ato de compartilhar uma xícara de café. </p>
                    <p> Acreditamos no poder das histórias que começam no campo, passam pelo barista e chegam até você em forma de aroma, sabor e sentimento. </p>
                    <p>Valorizamos pequenos produtores, técnicas artesanais e processos manuais que resgatam o verdadeiro significado do café brasileiro: riqueza cultural, dedicação e tradição.</p>
                    <div>
                        <div>
                            <div>
                                <h3>Nosso Endereço</h3>
                                <h4>Av Marechal Tito, 1500 <br> São Miguel Paulista</h4>
                            </div>
                            <div>
                                <h3>Nossos E-Mails</h3>
                                <a href="mailto:contato@email.com.br">contato@email.com.br</a>
                                <a href="mailto:atendimento@email.com.br">atendimento@email.com.br</a>
                            </div>
                        </div>

                        <div>
                            <div>
                                <h3>Nossos Telefones</h3>
                                <a href="tel:+5511999999888">(11) 999-999-888</a>
                                <a href="tel:+5511999888888">(11)999-888-888</a>
                            </div>
                            <div>
                                <h3>Siga-nos</h3>
                                <!-- Rede Social  -->
                                <ul class="redeSocial">
                                    <li>
                                        <a href="#" target="_blank">
                                            <img src="{{ asset('barista/img/facebook-24.png') }}" alt="Logo Facebook - Casa do Barista">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" target="_blank">
                                            <img src="{{ asset('barista/img/instagram-24.png') }}" alt="Logo Instagram - Casa do Barista">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" target="_blank">
                                            <img src="{{ asset('barista/img/linkedin-24.png') }}" alt="Logo LinkedIn - Casa do Barista">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://wa.me/5511988662233?text=Ol%C3%A1%21%20Gostaria%20de%20falar%20com%20a%20Casa%20Do%20Barista%20%E2%98%95"
                                            target="_blank">
                                            <img src="{{ asset('barista/img/whatsapp-24.png') }}" alt="Logo WhastApp - Casa do Barista">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FORM -->
                <div class="contato-form" id="formulario">

                    {{-- Retorno do envio (a mensagem chega no dashboard em "Mensagens") --}}
                    @if (session('sucesso'))
                        <p class="aviso-form aviso-sucesso" role="status">{{ session('sucesso') }}</p>
                    @endif

                    @if (session('erro'))
                        <p class="aviso-form aviso-erro" role="alert">{{ session('erro') }}</p>
                    @endif

                    @if ($errors->any())
                        <p class="aviso-form aviso-erro" role="alert">{{ $errors->first() }}</p>
                    @endif

                    <form action="{{ route('contato.store') }}" method="POST">

                        <div>
                            <input type="text" name="nome" placeholder="Nome Completo*: " maxlength="50" required
                                value="{{ old('nome') }}">
                        </div>
                        <div>
                            <input type="email" name="email" placeholder="E-mail*: " maxlength="80" required
                                value="{{ old('email') }}">
                        </div>

                        <div>
                            <div>
                                <input type="tel" name="fone" placeholder="Telefone: " maxlength="14"
                                    value="{{ old('fone') }}">
                            </div>
                            <div>
                                <select name="assunto" required>
                                    <option value="" disabled @selected(!old('assunto')) hidden>Selecione o assunto</option>
                                    @foreach ($assuntos as $assunto)
                                        <option value="{{ $assunto }}" @selected(old('assunto') === $assunto)>{{ $assunto }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div>
                            <textarea name="mens" cols="30" rows="10" placeholder="Digite sua mensagem" maxlength="2000" required>{{ old('mens') }}</textarea>
                        </div>
                        <div>
                            <button class="btn" type="submit">Enviar Mensagem</button>
                            <button class="btn" type="reset">Limpar</button>
                        </div>

                        {{-- Token no final: o CSS do formulário usa a posição dos campos (nth-child) --}}
                        @csrf

                    </form>



                </div>

            </div>
        </section>