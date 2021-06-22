</main>
        <footer>
            <div id="footer-top">
                <a href="/"><img src="{{ asset('assets/images/logo7.png') }}" alt="logo"></a>
                <div id="socialLinks">
                    <i class="fab fa-instagram"></i>
                    <i class="fab fa-facebook-square"></i>
                    <i class="fab fa-linkedin"></i>
                </div>
                <nav id="footer-nav">
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('browse') }}">Browse</a></li>
                        <li><a href="{{ route('author') }}">Contact</a></li>
                        <li><a href="{{ route('documentation') }}">Documentation</a></li>
                    </ul>
                </nav>
            </div>
            <div id="footer-bottom">
                <p>Napravio <a href="#">Aleksandar Stanković</a> 33/17, VISOKA ICT, 2020</p>
            </div>
        </footer>
    </div>

    <!--<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>
