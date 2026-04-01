<?php

function pixel_ebook_store_sanitize_on_off( $pixel_ebook_store_input ) {
	if ( true === $pixel_ebook_store_input ) {
		return true;
	} else {
		return false;
	}
}