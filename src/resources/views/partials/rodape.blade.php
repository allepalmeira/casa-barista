<footer class="rodape">
    <!-- CONTEÚDO PRINCIPAL DO RODAPÉ -->
    <section class="site rodape-grid">

        <div class="coluna-end">
            <h3>Nosso Endereço</h3>
            <address>
                Av Marechal Tito, 1500<br>
                São Miguel Paulista
            </address>
            <a href="{{ route('home') }}">Mapa</a>
        </div>

        <div class="coluna-reserva">
            <div class="box-reserva">
                <h3>Faça sua reserva</h3>
                <div class="linha-box">
                    <hr>
                    <img src="{{ asset('barita/assets/coffee-footer.svg')}}" alt="Faça sua reserva">
                    <hr>
                </div>
                <ul>
                    <li>
                        <span>Segunda - Sexta</span>
                        <span>09:00 - 00:00</span>
                    </li>
                    <li>
                        <span>Sábado</span>
                        <span>08:00 - 00:00</span>
                    </li>
                    <li>
                        <span>Domingo</span>
                        <span>16:00 - 00:00</span>
                    </li>
                    <li>
                        <span>Feriado</span>
                        <span>16:00 - 02:00</span>
                    </li>
                </ul>
                <a href="{{ route('home') }}" class="btn">Reserva</a>
            </div>

            <div class="box-email">
                <p>Informe seu email para receber as novidades e promoções da Casa do Barista</p>
                <form action="{{ route('home') }}" method="post">
                    <label for="email">Inscreva-se</label>
                    <input type="email" name="email" id="email" placeholder="Informe seu email">
                    <button type="submit" aria-label="Enviar">
                        <img src="{{ asset('barista/assets/arrow.svg') }}" alt="Botão Enviar">
                    </button>
                </form>
            </div>
        </div>

        <div class="coluna-contato">
            <h3>Contate-nos</h3>

            <a class="link-contato" href="mailto:contato@email.com.br">contato@email.com.br</a>
            <a class="link-contato" href="tel:++5511999999888">(11)999-999-888</a>

            <!-- Rede Social  | ul>li*3>a>img -->
            <ul class="redeSocial">
                <li>
                    <a href="#" target="_blank">
                        <img src="{{ asset('barista/assets/facebook-24.png') }}" alt="Logo Facebook - Casa do Barista">
                    </a>
                </li>
                <li>
                    <a href="#" target="_blank">
                        <img src="{{ asset('barista/assets/instagram-24.png') }}" alt="Logo Instagram - Casa do Barista">
                    </a>
                </li>
                <li>
                    <a href="#" target="_blank">
                        <img src="{{ asset('barista/assets/linkedin-24.png') }}" alt="Logo LinkedIn - Casa do Barista">
                    </a>
                </li>
                <li>
                    <a href="https://wa.me/5511988662233?text=Ol%C3%A1%21%20Gostaria%20de%20falar%20com%20a%20Casa%20Do%20Barista%20%E2%98%95"
                        target="_blank">
                        <img src="{{ asset('barista/assets/whatsapp-24.png') }}" alt="Logo WhastApp - Casa do Barista">
                    </a>
                </li>
            </ul>

        </div>

    </section>

    <!-- BARRA FINAL -->
    <div class="barra-final">
        <p>©
            - Criado e Desenvolvido por TIPI06 - Senac SMP
        </p>
    </div>

</footer>