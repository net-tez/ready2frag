            </div>
		</div>
        <footer>
            <div class="container">
                <div class="content">
                    <div class="row">
                        <div class="col-sm-3">
                            <h2>About Us</h2>
                            <ul>
                                <li><a href="{{ link.pages.about.dc }}">Datacenter &amp; Network</a></li>
                                <li><a href="{{ link.pages.about.features }}">Features</a></li>
                                <li><a href="{{ link.pages.whmcs.ticket }}">Contact Us</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-3">
                            <h2>Services</h2>
                            <ul>
                                <li><a href="{{ link.pages.game_servers }}">Game Servers</a></li>
                                <li><a href="{{ link.pages.dedicated_servers }}">Dedicated Servers</a></li>
                                <li><a href="{{ link.pages.vps }}">Virtual Private Servers</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-3">
                            <h2>Clients</h2>
                            <ul>
                                <li><a href="{{ link.wmhcs.home }}">Billing Area</a></li>
                                <li><a href="{{ link.panel }}">Game Server Panel</a></li>
                                <li><a href="{{ link.panel }}">VPS Panel</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-3">
                            <h2>&nbsp;</h2>
                            <ul>
                                <li><a href="{{ link.pages.terms_of_service }}">Terms of Service</a></li>
                                <li><a href="{{ link.pages.privacy_policy }}">Privacy Policy</a></li>
                                <li><a href="{{ link.pages.whmcs.ticket }}">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row lastrow">
                        <div class="pull-left">
                            <a href="{{ link.pages.home }}" class="logo"></a>
                        </div>
                        <div class="pull-right">
                            <a href="{{ link.pages.home }}">Copyright 2014</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        
        <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.1/js/bootstrap.min.js"></script>
        <script src="//ready2frag.com/js/fit.js"></script>
        <script src="//ready2frag.com/js/ready2frag.js"></script>
        <script src="templates/{$template}/assets/whmcs/js/whmcs.js"></script>

		{$footeroutput}
	</body>
</html>
