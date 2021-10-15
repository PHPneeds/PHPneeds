<?php declare( strict_types=1 );

header( "Link:</assets/vendor/bootstrap/css/bootstrap.min.css>; rel=preload; as=style;x-http2-push-only", false );

header( "Link: </assets/images/logo_256x50.png>; rel=preload; as=image;x-http2-push-only", false );

header( "Link:</assets/vendor/bootstrap/js/bootstrap.min.js>; rel=preload; as=style;x-http2-push-only", false );
header( "Link: </assets/vendor/jquery/jquery-3.6.0.min.js>; rel=preload; as=script;x-http2-push-only", false );
